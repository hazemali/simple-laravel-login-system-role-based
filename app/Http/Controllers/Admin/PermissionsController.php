<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class PermissionsController extends BaseAdminController
{


    public function __construct()
    {
        parent::__construct();

        $this->middleware('SuperAdmin');

        $this->data['module']='permissions';

        $this->data['name']='permission';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::all();
        //
        return view('admin.permissions.index',['data'=>$this->data,'permissions'=>$permissions]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::pluck('display_name','id');



        return view('admin.permissions.create',['data'=>$this->data,'permissions'=>$permissions]);
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



        $permission = new \App\Permission();
        $permission->name=str_slug(strtolower($request->display_name)) ;
        $permission->display_name = $request->display_name; // optional
        $permission->description  = $request->description; // optional
        $permission->save();





       Session::put('success','permission created successfully');
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
        $permission=Permission::findOrFail($id);



        return view('admin.permissions.edit',['data'=>$this->data,
            'permission'=>$permission]);
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




        $permission=Permission::where('id',$id)->first();


        if(empty($permission))
        {
            Session::put('error','invalid data');
        }
       else{
           $permission->display_name = $request->display_name; // optional
           $permission->description  = $request->description; // optional
           $permission->save();
            Session::put('success','Permission updated successfully');
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
       $permission= Permission::whereId($id)->first();



        if(empty($permission))
        {
            Session::put('error','invalid data');
        }


        else
        {



            $permission->roles()->sync([]);

            $permission->delete();
            Session::put('success','permission deleted successfully');
        }



        return back();
    }
}
