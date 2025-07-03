<x-frontend-layout>
    <x-slot name="title">{{ $article->title }}</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
            @else
                <img src="{{ asset('images/default-article.jpg') }}" alt="Default Article Image" class="w-full h-96 object-cover rounded-lg mb-6">
            @endif

            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $article->title }}</h1>
            <div class="text-gray-600 dark:text-gray-400 text-sm mb-6">
                Diposting pada {{ $article->created_at->format('d F Y') }} oleh {{ $article->author->name ?? 'Admin' }}
                <span class="ml-4 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                    {{ ucfirst(str_replace('_', ' ', $article->category)) }}
                </span>
            </div>

            {{-- Perubahan utama di sini: Tambahkan class text-justify --}}
            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                {!! $article->content !!} {{-- Gunakan {!! !!} karena konten biasanya HTML --}}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Artikel
                </a>
            </div>
        </article>
    </div>
</x-frontend-layout>