<x-frontend-layout>
    <x-slot name="title">Form Guru/Mentor</x-slot>

    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Lembar Kerja Guru/Mentor</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Meningkatkan Motivasi Belajar ABK</p>

            <form method="POST" action="{{ route('development.form.store', 'teacher_mentor') }}">
                @csrf

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Checklist Harian untuk Guru/Mentor</h2>
                <div class="space-y-2 mb-6">
                    <div>
                        <label for="puji_abk" class="inline-flex items-center">
                            <input id="puji_abk" type="checkbox" name="puji_abk" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('puji_abk') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Saya memberi pujian pada ABK hari ini</span>
                        </label>
                    </div>
                    <div>
                        <label for="bantu_pahami" class="inline-flex items-center">
                            <input id="bantu_pahami" type="checkbox" name="bantu_pahami" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('bantu_pahami') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Saya membantu ABK memahami pelajaran dengan cara berbeda</span>
                        </label>
                    </div>
                    <div>
                        <label for="suasana_ramah" class="inline-flex items-center">
                            <input id="suasana_ramah" type="checkbox" name="suasana_ramah" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('suasana_ramah') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Saya menciptakan suasana kelas yang ramah ABK</span>
                        </label>
                    </div>
                    <div>
                        <label for="dengar_kebutuhan" class="inline-flex items-center">
                            <input id="dengar_kebutuhan" type="checkbox" name="dengar_kebutuhan" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('dengar_kebutuhan') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Saya mendengarkan kebutuhan ABK hari ini</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>
                        {{ __('Simpan Form') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-frontend-layout>