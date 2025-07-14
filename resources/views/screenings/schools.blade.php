@extends('layouts.main')

@section('title', 'Pilih Sekolah - Skrining Kesehatan')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Pilih Sekolah untuk Skrining Kesehatan</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- SD Schools -->
        <div class="col-span-full">
            <h2 class="text-xl font-semibold mb-4 text-blue-600">Sekolah Dasar (SD)</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($schools->where('type', 'SD') as $school)
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
                @foreach($schools->where('type', 'SMP') as $school)
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
                @foreach($schools->where('type', 'OTHER') as $school)
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
</div>
@endsection
