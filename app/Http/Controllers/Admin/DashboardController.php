<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rules\File;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Basic KPIs
        $orderCount  = Order::count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $avgOrder = $totalRevenue / max($orderCount, 1);
        // $newCustomer = Payment::where('status', 'paid')->distinct('user_id')->count('user_id');

        // Accept optional start/end query params (YYYY-MM-DD). Defaults: last 30 days.
        $start = $request->input('start') ? Carbon::parse($request->input('start'))->startOfDay() : Carbon::now()->subDays(30)->startOfDay();
        $end = $request->input('end') ? Carbon::parse($request->input('end'))->endOfDay() : Carbon::now()->endOfDay();

        // Count new purchasers = users whose first paid payment happened in the window.
        $sub = DB::table('payments as p')
            ->join('orders as o', 'p.order_id', '=', 'o.id')
            ->where('p.status', 'paid')
            ->whereNotNull('o.user_id')
            ->select('o.user_id', DB::raw('MIN(p.created_at) as first_paid_at'))
            ->groupBy('o.user_id');

        $newCustomer = DB::table(DB::raw("({$sub->toSql()}) as t"))
            ->mergeBindings($sub)
            ->whereBetween('first_paid_at', [$start, $end])
            ->count();

        $bestSellers = DB::table('order_items as oi')
            ->join('orders as o', 'oi.order_id', '=', 'o.id')
            ->select(
                'oi.product_id',
                'oi.product_name',
                DB::raw('SUM(oi.quantity) as total_quantity'),
                DB::raw('SUM(oi.quantity * oi.price_at_purchase) as total_sales')
            )
            ->groupBy('oi.product_id', 'oi.product_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('admin.index', compact('orderCount', 'totalRevenue', 'avgOrder', 'newCustomer', 'start', 'end', 'bestSellers'));
    }
    public function showManageProducts()
    {
        $products = Products::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.manage_products', compact('products'));
    }
    public function searchProducts(Request $request)
    {
        $query = $request->input('query');

        $products = Products::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('storage', 'LIKE', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Preserve the search query on pagination links
        $products->appends($request->only('query'));

        return view('admin.search_products', compact('products', 'query'));
    }
    public function showAddProducts()
    {
        $products = Products::orderBy('created_at', 'desc')->paginate(10);
        // Load brands for the brand select in the form
        $brands = Brand::orderBy('name')->get();
        return view('admin.add_new_products', compact('brands', 'products'));
    }
    public function showCustomerOrders()
    {
        $status = request()->query('status');
        $orders = Order::when($status, function ($query, $status) {
            return $query->where('order_status', $status);
        })
            ->orderBy('created_at', 'desc')->paginate(15);




        return view('admin.customer_orders', compact('orders', 'status'));
    }
    public function storeProduct(Request $request)
    {
        try {
            $data = request()->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'price_discount' => 'nullable|numeric|min:0',
                'brand_id' => 'required|exists:brands,id',
                'storage' => 'nullable|numeric',
                'quantity' => 'required|integer|min:0',
                'color' => 'nullable|string|max:100',
                'availability_status' => 'nullable|string|max:100',
                'category' => 'nullable|string|max:100',
                'img_path' => ['required', File::types(['png', 'jpg', 'svg', 'webp'])],  // max 2MB
            ]);
            if (request()->hasFile('img_path')) {
                $file = request()->file('img_path');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('products', $filename, 'public');
                $data['img_path'] = '/storage/' . $filePath;
            }
            // Provide sensible defaults for fields not present in the form
            // $data['category'] = $data['category'] ?? 'Uncategorized';
            // $data['availability_status'] = $data['availability_status'] ?? 'In Stock';
            // $data['stock_status'] = ($data['quantity'] ?? 0) > 0;

            // // Map form fields to DB columns and create the product
            // $product = Products::create([
            //     'brand_id' => $data['brand_id'],
            //     'name' => $data['name'],
            //     'description' => $data['description'] ?? '',
            //     'price' => $data['price'],
            //     'discount_price' => $data['discount_price'] ?? null,
            //     'quantity' => $data['quantity'],
            //     'img_path' => $data['img_path'] ?? null,
            //     'color' => $data['color'] ?? null,
            //     'storage' => $data['storage'],
            //     'availability_status' => $data['availability_status'],
            //     'category' => $data['category'],
            //     'stock_status' => $data['stock_status'],
            // ]);

            $product = Products::create($data);
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error adding the product: ' . $e->getMessage());
        }

        return redirect()->route('add.products')->with('success', 'New Product added successfully!');
    }
    public function showUpdateProduct($id)
    {
        $product = Products::findOrFail($id);
        $brands = Brand::orderBy('name')->get();
        return view('admin.update_product', compact('product', 'brands'));
    }
    public function updateProduct(Request $request, $id)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_discount' => 'nullable|numeric|min:0',
            'brand_id' => 'required|exists:brands,id',
            'storage' => 'nullable|numeric',
            'quantity' => 'required|integer|min:0',
            'color' => 'nullable|string|max:100',
            'availability_status' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'img_path' => ['nullable', File::types(['png', 'jpg', 'svg', 'webp'])],  // max 2MB
        ]);
        if (request()->hasFile('img_path')) {
            $file = request()->file('img_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('products', $filename, 'public');
            $data['img_path'] = '/storage/' . $filePath;
        }
        // Ensure we have a product id (use the parameter when available, otherwise try route or input)
        $prodId = $id ?? request()->route('id') ?? request()->input('id');
        if (!$prodId) {
            abort(404);
        }
        $product = Products::findOrFail($prodId);
        $product->update($data);
        return redirect()->route('manage.products')->with('success', 'Product updated successfully!');
    }
    public function destroyProduct($id) {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->route('manage.products')->with('success', 'Product deleted successfully!');
    }
    public function showCustomerDetails($user_id = null)
    {
        // Support passing user_id as parameter OR via route/request
        $user_id = $user_id ?? request()->route('user_id') ?? request()->input('user_id');
        if (!$user_id) {
            abort(404);
        }

        // Load the user or fail
        $user = User::findOrFail($user_id);

        // Paginate orders for this user (for listing)
        $orders = Order::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Summary stats for this user (aggregate values)
        $summary = DB::table('orders')
            ->where('user_id', $user_id)
            ->select(
                DB::raw('SUM(total_price) as total_spent'),
                DB::raw('COUNT(id) as order_count'),
                DB::raw('MAX(created_at) as last_order_at')
            )
            ->first();

        return view('admin.customer_details', compact('user', 'orders', 'summary'));
    }
    public function searchOrdersByID(Request $request)
    {
        $query = request()->input('query');
        $status = request()->query('status');

        $query = trim((string) $query);

        // Build a query that matches order id (exact when numeric) or other text fields
        $ordersQuery = Order::query();
        if ($status) {
            $ordersQuery->where('order_status', $status);
        }

        // apply search query if provided
        if ($query !== '') {
            // If the query is purely numeric, prefer an exact id lookup (more reliable).
            if (is_numeric($query)) {
                $ordersQuery->where('id', (int) $query);
            } else {
                // text searches across several columns (created_at included as text fallback)
                $ordersQuery->where(function ($q) use ($query) {
                    $q->where('customer_email', 'LIKE', "%{$query}%")
                        ->orWhere('customer_phone', 'LIKE', "%{$query}%")
                        ->orWhere('order_status', 'LIKE', "%{$query}%");
                });
            }
        }

        // Order and paginate results (customer_orders expects a paginator)
        $orders = $ordersQuery->orderBy('created_at', 'desc')->paginate(15);

        // Preserve query and status on pagination links
        $orders->appends(request()->only('query', 'status'));

        return view('admin.customer_orders', compact('orders', 'query', 'status'));
    }
    public function showBrands()
    {
        return view('admin.brand_category');
    }

    public function showBilling()
    {
        return view('admin.billing');
    }
    public function showProfile()
    {
        return view('admin.profile');
    }
    public function showSettings()
    {
        return view('admin.settings');
    }
}
