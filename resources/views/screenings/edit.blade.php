@extends('layouts.main')

@section('title', 'Edit Skrining - ' . $screening->student->name)

@section('content')
    <div class="container mx-auto">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('screenings.school', $school) }}" class="text-gray-600 hover:text-gray-900">
                    ← Kembali ke Daftar Skrining
                </a>
            </div>

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Edit Data Skrining</h1>
                    <p class="text-gray-600">{{ $screening->student->name }} - {{ $school->name }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <form action="{{ route('screenings.update', [$school, $screening]) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- BB & TB -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" id="weight"
                                value="{{ old('weight', $screening->weight) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="height" id="height"
                                value="{{ old('height', $screening->height) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- LPIMT & Status Gizi -->
                        <div>
                            <label for="bmi" class="block text-sm font-medium text-gray-700">bmi</label>
                            <input type="number" step="0.01" name="bmi" id="bmi"
                                value="{{ old('bmi', $screening->bmi) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="nutritional_status" class="block text-sm font-medium text-gray-700">Status
                                gizi</label>
                            <select name="nutritional_status" id="nutritional_status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                                <option value="">Pilih Status Gizi</option>
                                <option value="Berat badan kurang"
                                    {{ old('nutritional_status') == 'Berat badan kurang' ? 'selected' : '' }}>
                                    Berat badan kurang
                                </option>
                                <option value="Normal" {{ old('nutritional_status') == 'Normal' ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="Berat badan berlebih"
                                    {{ old('nutritional_status') == 'Berat badan berlebih' ? 'selected' : '' }}>
                                    Berat badan berlebih
                                </option>
                                <option value="Obesitas" {{ old('nutritional_status') == 'Obesitas' ? 'selected' : '' }}>
                                    Obesitas
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="waist_circumference" class="block text-sm font-medium text-gray-700">Lingkar
                                perut</label>
                            <input type="number" step="0.01" name="waist_circumference" id="waist_circumference"
                                value="{{ old('waist_circumference', $screening->waist_circumference) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>


                        <!-- Tekanan Darah -->
                        <div>
                            <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Tekanan
                                Darah</label>
                            <input type="text" name="blood_pressure" id="blood_pressure"
                                value="{{ old('blood_pressure', $screening->blood_pressure) }}" placeholder="120/80"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Penglihatan -->
                        <div>
                            <label for="vision_right" class="block text-sm font-medium text-gray-700">Mata Kanan</label>
                            <input type="text" name="vision_right" id="vision_right"
                                value="{{ old('vision_right', $screening->vision_right) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="vision_left" class="block text-sm font-medium text-gray-700">Mata Kiri</label>
                            <input type="text" name="vision_left" id="vision_left"
                                value="{{ old('vision_left', $screening->vision_left) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Pendengaran -->
                        <div>
                            <label for="hearing" class="block text-sm font-medium text-gray-700">Pendengaran</label>
                            <input type="text" name="hearing" id="hearing"
                                value="{{ old('hearing', $screening->hearing) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Gigi -->
                        <div>
                            <label for="dental" class="block text-sm font-medium text-gray-700">Gigi</label>
                            <input type="text" name="dental" id="dental"
                                value="{{ old('dental', $screening->dental) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>


                        <!-- Anemia -->
                        <div>
                            <label for="hemoglobin" class="block text-sm font-medium text-gray-700">Anemia</label>
                            <input type="number" step="0.01" name="hemoglobin" id="hemoglobin"
                                value="{{ old('hemoglobin', $screening->hemoglobin) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Kecacatan -->
                        <div>
                            <label for="disability" class="block text-sm font-medium text-gray-700">Kecacatan</label>
                            <input type="text" name="disability" id="disability"
                                value="{{ old('disability', $screening->disability) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Kebugaran -->
                        <div>
                            <label for="fitness" class="block text-sm font-medium text-gray-700">Kebugaran</label>
                            <select name="fitness" id="fitness"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                                <option value="">Pilih Kebugaran</option>
                                <option value="Kurang" {{ old('fitness') == 'Kurang' ? 'selected' : '' }}>
                                    Kurang
                                </option>
                                <option value="Cukup" {{ old('fitness') == 'Cukup' ? 'selected' : '' }}>
                                    Cukup
                                </option>
                                <option value="Baik" {{ old('fitness') == 'Baik' ? 'selected' : '' }}>
                                    Baik
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Rujukan -->
                    <div class="mt-6">
                        <label for="referral" class="block text-sm font-medium text-gray-700">Rujukan</label>
                        <textarea name="referral" id="referral" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('referral', $screening->referral) }}</textarea>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto calculate LPIMT when weight or height changes
        document.addEventListener('DOMContentLoaded', function() {
            const weightInput = document.getElementById('weight');
            const heightInput = document.getElementById('height');
            const bmiInput = document.getElementById('bmi');

            function calculatebmi() {
                if (weightInput.value && heightInput.value) {
                    const weight = parseFloat(weightInput.value);
                    const height = parseFloat(heightInput.value) / 100;
                    const bmi = weight / (height * height);
                    bmiInput.value = bmi.toFixed(2);
                }
            }

            weightInput.addEventListener('input', calculatebmi);
            heightInput.addEventListener('input', calculatebmi);
        });
    </script>
@endsection
