<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Jkel;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bio=Bio::latest()->get();
        return response()->json([
          'message'=>'Biodata',
          'success'=>true,
          'data'=>$bio,
        ],200);
    }

    // public function pagination ()
    // {
    //   $data = Bio::paginate(5);
    //   return view('admin.kelas6a', compact('data'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function show($id_user)
     {
     //find post by ID
     $bio = Bio::findOrfail($id_user);

     //make response JSON
     return response()->json([
         'success' => true,
         'message' => 'Detail Data Post',
         'data'    => $bio
     ], 200);

   }
   public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'j_kelamin' => 'required',
            'nis' => 'required',
            'kd_kelas'   => 'required',
            'alamat' => 'required',
            'tanggal_lahir'   => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $bio = Bio::create([
            'nama'     => $request->nama,
            'j_kelamin'   => $request->j_kelamin,
            'nis'     => $request->nis,
            'kd_kelas'   => $request->kd_kelas,
            'alamat'     => $request->alamat,
            'tanggal_lahir'   => $request->tanggal_lahir,
        ]);

        //success save to database
        if($bio) {

            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data'    => $bio
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);

    }
    public function edit($id_user)
    {
      $bio = Bio::where('id_user',$id_user)->first();
      return response()->json($bio);
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

 /**
 * update
 *
 * @param  mixed $request
 * @param  mixed $post
 * @return void
 */
 public function update(Request $request,Bio $bio)
   {
       //set validation
       $validator = Validator::make($request->all(), [
           'nama'   => 'required',
           'nis' => 'required',
       ]);

       //response error validation
       if ($validator->fails()) {
           return response()->json($validator->errors(), 400);
       }

       //find post by ID
       $bio = Bio::findOrFail($bio->id_user);

       if($bio) {

           //update post
           $bio->update([
               'nama'     => $request->nama,
               'nis'   => $request->nis
           ]);

           return response()->json([
               'success' => true,
               'message' => 'Post Updated',
               'data'    => $bio
           ], 200);

       }

       //data post not found
       return response()->json([
           'success' => false,
           'message' => 'Post Not Found',
       ], 404);

   }

   public function destroy($id_user)
   {
       //find post by ID
       $bio = Bio::findOrfail($id_user);

       if($bio) {

           //delete post
           $bio->delete();

           return response()->json([
               'success' => true,
               'message' => 'Post Deleted',
           ], 200);

       }

       //data post not found
       return response()->json([
           'success' => false,
           'message' => 'Post Not Found',
       ], 404);
   }

}
