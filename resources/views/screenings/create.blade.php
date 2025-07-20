@extends('layouts.main')

@section('title', 'Tambah Skrining - ' . $school->name)

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('screenings.school', $school) }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    <i class="mdi mdi-arrow-left mr-2"></i>
                    <span>Kembali ke Daftar Skrining</span>
                </a>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-0">Tambah Skrining Kesehatan</h1>
                    <p class="text-sm sm:text-base text-gray-600">{{ $school->name }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <form action="{{ route('screenings.store', $school) }}" method="POST" class="p-4 sm:p-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Siswa -->
                        <div class="col-span-1 sm:col-span-2">
                            <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="mdi mdi-account-school mr-1"></i>
                                Siswa
                            </label>
                            <select name="student_id" id="student_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base"
                                required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} - Kelas
                                        {{ $student->class }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($students->isEmpty())
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="mdi mdi-alert mr-1"></i>
                                    Semua siswa di sekolah ini sudah memiliki data skrining.
                                </p>
                            @endif
                        </div>

                        <!-- BB & TB -->
                        <div class="relative">
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="mdi mdi-scale mr-1"></i>
                                Berat Badan (kg)
                            </label>
                            <input type="number" step="0.1" name="weight" id="weight" value="{{ old('weight') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base pl-8"
                                required>
                            <div class="absolute inset-y-0 left-0 pt-6 pl-2 pointer-events-none text-gray-500">
                                kg
                            </div>
                        </div>

                        <div class="relative">
                            <label for="height" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="mdi mdi-human-male-height mr-1"></i>
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" step="0.1" name="height" id="height" value="{{ old('height') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base pl-8"
                                required>
                            <div class="absolute inset-y-0 left-0 pt-6 pl-2 pointer-events-none text-gray-500">
                                cm
                            </div>
                        </div>

                        <div>
                            <label for="waist_circumference" class="block text-sm font-medium text-gray-700"> lingkar Badan
                                (cm)</label>
                            <input type="number" step="0.1" name="waist_circumference" id="waist_circumference"
                                value="{{ old('waist_circumference') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- IMT & Status Gizi -->
                        <div>
                            <label for="bmi" class="block text-sm font-medium text-gray-700">IMT</label>
                            <input type="number" step="0.01" name="bmi" id="bmi" value="{{ old('bmi') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required readonly>
                        </div>

                        <div>
                            <label for="nutritional_status" class="block text-sm font-medium text-gray-700">Status
                                gizi</label>
                            <input type="text" name="nutritional_status" id="nutritional_status"
                                value="{{ old('nutritional_status') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Tekanan Darah -->
                        <div>
                            <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Tekanan
                                Darah</label>
                            <input type="text" name="blood_pressure" id="blood_pressure"
                                value="{{ old('blood_pressure') }}" placeholder="120/80"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Penglihatan -->
                        <div>
                            <label for="vision_right" class="block text-sm font-medium text-gray-700">Mata Kanan</label>
                            <input type="text" name="vision_right" id="vision_right" value="{{ old('vision_right') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="vision_left" class="block text-sm font-medium text-gray-700">Mata Kiri</label>
                            <input type="text" name="vision_left" id="vision_left" value="{{ old('vision_left') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Pendengaran -->
                        <div>
                            <label for="hearing" class="block text-sm font-medium text-gray-700">Pendengaran</label>
                            <input type="text" name="hearing" id="hearing" value="{{ old('hearing') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Gigi -->
                        <div>
                            <label for="dental" class="block text-sm font-medium text-gray-700">Gigi</label>
                            <input type="text" name="dental" id="dental" value="{{ old('dental') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Anemia -->
                        <div>
                            <label for="hemoglobin" class="block text-sm font-medium text-gray-700">Anemia</label>
                            <input type="number" step="0.1" name="hemoglobin" id="hemoglobin"
                                value="{{ old('hemoglobin') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Kecacatan -->
                        <div>
                            <label for="disability" class="block text-sm font-medium text-gray-700">Kecacatan</label>
                            <input type="text" name="disability" id="disability" value="{{ old('disability') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Kebugaran -->
                        <div>
                            <label for="fitness" class="block text-sm font-medium text-gray-600">Status Kebugaran</label>
                            <select name="fitness" id="fitness"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Status Kebugaran</option>
                                <option value="1" class="text-green-600"
                                    {{ old('fitness') == '1' ? 'selected' : '' }}>Bugar</option>
                                <option value="0" class="text-red-600"
                                    {{ old('fitness') == '0' ? 'selected' : '' }}>Tidak Bugar</option>
                            </select>
                            @error('fitness')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <!-- Rujukan -->
                    <div class="mt-6">
                        <label for="referral" class="block text-sm font-medium text-gray-700">Rujukan</label>

                        <textarea name="referral" id="referral" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('referral') }}</textarea>

                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <button type="submit"
                                class="w-full sm:w-auto bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 flex items-center justify-center">
                                <i class="mdi mdi-content-save mr-2"></i>
                                Simpan Data Skrining
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto calculate bmi when weight or height changes
        document.addEventListener('DOMContentLoaded', function() {
            const weightInput = document.getElementById('weight');
            const heightInput = document.getElementById('height');
            const bmiInput = document.getElementById('bmi');

            function calculatebmi() {
                if (weightInput.value && heightInput.value) {
                    const weight = parseFloat(weightInput.value);
                    const height = parseFloat(heightInput.value) / 100; // convert to meters
                    const bmi = weight / (height * height);
                    bmiInput.value = bmi.toFixed(2);
                }
            }

            weightInput.addEventListener('input', calculatebmi);
            heightInput.addEventListener('input', calculatebmi);
        });
    </script>
@endsection
