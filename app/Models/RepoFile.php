<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepoFile extends Model
{
    use HasFactory;

    protected $table = 'repo_files';
    protected $primaryKey = 'repo_file_id';

    protected $fillable = ['repo_filename', 'repo_path'];


    
}