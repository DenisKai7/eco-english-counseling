<x-frontend-layout>
    <x-slot name="title">Form Anak ABK</x-slot>

    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Lembar Kerja Anak - Aku Bisa, Aku Semangat!</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Isilah dengan jujur ya, ini untuk menunjukkan betapa hebatnya kamu!</p>

            <form method="POST" action="{{ route('development.form.store', 'child_abk') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="senang_karena" :value="__('Hari ini aku merasa senang karena:')" />
                    <textarea id="senang_karena" name="senang_karena" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('senang_karena') }}</textarea>
                    <x-input-error :messages="$errors->get('senang_karena')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="berhasil_mencoba" :value="__('Aku berhasil mencoba:')" />
                    <textarea id="berhasil_mencoba" name="berhasil_mencoba" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('berhasil_mencoba') }}</textarea>
                    <x-input-error :messages="$errors->get('berhasil_mencoba')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="suka_belajar_apa" :value="__('Hal yang paling aku suka belajar adalah:')" />
                    <textarea id="suka_belajar_apa" name="suka_belajar_apa" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('suka_belajar_apa') }}</textarea>
                    <x-input-error :messages="$errors->get('suka_belajar_apa')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="saat_kesulitan" :value="__('Saat aku kesulitan, aku akan mencoba lagi karena aku:')" />
                    <textarea id="saat_kesulitan" name="saat_kesulitan" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('saat_kesulitan') }}</textarea>
                    <x-input-error :messages="$errors->get('saat_kesulitan')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="aku_hebat_karena" :value="__('Aku hebat karena:')" />
                    <textarea id="aku_hebat_karena" name="aku_hebat_karena" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('aku_hebat_karena') }}</textarea>
                    <x-input-error :messages="$errors->get('aku_hebat_karena')" class="mt-2" />
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