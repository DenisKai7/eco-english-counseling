<x-frontend-layout>
    {{-- Hero Section / Main Content --}}
    <div class="relative w-full min-h-screen flex items-center justify-center p-8 bg-cover bg-center" style="background-image: url('{{ asset('images/hero-image.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row items-center lg:items-start justify-between gap-12 py-16">
            {{-- Left Section --}}
            <div class="text-white text-center lg:text-left lg:w-1/2">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">Mempermudah konsultasi dan berbagi</h1>
                <p class="text-xl mb-8 leading-relaxed">
                    Keajaiban tercipta dari bercerita, solusi menjalar karena belajar. Kami hadir menjadi sahabat dan rekan dalam berbagi solusi.
                </p>
                <a href="{{ route('articles.index') }}" class="inline-block px-8 py-4 bg-green-500 text-white font-semibold rounded-lg shadow-lg hover:bg-green-700 transition duration-300">
                    Selengkapnya
                </a>
            </div>

            {{-- Right Section: Three Service Boxes --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:w-1/2 mt-12 lg:mt-0">
                {{-- Pengembangan (Green) --}}
                <a href="{{ route('development.index') }}" class="bg-green-400 p-8 rounded-lg shadow-xl text-center text-white flex flex-col items-center justify-center space-y-4 transform hover:scale-105 transition duration-300">
                    <i class="fas fa-heart text-5xl"></i>
                    <h3 class="text-xl font-semibold">Pengembangan</h3>
                </a>

                {{-- Konsultasi (Orange/Yellow) --}}
                <a href="{{ route('counseling.index') }}" class="bg-yellow-400 p-8 rounded-lg shadow-xl text-center text-white flex flex-col items-center justify-center space-y-4 transform hover:scale-105 transition duration-300">
                    <i class="fas fa-users text-5xl"></i>
                    <h3 class="text-xl font-semibold">Konsultasi</h3>
                </a>

                {{-- Bahasa (Blue) --}}
                <a href="{{ route('materials.index') }}" class="bg-blue-400 p-8 rounded-lg shadow-xl text-center text-white flex flex-col items-center justify-center space-y-4 transform hover:scale-105 transition duration-300">
                    <i class="fas fa-book text-5xl"></i>
                    <h3 class="text-xl font-semibold">Bahasa</h3>
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>