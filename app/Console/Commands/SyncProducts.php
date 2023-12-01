<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Cron ::: SyncProducts at ' . Carbon::now()->toDateTimeString());
        // Inserts new record from Backend to Strapi
//        Log::info('insert from af_backend DB to af_cms DB');
//        Log::info(DB::connection('mysql')->statement(
//            "INSERT INTO af_cms.products (name, sku, created_at, updated_at)
//                    select name, sku, created_at, updated_at
//                    FROM af_backend.products
//                    WHERE af_backend.products.sku
//                    NOT IN (
//                        select af_cms.products.sku
//                        from af_cms.products
//                        left join af_backend.products
//                        on af_cms.products.sku = af_backend.products.sku
//                        where af_backend.products.sku is not null
//                        )"
//        ));

        // Inserts new record from Strapi to Backend
//        Log::info('insert from af_cms DB to af_backend DB');
//        Log::info(DB::connection('mysql')->statement(
//            "INSERT INTO af_backend.products (name, sku, created_at, updated_at )
//                    select name, sku, created_at, updated_at
//                    FROM af_cms.products
//                    WHERE af_cms.products.sku
//                    NOT IN (
//                        select af_backend.products.sku
//                        from af_backend.products
//                        left join af_cms.products
//                        on af_cms.products.sku = af_backend.products.sku
//                         where af_cms.products.sku is not null
//                        )"
//        ));

//        Delete from two databases at same instance of time

//        DELETE af_backend.products, af_cms.products FROM af_backend.products, af_cms.products
//        WHERE af_cms.products.sku = 'product_1'
//        AND af_cms.products.sku = af_backend.products.sku


//        Log::info('Strapi DB');
//        Log::info(DB::connection('strapi_pgsql')->statement('select * from products'));

        // Update with the latest records from Backend to Strapi
        Log::info('update from af_backend DB to af_cms DB');
        Log::info(DB::connection('mysql')->statement(
            "UPDATE af_cms.products
                    SET af_cms.products.name = af_backend.products.name
                      , af_cms.products.sku = af_backend.products.sku
                      , af_cms.products.created_at = af_backend.products.created_at
                      , af_cms.products.updated_at = af_backend.products.updated_at
                    FROM af_backend.products
                    WHERE af_backend.products.sku
                    IN (
                        select af_cms.products.sku
                        from af_cms.products
                        left join af_backend.products
                        on af_cms.products.sku = af_backend.products.sku
                        where af_backend.products.sku is not null
                        and af_backend.products.created_at > af_cms.products.created_at
                        )"
        ));

        // Update with the latest records from Strapi to Backend
//        Log::info('update from af_cms DB to af_backend DB');
//        Log::info(DB::connection('mysql')->statement(
//            "UPDATE af_backend.products
//                    SET af_backend.products.name = af_cms.products.name
//                      , af_backend.products.sku = af_cms.products.sku
//                      , af_cms.products.created_at = af_backend.products.created_at
//                      , af_cms.products.updated_at = af_backend.products.updated_at
//                    FROM af_cms.products
//                    WHERE af_cms.products.created_at > af_backend.products.created_at
//                    AND af_cms.products.sku
//                    IN (
//                        select af_backend.products.sku
//                        from af_backend.products
//                        left join af_cms.products
//                        on af_cms.products.sku = af_backend.products.sku
//                         where af_cms.products.sku is not null
//                        )"
//        ));
    }
}
