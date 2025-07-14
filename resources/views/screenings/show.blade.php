@extends('layouts.main')

@section('title', 'Detail Skrining - ' . $screening->student->name)

@section('content')
    <div class="container mx-auto">
        <div class="max-w-5xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('screenings.school', $school) }}" class="text-gray-600 hover:text-gray-900">
                    ← Kembali ke Daftar Skrining
                </a>
            </div>

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Detail Skrining Kesehatan</h1>
                    <p class="text-gray-600">{{ $screening->student->name }} - {{ $school->name }}</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('screenings.edit', [$school, $screening]) }}"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                        Edit Data
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Info Siswa -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Informasi Siswa</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                                    <dd class="text-gray-900">{{ $screening->student->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                                    <dd class="text-gray-900">{{ $screening->student->class }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Skrining</dt>
                                    <dd class="text-gray-900">{{ $screening->created_at->format('d F Y') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Status Gizi -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Status Gizi</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Berat Badan</dt>
                                    <dd class="text-gray-900">{{ number_format($screening->weight, 1) }} kg</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tinggi Badan</dt>
                                    <dd class="text-gray-900">{{ number_format($screening->height, 1) }} cm</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">LPIMT</dt>
                                    <dd class="text-gray-900">{{ number_format($screening->lpimt, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Gizi</dt>
                                    <dd>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($screening->nutrition_status == 'Normal') bg-green-100 text-green-800
                                        @elseif(in_array($screening->nutrition_status, ['Kurus', 'Gemuk'])) bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                            {{ $screening->nutrition_status }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Tanda Vital -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Tanda Vital</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tekanan Darah</dt>
                                    <dd class="text-gray-900">{{ $screening->blood_pressure }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Anemia</dt>
                                    <dd>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($screening->anemia == 'Normal') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                            {{ $screening->anemia }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Penglihatan dan Pendengaran -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Penglihatan & Pendengaran</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Mata Kanan</dt>
                                    <dd class="text-gray-900">{{ $screening->vision_right }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Mata Kiri</dt>
                                    <dd class="text-gray-900">{{ $screening->vision_left }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pendengaran</dt>
                                    <dd>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($screening->hearing == 'Normal') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-orange-800 @endif">
                                            {{ $screening->hearing }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Kebugaran dan Kesehatan Gigi -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Kebugaran & Gigi</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Kebugaran</dt>
                                    <dd>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if (in_array($screening->fitness, ['Sangat Baik', 'Baik'])) bg-green-100 text-green-800
                                        @elseif($screening->fitness == 'Cukup') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                            {{ $screening->fitness }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Kesehatan Gigi</dt>
                                    <dd>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($screening->dental == 'Sehat') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ $screening->dental }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Kecacatan -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Kondisi Khusus</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Kecacatan</dt>
                                    <dd class="text-gray-900">{{ $screening->disability ?: 'Tidak Ada' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if ($screening->referral)
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Rujukan</h3>
                            <p class="text-gray-900 whitespace-pre-line">{{ $screening->referral }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
