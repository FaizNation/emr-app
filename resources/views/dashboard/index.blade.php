@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- SD Stats -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Sekolah Dasar (SD)</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['elementary_schools'] }}</p>
            <p class="text-gray-500 mt-1">Total SD</p>
        </div>

        <!-- SMP Stats -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Sekolah Menengah Pertama (SMP)</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['junior_high_schools'] }}</p>
            <p class="text-gray-500 mt-1">Total SMP</p>
        </div>

        <!-- Other Schools Stats -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Sekolah Lainnya</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['other_schools'] }}</p>
            <p class="text-gray-500 mt-1">Total Sekolah Lainnya</p>
        </div>

        <!-- Students Stats -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Total Siswa</h3>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $stats['total_students'] }}</p>
            <p class="text-gray-500 mt-1">Siswa Terdaftar</p>
        </div>

        <!-- Screenings Stats -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700">Total Skrining</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['total_screenings'] }}</p>
            <p class="text-gray-500 mt-1">Skrining Dilakukan</p>
        </div>
    </div>
</div>
@endsection
