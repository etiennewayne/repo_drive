<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepoFileController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('administrator.files');
    }



    public function create(){
       return view('administrator.files-create'); 
    }


}
