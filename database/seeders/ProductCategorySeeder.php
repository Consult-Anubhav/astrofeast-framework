<?php

namespace Database\Seeders;

use App\Models\Integration;
use App\Models\MasterProduct;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanilo\Category\Models\Taxon;
use Vanilo\Category\Models\Taxonomy;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed product category taxonomies
        $categories = [
            'childrens' => [[
                'title' => 'Beverages',
                'childrens' => [[
                    'title' => 'Water'
                ], [
                    'title' => 'Cofee'
                ], [
                    'title' => 'Tea',
                    'childrens' => [[
                        'title' => 'Black Tea'
                    ], [
                        'title' => 'White Tea'
                    ], [
                        'title' => 'Green Tea',
                        'childrens' => [[
                            'title' => 'Sencha'
                        ], [
                            'title' => 'Gyokuro'
                        ], [
                            'title' => 'Matcha'
                        ], [
                            'title' => 'Pi Lo Chun'
                        ]]
                    ]]
                ]]
            ], [
                'title' => 'Beverages 2',
                'childrens' => [[
                    'title' => 'Child',
                    'childrens' => [[
                        'title' => 'Child'
                    ]]
                ]]
            ], [
                'title' => 'Beverages 3',
                'childrens' => [[
                    'title' => 'Child'
                ]]
            ], [
                'title' => 'Beverages 4'
            ]]
        ];

        $category = Taxonomy::create(['name' => 'Category']);
        self::createTaxon($categories, null, $category->id);

        // Seed test integraitons
        $integrations = array(
            array('integration_name' => 'SERVICE0', 'code' => 'SENDER ID 1', 'value' => 'ESHPHL', 'sort_order' => '1', 'test' => '0'),
            array('integration_name' => 'SERVICE0', 'code' => 'MESSAGE REQUEST ACCEPTED WEIGHT', 'value' => '2', 'sort_order' => '2', 'test' => '0')
        );

        foreach ($integrations as $field)
        {
            Integration::updateOrCreate([
                'integration_name' => $field['integration_name'],
                'code' => $field['code']
            ],[
                'value' => isset($field['value']) ? $field['value'] : '',
                'sort_order' => isset($field['sort_order']) ? $field['sort_order'] : 0,
                'test' => isset($field['test']) ? $field['test'] : 0,
            ]);
        }

        $product = MasterProduct::create([
            'name' => 'Pazolini',
            'original_price' => 79.99,
            'price' => 79.99,
            'publish_date' => Carbon::now()->format('Y-m-d'),
            'state' => 'draft',
            'excerpt' => 'Slip-on shoes with Sparkles',
            'meta_title' => 'This is black tea category product',
            'meta_description' => 'lknzjkn,mcz knjsn,nc loren ipsum njkns,zmx hjknkasff olinjlfksn,d lkvnsdn jkha,jf jkbs nzbjc qwdnnak.s fnm,a',
            'meta_keywords' => 'bla bla, nice product, black tea, more love',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        $product->createVariant([
            'name' => 'Pazolini 36',
            'original_price' => 79.99,
            'price' => 79.99,
            'publish_date' => Carbon::now()->format('Y-m-d'),
            'state' => 'draft',
            'sku' => 'PZLBL-036',
            'stock' => 2,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        $product->createVariant([
            'name' => 'Pazolini 37',
            'original_price' => 79.99,
            'price' => 79.99,
            'publish_date' => Carbon::now()->format('Y-m-d'),
            'state' => 'draft',
            'sku' => 'PZLBL-037',
            'stock' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        $category = \Vanilo\Foundation\Models\Taxonomy::findOneBySlug('category');
        $smartphones = \Vanilo\Foundation\Models\Taxon::create([
            'taxonomy_id' => $category->id,
            'name' => 'Smartphones'
        ]);

        $product = MasterProduct::findBySlug('pazolini');
        $taxon1 = Taxon::findBySlug('smartphones');
        $taxon2 = Taxon::findBySlug('black-tea');
        $product->addTaxons([$taxon1, $taxon2]);

        //
        $product_keywords = [
            "Blue running shoes",
            "Men's athletic shoes",
            "Running sneakers",
            "Sports footwear",
            "Jogging shoes",
            "Men's running gear",
            "Athletic footwear",
            "Comfortable sneakers",
            "Performance running shoes",
            "Exercise shoes",
            "Outdoor running shoes",
            "Men's shoe sizes",
            "Running shoe reviews",
            "Breathable sneakers",
            "Affordable sports shoes",
            "Cushioned running shoes",
            "Lightweight athletic shoes",
            "Fitness footwear",
            "Best running shoes",
            "Durable sports shoes"
        ];

        foreach ($product_keywords as $keyword)
        {
            DB::table('meta_keywords')->insert(
                array(
                    'keyword'   =>   $keyword
                )
            );
        }

    }

    public function createTaxon($object, $parent_id, $taxonomy_id)
    {
        if (isset($object['title'])) {
            $node = Taxon::create([
                'taxonomy_id' => $taxonomy_id,
                'parent_id' => $parent_id,
                'name' => $object['title']
            ]);
            $parent_id = $node->id;
        }
        if (isset($object['childrens']))
            foreach ($object['childrens'] as $child) {
                self::createTaxon($child, $parent_id, $taxonomy_id);
            }
    }
}
