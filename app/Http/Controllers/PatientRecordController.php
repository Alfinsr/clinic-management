<?php

namespace App\Http\Controllers;

use App\Models\PatientRecord;
use App\Models\Patient;
use Carbon\Carbon;
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

        // Format tanggal untuk setiap riwayat kunjungan
        foreach ($records as $record) {
            $record->formatted_date = Carbon::parse($record->visit_date)->format('d F Y');
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
        // Form untuk membuat riwayat baru
    }

    /**
     * Store a newly created resource in storage.
     */
    // Dalam PatientRecordController
    public function store(Request $request, $patient_id)
    {
        // Validasi input
        $request->validate([
            'visit_date' => 'required|date',
            'complaint' => 'required',
            'treatment' => 'required',
            'blood_pressure' => 'required',
        ]);

        // Data untuk disimpan
        $data = [
            'patient_id' => $patient_id,
            'visit_date' => $request->visit_date,
            'complaint' => $request->complaint,
            'treatment' => $request->treatment,
            'blood_pressure' => $request->blood_pressure,
        ];

        // Menyimpan data riwayat kunjungan
        PatientRecord::create($data);

        // Menyimpan session success untuk riwayat kunjungan
        return redirect()->route('patients.edit', ['id' => $patient_id])->with('record_success', [
            'visit_date' => $request->visit_date,
            'complaint' => $request->complaint,
            'treatment' => $request->treatment,
        ]);
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
