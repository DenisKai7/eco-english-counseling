<x-frontend-layout>
    <x-slot name="title">{{ $material->title }}</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $material->title }}</h1>
            <div class="text-gray-600 dark:text-gray-400 text-sm mb-6">
                Level: <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">{{ ucfirst($material->level) }}</span>
                <span class="ml-4">Diposting pada {{ $material->created_at->format('d F Y') }} oleh {{ $material->mentor->name ?? 'Unknown Mentor' }}</span>
            </div>

            @if($material->description)
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">{{ $material->description }}</p>
            @endif

            {{-- Tampilkan Gambar Materi --}}
            @if($material->image_path)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $material->image_path) }}" alt="Gambar Materi {{ $material->title }}" class="w-full h-auto max-h-96 object-contain rounded-lg shadow-md">
                </div>
            @endif

            {{-- Tampilkan Audio Materi --}}
            @if($material->audio_path)
                <div class="mb-6">
                    <audio controls src="{{ asset('storage/' . $material->audio_path) }}" class="w-full"></audio>
                </div>
            @endif

            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                {!! $material->content !!} {{-- Konten utama materi --}}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('materials.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Materi
                </a>
            </div>
        </article>
    </div>
</x-frontend-layout>