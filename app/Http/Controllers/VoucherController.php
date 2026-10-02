<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = \App\Models\Voucher::latest()->get();
        return view('vouchers.index', compact('vouchers'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'status' => 'required|in:diberikan,digunakan',
            'notes' => 'nullable'
        ]);
        \App\Models\Voucher::create($request->all());
        return redirect()->back()->with('success', 'Voucher berhasil ditambahkan');
    }

    public function destroy(\App\Models\Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->back()->with('success', 'Voucher berhasil dihapus');
    }
}
