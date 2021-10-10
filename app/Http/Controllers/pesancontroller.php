<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pesan;
use App\Models\User;

class pesancontroller extends Controller
{
    public function index()
    {    
        $user = user::wherenotin('id', [auth()->user()->id])->get();
        return view('admin/pesan/index', compact('user'));
    }
    public function pesan(Request $request, $id)
    {
        // $query = "SELECT *, pesan.id as idpesan from pesan where to = ". $id ." AND from = ". auth()->user()->id ." OR to = ". $id ." AND from = ". auth()->user()->id  ." " ;
        // $pesan = pesan::query($query)
         $pesan = pesan::select('*', 'pesan.id as idpesan')->from('pesan')
                ->join('users', 'users.id', '=', 'pesan.from')    
                ->orderby('waktu', 'asc')
                ->get();
        pesan::where(['to' => auth()->user()->id, 'from' => $id ])->update(['status' => 0]);

        $user = user::find($id);
        if($request->ajax()){
            $ajax = [
                'pesan'     => $pesan,
                'user'      => $user
            ];
            return response()->json($ajax);
        }
        return view('admin/pesan/tulis-pesan', compact('pesan','user'));
    }
    public function pesan_aksi(Request $request, $id)
    {
      
        $pesan = [
            'to'        => $id,
            'from'      => auth()->user()->id,
            'pesan'     => $request->pesan,
            'waktu'     => date('Y-m-d-H:i:s'),
            'status'    => 1
        ];
        pesan::insert($pesan);
        return response()->json('berhasil');
    }

    public function pesan_hapus($id)
    {
        pesan::find($id)->delete();
        return response()->json('berhasil');
    }
}
