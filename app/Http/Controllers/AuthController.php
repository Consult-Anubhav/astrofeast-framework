<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\MasterProductVariant;
use App\Models\MetaKeyword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Konekt\User\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Vanilo\Foundation\Models\Taxon;
use Vanilo\Foundation\Models\Taxonomy;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index API Functions
    public function indexDashboard()
    {
        return view('portal.dashboard');
    }

    public function indexOrders()
    {
        return view('portal.orders');
    }

    public function indexPayments()
    {
        return view('portal.payments');
    }

    public function indexNotifications()
    {
        return view('portal.notifications');
    }

    public function indexCategories()
    {
        return view('portal.categories');
    }

    public function indexCategory()
    {
        return view('portal.childs.category');
    }

    public function indexProducts()
    {
//        Product::create([
//            'name'             => 'Maxi Baxi 2000',
//            'sku'              => 'MXB-2000',
//            'stock'            => 123.4567,
//            'price'            => 1999.95,
//            'slug'             => 'maxi-baxi-2000',
//            'excerpt'          => 'Maxi Baxi 2000 is the THING you always have dreamt of',
//            'description'      => 'Maxi Baxi 2000 makes your dreams come true. See: https://youtu.be/5RKM_VLEbOc',
//            'state'            => 'active',
//            'meta_keywords'    => 'maxi, baxi, dreams',
//            'meta_description' => 'The THING you always have dreamt of'
//        ]);

//        $product = Product::create([
//            'name'   => 'Mesh Panel Toning Trainers',
//            'sku'    => 'LS-170161',
//            'price'  => 34.99,
//            'weight' => 9
//        ]);

//        $product = MasterProduct::create(['name' => 'Pazolini', 'price' => 79.99, 'excerpt' => 'Slip-on shoes with Sparkles']);
//        $product->assignPropertyValues(['for' => 'women', 'brand' => 'Pazolini', 'shoe-type' => 'Loafers', 'shoes-size' => '']);
//        $product->createVariant(['properties' => ['shoe-size' => 36], 'sku' => 'PZLBL-036', 'stock' => 0]);
////        $product->createVariant(['properties' => ['shoe-size' => 37], 'sku' => 'PZLBL-037', 'stock' => 1]);
//        $product->createVariant(['sku' => 'PZLBL-036', 'stock' => 0]);
//        $product->createVariant(['sku' => 'PZLBL-037', 'stock' => 1]);
//
//        $category = Taxonomy::findOneBySlug('category');
//        $smartphones = Taxon::create([
//            'taxonomy_id' => $category->id,
//            'name' => 'Smartphones'
//        ]);
//
//        $product = MasterProduct::findBySlug('pazolini');
//        $taxon1 = Taxon::findBySlug('smartphones');
//        $taxon2 = Taxon::findBySlug('black-tea');
//        $product->addTaxons([$taxon1, $taxon2]);
//        $taxon1->addProduct($product);
//        $cart = new CartManager();
//        $cart = new Cart();
//        $cart->create();
//        $product = Product::findBySku('MXB-2000');
//        $product = MasterProductVariant::findBySku('PZLBL-036');

//        if ($product)
//            $cart->addItem($product);
//        $product = \Vanilo\Product\Models\Product::findBySku('MXB-2000');
//        session()->remove('cart');
//        var_dump($cart->exists());
//        var_dump(session()->has('cart'));
//        var_dump($product);
//        var_dump($cart->exists());
//        $cart->removeItem(0);
//        session()->put('sachin','bhoi00');
//        session()->save();
//        $product = Product::find(6);
//        $cart->removeProduct($product);
//        return $cart->getItems();
//        return session()->all();

        return view('portal.products');
    }

    public function indexProduct()
    {
        return view('portal.childs.product');
    }

    public function indexProductVariant()
    {
        return view('portal.childs.product_variant');
    }

    public function indexPricings()
    {
        return view('portal.pricing');
    }

    public function indexDiscounts()
    {
        return view('portal.discounts');
    }

    public function indexCustomers()
    {
        return view('portal.customers');
    }

    // List APIs
    public function getUser(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->first();

        if (isset($request->dark_mode) && $request->dark_mode == 'toggle' && $user) {
            $user->dark_mode = !$user->dark_mode;
            $user->save();
        }

        return $user;
    }

    public function getListCategories()
    {
        $category = Taxonomy::findOneByName('Category');
        $taxons = Taxon::byTaxonomy($category)->get();

        return $taxons;
    }

    public function getListProducts(Request $request)
    {
        $filters = [];

        if (isset($request->filters))
            $filters = $request->filters;

        $products = MasterProduct::getFilteredList($filters);

        return $products;
    }

    public function getDetailsProduct(Request $request)
    {
        if (isset($request->slug)) {
            $slug = $request->slug;

            return MasterProduct::getDetailsBySlug($slug);
        }

        return response([
            'status' => 200,
            'errors' => ["Product slug not provided."]
        ], 200);
    }

    public function getDetailsProductVariant(Request $request)
    {
        if (isset($request->slug) && isset($request->sku)) {
            $slug = $request->slug;
            $sku = $request->sku;

            return MasterProductVariant::getDetailsBySku($sku);
        }

        return response([
            'status' => 200,
            'errors' => ["Product slug or sku not provided."]
        ], 200);
    }

    // CRUD API Functions
    public function actionDetailsProduct(Request $request)
    {
        $data = $request->get('data');
        $for_what = $request->get('for_what');

        if ($for_what == 'update') {
            $for_section = $request->get('for_section');
            $product = MasterProduct::find($data['id']);

            if ($for_section == 'basic_info') {

                // Validation : basic info

                $product->name = $data['name'];
                $product->slug = $data['slug'];
                $product->description = $data['description'] ?? null;
                $product_categories = $data['categories'] ?? [];

                // categories
                $category_arr_inputs_ids = [];
                $category_arr_inputs_new_values = [];
                $category_arr_existing = MasterProduct::getProductCategories($product->id);

                foreach ($product_categories as $category) {
                    if (isset($category['id']))
                        $category_arr_inputs_ids[] = $category['id'];
                    else
                        $category_arr_inputs_new_values[] = $category['name'];
                }

                foreach ($category_arr_existing as $category) {
//                    dd(['cat' => $category ,'ids' => $category_arr_inputs_ids]);
                    if (!in_array($category->id,$category_arr_inputs_ids)) {
                        MasterProduct::deleteProductCategory($product->id, $category->id);
                    }
                }

                foreach ($category_arr_inputs_new_values as $category) {
                    MasterProduct::addProductCategory($product->id, $category);
                }

            } elseif ($for_section == 'state') {
                if ($data['state'] == 'schedule')
                    $product->publish_date = Carbon::createFromFormat('d-m-Y', $data['next_publish_date'])->format('Y-m-d');
                else
                    $product->state = $data['state'] ?? 'draft';

            } elseif ($for_section == 'seo') {
                $product->meta_title = $data['meta_title'] ?? null;
                $product->meta_keywords = $data['meta_keywords'] ?? null;
                $product->meta_description = $data['meta_description'] ?? null;
                $meta_keywords = explode(',',$product->meta_keywords);
                foreach ($meta_keywords as $meta_keyword)
                    MetaKeyword::updateOrCreate(['keyword'=>$meta_keyword],['keyword'=>$meta_keyword]);

            } elseif ($for_section == 'inventory') {
                //
            } elseif ($for_section == 'add_category') {
                //
            } elseif ($for_section == 'add_seo_keyword') {
                //
            } elseif ($for_section == 'set_default_media') {
                $media_id = $request->get('id');
                $product->default_media_id = $media_id;
            } else {
                return response()->json([
                    'messages' => ["Missing or invalid inputs provided."],
                    'status' => 200
                ], 200);
            }

            $product->save();
            return $this->getDetailsProduct(new Request([
                'slug' => $data['slug']
            ]));

        } elseif ($for_what == 'delete') {
            $for_section = $request->get('for_section');
            $product = MasterProduct::find($data['id']);

            if ($for_section == 'delete_media') {
                $media_id = $request->get('id');
                $media_collection_name = 'images';
                Media::find($media_id)->delete();

                $media_count = $product->countMediaByIdAndCollection($media_collection_name);

                if ($media_count > 0) {
                    $product->getMedia($media_collection_name);
                    $product->default_media_id = $product->media[0]->id;
                    $product->save();
                }
            }
            return $this->getDetailsProduct(new Request([
                'slug' => $data['slug']
            ]));
        } else {
            return response()->json([
                'messages' => ["Missing or invalid inputs provided."],
                'status' => 200
            ], 200);
        }
    }

    public function actionDetailsProductVariant(Request $request)
    {
        $data = $request->get('data');
        $for_what = $request->get('for_what');

        if ($for_what == 'update') {
            $for_section = $request->get('for_section');
            $product = MasterProductVariant::where('id', '=', $data['id'])->first();

            if ($for_section == 'basic_info') {
                $product->name = $data['name'];
                $product->sku = $data['sku'];
                $product->description = $data['description'] ?? null;

            } elseif ($for_section == 'state') {
                if ($data['state'] == 'schedule')
                    $product->publish_date = Carbon::createFromFormat('d-m-Y', $data['next_publish_date'])->format('Y-m-d');
                else
                    $product->state = $data['state'] ?? 'draft';

            } elseif ($for_section == 'pricing') {
                $product->price = $data['price'] ?? 0;
                $product->original_price = $data['original_price'] ?? 0;

            } elseif ($for_section == 'set_default_media') {
                $media_id = $request->get('id');
                $product->default_media_id = $media_id;
            } else {
                return response()->json([
                    'messages' => ["Missing or invalid inputs provided."],
                    'status' => 200
                ], 200);
            }

            $product->save();
            return $this->getDetailsProductVariant(new Request([
                'slug' => $request->slug,
                'sku' => $data['sku']
            ]));

        } elseif ($for_what == 'delete') {
            $for_section = $request->get('for_section');
            $product = MasterProductVariant::where('id', '=', $data['id'])->first();

            if ($for_section == 'delete_media') {
                $media_id = $request->get('id');
                $media_collection_name = 'images';
                Media::find($media_id)->delete();

                $media_count = $product->countMediaByIdAndCollection($media_collection_name);

                if ($media_count > 0) {
                    $product->getMedia($media_collection_name);
                    $product->default_media_id = $product->media[0]->id;
                    $product->save();
                }
            }
            return $this->getDetailsProductVariant(new Request([
                'slug' => $request->slug,
                'sku' => $data['sku']
            ]));
        } else {
            return response()->json([
                'messages' => ["Missing or invalid inputs provided."],
                'status' => 200
            ], 200);
        }
    }

}
