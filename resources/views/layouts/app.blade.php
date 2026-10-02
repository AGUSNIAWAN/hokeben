<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hokben Monitoring</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/hokben.css') }}">
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                Hokben Monitor
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('monitoring') }}" style="border-left-color: var(--primary-color); background-color: rgba(255,255,255,0.05);">Monitoring Area 19</a>
                <a href="{{ route('tracking.index') }}">📋 Tracking Sheet Data</a>
                <a href="{{ route('vouchers.index') }}">Manajemen Pocer</a>
                <a href="{{ route('activities.index') }}">Kegiatan Karyawan (Kicer)</a>
            </nav>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
