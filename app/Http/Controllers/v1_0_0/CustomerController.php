<?php

namespace App\Http\Controllers\v1_0_0;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomerController extends \App\Http\Controllers\Controller
{
    public static function registerCustomer(Request $request)
    {
        $data = $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'status' => 409
            ], 409);
        }

        Customer::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Controller::create(new Request(array_merge($request->all(), ['name' => $data['firstname'] . ' ' . $data['lastname']])));

        return response()->json([
            'message' => 'Customer registration successful',
            // 'customer' => $customer,
        ], 200); // HTTP 200 Created
    }

    public function loginCustomer(Request $request)
    {
        if (Auth::guard('customer')->attempt(
            $request->only(['email', 'password'])
        )) {
//            Auth::guard('customer')->login($request->only(['email','password']));
            return response()->json([
                'message' => 'Logged in successfully.',
                '_token' => session()->get('_token'),
                'status' => 200
            ]);
        }

        return response()->json([
            'errors' => 'Authentication failed. Please check your credentials and try again.',
            'status' => 401
        ], 401);
    }

//    public static function login(Request $request)
//    {
//        $data = $request->all();
//        // Validation
//        $validator = \Validator($data, [
//            'email' => 'required|email',
//            'password' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'errors' => $validator->errors()->all(),
//                'status' => 401
//            ], 401);
//        }
//
//        $user = Customer::where('email', $data['email'])->first();
//        if ($user && Hash::check($data['password'], $user->password)) {
//            // Code block to run after LoggedIn User.
//            return response()->json([
//                'message' => 'Customer login successful',
//                'status' => 200,
//                'data' => [
//                    'token' => "token_abc",
//                    'refresh-token' => "token_refresh"
//                ]
//            ], 200); // HTTP 200 OK
//        } else {
//            return response()->json([
//                'message' => 'Customer Not Found',
//                'status' => 400
//            ], 400); // HTTP 200 OK
//        }
//    }
}
