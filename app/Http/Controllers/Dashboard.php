<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function dashboard()
    {

        //return new WelcomeEmail(auth()->user());

        //1st check if there is a search
        //if there is, check the search value with our database
        $ideas = Idea::withCount('likes')->orderBy('created_at', 'DESC');

        //where content like %test%
        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }



        return view(
            'dashboard',
            [
                // 'ideas' => Idea::all()  //view idea using this way
                // 'ideas' => Idea::orderBy('created_at', 'DESC')->get()  //view idea using this way
                // 'ideas' => Idea::orderBy('created_at', 'DESC')->paginate(5)  //do pagination
                'ideas' => $ideas->paginate(5)  //do pagination
            ]
        );
    }
}
