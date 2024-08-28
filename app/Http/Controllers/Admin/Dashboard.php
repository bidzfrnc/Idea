<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class Dashboard extends Controller
{
    public function adminDash(){

        // if(!auth()->user()->is_admin){
        //     abort(403);
        // }
        //Log::info('inside admin dashboard controller');

        //two ways to GATE 
        //1st
        // if(!Gate::allows('admin')){
        //     abort(403);
        // }

        //2nd
        // if(Gate::denies('admin')){
        //     abort(403);
        // }

        //shortcut
        // $this->authorize('admin');

        return view('admin.dashboard');
    }


}
