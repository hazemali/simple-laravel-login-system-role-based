<?php
/**
 * Created by PhpStorm.
 * User: kappoo
 * Date: 12/25/2017
 * Time: 3:39 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class BaseAdminController extends  Controller
{
    protected $data=[];



    public function __construct()
    {
        $this->data[ 'sidebar' ]=
        [
            'users'=>[
                'href'=>'users',
                'class'=>'fa-users',
                'title'=>'Users',
                'label'=>\App\User::count(),
            ],
            'authorize'=>[
                'class'=>'fa-handshake-o',
                'title'=>'Authorization',
                'sub'=>[
                    'roles'=>[
                        'href'=>'roles',
                        'class'=>'fa-handshake',
                        'title'=>'Roles',
                        'label'=>\App\Role::count(),

                    ],
                    'permission'=>[
                        'href'=>'permissions',
                        'class'=>'fa-handshake',
                        'title'=>'Permissions',
                        'label'=>\App\Permission::count(),

                    ],

                ]
            ]
        ]   ;



    }
}