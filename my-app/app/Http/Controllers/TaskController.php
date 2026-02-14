<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntityName;

class TaskController extends Controller
{
    public function index()
    {
        $entities = EntityName::all();
        return view("index", compact('entities'));
    }
}
