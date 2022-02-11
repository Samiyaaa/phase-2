<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $users = User::orderBy('created_at','desc')->Paginate(5);  
        // $roles = Role::pluck('role_name','role_id');
        // $roleUser = RoleUser::pluck('user_id','role_id'); 
        // if (auth()->user()->role_id !== 16){
        //     return redirect('/home')->with('error','Unautherized Page!');
        // }   
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('role_name','role_id');
        // return view('users.create', compact('roles'));
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validate($request, [
            'name' => 'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'role_ids' => 'required|nullable' 
         ]);

         $user = new User;
         $roleUser = new RoleUser;
         $user->name = $request->input('name');
         $user->email =  $request->input('email');
         $user->password = Hash::make($request->input('password'));
         $user->save();
        //  if($user->save() == true)
        //  $id = $user->id;
        foreach($request->input('role_ids') as $role_id){
            $roleUser = new RoleUser;
            $roleUser->role_id = $role_id;
            $roleUser->user_id = $user->id;
            $roleUser->save();
        }
         return redirect('/users')->with('success', 'User created');
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
        $user = User::find($id);
        $roles = Role::pluck('role_name','role_id');
        // $roleUser = $user->roles->pluck('role_id','role_id')->alls();
        return view('users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this-> validate($request, [
            'name'  => 'required',
            'email' => 'required',
            // 'password' => '',
         ]);
         
         $user = User::find($id);
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->save();

         // Get role id
         $inputRoleId = $request->input('role_ids');

         // Check if user has role
         $userRole = RoleUser::where([
             'role_id' => $inputRoleId,
             'user_id' => $user->id
         ])->first();

         if($userRole == null){
             // delete prev role
             $prevUserRole = RoleUser::where('user_id', $user->id)->first();
             $prevUserRole->delete();

             $newUserRole = new RoleUser;
             $newUserRole->user_id = $user->id;
             $newUserRole->role_id = $inputRoleId;
             $newUserRole->save();
         }
 
         return redirect('/users')->with('success', 'User record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roleUser()->delete();
        $user->delete();
        return redirect('/users')->with('success', 'User Deleted');
    }
}
