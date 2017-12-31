<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends BaseAdminController
{


    public function __construct()
    {
        parent::__construct();

        $this->data['module']='users';

        $this->data['name']='user';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index',['data'=>$this->data]);
    }



    public function getUsers()
    {
        $users=DataTables::of(User::select(['id','name','email','created_at','updated_at']))
          ->addColumn('action',function ($model){





                $modal=' <div class="modal" tabindex="-1" role="dialog" id="modal'.$model->id.'">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete this item ? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post"  action="/admin/users/'.$model->id.'/delete">
                                            '.csrf_field().'
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>';

                return '<a href="/admin/users/'.$model->id.'/edit" class="btn btn-success btn-circle " title="edit"><i class="fa fa-edit"></i></a>'.
                    (!$model->hasRole('super-admin')&&Auth::user()->can('delete-user')?
                    ' <a href="#" data-toggle="modal"  data-target="#modal'.$model->id.'" class="btn btn-danger btn-circle" title="edit"><i class="fa fa-close"></i></a>'.$modal:' ');

        })

            -> addColumn('abc',function ($model){

                return ' ';
                dd($model);
                if($model->hasRole('super-admin'))
                {

                    $diplay='Super Admin';
                }else if($model->hasRole('admin'))
                {
                    $diplay='Admin';
                }else{
                    $diplay='User';
                }
                return $diplay;

            })
            ->make(true);


        //dd($users);

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();



        return view('admin.users.create',['data'=>$this->data,'roles'=>$roles]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //

        $user=User::create($request->all());

        if($user){
            $user->roles()->sync($request['role_id']);

            Session::put('success','User created successfully');
        }else{
            Session::put('error','Error happend');
        }

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
        $user=User::findOrFail($id);
        $roles=Role::all();


        return view('admin.users.edit',['data'=>$this->data,'roles'=>$roles,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input=$request->all();
        if(!$request->has('password'))
        {
            unset($input['password']);
        }

        $user=User::where('id',$id)->first();


        if(empty($user))
        {
            Session::put('error','invalid data');
        }

        else if($user->hasRole('super-admin'))
        {
            Session::put('error','Can\'t modify super admin data');

        }else{
            $user->update($input);
            Session::put('success','User updated');
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
        $user=User::whereId($id)->first();

        if(empty($user))
        {
            Session::put('error','invalid data');
        }

        else if($user->hasRole('super-admin'))
        {

            Session::put('error','You can\'t delete this user');
        }
        else if(Auth::user()->can('delete-user'))
        {
            $user->delete();
            Session::put('success','You can\'t delete this user');
        }
        else
        {
            Session::put('error','You can\'t delete user');
        }


        return back();
    }
}
