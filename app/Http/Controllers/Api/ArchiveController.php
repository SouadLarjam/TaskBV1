<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\User;
//use App\Models\Note;
use App\Models\TaskArchive;

class ArchiveController extends Controller
{

    public function afficherArchive(Request $request){
        return response()->json($request->user()->task_archives()->get(),200);
    }
}
