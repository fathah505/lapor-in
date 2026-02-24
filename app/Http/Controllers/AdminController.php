<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        // Ambil semua pengaduan terbaru
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan'])
            ->latest()
            ->take(10)
            ->get();
        
        // Hitung statistik
        $totalPengaduan = Pengaduan::count();
        $pending = Pengaduan::where('status', '0')->count();
        $proses = Pengaduan::where('status', '1')->count();
        $selesai = Pengaduan::where('status', '2')->count();
        $totalSiswa = User::where('level', 'siswa')->count();
        
        // Statistik per kategori 
        $kategoriStats = Kategori::withCount('pengaduan')
            ->orderBy('pengaduan_count', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'pengaduan',
            'totalPengaduan',
            'pending',
            'proses',
            'selesai',
            'totalSiswa',
            'kategoriStats'  
        ));
    }

    /**
     * Display all pengaduan
     */
    public function pengaduan(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'tanggapan']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul_laporan', 'like', '%' . $request->search . '%')
                  ->orWhere('isi_laporan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('nama', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pengaduan = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.pengaduan.index', compact('pengaduan', 'kategoris'));
    }

    /**
     * Show pengaduan detail
     */
    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan.admin'])
            ->findOrFail($id);
        
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update status pengaduan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    /**
     * Store tanggapan
     */
    public function storeTanggapan(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'tanggapan' => 'required|string'
        ]);

        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'admin_id' => Auth::id(),
            'tanggapan' => $request->tanggapan,
            'tgl_tanggapan' => now()
        ]);

        // Update status pengaduan menjadi "Diproses" jika masih pending
        $pengaduan = Pengaduan::find($request->pengaduan_id);
        if ($pengaduan->status == '0') {
            $pengaduan->update(['status' => '1']);
        }

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }

    /**
     * Display kategori management
     */
    public function kategori()
    {
        $kategoris = Kategori::withCount('pengaduan')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Store new kategori
     */
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update kategori
     */
    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Delete kategori
     */
    public function deleteKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Check if kategori has pengaduan
        if ($kategori->pengaduan()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki pengaduan!');
        }

        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Display user management
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Filter by level
        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%')
                  ->orWhere('nis_nip', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        // Validasi berbeda untuk admin dan siswa
        $rules = [
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'level' => 'required|in:admin,siswa',
            'telp' => 'nullable|string|max:20'
        ];

        if ($request->level == 'admin') {
            $rules['username'] = 'required|string|unique:users,username';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['nis_nip'] = 'nullable|string|unique:users,nis_nip';
        } else {
            $rules['nis_nip'] = 'required|string|unique:users,nis_nip';
            $rules['email'] = 'nullable|email|unique:users,email';
            $rules['username'] = 'nullable';
        }

        $request->validate($rules);

        $data = [
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'telp' => $request->telp
        ];

        if ($request->level == 'admin') {
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['nis_nip'] = $request->nis_nip ?? 'ADM' . rand(100, 999);
        } else {
            $data['nis_nip'] = $request->nis_nip;
            $data['email'] = $request->email;
        }

        User::create($data);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'nama' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'level' => 'required|in:admin,siswa',
            'telp' => 'nullable|string|max:20'
        ];

        if ($request->level == 'admin') {
            $rules['username'] = 'required|string|unique:users,username,' . $id;
            $rules['email'] = 'required|email|unique:users,email,' . $id;
            $rules['nis_nip'] = 'nullable|string|unique:users,nis_nip,' . $id;
        } else {
            $rules['nis_nip'] = 'required|string|unique:users,nis_nip,' . $id;
            $rules['email'] = 'nullable|email|unique:users,email,' . $id;
        }

        $request->validate($rules);

        $data = [
            'nama' => $request->nama,
            'level' => $request->level,
            'telp' => $request->telp
        ];

        if ($request->level == 'admin') {
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['nis_nip'] = $request->nis_nip ?? $user->nis_nip;
        } else {
            $data['nis_nip'] = $request->nis_nip;
            $data['email'] = $request->email;
            $data['username'] = null; // Hapus username jika diubah jadi siswa
        }

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User berhasil diupdate!');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting own account
        if ($user->id == Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        // Check if user has pengaduan
        if ($user->pengaduan()->count() > 0) {
            return redirect()->back()->with('error', 'User tidak dapat dihapus karena memiliki riwayat pengaduan!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }

    /**
     * Display laporan
     */
    public function laporan(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'tanggapan']);

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('tgl_pengaduan', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('tgl_pengaduan', '<=', $request->end_date);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $pengaduan = $query->latest()->get();
        $kategoris = Kategori::all();

        // Statistics
        $totalPengaduan = $pengaduan->count();
        $pending = $pengaduan->where('status', '0')->count();
        $proses = $pengaduan->where('status', '1')->count();
        $selesai = $pengaduan->where('status', '2')->count();
        
        // TAMBAHAN: Variable yang kurang
        $totalSiswa = User::where('level', 'siswa')->count();
        $totalKategori = Kategori::count();
        
        // Top 5 Kategori
        $topKategori = Kategori::withCount('pengaduan')
            ->orderBy('pengaduan_count', 'desc')
            ->take(5)
            ->get();
        
        // Pengaduan per Bulan (12 bulan terakhir)
        $pengaduanPerBulan = Pengaduan::selectRaw('MONTH(tgl_pengaduan) as bulan, COUNT(*) as total')
            ->whereYear('tgl_pengaduan', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        return view('admin.laporan.index', compact(
            'pengaduan',
            'kategoris',
            'totalPengaduan',
            'pending',
            'proses',
            'selesai',
            'totalSiswa',        // TAMBAHKAN
            'totalKategori',     // TAMBAHKAN
            'topKategori',       // TAMBAHKAN
            'pengaduanPerBulan'  // TAMBAHKAN
        ));
    }

    /**
     * Export laporan
     */
    public function exportLaporan(Request $request)
    {
        // This would typically use Laravel Excel or similar
        // For now, we'll return a basic implementation
        return redirect()->back()->with('info', 'Fitur export sedang dalam pengembangan!');
    }
}