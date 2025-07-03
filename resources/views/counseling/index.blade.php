<x-frontend-layout>
    <x-slot name="title">Layanan Konsultasi</x-slot> {{-- Set judul halaman --}}

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Layanan Konsultasi Kami</h1>
        <p class="mb-8 text-gray-700 dark:text-gray-300">
            Pilih mentor yang sesuai dengan kebutuhan Anda untuk memulai sesi konsultasi. Para mentor kami memiliki keahlian di berbagai bidang untuk membantu Anda.
        </p>

        @if($mentors->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">Informasi</p>
                <p>Belum ada mentor yang tersedia untuk konsultasi saat ini. Silakan cek kembali nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mentors as $mentor)
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $mentor->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">Spesialisasi: {{ $mentor->specialization ?? 'Umum' }}</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($mentor->bio, 150) }}</p>
                        @auth
                            <a href="{{ route('user.counseling.chat', $mentor) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300">
                                Mulai Chat
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-4 py-2 bg-indigo-400 text-white rounded-md cursor-not-allowed">
                                Login untuk Chat
                            </a>
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-frontend-layout>