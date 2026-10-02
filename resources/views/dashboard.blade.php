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
    --hb-green: #16a34a;
    --hb-blue: #2563eb;
    --hb-orange: #ea580c;
    --hb-purple: #7c3aed;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
}

/* HEADER & FILTERS */
.dash-header {
    background: linear-gradient(135deg, var(--hb-dark), #16213e);
    color: white;
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 24px;
    display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;
}
.dash-title h1 { margin: 0 0 5px 0; font-size: 1.6rem; font-weight: 800; }
.dash-title p { margin: 0; color: rgba(255,255,255,0.7); font-size: 0.9rem; display: flex; gap: 10px; align-items: center;}
.flow-badge { background: rgba(255,255,255,0.15); padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }

.dash-actions { display: flex; gap: 10px; flex-wrap: wrap; }
.dash-select, .dash-date { padding: 8px 12px; border: 1px solid rgba(255,255,255,0.3); border-radius: 8px; background: rgba(0,0,0,0.2); color: white; font-size: 0.85rem; outline: none; }
.dash-select option { background: var(--hb-dark); }
.btn-export { background: var(--hb-red); color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 700; cursor: pointer; transition: background 0.2s; }
.btn-export:hover { background: #a30000; }

/* KPI CARDS */
.kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
.kpi-card { background: var(--hb-card); border: 1px solid var(--hb-border); border-radius: 12px; padding: 18px; box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 16px; }
.kpi-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
.ki-blue { background: #eff6ff; color: var(--hb-blue); }
.ki-green { background: #f0fdf4; color: var(--hb-green); }
.ki-yellow { background: #fefce8; color: #ca8a04; }
.ki-purple { background: #faf5ff; color: var(--hb-purple); }
.ki-red { background: #fef2f2; color: var(--hb-red); }
.kpi-details h3 { margin: 0; font-size: 0.75rem; color: var(--hb-muted); text-transform: uppercase; letter-spacing: 0.5px; }
.kpi-details p { margin: 3px 0 0 0; font-size: 1.4rem; font-weight: 800; color: var(--hb-text); line-height: 1; }

/* PANELS */
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }
@media (max-width: 1024px) { .grid-2 { grid-template-columns: 1fr; } }

.panel { background: var(--hb-card); border: 1px solid var(--hb-border); border-radius: 12px; box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 24px;}
.panel-hdr { padding: 16px 20px; border-bottom: 1px solid var(--hb-border); background: #f8fafc; display: flex; justify-content: space-between; align-items: center; }
.panel-hdr h2 { margin: 0; font-size: 1rem; font-weight: 700; color: var(--hb-text); display: flex; align-items: center; gap: 8px; }

/* TABLES */
.tbl-wrap { overflow-x: auto; }
.data-tbl { width: 100%; border-collapse: collapse; font-size: 0.8rem; }
.data-tbl th { padding: 12px 16px; text-align: left; font-weight: 600; color: var(--hb-muted); text-transform: uppercase; letter-spacing: 0.5px; background: white; border-bottom: 1px solid var(--hb-border); white-space: nowrap; }
.data-tbl td { padding: 12px 16px; color: var(--hb-text); border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
.data-tbl tbody tr:hover { background: #f8fafc; }
.data-tbl tbody tr:last-child td { border-bottom: none; }

.bdg { display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; white-space: nowrap; }
.b-green { background: #dcfce7; color: #166534; }
.b-yellow { background: #fef9c3; color: #854d0e; }
.b-red { background: #fee2e2; color: #991b1b; }
.b-blue { background: #dbeafe; color: #1e40af; }
.b-gray { background: #f1f5f9; color: #475569; }

/* CHART PLACEHOLDER */
.chart-box { height: 250px; display: flex; align-items: center; justify-content: center; flex-direction: column; color: var(--hb-muted); border: 1px dashed var(--hb-border); border-radius: 8px; margin: 20px; background: #f8fafc; }

</style>

<div class="dash-header">
    <div class="dash-title">
        <h1>Dashboard Monitoring Area 19</h1>
        <p>
            <span class="flow-badge">Data Sumber</span> &rarr;
            <span class="flow-badge">Database Monitoring</span> &rarr;
            <span class="flow-badge">Tracking & Laporan</span>
        </p>
    </div>
    <div class="dash-actions">
        <select class="dash-select">
            <option>Semua Outlet (Area 19)</option>
            <option>05. PLAJU</option>
            <option>09. PSM</option>
        </select>
        <input type="date" class="dash-date" value="{{ date('Y-m-d') }}">
        <button class="btn-export">📥 Export Laporan Harian</button>
    </div>
</div>

{{-- KPI SUMMARY --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon ki-blue">🧑‍💼</div>
        <div class="kpi-details"><h3>Karyawan Aktif</h3><p>24 Orang</p></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon ki-purple">📦</div>
        <div class="kpi-details"><h3>Produk Habis</h3><p>2 Item</p></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon ki-yellow">🎟️</div>
        <div class="kpi-details"><h3>Voucher Digunakan</h3><p>45 / 120</p></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon ki-green">✨</div>
        <div class="kpi-details"><h3>Kebersihan (OK)</h3><p>85%</p></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon ki-red">⚠️</div>
        <div class="kpi-details"><h3>Kendala Terbuka</h3><p>3 Issue</p></div>
    </div>
</div>

{{-- PANEL 1: KARYAWAN & PRODUK --}}
<div class="grid-2">
    {{-- DATA AKTIVITAS KARYAWAN --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>🧑‍💼 Data Aktivitas Karyawan</h2>
            <span class="bdg b-blue">Lihat Semua</span>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Budi S.</strong></td>
                        <td>Opening Kasir<br><span style="font-size:0.7rem;color:var(--hb-muted)">Persiapan Modal</span></td>
                        <td>08:00 - 08:15</td>
                        <td><span class="bdg b-green">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>Siti A.</strong></td>
                        <td>Stok Opname Pagi<br><span style="font-size:0.7rem;color:var(--hb-muted)">Menghitung packaging</span></td>
                        <td>08:10 - 09:00</td>
                        <td><span class="bdg b-yellow">Proses</span></td>
                    </tr>
                    <tr>
                        <td><strong>Andi M.</strong></td>
                        <td>Cleaning Area Dine-in<br><span style="font-size:0.7rem;color:var(--hb-muted)">Sapu & Pel lantai</span></td>
                        <td>09:00 - <span style="color:var(--hb-muted)">--:--</span></td>
                        <td><span class="bdg b-yellow">Proses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- DATA MONITORING PRODUK --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>📦 Data Monitoring Produk</h2>
            <span class="bdg b-blue">Update Stok</span>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Terjual</th>
                        <th>Tersedia</th>
                        <th>Status / Pengecekan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Bento Special 1</strong></td>
                        <td>45 Porsi</td>
                        <td>120 Porsi</td>
                        <td><span class="bdg b-green">Aman</span> <br><span style="font-size:0.7rem;color:var(--hb-muted)">Cek: 08:30</span></td>
                    </tr>
                    <tr>
                        <td><strong>Hoka Hemat 2</strong></td>
                        <td>89 Porsi</td>
                        <td>15 Porsi</td>
                        <td><span class="bdg b-yellow">Menipis</span> <br><span style="font-size:0.7rem;color:var(--hb-muted)">Cek: 09:15</span></td>
                    </tr>
                    <tr>
                        <td><strong>Cold Ocha</strong></td>
                        <td>120 Gelas</td>
                        <td>0 Gelas</td>
                        <td><span class="bdg b-red">Habis</span> <br><span style="font-size:0.7rem;color:var(--hb-muted)">Cek: 09:40</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- PANEL 2: KENDALA & VOUCHER --}}
<div class="grid-2">
    {{-- DATA KENDALA (ISSUE TRACKER) --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>⚠️ Data Kendala / Issue</h2>
            <span class="bdg b-red">+ Lapor Kendala</span>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Jenis Kendala</th>
                        <th>Lokasi / Pelapor</th>
                        <th>Waktu Kejadian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Mesin EDC Error</strong><br><span style="font-size:0.7rem;color:var(--hb-muted)">Jaringan terputus</span></td>
                        <td>Area Kasir<br><span style="font-size:0.7rem;color:var(--hb-muted)">Lapor: Budi</span></td>
                        <td>08:45</td>
                        <td><span class="bdg b-red">Terbuka</span></td>
                    </tr>
                    <tr>
                        <td><strong>AC Kurang Dingin</strong><br><span style="font-size:0.7rem;color:var(--hb-muted)">Freon habis</span></td>
                        <td>Dine-in Lt.2<br><span style="font-size:0.7rem;color:var(--hb-muted)">Lapor: Andi</span></td>
                        <td>Kemarin 15:00</td>
                        <td><span class="bdg b-yellow">Penanganan</span></td>
                    </tr>
                    <tr>
                        <td><strong>Air Wastafel Mati</strong><br><span style="font-size:0.7rem;color:var(--hb-muted)">Pompa rusak</span></td>
                        <td>Toilet Tamu<br><span style="font-size:0.7rem;color:var(--hb-muted)">Lapor: Siti</span></td>
                        <td>07:30 <br><span style="font-size:0.7rem;color:var(--hb-green)">Selesai: 08:15</span></td>
                        <td><span class="bdg b-green">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- DATA VOUCHER --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>🎟️ Data Voucher</h2>
            <span class="bdg b-blue">Scan Voucher</span>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Kode Voucher</th>
                        <th>Status</th>
                        <th>Waktu Penggunaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>VCH-HKBN-8X2P</strong></td>
                        <td><span class="bdg b-green">Digunakan</span></td>
                        <td>Hari ini, 09:12</td>
                    </tr>
                    <tr>
                        <td><strong>VCH-HKBN-9L4M</strong></td>
                        <td><span class="bdg b-green">Digunakan</span></td>
                        <td>Hari ini, 08:45</td>
                    </tr>
                    <tr>
                        <td><strong>VCH-HKBN-7T1K</strong></td>
                        <td><span class="bdg b-yellow">Diberikan</span></td>
                        <td><span style="color:var(--hb-muted)">Belum digunakan</span></td>
                    </tr>
                    <tr>
                        <td><strong>VCH-HKBN-3R9Q</strong></td>
                        <td><span class="bdg b-red">Expired</span></td>
                        <td><span style="color:var(--hb-muted)">-</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- PANEL 3: KEBERSIHAN & KITCHEN --}}
<div class="grid-2">
    {{-- DATA KEBERSIHAN --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>✨ Data Kebersihan (Checklist)</h2>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Area Diperiksa</th>
                        <th>Petugas & Waktu</th>
                        <th>Hasil Pengecekan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Lantai Dine-in Pagi</strong></td>
                        <td>Andi M. <br><span style="font-size:0.7rem;color:var(--hb-muted)">08:30</span></td>
                        <td>Lantai bersih, tidak lengket</td>
                        <td><span class="bdg b-green">OK</span></td>
                    </tr>
                    <tr>
                        <td><strong>Meja Kasir & Kaca Depan</strong></td>
                        <td>Siti A. <br><span style="font-size:0.7rem;color:var(--hb-muted)">08:45</span></td>
                        <td>Kaca sedikit buram, sudah dilap</td>
                        <td><span class="bdg b-green">OK</span></td>
                    </tr>
                    <tr>
                        <td><strong>Toilet Pengunjung</strong></td>
                        <td>Andi M. <br><span style="font-size:0.7rem;color:var(--hb-muted)">Belum dicek</span></td>
                        <td>-</td>
                        <td><span class="bdg b-gray">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- DATA KITCHEN --}}
    <div class="panel">
        <div class="panel-hdr">
            <h2>🍳 Data Kitchen</h2>
        </div>
        <div class="tbl-wrap">
            <table class="data-tbl">
                <thead>
                    <tr>
                        <th>Aktivitas Kitchen</th>
                        <th>Petugas & Waktu</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Pemanasan Minyak (Fryer)</strong></td>
                        <td>Chef Eko <br><span style="font-size:0.7rem;color:var(--hb-muted)">08:00 - 08:30</span></td>
                        <td>Suhu mencapai 170°C</td>
                        <td><span class="bdg b-green">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>Pengecekan Suhu Chiller</strong></td>
                        <td>Chef Eko <br><span style="font-size:0.7rem;color:var(--hb-muted)">08:35</span></td>
                        <td>Suhu normal di angka 3°C</td>
                        <td><span class="bdg b-green">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>Preparation Sayur (Salad)</strong></td>
                        <td>Asst. Tono <br><span style="font-size:0.7rem;color:var(--hb-muted)">09:00 - --:--</span></td>
                        <td>Sedang potong kol & wortel</td>
                        <td><span class="bdg b-yellow">Proses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- GRAFIK GLOBAL --}}
<div class="panel" style="margin-bottom: 40px;">
    <div class="panel-hdr">
        <h2>📈 Grafik Integrasi Area 19</h2>
        <span style="font-size:0.8rem;color:var(--hb-muted)">Korelasi Produktivitas vs Penjualan Produk vs Voucher</span>
    </div>
    <div class="chart-box">
        <span style="font-size:2rem;margin-bottom:10px;">📊</span>
        <strong>Area Chart.js Integrasi Data</strong>
        <p style="margin:5px 0 0;font-size:0.85rem;">Menampilkan gabungan tren karyawan aktif, produk terjual, dan klaim voucher harian.</p>
    </div>
</div>

@endsection

