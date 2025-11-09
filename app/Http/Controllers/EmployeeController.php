<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Employee;
use  App\Models\ViewProfile;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller{
    
    public function viewEmployee(){
        $employee = Employee::paginate(6);
        return view("employee.viewEmployee",['employees'=>$employee]);
    }

    public function addEmployee(){ //for add -- get and post
        return view("employee.addEmployee");
    }
    
    public function postEmployee(Request $request){
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('media', 'public');
        } else {
            $path = 'media/employee-dissatisfaction-scaled.jpeg';
        }

        Employee::create([
            'name' => $request['name'],
            'eID' => $request['eID'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'image' => $path,
        ]);
        flash()->success("New employee added");
        return redirect()->route('view');
    }

    public function editEmployee($id){
        $e = Employee::find($id);
        return view("employee.editEmployee",['e'=>$e]);
    }

    public function postEdit(Request $request,$id){
        $emp = Employee::find($id);
        $data = [
            "name"=>$request['name'],
            "email"=>$request['email'],
            "address"=>$request['address'],
            "phone"=>$request['phone'],
        ];
        if ($request->hasFile('image')) {
            if ($emp->image && Storage::disk('public')->exists($emp->image)) {
                Storage::disk('public')->delete($emp->image);
            }
            $path = $request->file('image')->store('media', 'public');
            $data["image"]=$path;
        }
        $emp->update($data);
         flash()->success("Update Successful");
        return redirect()->route('view');
    }

    public function delEmployee($id){
        $emp = Employee::find($id);
        if ($emp->image && Storage::disk('public')->exists($emp->image)) {
            Storage::disk('public')->delete($emp->image);
        }
        $emp->delete();
        flash()->success("Employee Deleted succesful");
        return redirect()->route("view");
    }

    public function viewProfile($id){
        $emp = Employee::find($id);
        return view("employeeProfile.viewProfile",["emp"=>$emp]);
    }

    public function profile($id){
        return view("employeeProfile.updateProfile",["e"=>$id]);
    }

    public function updateProfile(Request $request,$id){
        Employee::updateOrCreate(
        ['id'=>$id],
        [
            'full_name' => $request->full_name,
            'bio' => $request->bio,
            'blood' => $request->blood,
        ]);
        $emp = Employee::where("id",$id)->first();
        flash()->success("Create/Update Successful");
        return redirect()->route("view");
    }
}
