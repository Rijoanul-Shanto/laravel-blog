<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
{
    public function index()
    {
        return view('file.index');
    }
}
