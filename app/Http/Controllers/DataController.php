<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function view(Request $request){
        if($request->ajax()){
            $users = User::query();
            return DataTables::eloquent($users)
            
            ->addColumn("operation",function(){
                return '
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
            ';
            })
            ->rawColumns(['operation'])//read html format
            ->toJson();
        }
        return view("user.userData");
        // return view("user.userData",["users"=>User::all()]);
    }
}
