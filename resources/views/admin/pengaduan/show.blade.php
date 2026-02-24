<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - Lapor.in</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        .main-content { margin-left: 260px; padding: 20px; min-height: 100vh; }
        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .topbar h1 { font-size: 28px; color: #2d5a7b; }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .btn i[data-lucide] { width: 16px; height: 16px; }
        .btn-back { background: #e0e0e0; color: #333; }
        .btn-back:hover { background: #d0d0d0; }

        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card h3 {
            color: #2d5a7b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card h3 i[data-lucide] { width: 20px; height: 20px; }

        .info-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        .info-label { font-weight: 600; color: #666; }
        .info-value { color: #333; }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .status-badge i[data-lucide] { width: 13px; height: 13px; }
        .status-menunggu { background: rgba(244,67,54,0.1); color: #f44336; }
        .status-proses { background: rgba(255,152,0,0.1); color: #ff9800; }
        .status-selesai { background: rgba(76,175,80,0.1); color: #4caf50; }

        .foto-pengaduan {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 10px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #2d5a7b;
            margin-bottom: 8px;
        }
        .form-group label i[data-lucide] { width: 16px; height: 16px; }
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s ease;
        }
        .form-group textarea:focus,
        .form-group select:focus { outline: none; border-color: #4fb3bf; }

        .btn-primary {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary i[data-lucide] { width: 18px; height: 18px; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,179,191,0.4); }

        .tanggapan-card {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #4fb3bf;
            margin-top: 15px;
        }
        .tanggapan-meta { font-size: 13px; color: #666; margin-bottom: 10px; }
        .tanggapan-text { color: #333; line-height: 1.6; }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="topbar">
            <h1>Detail Pengaduan #{{ str_pad($pengaduan->id, 4, '0', STR_PAD_LEFT) }}</h1>
            <a href="{{ route('admin.pengaduan') }}" class="btn btn-back">
                <i data-lucide="arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i data-lucide="check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <!-- Informasi Pelapor -->
        <div class="card">
            <h3><i data-lucide="user"></i> Informasi Pelapor</h3>
            <div class="info-grid">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $pengaduan->user->name }}</div>
                <div class="info-label">NIS/NIP</div>
                <div class="info-value">{{ $pengaduan->user->nis_nip }}</div>
                <div class="info-label">Kelas</div>
                <div class="info-value">{{ $pengaduan->user->kelas ?? '-' }}</div>
                <div class="info-label">No. Telepon</div>
                <div class="info-value">{{ $pengaduan->user->telp ?? '-' }}</div>
            </div>
        </div>

        <!-- Detail Pengaduan -->
        <div class="card">
            <h3><i data-lucide="clipboard-list"></i> Detail Pengaduan</h3>
            <div class="info-grid">
                <div class="info-label">Tanggal Pengaduan</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d F Y, H:i') }} WIB</div>
                <div class="info-label">Kategori</div>
                <div class="info-value">{{ $pengaduan->kategori->nama_kategori }}</div>
                <div class="info-label">Status</div>
                <div class="info-value">
                    @if($pengaduan->status == '0')
                        <span class="status-badge status-menunggu"><i data-lucide="clock"></i> Menunggu</span>
                    @elseif($pengaduan->status == '1')
                        <span class="status-badge status-proses"><i data-lucide="loader"></i> Dalam Proses</span>
                    @else
                        <span class="status-badge status-selesai"><i data-lucide="check-circle"></i> Selesai</span>
                    @endif
                </div>
                <div class="info-label">Judul Laporan</div>
                <div class="info-value"><strong>{{ $pengaduan->judul_laporan }}</strong></div>
                <div class="info-label">Isi Laporan</div>
                <div class="info-value" style="white-space: pre-wrap;">{{ $pengaduan->isi_laporan }}</div>
                @if($pengaduan->foto)
                <div class="info-label">Foto Bukti</div>
                <div class="info-value">
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="foto-pengaduan">
                </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan yang sudah ada -->
        @if($pengaduan->tanggapan)
        <div class="card">
            <h3><i data-lucide="message-square"></i> Tanggapan Petugas</h3>
            <div class="tanggapan-card">
                <div class="tanggapan-meta">
                    <strong>{{ $pengaduan->tanggapan->petugas->name }}</strong>
                    &bull; {{ \Carbon\Carbon::parse($pengaduan->tanggapan->tgl_tanggapan)->format('d F Y, H:i') }} WIB
                </div>
                <div class="tanggapan-text">{{ $pengaduan->tanggapan->tanggapan }}</div>
            </div>
        </div>
        @endif

        <!-- Form Tanggapan -->
        <div class="card">
            <h3><i data-lucide="edit-3"></i> {{ $pengaduan->tanggapan ? 'Update Tanggapan' : 'Berikan Tanggapan' }}</h3>
            <form action="{{ route('admin.tanggapan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                <div class="form-group">
                    <label><i data-lucide="align-left"></i> Tanggapan</label>
                    <textarea name="tanggapan" rows="6" placeholder="Tulis tanggapan Anda di sini..." required>{{ $pengaduan->tanggapan->tanggapan ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label><i data-lucide="refresh-cw"></i> Update Status</label>
                    <select name="status" required>
                        <option value="0" {{ $pengaduan->status == '0' ? 'selected' : '' }}>Menunggu</option>
                        <option value="1" {{ $pengaduan->status == '1' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="2" {{ $pengaduan->status == '2' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">
                    <i data-lucide="send"></i>
                    {{ $pengaduan->tanggapan ? 'Update Tanggapan' : 'Kirim Tanggapan' }}
                </button>
            </form>
        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>