@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">Manajemen Pocer (Voucher)</h1>

    <div class="card" style="margin-bottom: 30px;">
        <h2>Tambah Data Pocer</h2>
        <form action="{{ route('vouchers.store') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <div class="form-group">
                <label for="code">Kode Pocer</label>
                <input type="text" id="code" name="code" required placeholder="Masukkan kode voucher unik">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="diberikan">Diberikan (Pemberian ke Pelanggan)</option>
                    <option value="digunakan">Digunakan (Penjualan / Klaim)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">Catatan Tambahan</label>
                <input type="text" id="notes" name="notes" placeholder="Misal: Diberikan saat ultah">
            </div>
            <button type="submit" class="btn">Simpan Pocer</button>
        </form>
    </div>

    <div class="card">
        <h2>Riwayat Pocer</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                        <tr>
                            <td><strong>{{ $voucher->code }}</strong></td>
                            <td>
                                <span class="badge {{ $voucher->status == 'digunakan' ? 'badge-yellow' : 'badge-green' }}">
                                    {{ ucfirst($voucher->status) }}
                                </span>
                            </td>
                            <td>{{ $voucher->notes ?? '-' }}</td>
                            <td>{{ $voucher->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($vouchers->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data pocer.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
