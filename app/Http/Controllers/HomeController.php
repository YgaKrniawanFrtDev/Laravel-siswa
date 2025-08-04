<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showData()
    {
        $dataSiswa = siswa::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'dataSiswa' => $dataSiswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi inputan
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        // porses memauskan data ke dalam database
        $dataSiswa = siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat

        ]);


        // kirim data lewat json
        return response()->json([
            'success' => true,
            'message' => 'successfuly',
            'dataSiswa' => $dataSiswa
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataSiswa = siswa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nis' => 'nullable|integer',
            'nama' => 'nullable|string|max:255',
            'kelas' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $validateData = $validator->validate();

        $dataSiswa->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'dataSiswa' => $dataSiswa
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = siswa::findOrFail($id);

        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $siswa->delete();
        return response()->json([
            'success' => true,
            'message' =>  'successfuly',
            'dataDelete' => $siswa
        ]);
    }
}
