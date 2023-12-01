<?php

namespace App\Http\Controllers\v1_0_0;

use App\Models\Customer;
use App\Models\MasterProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vanilo\Cart\CartManager;

class CustomerAuthController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function logoutCustomer(Request $request)
    {
        Auth::guard('customer')->logout();
        return response()->json([
            'message' => 'Logged out successfully.',
            'status' => 200
        ]);
    }

    public static function updateProfile(Request $request)
    {
        $data = $request->get('data');
        Customer::updateProfile(Auth::id(),$data);
        return response()->json([
            'message' => 'Profile updated successfully.',
            'status' => 200
        ], );
    }

    public static function addToCart(Request $request)
    {
//        return response()->json(["payload"=>$request->all()]);
//        $cart_id = session()->get('cart');
        $product_sku = $request->get('sku');
        $cart = new CartManager();
        $user = Auth::guard('customer')->user();
        if ($user) {
            $cart->setUser($user);
            $cart->addItem(MasterProductVariant::findBySku($product_sku));
//            $cart->addItem(MasterProductVariant::findBySku('PZLBL-036'));
            return response()->json([
                'cart' => $cart->getItems(),
                'status' => 200
            ]);
        } else {
            return response()->json([
                'errors' => 'Cart not exists.',
                'status' => 400
            ], 400);
        }
    }

    public static function getCart(Request $request)
    {
        $cart = new CartManager();
        return response()->json([
            'cart' => $cart->getItems(),
            'status' => 200
        ], );
    }
}
