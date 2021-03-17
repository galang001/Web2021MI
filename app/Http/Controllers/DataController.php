<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bio=Bio::all();
        $title="Biodata";
        return view('admin.biodata', compact('title','bio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Input Data";
        return view('admin.inputdata', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message=[
            'required'=>'Kolom :attribute Harus Lengkap',
            'date'=>'Kolom :attribute Wajib Dengan Format Y-m-d contoh : 2000-04-12',
            'numeric'=>'Kolom :attribute Harus Angka'
        ];
        $validasi=$request->validate([
            'nama'=>'required|max:255',
            'alamat'=>'required|max:255',
            'tanggal_lahir'=>'date',
            'j_kelamin'=>'required'
        ]);
        $validasi['user_id']=Auth::id();
        Bio::create($validasi);
        return redirect('biodata')->with('success','Data Berhasil Tersimpan');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bio=Bio::find($id);
        $title="Edit Biodata";
        return view('admin.inputdata', compact('title','bio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message=[
            'required'=>'Kolom :attribute Harus Lengkap',
            'date'=>'Kolom :attribute Wajib Dengan Format Y-m-d contoh : 2000-04-12',
            'numeric'=>'Kolom :attribute Harus Angka'
        ];
        $validasi=$request->validate([
            'nama'=>'required|max:255',
            'alamat'=>'required|max:255',
            'tanggal_lahir'=>'date',
            'j_kelamin'=>'required'
        ]);
        $validasi['user_id']=Auth::id();
        Bio::where('id',$id)->update($validasi);
        return redirect('biodata')->with('success','Data Berhasil Terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bio=Bio::find($id);
        if($bio !=null){
            $bio=Bio::find($bio->id);
            Bio::where('id',$id)->delete();
        }
        return redirect('biodata')->with('success','Data Berhasil Terhapus');
    }
}
