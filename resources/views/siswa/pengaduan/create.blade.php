<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan Baru - Lapor.in</title>
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

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            max-width: 800px;
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

        .info-box {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2196f3;
            margin-bottom: 25px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .info-box i[data-lucide] { width: 20px; height: 20px; color: #1565c0; flex-shrink: 0; margin-top: 2px; }
        .info-box p { color: #1565c0; font-size: 14px; line-height: 1.6; }

        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            color: #2d5a7b;
            margin-bottom: 8px;
        }
        .form-group label i[data-lucide] { width: 15px; height: 15px; }
        .form-group label span { color: #f44336; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { outline: none; border-color: #4fb3bf; }
        .form-group small { color: #666; font-size: 12px; display: block; margin-top: 5px; }

        .file-input-wrapper { position: relative; display: inline-block; width: 100%; }
        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%; height: 100%;
            cursor: pointer;
        }
        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-input-label:hover { border-color: #4fb3bf; background: rgba(79,179,191,0.05); }
        .file-input-label.has-file { border-color: #4fb3bf; background: rgba(79,179,191,0.1); }
        .file-input-label i[data-lucide] { width: 48px; height: 48px; color: #4fb3bf; margin-bottom: 10px; }
        .file-input-label .check-icon i[data-lucide] { color: #4caf50; }

        .file-preview { margin-top: 15px; display: none; }
        .file-preview img { max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }

        .btn-primary {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-primary i[data-lucide] { width: 18px; height: 18px; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,179,191,0.4); }

        .btn-secondary {
            background: white;
            color: #666;
            padding: 15px 40px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-secondary i[data-lucide] { width: 18px; height: 18px; }
        .btn-secondary:hover { border-color: #4fb3bf; color: #4fb3bf; }

        .form-actions { display: flex; gap: 15px; margin-top: 30px; }
    </style>
</head>
<body>
    @include('siswa.partials.sidebar')

    <main class="main-content">
        <div class="topbar">
            <h1>Buat Pengaduan Baru</h1>
            <a href="{{ route('siswa.pengaduan') }}" class="btn btn-back">
                <i data-lucide="arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card">
            <h3><i data-lucide="file-plus"></i> Form Pengaduan</h3>

            <div class="info-box">
                <i data-lucide="info"></i>
                <p>
                    <strong>Petunjuk:</strong><br>
                    Silakan isi form di bawah ini dengan lengkap dan jelas. Pastikan Anda memberikan deskripsi yang detail tentang masalah yang Anda laporkan.
                    Foto bukti akan sangat membantu kami dalam memproses pengaduan Anda.
                </p>
            </div>

            <form action="{{ route('siswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label><i data-lucide="tag"></i> Kategori <span>*</span></label>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    <small>Pilih kategori yang sesuai dengan pengaduan Anda</small>
                    @error('kategori_id')<small style="color: #f44336;">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label><i data-lucide="type"></i> Judul Laporan <span>*</span></label>
                    <input type="text" name="judul_laporan" placeholder="Contoh: Kursi rusak di kelas XII-IPA-1" value="{{ old('judul_laporan') }}" required>
                    <small>Tuliskan judul yang singkat dan jelas (maksimal 255 karakter)</small>
                    @error('judul_laporan')<small style="color: #f44336;">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label><i data-lucide="align-left"></i> Isi Laporan <span>*</span></label>
                    <textarea name="isi_laporan" rows="8" placeholder="Jelaskan secara detail masalah yang Anda laporkan..." required>{{ old('isi_laporan') }}</textarea>
                    <small>Berikan penjelasan yang lengkap tentang masalah yang Anda laporkan</small>
                    @error('isi_laporan')<small style="color: #f44336;">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label><i data-lucide="image"></i> Foto Bukti (Opsional)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="foto" id="fotoInput" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)">
                        <div class="file-input-label" id="fileLabel">
                            <div style="text-align: center;">
                                <i data-lucide="upload-cloud" style="width: 48px; height: 48px; color: #4fb3bf; margin-bottom: 10px;"></i>
                                <p style="font-weight: 600; color: #2d5a7b; margin-bottom: 5px;">Klik untuk upload foto</p>
                                <p style="font-size: 13px; color: #666;">Format: JPG, PNG (Maksimal 2MB)</p>
                            </div>
                        </div>
                    </div>
                    <div class="file-preview" id="filePreview">
                        <img id="previewImg" src="" alt="Preview">
                    </div>
                    <small>Upload foto sebagai bukti pendukung pengaduan Anda</small>
                    @error('foto')<small style="color: #f44336;">{{ $message }}</small>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i data-lucide="send"></i> Kirim Pengaduan
                    </button>
                    <a href="{{ route('siswa.pengaduan') }}" class="btn-secondary">
                        <i data-lucide="x"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const fileLabel = document.getElementById('fileLabel');
            const filePreview = document.getElementById('filePreview');
            const previewImg = document.getElementById('previewImg');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    filePreview.style.display = 'block';
                    fileLabel.classList.add('has-file');
                    fileLabel.innerHTML = `
                        <div style="text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#4caf50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <p style="font-weight: 600; color: #4fb3bf; margin-bottom: 5px;">Foto telah dipilih</p>
                            <p style="font-size: 13px; color: #666;">${file.name}</p>
                            <p style="font-size: 12px; color: #999; margin-top: 5px;">Klik untuk mengubah foto</p>
                        </div>
                    `;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>lucide.createIcons();</script>
</body>
</html>