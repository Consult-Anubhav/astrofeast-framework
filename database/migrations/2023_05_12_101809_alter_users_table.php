<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('dark_mode')->default(0)->after('is_active');
            $table->boolean('is_admin')->default(0)->after('is_active');
            $table->string('google_id', 255)->nullable()->after('is_active');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('title');
            $table->tinyInteger('level')->unsigned()->default(1);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->tinyInteger('user_id')->unsigned();
            $table->tinyInteger('role_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('module_permissions', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->tinyInteger('module_id')->unsigned();
            $table->tinyInteger('role_id')->unsigned();
            $table->boolean('read')->default(1);
            $table->boolean('write')->default(0);
            $table->boolean('delete')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('integration', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->tinyInteger('sort_order')->unsigned();
            $table->string('integration_name');
            $table->string('code');
            $table->string('value')->nullable();
            $table->boolean('test')->default(1);
            $table->timestamps();
        });

        Schema::create('meta_keywords', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('keyword', 50);
            $table->timestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->string('address_line_2')->nullable()->after('address');
        });

        Schema::dropIfExists('products');

        Schema::table('master_products', function (Blueprint $table) {
            $table->bigInteger('default_media_id')->nullable()->after('slug');
            $table->string('meta_title', 255)->nullable()->after('meta_keywords');
            $table->boolean('stock_management')->default(1);
            $table->dateTime('publish_date')->nullable()->after('deleted_at');
            $table->timestamp('publish_timestamp')->nullable()->after('created_at');
        });

        Schema::table('master_product_variants', function (Blueprint $table) {
            $table->string('sku', 255)->unique()->change();
            $table->bigInteger('default_media_id')->nullable()->after('sku');
            $table->dateTime('publish_date')->nullable()->after('deleted_at');
            $table->timestamp('publish_timestamp')->nullable()->after('created_at');
            $table->float('units_sold', 15, 4)->default(0)->after('stock')->change();
            $table->float('units_backorder', 15, 4)->default(0)->after('stock');
            $table->float('units_preorder', 15, 4)->default(0)->after('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
