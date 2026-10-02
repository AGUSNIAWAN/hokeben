@extends('layouts.app')

@section('content')
<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px;">
    <div>
        <h1 style="margin: 0; font-size: 2rem; font-weight: 700; color: #1a1a1a; letter-spacing: -0.5px;">Input & Tracking Data Sheet</h1>
        <p style="margin: 5px 0 0 0; color: #666;">Area 19 &bull; {{ $namaBulan[$bulan] }} {{ $tahun }}</p>
    </div>
    <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <button onclick="toggleEmbed()" id="btn-embed"
            style="padding: 10px 18px; background: #1a56db; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
            <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 13H7v-2h6v2zm4-4H7V9h10v2z"/></svg>
            📂 Lihat File Asli Excel
        </button>
        <a href="https://ekabogainti-my.sharepoint.com/:x:/g/personal/giri_handoko_hokben_co_id/IQAglXy_uxWuTL3_6jULiDPNAbCmC_K7FrMfxRi6-t283jI?e=FT1W9G"
            target="_blank"
            style="padding: 10px 18px; background: white; color: #1a1a1a; border: 1px solid #e5e7eb; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 8px;">
            ↗ Buka di SharePoint
        </a>
        <form method="GET" action="{{ route('tracking.index') }}" style="display:flex; gap: 10px; align-items: center;">
            <input type="hidden" name="sheet" value="{{ $sheet }}">
            <select name="bulan" onchange="this.form.submit()" style="padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem;">
                @foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $m => $mn)
                    <option value="{{ $m }}" {{ $m == $bulan ? 'selected' : '' }}>{{ $mn }}</option>
                @endforeach
            </select>
            <select name="tahun" onchange="this.form.submit()" style="padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem;">
                @foreach([2025,2026,2027] as $y)
                    <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

{{-- ============ EMBED PANEL (SharePoint File Preview) ============ --}}
<div id="embed-panel" style="display:none; margin-bottom: 25px;">
    <div style="background: white; border-radius: 16px; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 16px 20px; background: #f8fafc; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span id="embed-title" style="font-weight: 700; color: #1a1a1a; font-size: 0.95rem;">📊 Harian_Sales Performance Regional 5 - Preview Langsung</span>
                <span style="margin-left: 12px; background: #d1fae5; color: #059669; padding: 3px 10px; border-radius: 20px; font-size: 0.78rem; font-weight: 600;">LIVE</span>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <select id="sheet-selector" onchange="changeSheet(this.value)"
                    style="padding: 6px 12px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 0.85rem;">
                    <option value="sep">SEP</option>
                    <option value="tc_all">TC ALL</option>
                    <option value="tc_member">TC Membership</option>
                    <option value="cust_fb">Cust Feedback</option>
                    <option value="mh">MH</option>
                    <option value="sales_mtd">Pencapaian Sales MTD</option>
                    <option value="dashboard">DASHBOARD</option>
                    <option value="sales_area_ext">Google Sheets: SALES AREA</option>
                </select>
                <button onclick="toggleEmbed()" style="background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; padding: 6px 12px; cursor: pointer; font-weight: 600; font-size: 0.85rem;">✕ Tutup</button>
            </div>
        </div>
        <div style="position: relative;">
            <div id="iframe-loading" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; z-index:5; padding:20px;">
                <div style="width:40px;height:40px;border:4px solid #e5e7eb;border-top:4px solid #1a56db;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto 15px;"></div>
                <p style="color:#666;font-size:0.9rem;">Memuat file Excel dari SharePoint...</p>
            </div>
            <iframe id="sharepoint-embed"
                src="https://ekabogainti-my.sharepoint.com/:x:/g/personal/giri_handoko_hokben_co_id/IQAglXy_uxWuTL3_6jULiDPNAbCmC_K7FrMfxRi6-t283jI?e=FT1W9G&action=embedview&wdAllowInteractivity=True&wdHideGridlines=False&wdHideHeaders=False&wdDownloadButton=True&wdInConfigurator=True"
                style="width:100%; height:600px; border:none; display:block;"
                onload="document.getElementById('iframe-loading').style.display='none';"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>


{{-- ============ SHEET TABS ============ --}}
<div style="background: white; border-radius: 16px; border: 1px solid #eaeaea; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 30px;">

    {{-- Tab Buttons --}}
    <div style="display: flex; background: #f8fafc; border-bottom: 1px solid #e2e8f0; overflow-x: auto;">
        @php
            $tabs = [
                'sep'       => ['label'=>'SEP',               'color'=>'#10b981'],
                'tc_all'    => ['label'=>'TC ALL',             'color'=>'#3b82f6'],
                'tc_member' => ['label'=>'TC Membership',      'color'=>'#6366f1'],
                'cust_fb'   => ['label'=>'Cust Feedback',      'color'=>'#f59e0b'],
                'mh'        => ['label'=>'MH',                 'color'=>'#ef4444'],
                'sales_mtd' => ['label'=>'Pencapaian Sales MTD','color'=>'#8b5cf6'],
                'sales_area'=> ['label'=>'Sales Area',          'color'=>'#0ea5e9'],
                'dashboard' => ['label'=>'DASHBOARD',           'color'=>'#d32f2f'],
            ];
        @endphp
        @foreach($tabs as $key => $tab)
            <a href="{{ route('tracking.index', ['sheet'=>$key, 'bulan'=>$bulan, 'tahun'=>$tahun]) }}"
               style="padding: 14px 22px; font-weight: 600; font-size: 0.9rem; text-decoration: none; white-space: nowrap;
                      color: {{ $sheet == $key ? $tab['color'] : '#64748b' }};
                      background: {{ $sheet == $key ? 'white' : 'transparent' }};
                      border-bottom: 3px solid {{ $sheet == $key ? $tab['color'] : 'transparent' }};
                      transition: 0.2s;">
                {{ $tab['label'] }}
            </a>
        @endforeach
    </div>

    <div style="padding: 25px;">

        {{-- ======= DATA TRACKING TABLE ======= --}}
        @if(in_array($sheet, $validSheets))
            @php
                $sheetTitles = [
                    'sep'       => ['title' => 'SEP (Store Excellence Program)', 'desc' => 'Tracking Data SEP harian per toko'],
                    'tc_all'    => ['title' => 'TRANSACTION COUNT (TC ALL)', 'desc' => 'Tracking total transaksi harian per toko'],
                    'tc_member' => ['title' => 'TC MEMBERSHIP', 'desc' => 'Tracking transaksi member harian'],
                    'cust_fb'   => ['title' => 'CUSTOMER FEEDBACK', 'desc' => 'Tracking input feedback pelanggan'],
                    'mh'        => ['title' => 'AKTUAL MAN HOUR (MH)', 'desc' => 'Total karyawan yang masuk di cabang per harinya'],
                    'sales_mtd' => ['title' => 'PENCAPAIAN SALES MTD', 'desc' => 'Pencapaian sales Month-to-Date per hari'],
                    'sales_area'=> ['title' => 'SALES AREA', 'desc' => 'Sales tracking harian area 19'],
                ];
                $currentTitle = $sheetTitles[$sheet]['title'] ?? strtoupper($sheet);
                $currentDesc = $sheetTitles[$sheet]['desc'] ?? 'Tracking harian per toko';
            @endphp
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <h2 style="margin:0; font-size:1.2rem; font-weight:700; color:#ef4444;">{{ $currentTitle }}</h2>
                    <p style="margin:4px 0 0 0; color:#666; font-size:0.85rem;">{{ $currentDesc }}</p>
                </div>
                <button onclick="document.getElementById('modal-add-sheet').style.display='flex'"
                    style="padding: 10px 20px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size:0.9rem;">
                    + Tambah Toko
                </button>
            </div>

            {{-- Summary Bar --}}
            <div style="display:grid; grid-template-columns: repeat(4,1fr); gap:15px; margin-bottom:20px;">
                <div style="background:#fef2f2; padding:15px; border-radius:10px; border-left:4px solid #ef4444;">
                    <div style="font-size:0.8rem; color:#ef4444; font-weight:600; text-transform:uppercase;">Total Toko</div>
                    <div style="font-size:1.8rem; font-weight:700; color:#1a1a1a;">{{ $sheetData->count() }}</div>
                </div>
                <div style="background:#f0fdf4; padding:15px; border-radius:10px; border-left:4px solid #10b981;">
                    <div style="font-size:0.8rem; color:#10b981; font-weight:600; text-transform:uppercase;">Terisi Hari Ini</div>
                    <div style="font-size:1.8rem; font-weight:700; color:#1a1a1a;">
                        {{ $sheetData->filter(fn($r) => !is_null($r->{"tgl_".now()->day}))->count() }}
                    </div>
                </div>
                <div style="background:#fffbeb; padding:15px; border-radius:10px; border-left:4px solid #f59e0b;">
                    <div style="font-size:0.8rem; color:#f59e0b; font-weight:600; text-transform:uppercase;">Belum Terisi</div>
                    <div style="font-size:1.8rem; font-weight:700; color:#1a1a1a;">
                        {{ $sheetData->filter(fn($r) => is_null($r->{"tgl_".now()->day}))->count() }}
                    </div>
                </div>
                <div style="background:#eff6ff; padding:15px; border-radius:10px; border-left:4px solid #3b82f6;">
                    <div style="font-size:0.8rem; color:#3b82f6; font-weight:600; text-transform:uppercase;">Total Bulan Ini</div>
                    <div style="font-size:1.8rem; font-weight:700; color:#1a1a1a;">
                        {{ number_format($sheetData->sum(function($r) use ($hariDalamBulan) {
                            $total = 0;
                            for($i=1;$i<=$hariDalamBulan;$i++) $total += floatval($r->{"tgl_$i"});
                            return $total;
                        }), 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div style="overflow-x: auto; border-radius: 10px; border: 1px solid #e5e7eb;">
                <table style="width:100%; border-collapse:collapse; font-size:0.82rem; margin:0;">
                    <thead>
                        {{-- Row Header Bulan --}}
                        <tr style="background:#ef4444; color:white;">
                            <th colspan="4" style="padding:10px 12px; text-align:left; border-right:2px solid rgba(255,255,255,0.3); white-space:nowrap;">
                                {{ $currentTitle }}
                            </th>
                            <th colspan="{{ $hariDalamBulan }}" style="padding:10px 12px; text-align:center; border-right:2px solid rgba(255,255,255,0.3);">
                                {{ strtoupper($namaBulan[$bulan]) }} {{ $tahun }}
                            </th>
                            <th style="padding:10px 12px; text-align:center;">NOTA</th>
                        </tr>
                        {{-- Row Kolom Header --}}
                        <tr style="background:#f8fafc;">
                            <th style="padding:10px 12px; text-align:center; border:1px solid #e5e7eb; min-width:45px;">NO</th>
                            <th style="padding:10px 12px; text-align:left; border:1px solid #e5e7eb; min-width:160px;">NAMA TOKO</th>
                            <th style="padding:10px 12px; text-align:center; border:1px solid #e5e7eb; min-width:90px;">CORP LEVEL</th>
                            <th style="padding:10px 12px; text-align:center; border:1px solid #e5e7eb; min-width:70px;">TIPE</th>
                            @for($d = 1; $d <= $hariDalamBulan; $d++)
                                @php $isToday = ($d == now()->day && $bulan == now()->month && $tahun == now()->year); @endphp
                                <th style="padding:8px 5px; text-align:center; border:1px solid #e5e7eb; min-width:36px;
                                    {{ $isToday ? 'background:#fef3c7; color:#d97706;' : '' }}">
                                    {{ $d }}
                                </th>
                            @endfor
                            <th style="padding:10px 12px; text-align:center; border:1px solid #e5e7eb; min-width:80px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sheetData as $idx => $row)
                        <tr class="mh-row" data-id="{{ $row->id }}" style="border-bottom:1px solid #f1f5f9; {{ $idx%2==0 ? 'background:white;' : 'background:#fafafa;' }}">
                            <td style="padding:8px 12px; text-align:center; border:1px solid #f1f5f9;">{{ $idx+1 }}</td>
                            <td style="padding:8px 12px; font-weight:600; border:1px solid #f1f5f9; white-space:nowrap;">{{ $row->nama_toko }}</td>
                            <td style="padding:8px 12px; text-align:center; border:1px solid #f1f5f9;">{{ $row->corporate_level }}</td>
                            <td style="padding:8px 12px; text-align:center; border:1px solid #f1f5f9;">{{ $row->tipe }}</td>
                            @for($d = 1; $d <= $hariDalamBulan; $d++)
                                @php
                                    $val = $row->{"tgl_$d"};
                                    $isToday = ($d == now()->day && $bulan == now()->month && $tahun == now()->year);
                                @endphp
                                <td style="padding:4px 2px; text-align:center; border:1px solid #f1f5f9;
                                    {{ $isToday ? 'background:#fef3c7;' : '' }}">
                                    <input type="number"
                                        step="0.5"
                                        value="{{ $val }}"
                                        onchange="updateCell({{ $row->id }}, 'tgl_{{ $d }}', this.value)"
                                        style="width:32px; padding:4px 2px; border:none; background:{{ is_null($val) ? '#fee2e2' : '#d1fae5' }};
                                               border-radius:4px; text-align:center; font-size:0.78rem; font-weight:600;"
                                        placeholder="-"
                                        onfocus="this.style.background='#dbeafe'; this.style.border='1px solid #3b82f6';"
                                        onblur="this.style.border='none'; this.style.background=this.value ? '#d1fae5' : '#fee2e2';"
                                    >
                                </td>
                            @endfor
                            <td style="padding:6px 10px; text-align:center; border:1px solid #f1f5f9; white-space:nowrap;">
                                <form method="POST" action="{{ route('tracking.sheet.destroy', $row->id) }}" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:#fee2e2; color:#ef4444; border:none; border-radius:6px; padding:5px 10px; cursor:pointer; font-size:0.78rem; font-weight:600;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $hariDalamBulan + 5 }}" style="padding:40px; text-align:center; color:#94a3b8;">
                                Belum ada data. Klik <strong>"+ Tambah Toko"</strong> untuk mulai input.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif

        {{-- ======= DASHBOARD ======= --}}
        @if($sheet == 'dashboard')
            <div style="padding:40px; text-align:center; color:#64748b;">
                <div style="font-size:3rem;">📈</div>
                <h3 style="margin:15px 0 10px; color:#1a1a1a;">Dashboard Ringkasan</h3>
                <p>Ringkasan keseluruhan data dari semua sheet akan ditampilkan di sini.</p>
            </div>
        @endif

    </div>{{-- end tab content --}}
</div>{{-- end card --}}

{{-- MODAL TAMBAH TOKO --}}
<div id="modal-add-sheet" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:16px; padding:30px; width:90%; max-width:500px; box-shadow:0 25px 50px rgba(0,0,0,0.3);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h3 style="margin:0; font-weight:700; color:#1a1a1a;">Tambah Toko - Sheet {{ strtoupper($sheet) }}</h3>
            <button onclick="document.getElementById('modal-add-sheet').style.display='none'"
                style="background:#f1f5f9; border:none; border-radius:6px; padding:6px 12px; cursor:pointer; font-size:1rem;">✕</button>
        </div>
        <form method="POST" action="{{ route('tracking.sheet.store') }}">
            @csrf
            <input type="hidden" name="sheet_name" value="{{ $sheet }}">
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">No. Toko</label>
                <input type="text" name="no_toko" placeholder="contoh: A001" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px; font-size:0.9rem;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">Nama Toko <span style="color:red">*</span></label>
                <input type="text" name="nama_toko" placeholder="contoh: HOKBEN SUDIRMAN" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px; font-size:0.9rem;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">Corporate Level</label>
                <select name="corporate_level" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px; font-size:0.9rem;">
                    <option value="">-- Pilih --</option>
                    <option>Class A</option>
                    <option>Class B</option>
                    <option>Class C</option>
                    <option>Class D</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:0.9rem;">Tipe</label>
                <select name="tipe" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px; font-size:0.9rem;">
                    <option value="">-- Pilih --</option>
                    <option>Mall</option>
                    <option>Street</option>
                    <option>Drive Thru</option>
                    <option>Standalone</option>
                </select>
            </div>
            <div style="display:flex; gap:10px; margin-top:25px;">
                <button type="submit" class="btn" style="flex:1; padding:12px; background:#10b981; color:white; border:none; border-radius:6px; font-weight:600; cursor:pointer;">💾 Simpan Toko</button>
                <button type="button" onclick="document.getElementById('modal-add-sheet').style.display='none'"
                    style="padding:12px 20px; background:#f1f5f9; border:none; border-radius:6px; cursor:pointer; font-weight:600;">Batal</button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes spin { 0%{transform:rotate(0deg)} 100%{transform:rotate(360deg)} }
</style>
<script>
function updateCell(id, field, value) {
    fetch(`/tracking/sheet/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ [field]: value })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const input = event.target;
            input.style.background = '#bfdbfe';
            setTimeout(() => { input.style.background = value ? '#d1fae5' : '#fee2e2'; }, 500);
        }
    });
}

function toggleEmbed() {
    const panel = document.getElementById('embed-panel');
    const btn   = document.getElementById('btn-embed');
    if (panel.style.display === 'none') {
        panel.style.display = 'block';
        btn.style.background = '#1e429f';
        btn.textContent = '✕ Sembunyikan Preview';
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        panel.style.display = 'none';
        btn.innerHTML = `<svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 13H7v-2h6v2zm4-4H7V9h10v2z"/></svg> 📂 Lihat File Asli Excel`;
        btn.style.background = '#1a56db';
    }
}

function changeSheet(val) {
    document.getElementById('iframe-loading').style.display = 'block';
    
    if (val === 'sales_area_ext') {
        const gsUrl = `https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/htmlembed?widget=true&headers=false`;
        document.getElementById('sharepoint-embed').src = gsUrl;
        document.getElementById('embed-title').innerText = '📊 08. AGUSTUS - SALES AREA 19 (Google Sheets)';
    } else {
        const baseUrl = `https://ekabogainti-my.sharepoint.com/:x:/g/personal/giri_handoko_hokben_co_id/IQAglXy_uxWuTL3_6jULiDPNAbCmC_K7FrMfxRi6-t283jI?e=FT1W9G&action=embedview&wdAllowInteractivity=True&wdHideGridlines=False&wdHideHeaders=False&wdDownloadButton=True`;
        document.getElementById('sharepoint-embed').src = baseUrl;
        document.getElementById('embed-title').innerText = '📊 Harian_Sales Performance Regional 5 - Preview Langsung';
    }
}
</script>
@endsection
