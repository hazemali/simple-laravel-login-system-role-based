<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/start-application',function (){

    //create role of super admin and assign it to first user that will be super admin
    $superAdmin = new App\Role();
    $superAdmin->name         = 'super-admin';
    $superAdmin->display_name = 'Super Admin'; // optional
    $superAdmin->description  = 'Admin who have all permissions'; // optional
    $superAdmin->save();

    $user=\App\User::first();
    $user->attachRole($superAdmin);


    $adminLoginPermission = new App\Permission();
    $adminLoginPermission->name         = 'admin-login';
    $adminLoginPermission->display_name = 'Admin can login to admin panels'; // optional
// Allow a user to...
    $adminLoginPermission->description  = 'Admin can login to admin panels'; // optional
    $adminLoginPermission->save();


    $superAdmin->attachPermission($adminLoginPermission);



    return 'well done';


});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin','middleware'=>'web','namespace'=>'Admin','name'=>'admin','as'=>'admin.'],function (){

    Route::any('/login','AdminLoginController@login');

    Route::group(['middleware'=>'Admin'],function (){

        Route::get('/','DashboardController@index');

        Route::get('/logout','AdminLoginController@logout');

        Route::resource('users',"UsersController");

        Route::post('/users/{id}/delete','UsersController@destroy')->name('users.destroy');

        Route::get('get-users','UsersController@getUsers');


        Route::resource('roles',"RolesController");

        Route::post('/roles/{id}/delete','RolesController@destroy')->name('roles.destroy');


        Route::resource('permissions',"PermissionsController");

        Route::post('/permissions/{id}/delete','PermissionsController@destroy')->name('permissions.destroy');

    });


});
