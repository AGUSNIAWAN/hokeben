<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = \App\Models\Activity::latest()->get();
        return view('activities.index', compact('activities'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
            'activity_name' => 'required',
            'status' => 'required|in:Proses,Selesai',
            'notes' => 'nullable'
        ]);
        \App\Models\Activity::create($request->all());
        return redirect()->back()->with('success', 'Kegiatan berhasil dicatat');
    }

    public function destroy(\App\Models\Activity $activity)
    {
        $activity->delete();
        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }
}
