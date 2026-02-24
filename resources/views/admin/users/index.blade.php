<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Users - Lapor.in</title>
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

        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert i[data-lucide] { width: 18px; height: 18px; flex-shrink: 0; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .btn-primary {
            background: linear-gradient(135deg, #4fb3bf 0%, #2d5a7b 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary i[data-lucide] { width: 16px; height: 16px; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,179,191,0.4); }

        .table-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background: #f5f7fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #2d5a7b; font-size: 14px; }
        td { padding: 15px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        tbody tr:hover { background: #f9fafb; }

        .level-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .level-badge i[data-lucide] { width: 13px; height: 13px; }
        .level-admin { background: rgba(156,39,176,0.1); color: #9c27b0; }
        .level-petugas { background: rgba(33,150,243,0.1); color: #2196f3; }
        .level-siswa { background: rgba(76,175,80,0.1); color: #4caf50; }

        .action-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .action-btn i[data-lucide] { width: 14px; height: 14px; }
        .btn-edit { background: rgba(255,152,0,0.1); color: #ff9800; }
        .btn-edit:hover { background: #ff9800; color: white; }
        .btn-delete { background: rgba(244,67,54,0.1); color: #f44336; }
        .btn-delete:hover { background: #f44336; color: white; }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s ease;
            overflow-y: auto;
        }
        .modal.show { display: flex; align-items: center; justify-content: center; padding: 20px; }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: slideDown 0.3s ease;
            margin: auto;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideDown { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
        }
        .modal-header h3 { color: #2d5a7b; font-size: 20px; display: flex; align-items: center; gap: 8px; }
        .modal-header h3 i[data-lucide] { width: 20px; height: 20px; }
        .close-btn { font-size: 28px; color: #999; cursor: pointer; transition: color 0.3s ease; line-height: 1; }
        .close-btn:hover { color: #333; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; color: #2d5a7b; margin-bottom: 8px; }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus,
        .form-group select:focus { outline: none; border-color: #4fb3bf; }
        .form-group small { color: #666; font-size: 12px; }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="topbar">
            <h1>Kelola Users</h1>
            <button class="btn-primary" onclick="showAddModal()">
                <i data-lucide="user-plus"></i> Tambah User
            </button>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i data-lucide="check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <i data-lucide="x-circle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="table-card">
            <h3 style="color: #2d5a7b; margin-bottom: 10px;">Daftar Pengguna Sistem</h3>
            <p style="color: #666; font-size: 14px;">Kelola akun admin, petugas, dan siswa</p>

            <table>
                <thead>
                    <tr>
                        <th>NIS/NIP</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Kelas</th>
                        <th>Telepon</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td><strong>{{ $user->nis_nip }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->level == 'admin')
                                <span class="level-badge level-admin"><i data-lucide="shield"></i> Admin</span>
                            @elseif($user->level == 'petugas')
                                <span class="level-badge level-petugas"><i data-lucide="shield-check"></i> Petugas</span>
                            @else
                                <span class="level-badge level-siswa"><i data-lucide="graduation-cap"></i> Siswa</span>
                            @endif
                        </td>
                        <td>{{ $user->kelas ?? '-' }}</td>
                        <td>{{ $user->telp ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                        <td>
                            <button class="action-btn btn-edit"
                                onclick="showEditModal({{ $user->id }}, '{{ $user->nis_nip }}', '{{ $user->name }}', '{{ $user->level }}', '{{ $user->kelas }}', '{{ $user->telp }}')">
                                <i data-lucide="pencil"></i> Edit
                            </button>
                            @if($user->id != auth()->id())
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i data-lucide="trash-2"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #999;">Belum ada user terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal Tambah User -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i data-lucide="user-plus"></i> Tambah User Baru</h3>
                <span class="close-btn" onclick="closeAddModal()">&times;</span>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>NIS/NIP *</label>
                        <input type="text" name="nis_nip" placeholder="Contoh: 2024001" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="name" placeholder="Contoh: Ahmad Rizki" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Level *</label>
                        <select name="level" id="addLevel" onchange="toggleKelas('add')" required>
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <div class="form-group" id="addKelasGroup" style="display:none;">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Contoh: XII-IPA-1">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="telp" placeholder="Contoh: 08123456789">
                    </div>
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="password" name="password" placeholder="Min. 8 karakter" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%;">
                    <i data-lucide="save"></i> Simpan User
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i data-lucide="pencil"></i> Edit User</h3>
                <span class="close-btn" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label>NIS/NIP *</label>
                        <input type="text" id="editNisNip" name="nis_nip" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" id="editName" name="name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Level *</label>
                        <select id="editLevel" name="level" onchange="toggleKelas('edit')" required>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <div class="form-group" id="editKelasGroup">
                        <label>Kelas</label>
                        <input type="text" id="editKelas" name="kelas">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" id="editTelp" name="telp">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
                        <small>Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%;">
                    <i data-lucide="save"></i> Update User
                </button>
            </form>
        </div>
    </div>

    <script>
        function showAddModal() { document.getElementById('addModal').classList.add('show'); }
        function closeAddModal() { document.getElementById('addModal').classList.remove('show'); }
        function showEditModal(id, nisNip, name, level, kelas, telp) {
            document.getElementById('editForm').action = '{{ url("admin/users") }}/' + id;
            document.getElementById('editNisNip').value = nisNip;
            document.getElementById('editName').value = name;
            document.getElementById('editLevel').value = level;
            document.getElementById('editKelas').value = kelas || '';
            document.getElementById('editTelp').value = telp || '';
            toggleKelas('edit');
            document.getElementById('editModal').classList.add('show');
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('show'); }
        function toggleKelas(type) {
            const level = document.getElementById(type + 'Level').value;
            document.getElementById(type + 'KelasGroup').style.display = level === 'siswa' ? 'block' : 'none';
        }
        window.onclick = function(event) {
            if (event.target == document.getElementById('addModal')) closeAddModal();
            if (event.target == document.getElementById('editModal')) closeEditModal();
        }
    </script>
    <script>lucide.createIcons();</script>
</body>
</html>