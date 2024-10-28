<?php

namespace App\Http\Controllers;

use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($patient_id)
    {
        // Mengambil semua riwayat berdasarkan `patient_id`
        $records = PatientRecord::where('patient_id', $patient_id)->orderBy('visit_date', 'desc')->get();

        if ($records->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada riwayat untuk pasien ini',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengambil riwayat pasien',
            'data' => $records
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $patient_id)
    {
        //POST riwayat pasien
        $request->validate([
            'visit_date' => 'required|date',
            'complaint' => 'required',
            'treatment' => 'required',
            'blood_pressure' => 'required'
        ]);

        $data = [
            'patient_id' => $patient_id,
            'visit_date' => $request->visit_date,
            'complaint' => $request->complaint,
            'treatment' => $request->treatment,
            'blood_pressure' => $request->blood_pressure
        ];

        PatientRecord::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menambahkan riwayat',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientRecord $patientRecord)
    {
        //
    }
}
