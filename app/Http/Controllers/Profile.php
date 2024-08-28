<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{

    public function profile (){

        $users = [
            [
                'name' => 'Bidz',
                'age' => '20'
            ],
            [
                'name' => 'PH',
                'age' => '12'
            ],

            [
                'name' => 'Loki',
                'age' => '1'
            ]
        ];



        return view(
            'profile',
            [
                'users_list' => $users
            ]
        );
    }
    // public function profile (){
    //     return view('profile');
    // }

}
