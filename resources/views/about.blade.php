<x-frontend-layout>
    <x-slot name="title">About Us - ECO English and Counseling</x-slot>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white text-center mb-10">Tentang Kami</h1>

        {{-- Bagian Tujuan --}}
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-green-700 dark:text-green-400 mb-6 text-center">Tujuan ECO English and Counseling</h2>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                <p><strong>ECO English and Counseling</strong> hadir sebagai platform inovatif yang didedikasikan untuk mendukung tumbuh kembang optimal anak-anak berkebutuhan khusus (ABK) melalui pendekatan holistik. Kami percaya bahwa setiap anak memiliki potensi luar biasa yang dapat digali dan dikembangkan dengan pendampingan yang tepat.</p>
                <p>Tujuan utama kami adalah:</p>
                <ol>
                    <li><strong>Meningkatkan Motivasi Belajar:</strong> Menyediakan materi pembelajaran Bahasa Inggris yang disesuaikan dan interaktif, dirancang khusus untuk memenuhi kebutuhan unik ABK, sehingga proses belajar menjadi lebih menyenangkan dan efektif.</li>
                    <li><strong>Memberikan Dukungan Konseling:</strong> Menawarkan layanan konseling profesional bagi anak-anak, orang tua, dan guru, untuk membantu mengatasi tantangan emosional, sosial, dan akademik yang mungkin timbul.</li>
                    <li><strong>Membangun Komunitas Inklusif:</strong> Menjadi jembatan komunikasi antara orang tua, guru, dan para ahli, untuk saling berbagi informasi, pengalaman, dan strategi terbaik dalam mendampingi ABK.</li>
                    <li><strong>Menyediakan Sumber Daya Terpercaya:</strong> Mengumpulkan dan menyajikan artikel, berita, serta lembar kerja pendampingan yang relevan dan praktis, sebagai panduan bagi semua pihak yang terlibat dalam pendidikan ABK.</li>
                </ol>
                <p>Kami berkomitmen untuk menciptakan lingkungan belajar yang suportif, inklusif, dan penuh semangat, di mana setiap anak ABK merasa dihargai, mampu, dan termotivasi untuk terus belajar dan berkembang.</p>
            </div>
        </section>

        {{-- Bagian Tim Pengembang --}}
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-green-700 dark:text-green-400 mb-6 text-center">Tim Pengembang ECO English and Counseling</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Dosen Pembimbing --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/dr_fitra_pinandhita.jpg') }}" alt="Dr. Fitra Pinandhita, M.Pd." class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-green-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Dr. Fitra Pinandhita, M.Pd.</h3>
                    <p class="text-green-600 dark:text-green-400">Tutor Bahasa Inggris</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/dr_ratih_christiana.jpg') }}" alt="Dr. Ratih Christiana, M.Pd." class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-green-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Dr. Ratih Christiana, M.Pd.</h3>
                    <p class="text-green-600 dark:text-green-400">Konselor Pendidikan</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/puguh_jayadi.jpg') }}" alt="Puguh Jayadi, M.Kom" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-green-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Puguh Jayadi, M.Kom</h3>
                    <p class="text-green-600 dark:text-green-400">Konselor TI</p>
                </div>

                {{-- Mahasiswa --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/aline_aurora.jpg') }}" alt="Aline Aurora Dewi Narindra" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-blue-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Aline Aurora Dewi Narindra</h3>
                    <p class="text-blue-600 dark:text-blue-400">Asisten Tutor Bhs Inggris</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/vara_dika_frisca.jpg') }}" alt="Vara Diva Frisca" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-blue-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Vara Diva Frisca</h3>
                    <p class="text-blue-600 dark:text-blue-400">Asisten Konselor Pendidikan</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/team/jofanza_dannis.jpg') }}" alt="Jofanza Denis Aldida" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-blue-500">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Jofanza Denis Aldida</h3>
                    <p class="text-blue-600 dark:text-blue-400">Konselor TI</p>
                </div>
            </div>
        </section>

        {{-- Bagian Harapan --}}
        <section>
            <h2 class="text-3xl font-semibold text-green-700 dark:text-green-400 mb-6 text-center">Harapan Kami</h2>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                <p>Kami berharap <strong>ECO English and Counseling</strong> dapat menjadi sumber daya yang berharga dan inspiratif bagi setiap anak berkebutuhan khusus, orang tua, dan pendidik. Melalui platform ini, kami bercita-cita untuk:</p>
                <ul>
                    <li>Melihat lebih banyak anak ABK yang termotivasi dan antusias dalam belajar Bahasa Inggris.</li>
                    <li>Memberdayakan orang tua dengan pengetahuan dan strategi pendampingan yang efektif.</li>
                    <li>Mendukung guru dalam menciptakan lingkungan belajar yang lebih inklusif dan responsif.</li>
                    <li>Membangun jaringan kolaborasi yang kuat antara semua pihak demi masa depan ABK yang lebih cerah.</li>
                </ul>
                <p>Dengan semangat kebersamaan dan dedikasi, kami yakin dapat memberikan kontribusi positif yang signifikan dalam dunia pendidikan anak berkebutuhan khusus di Indonesia.</p>
            </div>
        </section>
    </div>
</x-frontend-layout>