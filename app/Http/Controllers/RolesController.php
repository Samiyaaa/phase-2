<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;

class RolesController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
       
        $roles = Role::orderBy('role_name','asc')->Paginate(5); 
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'role'  => 'required'
         ]);
         
         $role = new Role;
         $role->role_name = $request->input('role');
         $checkRole = Role::where('role_name', '=',  $request->input('role'))->first();
         if($checkRole === null){
           $role->save();  
        }
        else{
            return redirect('/roles')->with('error', 'Role Already Exist');
        }
         
 
         return redirect('/roles')->with('success', 'Role created');
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
    public function edit($role_id)
    {
        $role = Role::find($role_id);
        return view('roles.edit')->with('role',$role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role_id)
    {
        $role = Role::find($role_id);
        $role->role_name = $request->input('role');
        $role->save();
 
        return redirect('/roles')->with('success', 'Role updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id)
    {
        
        $role = Role::find($role_id);
        $role->roleUser()->delete();
        $role->delete();
        return redirect('/roles')->with('success', 'Role Deleted');
    }
}
