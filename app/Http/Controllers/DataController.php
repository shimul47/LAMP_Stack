<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SoftDelete;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function view(Request $request){
        if($request->ajax()){
            $users = User::query();
            return DataTables::eloquent($users)
            
            ->addColumn("operation",function($user){
                return '
                    <button type="button" class="btn btn-sm" onclick="openEditModal('.$user->id.', \''.($user->name).'\')"> <i class="fa-regular fa-pen-to-square"></i></button>
                    
                ';
            })
            ->rawColumns(['operation'])//read html format
            ->toJson();
        }
        return view("user.userData");
        // return view("user.userData",["users"=>User::all()]);
    }
    
    public function update(Request $request){
        $request->validate([
            "name" => "required",
        ]);
        $user = User::findOrFail($request->id);
        $user->update([
            "name" => $request->name,
        ]);
        return response()->json();
    }

    public function store_delete(){
        //
    }

}
