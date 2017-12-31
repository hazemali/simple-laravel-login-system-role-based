<?php
/**
 * Created by PhpStorm.
 * User: kappoo
 * Date: 12/24/2017
 * Time: 4:08 PM
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{

    protected $data;

    public function index(Request $request)
    {




        return view('admin.dashboard',['data'=>$this->data]);

    }





}