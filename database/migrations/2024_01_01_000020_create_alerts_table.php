<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alerts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignUuid('location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->enum('type', ['low_stock', 'out_of_stock', 'expiry_soon', 'expired']);
            $table->enum('status', ['active', 'resolved'])->default('active');
            $table->text('message');
            $table->timestamp('triggered_at');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'status']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('alerts');
    }
};
