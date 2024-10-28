<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user  = $user;
    }

     /** User SignUp */
     public function register(Request $request)
     {
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
        ], [
            'email.unique' => 'This email already exists.',
            'mobile.unique' => 'This mobile number already exists.'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()->messages()
            ], 422);
        }
 
        DB::beginTransaction();
        try{
            /** Create User */
            $user = $this->user->signupUser($request);
            if (!$user) {
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not created',
                ], 500);
            }
            DB::commit();
            $response['status'] = 'success';
            $response['message'] = 'User registred successfully.';
            if($user){
                $response['data'] = $user;
            }
            return response()->json($response, 200);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
     }

    /** user login */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()->messages()
            ], 422);
        }
        $credentials = $request->only(['email', 'password']);
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid cred'
            ], 401);
        }
        $tokenUser = JWTAuth::user($token);
        if (!$tokenUser) {
            JWTAuth::setToken($token)->invalidate(true);
            return response()->json([
                'status' => 'failed',
                'message' => 'Inactive user'
            ], 401);
        }
    
        $result = [
            'token' => $token,
            'user_details' => $this->user->getUserByID($tokenUser->id)
        ];
        $response['status'] = 'success';
        $response['message'] = 'Log in successfully';
        if($result){
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }

    /** user logout */
    public function logout()
    {
        try{
            JWTAuth::parseToken()->invalidate(true);
            $result = [
                'is_logout' => true,
            ];
        
            $response['status'] = 'success';
            $response['message'] = 'Logout successfully';
            if($result){
                $response['data'] = $result;
            }
            return response()->json($response, 200);
            
        }catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
