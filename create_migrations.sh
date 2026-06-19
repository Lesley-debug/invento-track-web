#!/bin/bash
set -e

echo "================================================"
echo " Invento Track — Creating all 20 migrations"
echo "================================================"

# Remove default migrations we are replacing
rm -f database/migrations/0001_01_01_000000_create_users_table.php
rm -f database/migrations/0001_01_01_000001_create_cache_table.php
echo "✓ Removed default user & cache migrations"

# ─── 1. PLANS ────────────────────────────────────────
cat > database/migrations/2024_01_01_000001_create_plans_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->decimal('price_monthly', 10, 2)->default(0);
            $table->decimal('price_yearly', 10, 2)->default(0);
            $table->unsignedInteger('max_users')->default(2);
            $table->unsignedInteger('max_products')->default(500);
            $table->unsignedInteger('max_locations')->default(1);
            $table->boolean('has_api_access')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('plans');
    }
};
EOF
echo "✓ plans"

# ─── 2. TENANTS ──────────────────────────────────────
cat > database/migrations/2024_01_01_000002_create_tenants_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tenants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('plan_id')->constrained('plans')->onDelete('restrict');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo_url')->nullable();
            $table->string('currency', 10)->default('USD');
            $table->string('timezone')->default('UTC');
            $table->string('subscription_status')->default('trial');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tenants');
    }
};
EOF
echo "✓ tenants"

# ─── 3. USERS (replaces default) ─────────────────────
cat > database/migrations/2024_01_01_000003_create_users_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->nullable()->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['super_admin', 'admin', 'manager', 'staff'])->default('staff');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
EOF
echo "✓ users + password_reset_tokens + sessions"

# ─── 4. SUBSCRIPTIONS ────────────────────────────────
cat > database/migrations/2024_01_01_000004_create_subscriptions_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('plan_id')->constrained('plans')->onDelete('restrict');
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('status')->default('trialing');
            $table->timestamp('current_period_start')->nullable();
            $table->timestamp('current_period_end')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('subscriptions');
    }
};
EOF
echo "✓ subscriptions"

# ─── 5. CATEGORIES ───────────────────────────────────
cat > database/migrations/2024_01_01_000005_create_categories_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
EOF
echo "✓ categories"

# ─── 6. UNITS ────────────────────────────────────────
cat > database/migrations/2024_01_01_000006_create_units_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->string('abbreviation', 20);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('units');
    }
};
EOF
echo "✓ units"

# ─── 7. PRODUCTS ─────────────────────────────────────
cat > database/migrations/2024_01_01_000007_create_products_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignUuid('unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('cost_price', 15, 2)->default(0);
            $table->decimal('selling_price', 15, 2)->default(0);
            $table->unsignedInteger('min_stock')->default(0);
            $table->unsignedInteger('max_stock')->default(0);
            $table->boolean('track_expiry')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['tenant_id', 'sku']);
            $table->index(['tenant_id', 'barcode']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
EOF
echo "✓ products"

# ─── 8. LOCATIONS ────────────────────────────────────
cat > database/migrations/2024_01_01_000008_create_locations_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->string('type')->default('warehouse');
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('locations');
    }
};
EOF
echo "✓ locations"

# ─── 9. STOCK LEVELS ─────────────────────────────────
cat > database/migrations/2024_01_01_000009_create_stock_levels_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stock_levels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignUuid('location_id')->constrained('locations')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['product_id', 'location_id']);
            $table->index('tenant_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_levels');
    }
};
EOF
echo "✓ stock_levels"

# ─── 10. STOCK MOVEMENTS ─────────────────────────────
cat > database/migrations/2024_01_01_000010_create_stock_movements_table.php << 'EOF'
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
EOF
echo "✓ stock_movements"

# ─── 11. SUPPLIERS ───────────────────────────────────
cat > database/migrations/2024_01_01_000011_create_suppliers_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('suppliers');
    }
};
EOF
echo "✓ suppliers"

# ─── 12. PURCHASE ORDERS ─────────────────────────────
cat > database/migrations/2024_01_01_000012_create_purchase_orders_table.php << 'EOF'
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
EOF
echo "✓ purchase_orders"

# ─── 13. PO ITEMS ────────────────────────────────────
cat > database/migrations/2024_01_01_000013_create_po_items_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('po_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('restrict');
            $table->unsignedInteger('quantity_ordered');
            $table->unsignedInteger('quantity_received')->default(0);
            $table->decimal('unit_cost', 15, 2);
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('po_items');
    }
};
EOF
echo "✓ po_items"

# ─── 14. CUSTOMERS ───────────────────────────────────
cat > database/migrations/2024_01_01_000014_create_customers_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('customers');
    }
};
EOF
echo "✓ customers"

# ─── 15. TAX RATES ───────────────────────────────────
cat > database/migrations/2024_01_01_000015_create_tax_rates_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->string('name');
            $table->decimal('rate', 5, 2);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tax_rates');
    }
};
EOF
echo "✓ tax_rates"

# ─── 16. SALES ORDERS ────────────────────────────────
cat > database/migrations/2024_01_01_000016_create_sales_orders_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignUuid('location_id')->constrained('locations')->onDelete('restrict');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignUuid('tax_rate_id')->nullable()->constrained('tax_rates')->onDelete('set null');
            $table->string('order_number')->unique();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('sales_orders');
    }
};
EOF
echo "✓ sales_orders"

# ─── 17. SALE ITEMS ──────────────────────────────────
cat > database/migrations/2024_01_01_000017_create_sale_items_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sales_order_id')->constrained('sales_orders')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('restrict');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 15, 2);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_price', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sale_items');
    }
};
EOF
echo "✓ sale_items"

# ─── 18. INVOICES ────────────────────────────────────
cat > database/migrations/2024_01_01_000018_create_invoices_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('sales_order_id')->constrained('sales_orders')->onDelete('restrict');
            $table->foreignUuid('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->string('invoice_number')->unique();
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'cancelled'])->default('draft');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('invoices');
    }
};
EOF
echo "✓ invoices"

# ─── 19. PAYMENTS ────────────────────────────────────
cat > database/migrations/2024_01_01_000019_create_payments_table.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignUuid('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('restrict');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method')->default('cash');
            $table->string('reference_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('paid_at');
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
EOF
echo "✓ payments"

# ─── 20. ALERTS ──────────────────────────────────────
cat > database/migrations/2024_01_01_000020_create_alerts_table.php << 'EOF'
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
EOF
echo "✓ alerts"

echo ""
echo "================================================"
echo " All 20 migrations created successfully!"
echo " Now run: php artisan migrate"
echo "================================================"
