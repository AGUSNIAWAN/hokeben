@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">Monitoring Kegiatan (Kicer)</h1>

    <div class="card" style="margin-bottom: 30px;">
        <h2>Catat Kegiatan Karyawan</h2>
        <form action="{{ route('activities.store') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <div class="form-group">
                <label for="employee_name">Nama Karyawan</label>
                <input type="text" id="employee_name" name="employee_name" required placeholder="Nama Karyawan">
            </div>
            <div class="form-group">
                <label for="activity_name">Jenis Kegiatan</label>
                <input type="text" id="activity_name" name="activity_name" required placeholder="Contoh: Membersihkan Kicer">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Proses">Sedang Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">Catatan Tambahan</label>
                <input type="text" id="notes" name="notes" placeholder="Misal: Shift Pagi">
            </div>
            <button type="submit" class="btn">Simpan Kegiatan</button>
        </form>
    </div>

    <div class="card">
        <h2>Riwayat Kegiatan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Karyawan</th>
                        <th>Kegiatan</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                            <td><strong>{{ $activity->employee_name }}</strong></td>
                            <td>{{ $activity->activity_name }}</td>
                            <td>
                                <span class="badge {{ $activity->status == 'Selesai' ? 'badge-green' : 'badge-yellow' }}">
                                    {{ $activity->status }}
                                </span>
                            </td>
                            <td>{{ $activity->notes ?? '-' }}</td>
                            <td>
                                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($activities->isEmpty())
                        <tr>
                            <td colspan="6" style="text-align: center;">Belum ada kegiatan tercatat.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
