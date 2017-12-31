<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends BaseAdminController
{


    public function __construct()
    {
        parent::__construct();

        $this->middleware('SuperAdmin');

        $this->data['module']='roles';

        $this->data['name']='role';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
        //
        return view('admin.roles.index',['data'=>$this->data,'roles'=>$roles]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::pluck('display_name','id');



        return view('admin.roles.create',['data'=>$this->data,'permissions'=>$permissions]);
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
        $this->validate($request,[
            'display_name'=>'required|min:2',
            'description'=>'required|min:2',

        ]);

        if($request->has('permissions')&&!empty($request->permissions))
            $this->validate($request,[
                'permissions'=>'exists:permissions,id'
            ]);


        $role = new \App\Role();
        $role->name=str_slug(strtolower($request->display_name)) ;
        $role->display_name = $request->display_name; // optional
        $role->description  = $request->description; // optional
        $role->save();





       $role->perms()->sync($request->permissions);

       Session::put('success','role created successfully');
        return back();

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
        $role=Role::findOrFail($id);
        $permissions=Permission::pluck('display_name','id');


        return view('admin.roles.edit',['data'=>$this->data,
            'role'=>$role,'permissions'=>$permissions]);
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
        $this->validate($request,[
            'display_name'=>'required|min:2',
            'description'=>'required|min:2',

        ]);

        if($request->has('permissions')&&!empty($request->permissions))
            $this->validate($request,[
                'permissions'=>'exists:permissions,id'
            ]);


        $role=Role::where('id',$id)->first();


        if(empty($role))
        {
            Session::put('error','invalid data');
        }
       else{
           $role->display_name = $request->display_name; // optional
           $role->description  = $request->description; // optional
           $role->save();
           $role->perms()->sync($request->permissions);
            Session::put('success','Role updated successfully');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $role= Role::whereId($id)->first();



        if(empty($role))
        {
            Session::put('error','invalid data');
        }
        else if($role->name=='super-admin')
        {

            Session::put('error','you can\'t delete this role');
        }

        else
        {


            $role->users->sync([]);
            $role->perms->sync([]);

            $role->delete();
            Session::put('success','role deleted successfully');
        }



        return back();
    }
}
