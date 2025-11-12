<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        return view('admin.add_new_products');
    }
    public function showCustomerOrders()
    {
        $status = request()->query('status');
        $orders = Order::when($status, function ($query, $status) {
            return $query->where('order_status', $status);
        })
            ->orderBy('created_at', 'desc')->paginate(15);
        // $orders = Order::orderBy('created_at', 'desc')->paginate(15);
        // $orderProcessing = Order::where('order_status', 'processing')
        // ->orderBy('created_at', 'desc')->paginate(15);
        // $orderConfirmed = Order::where('order_status', 'confirmed')
        // ->orderBy('created_at', 'desc')->paginate(15);
        // $orderShipped = Order::where('order_status', 'shipped')
        // ->orderBy('created_at', 'desc')->paginate(15);
        // $orderDelivered = Order::where('order_status', 'delivered')
        // ->orderBy('created_at', 'desc')->paginate(15);
        // $orderCancelled = Order::where('order_status', 'cancelled')
        // ->orderBy('created_at', 'desc')->paginate(15);


        return view('admin.customer_orders', compact('orders', 'status'));
    }
    public function showCustomerDetails($user_id)
    {
        // Load the user or fail
        $user = User::findOrFail($user_id);

        // Paginate orders for this user
        $orders = Order::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.customer_details', compact('user', 'orders'));
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
