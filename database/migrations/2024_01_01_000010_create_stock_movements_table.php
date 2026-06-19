<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignUuid('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('restrict');
            $table->uuid('reference_id')->nullable();
            $table->string('reference_type')->nullable();
            $table->enum('type', ['in', 'out', 'adjustment', 'transfer_in', 'transfer_out']);
            $table->integer('quantity');
            $table->decimal('unit_cost', 15, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'product_id']);
            $table->index(['reference_id', 'reference_type']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_movements');
    }
};
