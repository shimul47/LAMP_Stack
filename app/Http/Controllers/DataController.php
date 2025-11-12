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
                    <button type="button" class="btn btn-sm" onclick="softDelete(' .$user->id.', \'' . $user->name . '\', \'' . $user->email . '\', \'' . $user->created_at . '\')"><i class="fa-solid fa-trash"></i></button>
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

    public function store_delete(Request $request){
        SoftDelete::create([
            "name" => $request->name,
            "email" => $request->email,
            "joined_at" => $request->created_at,
            "deleted_at" => now(),
        ]);
        User::findOrFail($request->id)->delete();
        return response()->json();
    }

}
// $contr = new DataController();
// $contr->store_delete();
