<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use APP\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');

    }//end mathod


    public function AdminLogout(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
}
//end mathod

public function AdminLogin(){
    return view('admin.admin_login');

}//end

public function AdminProfile(){
    $id= Auth::user()->id;
    $profileData= User::find($id);
    return view('admin.body.admin_pofile_view',compact('profileData'));





}
//end
public function AdminProfileStore(Request $request){
    $id= Auth::user()->id;
    $Data= User::find($id);
    $data->username=$request->username;
    $data->name=$request->name;
    $data->email=$request->email;
    $data->phone=$request->phone;

    if($request->file('photo')){
        $file =$request->file('photo');
        $filename = date('ymdi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'),$filename);
        $data['photo']=$filename;
    }
    $data->save();
    return redirect()->back();


    


}
//end




}
