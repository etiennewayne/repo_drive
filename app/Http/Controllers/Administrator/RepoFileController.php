<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RepoFile;
use App\Models\Syslog;

use Auth;

class RepoFileController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('administrator.files');
    }

    public function getFiles(Request $req){
        $sort = explode('.',$req->sort_by);
        $data = RepoFile::where('repo_filename', 'like', $req->repo . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;
    }

    public function create(){
       return view('administrator.files-create'); 
    }


    public function store(Request $req){

        $req->validate([
            'repo_filename' => ['required']
        ]);

        $mgaFiles = '';
        $user = Auth::user();
        foreach($req->repo_filepath as $repo){
            //$file = $repo('bed_img');
            $pathFile = $repo->store('public/repo'); //get path of the file
            $data = RepoFile::create([
                'user_id' => $user->user_id,
                'repo_filename' => $repo->getClientOriginalName(),
                'repo_path' => $pathFile,
                'repo_ext' => $repo->getClientOriginalExtension()
            ]);

            $mgaFiles = $mgaFiles . ', ' . $repo->getClientOriginalName();
        }

        
            
        Syslog::create([
            'syslog' => 'Successfully uploaded file ' . $mgaFiles,
            'username' => $user->username
        ]);

        return response()->json([
            'status' => 'saved'
        ]);
    }


}
