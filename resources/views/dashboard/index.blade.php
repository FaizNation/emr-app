@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">📊 Dashboard</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- SD Stats -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <i class="mdi mdi-school text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Sekolah Dasar (SD)</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['elementary_schools'] }}</p>
                    <p class="text-sm text-gray-500">Total SD</p>
                </div>
            </div>
        </div>

        <!-- SMP Stats -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <i class="mdi mdi-school-outline text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Sekolah Menengah Pertama (SMP)</h3>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['junior_high_schools'] }}</p>
                    <p class="text-sm text-gray-500">Total SMP</p>
                </div>
            </div>
        </div>

        <!-- Other Schools -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                    <i class="mdi mdi-domain text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Sekolah Lainnya</h3>
                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ $stats['other_schools'] }}</p>
                    <p class="text-sm text-gray-500">Total Sekolah Lain</p>
                </div>
            </div>
        </div>

        <!-- Total Siswa -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
                    <i class="mdi mdi-account-multiple text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Siswa</h3>
                    <p class="text-3xl font-bold text-orange-500 mt-1">{{ $stats['total_students'] }}</p>
                    <p class="text-sm text-gray-500">Siswa Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Skrining -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="bg-red-100 text-red-500 p-3 rounded-full">
                    <i class="mdi mdi-heart-pulse text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Skrining</h3>
                    <p class="text-3xl font-bold text-red-500 mt-1">{{ $stats['total_screenings'] }}</p>
                    <p class="text-sm text-gray-500">Skrining Dilakukan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
