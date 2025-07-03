<x-frontend-layout>
    <x-slot name="title">Artikel & Berita</x-slot>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Artikel & Berita Terbaru</h1>
        <p class="mb-8 text-gray-700 dark:text-gray-300">
            Temukan informasi dan wawasan terbaru seputar konseling dan pembelajaran Bahasa Inggris untuk anak berkebutuhan khusus.
        </p>

        @if($articles->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">Informasi</p>
                <p>Belum ada artikel yang tersedia saat ini. Silakan cek kembali nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('images/default-article.jpg') }}" alt="Default Article Image" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mt-2 mb-3">{{ $article->title }}</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300 text-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</x-frontend-layout>