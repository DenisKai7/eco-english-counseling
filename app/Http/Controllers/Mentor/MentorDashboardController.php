<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Chat;
use App\Models\User;
use App\Models\Mentor;
use App\Models\DevelopmentForm;
use App\Models\Feedback;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class MentorDashboardController extends Controller
{
    private function getLoggedInMentorId()
    {
        if (Auth::guard('mentor')->check()) {
            return Auth::guard('mentor')->id();
        }
        if (Auth::check() && Auth::user()->role === 'mentor') {
            $mentor = Mentor::where('user_id', Auth::id())->first();
            return $mentor ? $mentor->id : null;
        }
        return null;
    }

    public function index()
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan mengakses dashboard mentor.');
        }
        $totalMaterials = Material::where('mentor_id', $currentMentorId)->count();
        $recentChats = Chat::where('mentor_id', $currentMentorId)
                           ->latest()
                           ->take(5)
                           ->with('user')
                           ->get();
        // Ambil form yang perlu direview
        $formsToReview = DevelopmentForm::whereNull('mentor_id') // Form yang diisi user biasa
                                        ->orWhere('mentor_id', $currentMentorId) // Form yang diisi mentor ini sendiri
                                        ->whereDoesntHave('feedback', function ($query) use ($currentMentorId) {
                                            $query->where('mentor_id', $currentMentorId); // Yang belum ada feedback dari mentor ini
                                        })
                                        ->with('user')
                                        ->latest()
                                        ->paginate(30); // Ambil 5 form terbaru

        return view('mentor.dashboard', compact('totalMaterials', 'recentChats', 'formsToReview'));
    }

    public function materials()
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan mengelola materi.');
        }
        $materials = Material::where('mentor_id', $currentMentorId)->latest()->paginate(10);
        return view('mentor.materials.index', compact('materials'));
    }

    public function createMaterial()
    {
        return view('mentor.materials.create');
    }

    public function storeMaterial(Request $request)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan membuat materi.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validasi gambar
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240', // Validasi audio (10MB)
            'level' => 'required|in:basic,intermediate,advanced',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = null;
        $audioPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('materials/images', 'public');
        }
        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('materials/audio', 'public');
        }

        Material::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'image_path' => $imagePath, // Simpan path gambar
            'audio_path' => $audioPath, // Simpan path audio
            'level' => $request->level,
            'mentor_id' => $currentMentorId,
        ]);

        return redirect()->route('mentor.materials.index')->with('success', 'Material created successfully!');
    }

    public function editMaterial(Material $material)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId || $material->mentor_id !== $currentMentorId) {
            abort(403, 'Unauthorized action.');
        }
        return view('mentor.materials.edit', compact('material'));
    }

    public function updateMaterial(Request $request, Material $material)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId || $material->mentor_id !== $currentMentorId) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240',
            'level' => 'required|in:basic,intermediate,advanced',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = $material->image_path; // Pertahankan yang lama jika tidak ada yang baru
        $audioPath = $material->audio_path; // Pertahankan yang lama jika tidak ada yang baru

        if ($request->hasFile('image')) {
            if ($material->image_path) { // Hapus yang lama jika ada
                Storage::disk('public')->delete($material->image_path);
            }
            $imagePath = $request->file('image')->store('materials/images', 'public');
        }
        if ($request->hasFile('audio')) {
            if ($material->audio_path) { // Hapus yang lama jika ada
                Storage::disk('public')->delete($material->audio_path);
            }
            $audioPath = $request->file('audio')->store('materials/audio', 'public');
        }

        $material->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'image_path' => $imagePath,
            'audio_path' => $audioPath,
            'level' => $request->level,
        ]);

        return redirect()->route('mentor.materials.index')->with('success', 'Material updated successfully!');
    }

    public function destroyMaterial(Material $material)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId || $material->mentor_id !== $currentMentorId) {
            abort(403, 'Unauthorized action.');
        }
        // Hapus file media terkait saat materi dihapus
        if ($material->image_path) {
            Storage::disk('public')->delete($material->image_path);
        }
        if ($material->audio_path) {
            Storage::disk('public')->delete($material->audio_path);
        }
        $material->delete();
        return redirect()->route('mentor.materials.index')->with('success', 'Material deleted successfully!');
    }

    public function reviewForm(DevelopmentForm $form)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan melihat form ini.');
        }

        // Pastikan form ini relevan untuk mentor ini (misal, belum ada feedback dari mentor lain, atau form ini diisi oleh mentor ini)
        // Atau, jika mentor bisa mereview semua form:
        // Anda bisa menambahkan logika otorisasi yang lebih kompleks di sini.
        // Untuk saat ini, asumsikan mentor bisa mereview form yang belum ada feedback dari mereka.
        $existingFeedback = Feedback::where('development_form_id', $form->id)
                                    ->where('mentor_id', $currentMentorId)
                                    ->first();

        return view('mentor.development.review', compact('form', 'existingFeedback'), ['title' => 'Review Form']);
    }

    public function storeFeedback(Request $request, DevelopmentForm $form)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan memberikan feedback.');
        }

        $request->validate([
            'feedback_content' => 'required|string|max:2000',
        ]);

        // Cek apakah sudah ada feedback dari mentor ini untuk form ini
        $feedback = Feedback::firstOrNew([
            'development_form_id' => $form->id,
            'mentor_id' => $currentMentorId,
        ]);

        $feedback->feedback_content = $request->feedback_content;
        $feedback->save();

        return redirect()->route('mentor.development.review', $form)->with('success', 'Feedback berhasil disimpan!');
    }


    public function chats()
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak diizinkan melihat chat.');
        }
        $chats = Chat::where('mentor_id', $currentMentorId)
                    ->select('user_id')
                    ->distinct()
                    ->with('user')
                    ->get();
        return view('mentor.chats.index', compact('chats'));
    }

    public function showChat(User $user)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak memiliki akses ke chat ini.');
        }
        $messages = Chat::where(function($query) use ($user, $currentMentorId) {
                            $query->where('user_id', $user->id)
                                  ->where('mentor_id', $currentMentorId);
                        })->orderBy('created_at', 'asc')->get();
        return view('mentor.chats.show', compact('user', 'messages'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $currentMentorId = $this->getLoggedInMentorId();
        if (!$currentMentorId) {
            abort(403, 'Anda tidak memiliki akses untuk mengirim pesan ini.');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'user_id' => $user->id,
            'mentor_id' => $currentMentorId,
            'message' => $request->message,
            'sender_type' => 'mentor',
        ]);

        event(new \App\Events\NewChatMessage($chat->message, $chat->user_id, $chat->mentor_id, $chat->sender_type));

        return back();
    }
}