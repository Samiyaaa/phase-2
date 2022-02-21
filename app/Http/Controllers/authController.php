<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class authController extends Controller
{
   public function register(Request $request){
      $fields = $request->validate([
          'name' => 'required|string',
          'phone_no' => 'required|string|unique:users,phone_no',
          'address' => 'required|string',
          'email' => 'required|string|unique:users,email',
          'password' => 'required|string|confirmed',
          'role'  => 'required|string'
      ]); 

      $user = User::create([
          'name' => $fields['name'],
          'phone_no' => $fields['phone_no'],
          'address' => $fields['address'],
          'email' => $fields['email'],
          'password' => bcrypt($fields['password'])
      ]);
      
      $role = Role::where(['role_name' => $fields['role']])->first();
      $roleUser = new RoleUser;
      $roleUser->user_id = $user->id;
      $roleUser->role_id = $role->role_id;
      $roleUser->save();

      $token = $user->createToken('mytoken')->plainTextToken;

      $response = [
          'user' => $user,
          'role' => $role->role_name,
          'token' => $token
      ];

      return response($response, 201);
   } 

   public function login(Request $request){
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]); 

    $user = User::where('email', $fields['email'])->first();
    if(!$user || !Hash::check($fields['password'], $user->password)){
        return response([
            'message' => 'Bad Creds'
        ],401);
    }

    $token = $user->createToken('mytoken')->plainTextToken;
    $userRoles = RoleUser::where('user_id',$user->id)->get();
    foreach($userRoles as $userRole){
        $role_id = $userRole->role_id;
        $roles = Role::where('role_id',$role_id)->get();
        foreach($roles as $role){
            $role_name = $role->role_name;
        }
    }
    // foreach($roles as $role){
    //     $roleName=[
    //     'role' => $role->role_name
    // ];
    // 
    $response = [
        'user' => $user,
        'role' => $role_name,
        'token' => $token
    ];

    return response($response, 201);
 }

   public function logout(Request $request){
       auth()->user()->tokens()->delete();

       return [
           'message' => 'Logged out'
       ];
   }

}
