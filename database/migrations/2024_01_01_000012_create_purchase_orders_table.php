<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('supplier_id')->constrained('suppliers')->onDelete('restrict');
            $table->foreignUuid('location_id')->constrained('locations')->onDelete('restrict');
            $table->foreignUuid('created_by')->constrained('users')->onDelete('restrict');
            $table->string('po_number')->unique();
            $table->enum('status', ['draft', 'sent', 'partial', 'received', 'cancelled'])->default('draft');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->date('expected_date')->nullable();
            $table->date('received_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('purchase_orders');
    }
};
