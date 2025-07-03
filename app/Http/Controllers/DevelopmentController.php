<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevelopmentForm;
use App\Models\User; // Tetap gunakan model User untuk Auth::user()
use App\Models\Mentor; // Tetap gunakan model Mentor untuk menghubungkan
use Auth; // Tetap gunakan facade Auth


class DevelopmentController extends Controller
{
    // Halaman utama pengembangan, memilih peran
    public function index()
    {
        return view('development.index', ['title' => 'Pengembangan Diri']);
    }

    // Menampilkan form berdasarkan peran yang dipilih
    public function showForm(Request $request, $roleType)
    {
        if (!in_array($roleType, ['child_abk', 'parent', 'teacher_mentor'])) {
            abort(404);
        }

        // Pastikan user login untuk mengisi form
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengisi form pengembangan.');
        }

        return view('development.forms.' . $roleType, compact('roleType'), ['title' => 'Form ' . ucfirst(str_replace('_', ' ', $roleType))]);
    }

    // Menyimpan data form
    public function storeForm(Request $request, $roleType)
    {
        if (!in_array($roleType, ['child_abk', 'parent', 'teacher_mentor'])) {
            abort(404);
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengisi form pengembangan.');
        }

        $rules = [];
        $dataToStore = [];
        $userId = null;
        $mentorId = null;

        if (Auth::check()) {
            $userId = Auth::id();
        }

        if ($roleType === 'child_abk') {
            $rules = [
                'senang_karena' => 'required|string|max:1000',
                'berhasil_mencoba' => 'required|string|max:1000',
                'suka_belajar_apa' => 'required|string|max:1000',
                'saat_kesulitan' => 'required|string|max:1000',
                'aku_hebat_karena' => 'required|string|max:1000',
            ];
            $dataToStore = $request->only(array_keys($rules));
        } elseif ($roleType === 'parent') {
            $rules = [
                'suka_dilakukan' => 'required|string|max:1000',
                'merasa_senang_kalau' => 'required|string|max:1000',
                'ingin_coba_pelajari' => 'required|string|max:1000',
                'selalu_mendukung' => 'required|string|max:1000',
                'jadwal_senin' => 'nullable|string|max:255',
                'jadwal_selasa' => 'nullable|string|max:255',
                'jadwal_rabu' => 'nullable|string|max:255',
                'jadwal_kamis' => 'nullable|string|max:255',
                'jadwal_jumat' => 'nullable|string|max:255',
                'bangga_karena' => 'required|string|max:1000',
                'sudah_mencoba_belajar' => 'required|string|max:1000',
                'ortu_bilang_hebat_karena' => 'required|string|max:1000',
                'puji_anak' => 'boolean',
                'dengar_cerita' => 'boolean',
                'pelukan_positif' => 'boolean',
                'ingatkan_hebat' => 'boolean',
                'temani_belajar' => 'boolean',
            ];
            $dataToStore = $request->only(array_keys($rules));
            foreach (['puji_anak', 'dengar_cerita', 'pelukan_positif', 'ingatkan_hebat', 'temani_belajar'] as $checkbox) {
                $dataToStore[$checkbox] = $request->has($checkbox);
            }
        } elseif ($roleType === 'teacher_mentor') {
            $isAuthUserMentor = Auth::check() && Auth::user()->isMentor();
            $isAuthMentorGuard = Auth::guard('mentor')->check();

            if (!$isAuthUserMentor && !$isAuthMentorGuard && !Auth::user()->isAdmin()) {
                abort(403, 'Anda tidak diizinkan mengisi form ini.');
            }

            $mentor = null;
            if ($isAuthUserMentor) {
                $mentor = Mentor::where('user_id', Auth::id())->first();
            } elseif ($isAuthMentorGuard) {
                $mentor = Auth::guard('mentor')->user();
            } else {
                $mentor = Mentor::where('user_id', Auth::id())->first();
            }

            // dd($mentor, Auth::id(), Auth::user()->role, Auth::guard('mentor')->check()); // HAPUS DD INI

            if (!$mentor) {
                abort(403, 'Profil mentor Anda belum lengkap atau tidak ditemukan di tabel mentor. Silakan hubungi administrator.');
            }
            $mentorId = $mentor->id;
            $userId = null; // Pastikan ini null untuk form teacher_mentor

            $rules = [
                'puji_abk' => 'boolean',
                'bantu_pahami' => 'boolean',
                'suasana_ramah' => 'boolean',
                'dengar_kebutuhan' => 'boolean',
            ];
            $dataToStore = $request->only(array_keys($rules));
            foreach (['puji_abk', 'bantu_pahami', 'suasana_ramah', 'dengar_kebutuhan'] as $checkbox) {
                $dataToStore[$checkbox] = $request->has($checkbox);
            }
        }

        // --- DEBUGGING POINT: Cek hasil validasi sebelum create ---
        // try {
        //     $request->validate($rules);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     dd('Validation failed:', $e->errors());
        // }

        // --- DEBUGGING POINT: Cek data final sebelum create ---
        // dd('Final data for creation:', [
        //     'user_id' => $userId,
        //     'mentor_id' => $mentorId,
        //     'form_type' => $roleType,
        //     'data' => $dataToStore,
        // ]);

    

        DevelopmentForm::create([
            'user_id' => $userId,
            'mentor_id' => $mentorId,
            'form_type' => $roleType,
            'data' => $dataToStore,
        ]);

        return redirect()->route('development.index')->with('success', 'Form berhasil disimpan!');
    }
}