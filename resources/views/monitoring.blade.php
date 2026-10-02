@extends('layouts.app')

@section('content')

<style>
:root {
    --hb-red: #CC0000;
    --hb-yellow: #F8B803;
    --hb-dark: #1a1a2e;
    --hb-card: #ffffff;
    --hb-border: #e2e8f0;
    --hb-text: #2d3748;
    --hb-muted: #718096;
    --hb-green: #38a169;
    --hb-blue: #3182ce;
    --hb-orange: #dd6b20;
    --hb-purple: #805ad5;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
}

/* PAGE HEADER */
.mon-header {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    color: white;
    padding: 28px 32px;
    border-radius: 16px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.mon-header::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(248,184,3,0.15);
}
.mon-header::after {
    content: '';
    position: absolute;
    bottom: -60px; left: 60px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(204,0,0,0.1);
}
.mon-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(248,184,3,0.2);
    border: 1px solid rgba(248,184,3,0.4);
    color: #F8B803;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    margin-bottom: 10px;
    position: relative; z-index: 1;
}
.mon-header h1 {
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0 0 6px 0;
    position: relative; z-index: 1;
}
.mon-header p {
    margin: 0;
    color: rgba(255,255,255,0.65);
    font-size: 0.9rem;
    position: relative; z-index: 1;
}

/* SECTION TITLE */
.sec-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 26px 0 14px 0;
}
.sec-title h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--hb-text);
    margin: 0;
    white-space: nowrap;
}
.sec-divider { flex: 1; height: 1px; background: var(--hb-border); }
.sec-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem; flex-shrink: 0;
}
.icon-red { background: #fff5f5; color: var(--hb-red); }
.icon-blue { background: #ebf8ff; color: var(--hb-blue); }
.icon-green { background: #f0fff4; color: var(--hb-green); }

/* LINK CARDS */
.link-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}
.link-card {
    background: var(--hb-card);
    border: 1px solid var(--hb-border);
    border-radius: 14px;
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s;
    text-decoration: none;
}
.link-card:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--hb-red);
    transform: translateY(-2px);
}
.lc-icon {
    width: 46px; height: 46px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.lc-icon.red { background: linear-gradient(135deg, #CC0000, #e53e3e); }
.lc-icon.yellow { background: linear-gradient(135deg, #F8B803, #f6ad55); }
.lc-content h3 { font-size: 0.9rem; font-weight: 700; color: var(--hb-text); margin: 0 0 2px 0; }
.lc-content p { font-size: 0.78rem; color: var(--hb-muted); margin: 0; }
.lc-arrow { margin-left: auto; color: var(--hb-muted); font-size: 1.05rem; flex-shrink: 0; }

/* SHEET TABS WRAPPER */
.tabs-wrap {
    background: var(--hb-card);
    border: 1px solid var(--hb-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 24px;
}
.tabs-header {
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    padding: 16px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.tabs-header h3 { color: white; font-size: 0.95rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px; }
.tabs-nav {
    display: flex;
    overflow-x: auto;
    gap: 0;
    padding: 0 20px;
    background: #f8fafc;
    border-bottom: 2px solid var(--hb-border);
    scrollbar-width: none;
}
.tabs-nav::-webkit-scrollbar { display: none; }
.tab-btn {
    display: flex; align-items: center; gap: 7px;
    padding: 13px 18px;
    background: none; border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    font-size: 0.82rem; font-weight: 600;
    color: var(--hb-muted);
    white-space: nowrap;
    transition: all 0.2s;
    margin-bottom: -2px;
    font-family: inherit;
}
.tab-btn:hover { color: var(--hb-text); background: rgba(204,0,0,0.03); }
.tab-btn.active { color: var(--hb-red); border-bottom-color: var(--hb-red); background: white; }
.tab-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; flex-shrink: 0; }

/* PANEL */
.tab-panel { display: none; padding: 22px; animation: panelIn 0.22s ease; }
.tab-panel.active { display: block; }
@keyframes panelIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* OUTLET SUMMARY */
.outlet-summary {
    display: flex; gap: 10px; flex-wrap: wrap;
    padding: 14px 16px;
    background: linear-gradient(135deg, rgba(26,26,46,0.04), rgba(204,0,0,0.04));
    border: 1px solid rgba(204,0,0,0.15);
    border-radius: 12px;
    margin-bottom: 18px;
}
.sum-item { flex: 1; min-width: 110px; text-align: center; }
.sum-label { font-size: 0.68rem; color: var(--hb-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 3px; }
.sum-val { font-size: 1.05rem; font-weight: 800; color: var(--hb-text); }
.sum-val.red { color: var(--hb-red); }
.sum-val.green { color: var(--hb-green); }

/* SUBSECTION LABEL */
.sub-label {
    font-size: 0.75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.8px;
    color: var(--hb-muted);
    border-bottom: 2px solid var(--hb-border);
    padding-bottom: 7px;
    margin: 18px 0 13px 0;
    display: flex; align-items: center; gap: 8px;
}
.sub-label .sub-badge {
    background: var(--hb-border); color: var(--hb-muted);
    padding: 2px 8px; border-radius: 8px; font-size: 0.68rem;
}

/* PERKOLOM GRID */
.perkolom-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}
.col-card {
    background: #f8fafc;
    border: 1px solid var(--hb-border);
    border-radius: 12px;
    padding: 14px;
    text-align: center;
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
}
.col-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--acc, #CBD5E0);
}
.col-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
    border-color: var(--acc, var(--hb-border));
}
.col-card .cc-label {
    font-size: 0.68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.4px;
    color: var(--hb-muted); margin-bottom: 9px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.col-card .cc-val {
    font-size: 1.3rem; font-weight: 800;
    color: var(--hb-text); line-height: 1;
    margin-bottom: 4px;
}
.col-card .cc-sub { font-size: 0.68rem; color: var(--hb-muted); margin-top: 3px; }
.col-card .cc-pct {
    display: inline-block; padding: 2px 7px;
    border-radius: 10px; font-size: 0.68rem; font-weight: 700;
    margin-top: 5px;
}
.pct-green { background: #f0fff4; color: var(--hb-green); }
.pct-red { background: #fff5f5; color: var(--hb-red); }
.pct-yellow { background: #fffff0; color: #b7791f; }

/* EMBED */
.embed-wrap {
    background: var(--hb-card);
    border: 1px solid var(--hb-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 24px;
}
.embed-hdr {
    padding: 14px 22px;
    background: #f8fafc;
    border-bottom: 1px solid var(--hb-border);
    display: flex; align-items: center; justify-content: space-between;
}
.embed-hdr h3 { font-size: 0.9rem; font-weight: 700; color: var(--hb-text); margin: 0; display: flex; align-items: center; gap: 7px; }
.embed-hdr a { font-size: 0.78rem; color: var(--hb-blue); text-decoration: none; font-weight: 600; }
.embed-hdr a:hover { text-decoration: underline; }
.embed-toolbar {
    display: flex; gap: 5px; flex-wrap: wrap;
    padding: 10px 22px;
    background: white;
    border-bottom: 1px solid var(--hb-border);
}
.gid-btn {
    font-size: 0.72rem; padding: 3px 9px;
    border-radius: 7px;
    border: 1px solid var(--hb-border);
    background: white; cursor: pointer;
    font-family: inherit; font-weight: 500;
    color: var(--hb-muted); transition: all 0.15s;
}
.gid-btn:hover { border-color: var(--hb-red); color: var(--hb-red); }
.gid-btn.active { background: var(--hb-red); color: white; border-color: var(--hb-red); }
.embed-frame iframe { width: 100%; border: none; display: block; }

/* TRACKING TABLE */
.track-wrap {
    background: var(--hb-card);
    border: 1px solid var(--hb-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}
.track-tbl { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
.track-tbl thead tr { background: #f8fafc; border-bottom: 2px solid var(--hb-border); }
.track-tbl th { padding: 12px 18px; text-align: left; font-weight: 600; color: var(--hb-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.4px; white-space: nowrap; }
.track-tbl td { padding: 12px 18px; color: var(--hb-text); border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
.track-tbl tbody tr:hover { background: #f8fafc; }
.track-tbl tbody tr:last-child td { border-bottom: none; }
.bdg { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
.bdg-green { background: #d1fae5; color: #059669; }
.bdg-red { background: #fee2e2; color: #dc2626; }
.bdg-yellow { background: #fef3c7; color: #d97706; }
.bdg-gray { background: #f1f5f9; color: #64748b; }
</style>

{{-- PAGE HEADER --}}
<div class="mon-header">
    <div class="mon-badge">📊 Sales Area 19 · Agustus 2026</div>
    <h1>Monitoring Harian Area 19</h1>
    <p>Rekap data penjualan per kolom untuk setiap outlet — SISWANTO</p>
</div>

{{-- QUICK LINKS --}}
<div class="sec-title">
    <div class="sec-icon icon-blue">🔗</div>
    <h2>Sumber Data Eksternal</h2>
    <div class="sec-divider"></div>
</div>
<div class="link-grid">
    <a href="https://ekabogainti-my.sharepoint.com/:x:/g/personal/giri_handoko_hokben_co_id/IQAglXy_uxWuTL3_6jULiDPNAbCmC_K7FrMfxRi6-t283jI?e=FT1W9G" target="_blank" class="link-card">
        <div class="lc-icon red">📈</div>
        <div class="lc-content">
            <h3>Sales Performance Regional 5</h3>
            <p>Harian_Sales Performance Regional 5 Th 2026.xlsx</p>
        </div>
        <div class="lc-arrow">↗</div>
    </a>
    <a href="https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/edit?gid=297723641#gid=297723641" target="_blank" class="link-card">
        <div class="lc-icon yellow">📋</div>
        <div class="lc-content">
            <h3>08. AGUSTUS – Sales Area 19 2026</h3>
            <p>SISWANTO · Google Sheets</p>
        </div>
        <div class="lc-arrow">↗</div>
    </a>
</div>

{{-- PERKOLOM PER SHEET --}}
<div class="sec-title">
    <div class="sec-icon icon-red">🏪</div>
    <h2>Data Per Kolom – Per Sheet Outlet</h2>
    <div class="sec-divider"></div>
</div>

@php
$outlets = [
    ['id'=>'plaju',         'label'=>'05. PLAJU',          'gid'=>'297723641',  'color'=>'#CC0000'],
    ['id'=>'simpang',       'label'=>'06. SIMPANG BANDARA','gid'=>'297723641',  'color'=>'#e53e3e'],
    ['id'=>'lcm',           'label'=>'07. LCM',            'gid'=>'297723641',  'color'=>'#dd6b20'],
    ['id'=>'lahat',         'label'=>'08. LAHAT',          'gid'=>'297723641',  'color'=>'#d69e2e'],
    ['id'=>'psm',           'label'=>'09. PSM',            'gid'=>'297723641',  'color'=>'#38a169'],
    ['id'=>'pangkalpinang', 'label'=>'10. PANGKAL PINANG', 'gid'=>'297723641',  'color'=>'#3182ce'],
    ['id'=>'baturaja',      'label'=>'11. BATURAJA',       'gid'=>'297723641',  'color'=>'#805ad5'],
];
$salesCols = [
    ['label'=>'Birthday',   'color'=>'#CC0000', 'icon'=>'🎂'],
    ['label'=>'Dine In',    'color'=>'#e53e3e', 'icon'=>'🍽️'],
    ['label'=>'Delivery',   'color'=>'#3182ce', 'icon'=>'🛵'],
    ['label'=>'Expoo',      'color'=>'#dd6b20', 'icon'=>'🏪'],
    ['label'=>'Take Away',  'color'=>'#d69e2e', 'icon'=>'📦'],
    ['label'=>'Drive Thru', 'color'=>'#38a169', 'icon'=>'🚗'],
    ['label'=>'Gofood',     'color'=>'#38a169', 'icon'=>'🟢'],
    ['label'=>'Grabfood',   'color'=>'#16a34a', 'icon'=>'🟩'],
    ['label'=>'Shopeefood', 'color'=>'#e53e3e', 'icon'=>'🛍️'],
];
$tcCols = [
    ['label'=>'TMS',       'color'=>'#3182ce'],
    ['label'=>'CL+TMBS',   'color'=>'#805ad5'],
    ['label'=>'Honorer',   'color'=>'#dd6b20'],
    ['label'=>'Partime',   'color'=>'#d69e2e'],
    ['label'=>'CL',        'color'=>'#38a169'],
    ['label'=>'Part Time', 'color'=>'#e53e3e'],
];
@endphp

<div class="tabs-wrap">
    <div class="tabs-header">
        <h3>📂 Sheet Outlet — Pilih untuk melihat data per kolom</h3>
        <span style="color:rgba(255,255,255,0.45);font-size:0.78rem;">Sales Area 19 · 2026</span>
    </div>
    <div class="tabs-nav">
        @foreach($outlets as $i => $outlet)
        <button class="tab-btn {{ $i===0?'active':'' }}"
                onclick="switchTab('{{ $outlet['id'] }}')"
                id="tab-{{ $outlet['id'] }}">
            <span class="tab-dot" style="color:{{ $outlet['color'] }};"></span>
            {{ $outlet['label'] }}
        </button>
        @endforeach
    </div>

    @foreach($outlets as $i => $outlet)
    <div class="tab-panel {{ $i===0?'active':'' }}" id="panel-{{ $outlet['id'] }}">

        {{-- Outlet Summary --}}
        <div class="outlet-summary">
            <div class="sum-item">
                <div class="sum-label">Outlet</div>
                <div class="sum-val red">{{ $outlet['label'] }}</div>
            </div>
            <div class="sum-item">
                <div class="sum-label">Target Sales / Bulan</div>
                <div class="sum-val">—</div>
            </div>
            <div class="sum-item">
                <div class="sum-label">Actual Sales</div>
                <div class="sum-val green">—</div>
            </div>
            <div class="sum-item">
                <div class="sum-label">Pencapaian</div>
                <div class="sum-val">—%</div>
            </div>
            <div class="sum-item">
                <div class="sum-label">Target TC</div>
                <div class="sum-val">—</div>
            </div>
            <div class="sum-item">
                <div class="sum-label">Actual TC</div>
                <div class="sum-val green">—</div>
            </div>
        </div>

        {{-- Section A: Sales Per Kolom --}}
        <div class="sub-label">📊 Section A — Sales Per Kolom <span class="sub-badge">Resume Bulan</span></div>
        <div class="perkolom-grid">
            @foreach($salesCols as $col)
            <div class="col-card" style="--acc:{{ $col['color'] }}">
                <div class="cc-label">{{ $col['icon'] }} {{ $col['label'] }}</div>
                <div class="cc-val">—</div>
                <div class="cc-sub">Total Resume</div>
                <span class="cc-pct pct-yellow">AC: —%</span>
            </div>
            @endforeach
            <div class="col-card" style="--acc:#1a1a2e;background:linear-gradient(135deg,rgba(26,26,46,0.05),rgba(204,0,0,0.05))">
                <div class="cc-label">💰 TOTAL SALES</div>
                <div class="cc-val" style="color:var(--hb-red)">—</div>
                <div class="cc-sub">Resume Bulan</div>
                <span class="cc-pct pct-yellow">—%</span>
            </div>
        </div>

        {{-- Section TC Per Kolom --}}
        <div class="sub-label">👥 Section TC — Traffic Count Per Kolom <span class="sub-badge">Resume Bulan</span></div>
        <div class="perkolom-grid">
            @foreach($tcCols as $col)
            <div class="col-card" style="--acc:{{ $col['color'] }}">
                <div class="cc-label">{{ $col['label'] }}</div>
                <div class="cc-val">—</div>
                <div class="cc-sub">Resume TC</div>
            </div>
            @endforeach
            <div class="col-card" style="--acc:#3182ce;background:linear-gradient(135deg,rgba(49,130,206,0.05),rgba(128,90,213,0.05))">
                <div class="cc-label">🔢 TC PER DAY</div>
                <div class="cc-val" style="color:var(--hb-blue)">—</div>
                <div class="cc-sub">Resume Bulan</div>
                <span class="cc-pct pct-yellow">—%</span>
            </div>
        </div>

        {{-- Section AC Per Day --}}
        <div class="sub-label">📐 Section AC Per Day — Avg Check Per Kolom <span class="sub-badge">Per Day</span></div>
        <div class="perkolom-grid">
            @foreach($salesCols as $col)
            <div class="col-card" style="--acc:{{ $col['color'] }}">
                <div class="cc-label">{{ $col['icon'] }} {{ $col['label'] }}</div>
                <div class="cc-val">—</div>
                <div class="cc-sub">AC Per Day</div>
            </div>
            @endforeach
        </div>

        <div style="margin-top:14px;padding:12px;background:#f8fafc;border:1px dashed var(--hb-border);border-radius:10px;text-align:center;">
            <p style="margin:0;font-size:0.82rem;color:var(--hb-muted)">
                💡 Data di atas diisi manual dari Google Sheets.
                <a href="https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/edit?gid={{ $outlet['gid'] }}#gid={{ $outlet['gid'] }}" target="_blank" style="color:var(--hb-red);font-weight:600">
                    Buka Sheet {{ $outlet['label'] }} ↗
                </a>
            </p>
        </div>
    </div>
    @endforeach
</div>

{{-- GOOGLE SHEETS EMBED --}}
<div class="sec-title">
    <div class="sec-icon icon-green">📄</div>
    <h2>Tampilan Google Sheets Langsung</h2>
    <div class="sec-divider"></div>
</div>
<div class="embed-wrap">
    <div class="embed-hdr">
        <h3>📊 08. AGUSTUS – SALES AREA 19 2026 – SISWANTO</h3>
        <a href="https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/edit?gid=297723641#gid=297723641" target="_blank">Buka di Google Sheets ↗</a>
    </div>
    <div class="embed-toolbar">
        @foreach($outlets as $outlet)
        <button class="gid-btn {{ $loop->first?'active':'' }}"
                onclick="changeEmbed('{{ $outlet['gid'] }}', this)"
                title="{{ $outlet['label'] }}">
            {{ $outlet['label'] }}
        </button>
        @endforeach
    </div>
    <div class="embed-frame">
        <iframe id="sheets-embed"
            src="https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/pubhtml?gid=297723641&single=true&widget=true&headers=false"
            height="580"
            title="Sales Area 19 Google Sheets">
        </iframe>
    </div>
</div>

{{-- TRACKING KELENGKAPAN --}}
<div class="sec-title">
    <div class="sec-icon icon-red">✅</div>
    <h2>Tracking Kelengkapan Data Kolom</h2>
    <div class="sec-divider"></div>
</div>
<div class="track-wrap">
    <table class="track-tbl">
        <thead>
            <tr>
                <th>Sheet / Outlet</th>
                <th>Status</th>
                <th>Kolom Sales</th>
                <th>Kolom TC</th>
                <th>Kolom AC/Day</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $tracking = [
                ['outlet'=>'05. PLAJU',          'status'=>'Lengkap',       'sales'=>'Lengkap',       'tc'=>'Lengkap', 'ac'=>'Lengkap',       'ket'=>'-'],
                ['outlet'=>'06. SIMPANG BANDARA', 'status'=>'Belum Lengkap', 'sales'=>'Belum Lengkap', 'tc'=>'Lengkap', 'ac'=>'Belum Lengkap', 'ket'=>'Target harian belum diisi'],
                ['outlet'=>'07. LCM',             'status'=>'Lengkap',       'sales'=>'Lengkap',       'tc'=>'Lengkap', 'ac'=>'Lengkap',       'ket'=>'-'],
                ['outlet'=>'08. LAHAT',           'status'=>'Review',        'sales'=>'Lengkap',       'tc'=>'Review',  'ac'=>'Lengkap',       'ket'=>'Perlu verifikasi TC Membership'],
                ['outlet'=>'09. PSM',             'status'=>'Lengkap',       'sales'=>'Lengkap',       'tc'=>'Lengkap', 'ac'=>'Lengkap',       'ket'=>'-'],
                ['outlet'=>'10. PANGKAL PINANG',  'status'=>'Belum Lengkap', 'sales'=>'Belum Lengkap', 'tc'=>'Lengkap', 'ac'=>'Belum Lengkap', 'ket'=>'Aktual sales belum diisi'],
                ['outlet'=>'11. BATURAJA',        'status'=>'Lengkap',       'sales'=>'Lengkap',       'tc'=>'Lengkap', 'ac'=>'Lengkap',       'ket'=>'-'],
            ];
            @endphp
            @foreach($tracking as $row)
            @php
                $sc = match($row['status']){ 'Lengkap'=>'bdg-green','Belum Lengkap'=>'bdg-red','Review'=>'bdg-yellow',default=>'bdg-gray' };
                $ss = $row['sales']==='Lengkap'?'bdg-green':($row['sales']==='Review'?'bdg-yellow':'bdg-red');
                $st = $row['tc']==='Lengkap'?'bdg-green':($row['tc']==='Review'?'bdg-yellow':'bdg-red');
                $sa = $row['ac']==='Lengkap'?'bdg-green':($row['ac']==='Review'?'bdg-yellow':'bdg-red');
            @endphp
            <tr>
                <td style="font-weight:700">{{ $row['outlet'] }}</td>
                <td><span class="bdg {{ $sc }}">{{ $row['status'] }}</span></td>
                <td><span class="bdg {{ $ss }}">{{ $row['sales'] }}</span></td>
                <td><span class="bdg {{ $st }}">{{ $row['tc'] }}</span></td>
                <td><span class="bdg {{ $sa }}">{{ $row['ac'] }}</span></td>
                <td style="color:var(--hb-muted);font-size:0.82rem">{{ $row['ket'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function switchTab(id) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + id).classList.add('active');
    document.getElementById('tab-' + id).classList.add('active');
}
function changeEmbed(gid, btn) {
    document.getElementById('sheets-embed').src =
        'https://docs.google.com/spreadsheets/d/1zNxrQc1z02yEXmCmvuvGAkkGlJcdwDPH/pubhtml?gid=' + gid + '&single=true&widget=true&headers=false';
    document.querySelectorAll('.gid-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
// Sync tab click with embed switcher
document.querySelectorAll('.tab-btn').forEach((btn, i) => {
    btn.addEventListener('click', function() {
        const gidBtns = document.querySelectorAll('.gid-btn');
        if (gidBtns[i]) {
            const gid = gidBtns[i].onclick ? gidBtns[i].getAttribute('onclick').match(/'([^']+)'/)[1] : '297723641';
            changeEmbed(gid, gidBtns[i]);
        }
    });
});

@endsection
