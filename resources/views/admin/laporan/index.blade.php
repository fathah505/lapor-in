<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Lapor.in</title>
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

        .btn-primary {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-primary i[data-lucide] { width: 16px; height: 16px; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,179,191,0.4); }

        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; }
        .alert-info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon i[data-lucide] { width: 28px; height: 28px; }
        .stat-icon.blue { background: rgba(79,179,191,0.1); color: #4fb3bf; }
        .stat-icon.purple { background: rgba(156,39,176,0.1); color: #9c27b0; }
        .stat-icon.orange { background: rgba(255,152,0,0.1); color: #ff9800; }
        .stat-info h3 { font-size: 32px; font-weight: 700; color: #2d5a7b; margin-bottom: 5px; }
        .stat-info p { color: #666; font-size: 14px; }

        .chart-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .chart-section h3 {
            color: #2d5a7b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chart-section h3 i[data-lucide] { width: 20px; height: 20px; }
        .chart-placeholder {
            background: #f5f7fa;
            padding: 60px;
            border-radius: 8px;
            text-align: center;
            color: #666;
            border: 2px dashed #e0e0e0;
        }

        .category-list { list-style: none; }
        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.3s ease;
        }
        .category-item:hover { background: #f9fafb; }
        .category-item:last-child { border-bottom: none; }
        .category-name { font-weight: 600; color: #333; }
        .category-count {
            background: rgba(79,179,191,0.1);
            color: #4fb3bf;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .progress-bar { width: 200px; height: 8px; background: #e0e0e0; border-radius: 4px; overflow: hidden; margin: 0 15px; }
        .progress-fill { height: 100%; background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%); transition: width 0.3s ease; }

        .note-box {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .note-box i[data-lucide] { width: 20px; height: 20px; color: #856404; flex-shrink: 0; margin-top: 2px; }
        .note-box-content p:first-child { color: #856404; font-weight: 600; margin-bottom: 5px; }
        .note-box-content p:last-child { color: #856404; font-size: 14px; }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="topbar">
            <h1>Laporan &amp; Statistik</h1>
            <a href="{{ route('admin.laporan.export') }}" class="btn-primary">
                <i data-lucide="download"></i> Export Laporan
            </a>
        </div>

        @if(session('info'))
        <div class="alert alert-info">
            <i data-lucide="info"></i> {{ session('info') }}
        </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i data-lucide="clipboard-list"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPengaduan }}</h3>
                    <p>Total Pengaduan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple"><i data-lucide="graduation-cap"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalSiswa }}</h3>
                    <p>Total Siswa</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange"><i data-lucide="tag"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalKategori }}</h3>
                    <p>Kategori Aktif</p>
                </div>
            </div>
        </div>

        <div class="chart-section">
            <h3><i data-lucide="bar-chart-2"></i> Grafik Pengaduan per Bulan</h3>
            <div class="chart-placeholder">
                <p style="font-size: 18px; margin-bottom: 10px;">Visualisasi Data</p>
                <p>Grafik pengaduan 12 bulan terakhir akan ditampilkan di sini</p>
                <p style="font-size: 13px; color: #999; margin-top: 10px;">Implementasi chart menggunakan Chart.js atau library lainnya</p>
            </div>
        </div>

        <div class="chart-section">
            <h3><i data-lucide="trophy"></i> Top 5 Kategori Pengaduan</h3>
            <ul class="category-list">
                @forelse($topKategori as $index => $kategori)
                <li class="category-item">
                    <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                        <span style="font-size: 20px; font-weight: 700; color: #4fb3bf;">{{ $index + 1 }}</span>
                        <span class="category-name">{{ $kategori->nama_kategori }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalPengaduan > 0 ? ($kategori->pengaduan_count / $totalPengaduan * 100) : 0 }}%"></div>
                    </div>
                    <span class="category-count">{{ $kategori->pengaduan_count }} pengaduan</span>
                </li>
                @empty
                <li class="category-item" style="justify-content: center; color: #999;">Belum ada data kategori</li>
                @endforelse
            </ul>
        </div>

        <div class="chart-section">
            <h3><i data-lucide="calendar"></i> Pengaduan per Bulan (12 Bulan Terakhir)</h3>
            <div class="chart-placeholder">
                <p style="font-size: 18px; margin-bottom: 10px;">Data Bulanan</p>
                <p>Tabel atau grafik data bulanan akan ditampilkan di sini</p>
                @if($pengaduanPerBulan->count() > 0)
                <div style="margin-top: 20px; text-align: left; max-width: 400px; margin-left: auto; margin-right: auto;">
                    <table style="width: 100%;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 10px; text-align: left;">Bulan</th>
                                <th style="padding: 10px; text-align: right;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduanPerBulan as $data)
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 10px;">{{ \Carbon\Carbon::create()->month($data->bulan)->format('F') }}</td>
                                <td style="padding: 10px; text-align: right; font-weight: 600;">{{ $data->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        <div class="note-box">
            <i data-lucide="lightbulb"></i>
            <div class="note-box-content">
                <p>Catatan</p>
                <p>Fitur export laporan ke Excel/PDF sedang dalam pengembangan. Untuk saat ini, Anda dapat menggunakan print browser untuk menyimpan laporan ini.</p>
            </div>
        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>