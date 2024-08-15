<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [ new Middleware('auth:api', except: ['register', 'login']) ];
    }

    public function register(Request $request)
    {
        // return response()->json([
        //     'data' => User::find('9cbdd08b-3f1a-40d9-9053-4604e787c2a0')->company,
        // ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);

        $validated = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required',

            // 'browserInfo' => 'required|array',
            // 'browserInfo.chrome' => 'boolean',
            // 'browserInfo.chrome_view' => 'boolean',
            // 'browserInfo.chrome_mobile' => 'boolean',
            // 'browserInfo.chrome_mobile_ios' => 'boolean',
            // 'browserInfo.safari' => 'boolean',
            // 'browserInfo.safari_mobile' => 'boolean',
            // 'browserInfo.msedge' => 'boolean',
            // 'browserInfo.msie_mobile' => 'boolean',
            // 'browserInfo.msie' => 'boolean',

            // 'machineInfo' => 'array',
            // 'machineInfo.brand' => 'string',
            // 'machineInfo.model' => 'nullable|string',
            // 'machineInfo.os_name' => 'string',
            // 'machineInfo.os_version' => 'string',
            // 'machineInfo.type' => 'string',

            // 'osInfo' => 'required|array',
            // 'osInfo.android' => 'boolean',
            // 'osInfo.blackberry' => 'boolean',
            // 'osInfo.ios' => 'boolean',
            // 'osInfo.windows' => 'boolean',
            // 'osInfo.windows_phone' => 'boolean',
            // 'osInfo.mac' => 'boolean',
            // 'osInfo.linux' => 'boolean',
            // 'osInfo.chrome' => 'boolean',
            // 'osInfo.firefox' => 'boolean',
            // 'osInfo.gamingConsole' => 'boolean',

            // 'osNameInfo' => 'required|array',
            // 'osNameInfo.name' => 'required|string',
            // 'osNameInfo.version' => 'required|string',
            // 'osNameInfo.platform' => 'nullable|string',

            // 'Device' => 'required|string',
            // 'Model' => 'required|string',
            // 'Source' => 'required|ip',
            // 'Exp' => 'required|integer',
        ], [
            'username' => 'The username is required',
            'password' => 'The password is required'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validated->errors(),
            ], 400);
        }

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me(){
        return response()->json([
            'message' => 'Get data success!',
            'user' => auth('api')->user(),
        ]);
    }

    public function logout(){
        auth()->invalidate(true);
        auth('api')->logout();

        return response()->json(['message' => 'Logout successfully!']);
    }

    protected function respondWithToken($token)
    {
        $authUser = auth('api')->user();

        return response()->json([
            'message' => 'Login success',
            'user' => [
                'username' => $authUser->username,
                'company' => [
                    'company_id' => $authUser->company->id,
                    'company_name' => $authUser->company->company_name,
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]
        ]);
    }
}
