<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data_mahasiswa = Mahasiswa::all();
        return view('mahasiswa',['mahasiswa' => $data_mahasiswa]);
    }

    public function tambah()
    {
        return view('tambahMahasiswa');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'first_name' => 'required',
            'last_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required'
    	]);
 
        Mahasiswa::create([
    		'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_email' => $request->user_email,
            'user_password' => md5($request->user_password)
    	]);

        return redirect('/mahasiswa');
    }

    public function edit($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        return view('edit',['mahasiswa' => $data_mahasiswa]);
    }

    public function update($id,Request $request)
    {
        $this->validate($request,[
    		'first_name' => 'required',
            'last_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required'
        ]);
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->first_name = $request->first_name;
        $mahasiswa->last_name = $request->last_name;
        $mahasiswa->user_email = $request->user_email;
        $mahasiswa->user_password = $request->user_password;
        $mahasiswa->save();
        return redirect('/mahasiswa');
    }

    public function destroy($id)
    {
        Mahasiswa::where('id',$id)->delete();
        return redirect()->back();
    }
}
