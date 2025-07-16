@extends('layouts.main')

@section('title', 'Pilih Sekolah - Skrining Kesehatan')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Pilih Sekolah untuk Skrining Kesehatan</h1>
        </div>

        <!-- Search Form -->
        <div class="mb-8">
            <form action="{{ route('screenings.index') }}" method="GET" class="flex gap-4 max-w-2xl">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari sekolah berdasarkan nama atau jenis (SD/SMP)..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                @if ($search)
                    <a href="{{ route('screenings.index') }}"
                        class="px-4 py-2 bg-gray-100 text-gray-600 rounded-md hover:bg-gray-200">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @if ($schools->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada sekolah ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $search ? 'Coba kata kunci pencarian yang lain' : 'Belum ada sekolah yang terdaftar' }}</p>
                @if ($search)
                    <div class="mt-6">
                        <a href="{{ route('screenings.index') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-500">
                            ← Kembali ke daftar semua sekolah
                        </a>
                    </div>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- SD Schools -->
                <div class="col-span-full mt-8">
                    <h2 class="text-xl font-semibold mb-4 text-blue-600">Sekolah Dasar (SD)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($schools->where('type', 'SD') as $school)
                            <a href="{{ route('screenings.school', $school) }}"
                                class="block p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-900">{{ $school->name }}</h3>
                                <div class="mt-2">
                                    <p class="text-blue-600">{{ $school->students_count }} Siswa</p>
                                    <p class="text-gray-500 text-sm">{{ $school->screenings_count }} Skrining</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- SMP Schools -->
                <div class="col-span-full mt-8">
                    <h2 class="text-xl font-semibold mb-4 text-green-600">Sekolah Menengah Pertama (SMP)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($schools->where('type', 'SMP') as $school)
                            <a href="{{ route('screenings.school', $school) }}"
                                class="block p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-900">{{ $school->name }}</h3>
                                <div class="mt-2">
                                    <p class="text-green-600">{{ $school->students_count }} Siswa</p>
                                    <p class="text-gray-500 text-sm">{{ $school->screenings_count }} Skrining</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Other Schools -->
                <div class="col-span-full mt-8">
                    <h2 class="text-xl font-semibold mb-4 text-purple-600">Sekolah Lainnya</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($schools->where('type', 'OTHER') as $school)
                            <a href="{{ route('screenings.school', $school) }}"
                                class="block p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-900">{{ $school->name }}</h3>
                                <div class="mt-2">
                                    <p class="text-purple-600">{{ $school->students_count }} Siswa</p>
                                    <p class="text-gray-500 text-sm">{{ $school->screenings_count }} Skrining</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
