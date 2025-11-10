<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;
use App\Models\Products;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_state');
            $table->string('customer_city');
            $table->text('shipping_address');
            $table->decimal('total_price', 8, 2);
            $table->decimal('shipping_fee', 8, 2);
            $table->string('reference')->unique();
            $table->enum('order_status', ['processing', 'confirmed', 'cancelled', 'delivered', 'shipped', 'refunded']);
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('product_name'); // In case product is deleted
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 8, 2);
            $table->decimal('discount_at_purchase', 8, 2)->nullable();
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['bank_transfer', 'card', 'paystack', 'flutterwave']);
            $table->string('transaction_id');
            $table->decimal('amount', 8, 2);
            $table->enum('status', ['pending', 'paid', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('payments');
    }
};
