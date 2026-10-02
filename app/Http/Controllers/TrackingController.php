<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackingMh;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', 9);
        $tahun = $request->get('tahun', 2026);
        $sheet = $request->get('sheet', 'sep');

        // Allow these sheets to use the generic daily table
        $validSheets = ['sep', 'tc_all', 'tc_member', 'cust_fb', 'mh', 'sales_mtd', 'sales_area'];
        if (!in_array($sheet, $validSheets) && $sheet !== 'dashboard') {
            $sheet = 'sep';
        }

        $sheetData = [];
        if (in_array($sheet, $validSheets)) {
            $sheetData = \App\Models\TrackingSheet::where('sheet_name', $sheet)
                                      ->where('bulan', $bulan)
                                      ->where('tahun', $tahun)
                                      ->get();
        }

        // Hitung jumlah hari dalam bulan
        $hariDalamBulan = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        $namaBulan = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
            7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];

        return view('tracking.index', compact('sheetData','bulan','tahun','sheet','hariDalamBulan','namaBulan', 'validSheets'));
    }

    public function storeSheet(Request $request)
    {
        $data = $request->validate([
            'sheet_name'      => 'required|string',
            'no_toko'         => 'nullable|string|max:20',
            'nama_toko'       => 'required|string|max:100',
            'corporate_level' => 'nullable|string|max:50',
            'tipe'            => 'nullable|string|max:50',
            'bulan'           => 'required|integer',
            'tahun'           => 'required|integer',
            'nota'            => 'nullable|string',
        ]);

        for ($i = 1; $i <= 31; $i++) {
            $data["tgl_$i"] = $request->input("tgl_$i");
        }

        \App\Models\TrackingSheet::create($data);
        return redirect()->route('tracking.index', ['sheet'=>$data['sheet_name'],'bulan'=>$data['bulan'],'tahun'=>$data['tahun']])->with('success','Data berhasil disimpan!');
    }

    public function updateSheet(Request $request, $id)
    {
        $row = \App\Models\TrackingSheet::findOrFail($id);
        $fillable = [];
        for ($i = 1; $i <= 31; $i++) {
            $key = "tgl_$i";
            $fillable[$key] = $request->input($key);
        }
        $fillable['nota'] = $request->input('nota');
        $row->update($fillable);
        return response()->json(['success' => true]);
    }

    public function destroySheet($id)
    {
        \App\Models\TrackingSheet::findOrFail($id)->delete();
        return back()->with('success', 'Baris berhasil dihapus.');
    }
}

