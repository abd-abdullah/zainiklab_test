<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_slug'] = 'dashboard';
        if(auth()->user()->user_type == 'admin'){
            $data['totalStudent'] = User::whereStatus(1)->where('user_type', 'student')->count();
            $data['totalCourse'] = Course::whereStatus(1)->count();
        }
        else{
            $data['totalEnrolledCourse'] = auth()->user()->courses->count();
        }
        return view('home', $data);
    }
}
