<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\MasterProductVariant;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Konekt\Customer\Models\Customer;
use Laravel\Socialite\Facades\Socialite;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function indexSignin()
    {
        if (Auth::check())
            return redirect()->route('dashboard');

        return view('auth.auth');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $input = $request->only('email', 'password');
        $remember = (boolean)$request->get('remember');

        if (Auth::attempt($input, $remember)) {
            $user = User::where('id', Auth::id())->first();
            $user->last_login_at = Carbon::now();
            $user->login_count = $user->login_count + 1;
            $user->save();

            Role::redisSetUserRolesPermissions($user->id);

            $intend = redirect()->intended()->getTargetUrl();

            if (Str::contains($intend, '/admin'))
                return redirect()->to($intend);
            else
                return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('errors', ['Invalid credentials.']);
        }
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Test functions

    public function createAdmin(Request $request)
    {
        return $this->create(
            $request->only(['name', 'email', 'password'])
        );
    }

    public static function create($data)
    {
        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errors' => $e->getMessage(),
                'status' => 409
            ], 409);
        }

        return response()->json([
            'message' => 'Account creation successful.',
            'status' => 200
        ]);
    }

    public function loginUser(Request $request)
    {
        if (Auth::attempt(
            $request->only(['email', 'password'])
        )) {
            return response()->json([
                'message' => 'Logged in successfully.',
                'status' => 200
            ]);
        }

        return response()->json([
            'errors' => 'Authentication failed. Please check your credentials and try again.',
            'status' => 401
        ], 401);
    }

    public function createCustomer(Request $request)
    {
        return $this->createCus(
            $request->only(['name', 'email', 'password'])
        );
    }

    public function createCus($data)
    {
        try {
            Customer::create([
                'firstname' => $data['firstname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errors' => $e->getMessage(),
                'status' => 409
            ], 409);
        }

        return response()->json([
            'message' => 'Account creation successful.',
            'status' => 200
        ]);
    }

    public function checkLogin(Request $request)
    {
//        $redis = Redis::connection();
//        $redis->hmset('name', array(5, 10));

//        $values = Redis::command('lrange', ['name', 0, 4]);
//        return $values;
//        Session::put('one', 1);
//        return session()->all();
//        return Auth::logout();
//        return Auth::user();
//        return Auth::guard('customer')->user();
        $this->loginUser(new Request(['email'=>'tech@astrofeast.com', 'password'=>'Astrofeast@2023']));
//        return $this->loginCustomer(new Request(['email'=>'givesachin@gmail.com', 'password'=>'Odoo@123']));
        return Auth::user();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->getId())
                ->first();

            if (!$finduser) {
                $finduser = User::where('email', $user->getEmail())
                    ->first();

                if ($finduser) {
                    User::where('email', $user->getEmail())
                        ->update(['google_id' => $user->getId()]);
                }
            }

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('dashboard');

            } else {
                return redirect()->route('login')
                    ->with('errors', ['No account found with selected google account.']);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function commonSearchCategory(Request $request)
    {
        $term = $request->get('term');
        $term_arr = explode(' ', $term);
        $subquery_score = '';

        foreach ($term_arr as $key => $keyword) {
            if ($key == 0)
                $subquery_score = "(taxons.name LIKE '%" . $keyword . "%')";
            else
                $subquery_score = $subquery_score . '+' . "(taxons.name LIKE '%" . $keyword . "%')";
        }

        $subquery = DB::table('taxons')
            ->leftJoin('taxonomies','taxonomies.id', '=', 'taxons.taxonomy_id')
            ->where('taxonomies.name', '=', 'Category')
            ->select(
                'taxons.id',
                'taxons.name',
                DB::raw('(' . $subquery_score . ') AS score')
            );

        return DB::query()->from($subquery, 'results')
            ->where('score', '<>', 0)
            ->select('id', 'name')
            ->orderBy('score', 'desc')
            ->limit(5)
            ->get();
    }

    public function commonSearchMetaTag(Request $request)
    {
        $term = $request->get('term');
        $term_arr = explode(' ', $term);
        $subquery_score = '';

        foreach ($term_arr as $key => $keyword) {
            if ($key == 0)
                $subquery_score = "(keyword LIKE '%" . $keyword . "%')";
            else
                $subquery_score = $subquery_score . '+' . "(keyword LIKE '%" . $keyword . "%')";
        }

        $subquery = DB::table('meta_keywords')
            ->select(
                'id',
                'keyword',
                DB::raw('(' . $subquery_score . ') AS score')
            );

        return DB::query()->from($subquery, 'results')
            ->where('score', '<>', 0)
            ->select('id', 'keyword')
            ->orderBy('score', 'desc')
            ->limit(5)
            ->get();
    }

    public function commonUpload(Request $request)
    {
        $for_what = $request->for_what;

        // Is staff ???
        if ($for_what == 'product_variant') {
            $id = $request->id;
            $sku = $request->sku;
            $media_collection_name = 'images';

            $product = MasterProductVariant::where('id', '=', $id)->first();
            $product->addMedia($request->file('image'))->toMediaCollection($media_collection_name);

            $media_count = $product->countMediaByIdAndCollection($media_collection_name);

            if ($media_count == 1) {
                $product->getMedia($media_collection_name);
                $product->default_media_id = $product->media[0]->id;
                $product->save();
            }

            return MasterProductVariant::getDetailsBySku($sku);
        }

        if ($for_what == 'product') {
            $id = $request->id;
            $slug = $request->slug;
            $media_collection_name = 'images';

            $product = MasterProduct::where('id', '=', $id)->first();
            $product->addMedia($request->file('image'))->toMediaCollection('images');

            $media_count = $product->countMediaByIdAndCollection($media_collection_name);

            if ($media_count == 1) {
                $product->getMedia($media_collection_name);
                $product->default_media_id = $product->media[0]->id;
                $product->save();
            }

            return MasterProduct::getDetailsBySlug($slug);
        }
    }
}
