<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Vanilo\MasterProduct\Contracts\MasterProduct as InterfaceBaseProduct;
use Vanilo\Foundation\Models\MasterProduct as BaseProduct;

class MasterProduct extends BaseProduct implements InterfaceBaseProduct
//    , HasMedia
{
//    use InteractsWithMedia;

    // Object Functions
    public function countMediaByIdAndCollection($media_collection_name)
    {
        return Media::where('model_id', $this->id)
            ->where('collection_name', $media_collection_name)
            ->where('model_type', MasterProduct::class)
            ->count();
    }

//    public function getMediaByIdAndCollection($media_collection_name)
//    {
//        return Media::where('model_id', $this->id)
//            ->where('collection_name', $media_collection_name)
//            ->where('model_type', MasterProduct::class)
//            ->get();
//    }

    // Static FUnctions
    public static function getFilteredList($filters)
    {
        return MasterProduct::leftJoin('master_product_variants', 'master_product_variants.master_product_id', '=', 'master_products.id')
            ->leftJoin('media', 'media.id', '=', 'master_products.default_media_id')
            ->select(
                DB::raw("CAST(SUM(master_product_variants.stock) AS float) as master_stock"),
                DB::raw("COUNT(master_product_variants.stock) as variants_count"),
                DB::raw("SUM(master_product_variants.units_preorder) as master_units_preorder"),
                DB::raw("SUM(master_product_variants.units_backorder) as master_units_backorder"),
                DB::raw("SUM(master_product_variants.units_sold) as master_units_sold"),
                DB::raw("CONCAT('" . env('APP_URL') . "','/storage/',media.id,'/',media.file_name) as default_media"),
                'master_products.*'
            )
            ->groupBy('master_products.id')
            ->get();
    }

    public static function getDetailsBySlug($slug)
    {
        $product = MasterProduct::where('slug', '=', $slug)
//            ->leftJoin('media', 'media.id', '=', 'master_products.default_media_id')
            ->select(
                'master_products.*',
                DB::raw("DATE_FORMAT(STR_TO_DATE(master_products.publish_date, '%Y-%m-%d %H:%i:%s'),'%d-%m-%Y') as publish_date"),
                DB::raw("IF(master_products.state = 'draft', -1,IF(master_products.state = 'schedule', 0, 1)) as is_published"),
//                DB::raw("CONCAT('".env('APP_URL')."','/storage/',media.id,'/',media.file_name) as default_media")
            )
            ->first();

        $product->variants = self::getProductVariants($product->id);
        $product->categories = self::getProductCategories($product->id);
        $product->getMedia('images');

        return $product;
    }

    public static function getProductVariants($product_id)
    {
        return DB::table('master_product_variants')
            ->leftJoin('media', 'media.id', '=', 'master_product_variants.default_media_id')
            ->where('master_product_id', '=', $product_id)
            ->select(
                'master_product_variants.*',
                DB::raw("CONCAT('" . env('APP_URL') . "','/storage/',media.id,'/',media.file_name) as default_media")
            )
            ->get();
    }

    public static function getProductCategories($product_id)
    {
        return DB::table('model_taxons')
            ->leftJoin('taxons', 'taxons.id', '=', 'model_taxons.taxon_id')
            ->where('model_type', '=', MasterProduct::class)
            ->where('model_id', '=', $product_id)
            ->select('taxons.id', 'taxons.name')
            ->get();
    }

    public static function deleteProductCategory($product_id, $product_category_id)
    {
        return DB::table('model_taxons')
            ->where('model_type', '=', MasterProduct::class)
            ->where('model_id', '=', $product_id)
            ->where('taxon_id', '=', $product_category_id)
            ->delete();
    }

    public static function addProductCategory($product_id, $product_category)
    {
        $taxon = DB::table('taxons')
            ->where('taxonomy_id', '=', 1)
            ->where('name', '=', $product_category)
            ->first();

        if ($taxon)
            $taxon_id = $taxon->id;
        else
            $taxon_id = DB::table('taxons')
                ->insert([
                    'taxonomy_id' => 1,
                    'name' => $product_category
                ]);

        return DB::table('model_taxons')
            ->updateOrInsert([
                'model_id' => $product_id,
                'model_type' => MasterProduct::class,
                'taxon_id' => $taxon_id,
            ], []);
    }

    public static function getDetailsById($id)
    {
        $product = MasterProduct::where('id', '=', $id)
            ->select(
                'master_products.name',
                'master_products.slug',
                'master_products.state',
            )
            ->first();

        $product->getMedia('images');

        return $product;
    }
}
