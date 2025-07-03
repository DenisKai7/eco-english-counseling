<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Material;
use App\Models\Mentor; // Tambahkan ini
use Illuminate\Support\Str; // Tambahkan ini (untuk Str::limit di view)

class HomeController extends Controller
{
    public function index()
    {
        // Data ini bisa ditampilkan di welcome page jika diperlukan, tapi saat ini welcome hanya menampilkan hero
        $latestArticles = Article::latest()->take(3)->get();
        $latestMaterials = Material::latest()->take(3)->get();
        
        return view('welcome', compact('latestArticles', 'latestMaterials'), ['title' => 'Home']);
    }

    public function about()
    {
        return view('about', ['title' => 'Tentang Kami']); 
    }

    public function contact()
    {
        return view('contact', ['title' => 'Kontak Kami']);
    }

    public function articles()
    {
        $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'), ['title' => 'Artikel & Berita']);
    }

    public function showArticle(Article $article)
    {
        return view('articles.show', compact('article'), ['title' => $article->title]);
    }

    public function materials()
    {
        $materials = Material::latest()->paginate(10);
        return view('materials.index', compact('materials'), ['title' => 'Materi Pembelajaran']);
    }

    public function showMaterial(Material $material)
    {
        return view('materials.show', compact('material'), ['title' => $material->title]);
    }

    public function counseling()
    {
        $mentors = Mentor::all(); // Mengambil semua mentor
        return view('counseling.index', compact('mentors'), ['title' => 'Layanan Konsultasi']);
    }
}