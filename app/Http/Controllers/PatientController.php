<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $query = Patient::orderBy('id', 'asc');

        if (request('search')) {
            $search = request('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('id', intval($search));
        }

        $data = $query->get();

        if (request()->ajax()) {
            return view('pages.patients.table', compact('data'))->render();
        }

        return view('pages.patients.index', compact('data'));
    }




    public function shows()
    {
        //showing patient data
        $data = Patient::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengambil data !',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //showing form add patient
        return view('pages.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //process POST patient data
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
            'gender' => 'required',
            'phone_number' => 'nullable', // Membuat phone_number opsional
            'birthday' => 'nullable|date' // Membuat birthday opsional
        ], [
            'name.required' => 'Nama wajib diisi !',
            'age.required' => 'Umur wajib diisi !',
            'address.required' => 'Alamat wajib diisi !',
            'gender.required' => 'Jenis Kelamin wajib diisi !',
        ]);

        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number ?? null,
            'birthday' => $request->birthday ?? null
        ];

        $patient = Patient::create($data);

        return redirect('/patients/add')->with('success', [
            'id' => $patient->id, // Tambahkan ID pasien ke session
            'name' => $patient->name,
            'age' => $patient->age
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'status' => false,
                'message' => 'Data pasien tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengambil data pasien!',
            'data' => $patient
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Patient::findOrFail($id);
        return view('pages.patients.edit', ['patient' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    // Dalam PatientController
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Validasi dan update data pasien
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'age' => 'required|integer',
            'birthday' => 'required|date',
            'phone_number' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi !',
            'age.required' => 'Umur wajib diisi !',
            'address.required' => 'Alamat wajib diisi !',
            'gender.required' => 'Jenis Kelamin wajib diisi !',
        ]);

        $patient->update($request->all());

        // Menyimpan session success untuk pasien
        return redirect()->route('patients.edit', ['id' => $id])->with('patient_success', [
            'id' => $patient->id,
            'name' => $patient->name,
            'age' => $patient->age,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::where('id', $id);
        $patient->delete();
        return redirect('/patients')->with('success');
    }
}
