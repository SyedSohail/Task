<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function signup(Request $request)
    {dd('sdasd');
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validation->fails()){
            return response()->json(['success'=>false,'data'=>$validation->messages()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'User'
        ]);

        return response()->json([
            'success'=>true,
            'message' => 'Successfully created user!'
        ], 201);
    }
     
    public function login(Request $request)
    {
        
        $validation = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if($validation->fails()){
            return response()->json(['success'=>false,'data'=>$validation->messages()],422);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::guard('api')->attempt($credentials)){
            return response()->json([
                'message' => 'Email or Password is not correct'
            ], 401);
            dd(auth()->user());
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token')->accessToken;
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addDays(1);

        $token->save();

        Auth::user()->setAttribute('access_token',$tokenResult->accessToken);

        Auth::user()->setAttribute('token_type','Bearer');

        Auth::user()->setAttribute('expires_at',Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString());

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
