<x-frontend-layout>
    <x-slot name="title">Form Orang Tua</x-slot>

    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Lembar Kerja Orang Tua</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Jawab bersama anak, bantu ia mengenali dirinya.</p>

            <form method="POST" action="{{ route('development.form.store', 'parent') }}">
                @csrf

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Bagian 1: Mengenali Potensi Anak</h2>
                <div class="mb-4">
                    <x-input-label for="suka_dilakukan" :value="__('Hal yang aku suka lakukan:')" />
                    <textarea id="suka_dilakukan" name="suka_dilakukan" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('suka_dilakukan') }}</textarea>
                    <x-input-error :messages="$errors->get('suka_dilakukan')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="merasa_senang_kalau" :value="__('Aku merasa senang kalau:')" />
                    <textarea id="merasa_senang_kalau" name="merasa_senang_kalau" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('merasa_senang_kalau') }}</textarea>
                    <x-input-error :messages="$errors->get('merasa_senang_kalau')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="ingin_coba_pelajari" :value="__('Hal yang aku ingin coba pelajari:')" />
                    <textarea id="ingin_coba_pelajari" name="ingin_coba_pelajari" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('ingin_coba_pelajari') }}</textarea>
                    <x-input-error :messages="$errors->get('ingin_coba_pelajari')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-input-label for="selalu_mendukung" :value="__('Orang yang selalu mendukung aku adalah:')" />
                    <textarea id="selalu_mendukung" name="selalu_mendukung" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('selalu_mendukung') }}</textarea>
                    <x-input-error :messages="$errors->get('selalu_mendukung')" class="mt-2" />
                </div>

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 mt-8">Bagian 2: Rutinitas Belajar yang Seru</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Tentukan jadwal belajar sederhana bersama anak:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <x-input-label for="jadwal_senin" :value="__('Senin:')" />
                        <x-text-input id="jadwal_senin" class="block mt-1 w-full" type="text" name="jadwal_senin" :value="old('jadwal_senin')" />
                    </div>
                    <div>
                        <x-input-label for="jadwal_selasa" :value="__('Selasa:')" />
                        <x-text-input id="jadwal_selasa" class="block mt-1 w-full" type="text" name="jadwal_selasa" :value="old('jadwal_selasa')" />
                    </div>
                    <div>
                        <x-input-label for="jadwal_rabu" :value="__('Rabu:')" />
                        <x-text-input id="jadwal_rabu" class="block mt-1 w-full" type="text" name="jadwal_rabu" :value="old('jadwal_rabu')" />
                    </div>
                    <div>
                        <x-input-label for="jadwal_kamis" :value="__('Kamis:')" />
                        <x-text-input id="jadwal_kamis" class="block mt-1 w-full" type="text" name="jadwal_kamis" :value="old('jadwal_kamis')" />
                    </div>
                    <div>
                        <x-input-label for="jadwal_jumat" :value="__('Jumat:')" />
                        <x-text-input id="jadwal_jumat" class="block mt-1 w-full" type="text" name="jadwal_jumat" :value="old('jadwal_jumat')" />
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 mt-8">Bagian 3: Kotak Apresiasi 'Aku Hebat'</h2>
                <div class="mb-4">
                    <x-input-label for="bangga_karena" :value="__('Hari ini aku bangga karena:')" />
                    <textarea id="bangga_karena" name="bangga_karena" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('bangga_karena') }}</textarea>
                    <x-input-error :messages="$errors->get('bangga_karena')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="sudah_mencoba_belajar" :value="__('Aku sudah mencoba belajar tentang:')" />
                    <textarea id="sudah_mencoba_belajar" name="sudah_mencoba_belajar" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('sudah_mencoba_belajar') }}</textarea>
                    <x-input-error :messages="$errors->get('sudah_mencoba_belajar')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-input-label for="ortu_bilang_hebat_karena" :value="__('Orang tua bilang aku hebat karena:')" />
                    <textarea id="ortu_bilang_hebat_karena" name="ortu_bilang_hebat_karena" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('ortu_bilang_hebat_karena') }}</textarea>
                    <x-input-error :messages="$errors->get('ortu_bilang_hebat_karena')" class="mt-2" />
                </div>

                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 mt-8">Checklist Motivasi Harian untuk Orang Tua</h2>
                <div class="space-y-2 mb-6">
                    <div>
                        <label for="puji_anak" class="inline-flex items-center">
                            <input id="puji_anak" type="checkbox" name="puji_anak" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('puji_anak') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Memberi pujian saat anak belajar</span>
                        </label>
                    </div>
                    <div>
                        <label for="dengar_cerita" class="inline-flex items-center">
                            <input id="dengar_cerita" type="checkbox" name="dengar_cerita" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('dengar_cerita') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Mendengarkan cerita atau perasaan anak</span>
                        </label>
                    </div>
                    <div>
                        <label for="pelukan_positif" class="inline-flex items-center">
                            <input id="pelukan_positif" type="checkbox" name="pelukan_positif" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('pelukan_positif') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Memberi pelukan/sentuhan positif</span>
                        </label>
                    </div>
                    <div>
                        <label for="ingatkan_hebat" class="inline-flex items-center">
                            <input id="ingatkan_hebat" type="checkbox" name="ingatkan_hebat" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('ingatkan_hebat') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Mengingatkan anak bahwa dia hebat & bisa berkembang</span>
                        </label>
                    </div>
                    <div>
                        <label for="temani_belajar" class="inline-flex items-center">
                            <input id="temani_belajar" type="checkbox" name="temani_belajar" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('temani_belajar') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Menemani anak belajar tanpa memaksa</span>
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