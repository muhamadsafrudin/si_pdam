<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class usercontroller extends Controller
{
    public function index()
    {
        $users = User::where('email','!=', "admin@gmail.com")->get();
        return view('admin/user/index', compact('users'));
    }
    public function create()
    {
        return view('admin/user/create');
    }
    public function store(Request $request)
    {
        $messages = [
            'required'       => "Form masih Kosong",
            'same'           => "Tidak sesuai dengan password",
            'unique'         => "Email sudah digunakan",
        ];
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|unique:users,email',
            'role'      => 'required',
            'password'  => 'required',
            'passconf'  => 'required|same:password',
        ],$messages);
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => hash::make($request->password),
        ];
        user::insert($data);
        return redirect('admin/user')->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $user = user::find($id);
        return view('admin/user/edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $messages = [
            'required'       => "Form masih Kosong",
            'same'           => "Tidak sesuai dengan password",
        ];
        if($request->password || $request->passconf){
            $request->validate([
                'nama'      => 'required',
                'role'      => 'required',
                'password'  => 'required',
                'passconf'  => 'required|same:password',
            ],$messages);

            $data = [
                'name' => $request->nama,
                'role' => $request->role,
                'password' => hash::make($request->password),
            ];
        }else{
            $request->validate([
                'nama'      => 'required',
                'role'      => 'required',
            ],$messages);
            $data = [
                'name' => $request->nama,
                'role' => $request->role,
            ];
        }
       // dd($data);
        user::where('id',$id)->update($data);
        return redirect('admin/user')->with('success','Data berhasil diedit');
    }
    public function destroy($id)
    {
        user::where('id',$id)->delete();
        return redirect('admin/user')->with('success','Data berhasil dihapus');
    }



    //profile
    public function profile()
    {
        return view('admin/user/profile');
    }
    public function profileupdate(Request $request,$id)
    {
        $messages = [
            'required'       => "Form masih Kosong",
            'same'           => "Tidak sesuai dengan password",
        ];
        if($request->password || $request->passconf){
            $request->validate([
                'nama'      => 'required',
                'password'  => 'required',
                'passconf'  => 'required|same:password',
            ],$messages);
            $data = [
                'name' => $request->nama,
                'password' => hash::make($request->password),
            ];
        }else{
            $request->validate([
                'nama'      => 'required',
            ],$messages);
            $data = [
                'name' => $request->nama,
                'password' => hash::make($request->password),
            ];
        }
        user::where('id',$id)->update($data);
        return back()->with('success','Data berhasil diedit');
    }

}
