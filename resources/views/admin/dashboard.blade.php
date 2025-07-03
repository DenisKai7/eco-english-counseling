<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Test Alpine.js (bisa dihapus setelah konfirmasi) --}}
                    {{-- <div x-data="{ showMe: false }">
                        <button @click="showMe = !showMe" class="px-4 py-2 bg-blue-500 text-white rounded">Toggle Test</button>
                        <p x-show="showMe" class="mt-2 text-green-600">Jika Anda melihat ini, Alpine.js berfungsi!</p>
                    </div> --}}

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Welcome, Admin!</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-blue-800">Total Users</h4>
                            <p class="text-3xl font-bold text-blue-900">{{ $totalUsers }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-green-800">Total Mentors</h4>
                            <p class="text-3xl font-bold text-green-900">{{ $totalMentors }}</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-purple-800">Total Articles</h4>
                            <p class="text-3xl font-bold text-purple-900">{{ $totalArticles }}</p>
                        </div>
                        {{-- Kartu Baru: Mentor Development Forms --}}
                        <div class="bg-indigo-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-indigo-800">Mentor Forms Submitted</h4>
                            <p class="text-3xl font-bold text-indigo-900">{{ $totalMentorDevelopmentForms }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>