<x-frontend-layout>
    <x-slot name="title">Materi Pembelajaran</x-slot> {{-- Set judul halaman --}}

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Materi Pembelajaran Bahasa Inggris</h1>
        <p class="mb-8 text-gray-700 dark:text-gray-300">
            Temukan berbagai materi pembelajaran Bahasa Inggris yang disesuaikan, terutama untuk anak berkebutuhan khusus.
        </p>

        @if($materials->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">Informasi</p>
                <p>Belum ada materi pembelajaran yang tersedia saat ini. Silakan cek kembali nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($materials as $material)
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $material->title }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">Level: {{ ucfirst($material->level) }}</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($material->description ?? $material->content, 150) }}</p>
                        <a href="{{ route('materials.show', $material->slug) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">
                            Baca Materi
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $materials->links() }}
            </div>
        @endif
    </div>
</x-frontend-layout>