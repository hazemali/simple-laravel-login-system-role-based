<?php
/**
 * Created by PhpStorm.
 * User: kappoo
 * Date: 12/24/2017
 * Time: 4:08 PM
 */
namespace App\Http\Controllers\Admin;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

    public function login(Request $request)
    {
        Auth::logout();

        if($request->method()=='GET'){

            return view('admin.login.login');

        }else{


            $this->validate($request,[
                'email'=>'required|email',
                'password'=>'required'
                ]
            );

           $credential=$request->only(['email','password']) ;

            $flag=Auth::attempt($credential,(bool)$request->remember);



            if(!$flag||!Auth::user()->can('admin-login')){
                Session::put('error','wrong email or password');
                return back();
            }else{
                Session::put('success','welcome admin '.Auth::user()->name);
                return redirect('/admin');
            }

        }


    }




    public function logout()
    {
        Auth::logout();

        Session::put('success','Bye admin');

        return back();

    }
}