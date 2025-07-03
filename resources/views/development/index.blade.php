<x-frontend-layout>
    <x-slot name="title">Pengembangan Diri</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Pilih Peran Anda dalam Pengembangan</h1>
        <p class="mb-8 text-gray-700 dark:text-gray-300">
            Pilih peran Anda untuk mengisi lembar kerja pengembangan diri.
        </p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <i class="fas fa-child text-5xl text-blue-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Anak Berkebutuhan Khusus</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Isi lembar kerja untuk anak ABK.</p>
                <a href="{{ route('development.form.show', 'child_abk') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Isi Form</a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <i class="fas fa-users text-5xl text-purple-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Orang Tua/Wali</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Isi lembar kerja pendampingan orang tua.</p>
                <a href="{{ route('development.form.show', 'parent') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition duration-300">Isi Form</a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <i class="fas fa-chalkboard-teacher text-5xl text-green-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Guru/Mentor</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Isi checklist harian untuk guru/mentor.</p>
                <a href="{{ route('development.form.show', 'teacher_mentor') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">Isi Form</a>
            </div>
        </div>
    </div>
</x-frontend-layout>