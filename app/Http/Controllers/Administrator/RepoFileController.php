<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RepoFile;


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


    public function store(Request $req){

        foreach($req->repo_filepath as $repo){
            //$file = $repo('bed_img');
            $pathFile = $repo->store('public/repo'); //get path of the file
            RepoFile::create([
                'repo_filename' => $req->repo_filename,
                'repo_path' => $pathFile
            ]);
        }
        return $req;
    }


}
