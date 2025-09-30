<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Brand;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->decimal('discount_price', 8,2 )->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->string('img_path', 255)->nullable();
            $table->string('color', 50)->nullable();
            $table->enum('storage', ['64', '128', '256', '512']);
            $table->string('availability_status', 20)->default('In Stock');
            $table->string('category', 100);
            $table->boolean('stock_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
