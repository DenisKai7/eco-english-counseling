<x-mentor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Development Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                    Form {{ ucfirst(str_replace('_', ' ', $form->form_type)) }}
                    dari @if ($form->form_type === 'teacher_mentor')
                        {{ $form->mentor->name ?? 'Unknown Mentor' }} {{-- Ambil nama dari relasi mentor --}}
                    @else
                        {{ $form->user->name ?? 'Unknown User' }} {{-- Ambil nama dari relasi user --}}
                    @endif
                    pada {{ $form->created_at->format('d F Y H:i') }}
                </h1>

                <div class="mb-8 p-4 border rounded-md bg-gray-50 dark:bg-gray-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">Isi Form:</h2>
                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                        @if($form->form_type === 'child_abk')
                            <p><strong>Hari ini aku merasa senang karena:</strong> {{ $form->data['senang_karena'] ?? '-' }}</p>
                            <p><strong>Aku berhasil mencoba:</strong> {{ $form->data['berhasil_mencoba'] ?? '-' }}</p>
                            <p><strong>Hal yang paling aku suka belajar adalah:</strong> {{ $form->data['suka_belajar_apa'] ?? '-' }}</p>
                            <p><strong>Saat aku kesulitan, aku akan mencoba lagi karena aku:</strong> {{ $form->data['saat_kesulitan'] ?? '-' }}</p>
                            <p><strong>Aku hebat karena:</strong> {{ $form->data['aku_hebat_karena'] ?? '-' }}</p>
                        @elseif($form->form_type === 'parent')
                            <h3>Bagian 1: Mengenali Potensi Anak</h3>
                            <p><strong>Hal yang aku suka lakukan:</strong> {{ $form->data['suka_dilakukan'] ?? '-' }}</p>
                            <p><strong>Aku merasa senang kalau:</strong> {{ $form->data['merasa_senang_kalau'] ?? '-' }}</p>
                            <p><strong>Hal yang aku ingin coba pelajari:</strong> {{ $form->data['ingin_coba_pelajari'] ?? '-' }}</p>
                            <p><strong>Orang yang selalu mendukung aku adalah:</strong> {{ $form->data['selalu_mendukung'] ?? '-' }}</p>

                            <h3>Bagian 2: Rutinitas Belajar yang Seru</h3>
                            <p><strong>Jadwal Senin:</strong> {{ $form->data['jadwal_senin'] ?? '-' }}</p>
                            <p><strong>Jadwal Selasa:</strong> {{ $form->data['jadwal_selasa'] ?? '-' }}</p>
                            <p><strong>Jadwal Rabu:</strong> {{ $form->data['jadwal_rabu'] ?? '-' }}</p>
                            <p><strong>Jadwal Kamis:</strong> {{ $form->data['jadwal_kamis'] ?? '-' }}</p>
                            <p><strong>Jadwal Jumat:</strong> {{ $form->data['jadwal_jumat'] ?? '-' }}</p>

                            <h3>Bagian 3: Kotak Apresiasi 'Aku Hebat'</h3>
                            <p><strong>Hari ini aku bangga karena:</strong> {{ $form->data['bangga_karena'] ?? '-' }}</p>
                            <p><strong>Aku sudah mencoba belajar tentang:</strong> {{ $form->data['sudah_mencoba_belajar'] ?? '-' }}</p>
                            <p><strong>Orang tua bilang aku hebat karena:</strong> {{ $form->data['ortu_bilang_hebat_karena'] ?? '-' }}</p>

                            <h3>Checklist Motivasi Harian untuk Orang Tua</h3>
                            <ul>
                                <li>Memberi pujian saat anak belajar: {{ ($form->data['puji_anak'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Mendengarkan cerita atau perasaan anak: {{ ($form->data['dengar_cerita'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Memberi pelukan/sentuhan positif: {{ ($form->data['pelukan_positif'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Mengingatkan anak bahwa dia hebat & bisa berkembang: {{ ($form->data['ingatkan_hebat'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Menemani anak belajar tanpa memaksa: {{ ($form->data['temani_belajar'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                            </ul>
                        @elseif($form->form_type === 'teacher_mentor')
                            <h3>Checklist Harian untuk Guru/Mentor</h3>
                            <ul>
                                <li>Saya memberi pujian pada ABK hari ini: {{ ($form->data['puji_abk'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Saya membantu ABK memahami pelajaran dengan cara berbeda: {{ ($form->data['bantu_pahami'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Saya menciptakan suasana kelas yang ramah ABK: {{ ($form->data['suasana_ramah'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                                <li>Saya mendengarkan kebutuhan ABK hari ini: {{ ($form->data['dengar_kebutuhan'] ?? false) ? 'Ya' : 'Tidak' }}</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Berikan Feedback:</h2>
                <form method="POST" action="{{ route('mentor.development.storeFeedback', $form) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea name="feedback_content" rows="6" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Tulis feedback Anda di sini...">{{ old('feedback_content', $existingFeedback->feedback_content ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('feedback_content')" class="mt-2" />
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Simpan Feedback') }}
                        </x-primary-button>
                    </div>
                </form>

                @if($existingFeedback)
                    <div class="mt-8 p-4 border rounded-md bg-green-50 dark:bg-green-700 text-green-800 dark:text-green-100">
                        <h3 class="font-semibold mb-2">Feedback Anda Sebelumnya:</h3>
                        <p>{{ $existingFeedback->feedback_content }}</p>
                        <p class="text-sm mt-2">Diberikan pada: {{ $existingFeedback->updated_at->format('d M Y H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-mentor-layout>