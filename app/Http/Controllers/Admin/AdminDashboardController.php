<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\DevelopmentForm;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     * Mengambil data ringkasan untuk ditampilkan di dashboard admin.
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalMentors = Mentor::count();
        $totalArticles = Article::count();
        // Pastikan baris ini ada dan benar
        $totalMentorDevelopmentForms = DevelopmentForm::where('form_type', 'teacher_mentor')->count();

        // Pastikan variabel ini diteruskan ke view
        return view('admin.dashboard', compact('totalUsers', 'totalMentors', 'totalArticles', 'totalMentorDevelopmentForms'));
    }

    // CRUD Users
    public function users()
    {
        $users = User::where('role', 'user')->paginate(10); // Hanya user biasa
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin', // Admin bisa membuat user biasa atau admin lain
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            'role' => 'required|in:user,admin',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) { // Mencegah admin menghapus dirinya sendiri
            return back()->with('error', 'You cannot delete your own account.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    // CRUD Mentors
    public function mentors()
    {
        $mentors = Mentor::paginate(10);
        return view('admin.mentors.index', compact('mentors'));
    }

    public function createMentor()
    {
        return view('admin.mentors.create');
    }

    public function storeMentor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mentors',
            'password' => 'required|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        Mentor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'specialization' => $request->specialization,
            'phone_number' => $request->phone_number,
            'bio' => $request->bio,
        ]);

        return redirect()->route('admin.mentors.index')->with('success', 'Mentor created successfully!');
    }

    public function editMentor(Mentor $mentor)
    {
        return view('admin.mentors.edit', compact('mentor'));
    }

    public function updateMentor(Request $request, Mentor $mentor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mentors,email,' . $mentor->id,
            'password' => 'nullable|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->specialization = $request->specialization;
        $mentor->phone_number = $request->phone_number;
        $mentor->bio = $request->bio;

        if ($request->filled('password')) {
            $mentor->password = Hash::make($request->password);
        }

        $mentor->save();

        return redirect()->route('admin.mentors.index')->with('success', 'Mentor updated successfully!');
    }

    public function destroyMentor(Mentor $mentor)
    {
        $mentor->delete();
        return redirect()->route('admin.mentors.index')->with('success', 'Mentor deleted successfully!');
    }

    // CRUD Articles
    public function articles()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        return view('admin.articles.create');
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:counseling,english_special_needs',
            'image' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        $slug = Str::slug($request->title);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'author_id' => auth()->id(),
            'category' => $request->category,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully!');
    }

    public function editArticle(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:counseling,english_special_needs',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = $article->image; // Pertahankan gambar lama jika tidak ada yang baru diunggah

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroyArticle(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }
}