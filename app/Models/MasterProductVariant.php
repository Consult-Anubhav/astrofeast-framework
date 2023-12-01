<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Vanilo\Foundation\Models\MasterProductVariant as BaseProductVariant;

class MasterProductVariant extends BaseProductVariant
//    implements HasMedia
{
//    use InteractsWithMedia;

    // Object Functions
    public function countMediaByIdAndCollection($media_collection_name)
    {
        return Media::where('model_id', $this->id)
            ->where('collection_name', $media_collection_name)
            ->where('model_type', MasterProductVariant::class)
            ->count();
    }

//    public function getMediaByIdAndCollection($media_collection_name)
//    {
//        return Media::where('model_id', $this->id)
//            ->where('collection_name', $media_collection_name)
//            ->where('model_type', MasterProductVariant::class)
//            ->get();
//    }

    // Static FUnctions
    public static function getDetailsBySku($sku)
    {
        $product = MasterProductVariant::where('sku', '=', $sku)
//            ->leftJoin('media', 'media.id', '=', 'master_product_variants.default_media_id')
            ->select(
                'master_product_variants.*',
                DB::raw("DATE_FORMAT(STR_TO_DATE(master_product_variants.publish_date, '%Y-%m-%d %H:%i:%s'),'%d-%m-%Y') as publish_date"),
                DB::raw("IF(master_product_variants.state = 'draft', -1,IF(master_product_variants.state = 'schedule', 0, 1)) as is_published"),
//                DB::raw("CONCAT('".env('APP_URL')."','/storage/',media.id,'/',media.file_name) as default_media")
            )
            ->first();

        $product->getMedia('images');

        $master_product = MasterProduct::find($product->master_product_id);

        $master_product->getMedia('images');

        $product->master_product_ = $master_product;

        return $product;
    }
}
