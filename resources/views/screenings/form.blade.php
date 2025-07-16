@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Skrining Kesehatan</h1>
                <a href="{{ route('students.show', ['school' => $student->school_id, 'student' => $student->id]) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>

            <form action="{{ route('screenings.store', ['student' => $student->id]) }}" method="POST">
                @csrf

                <!-- PERTUMBUHAN -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 text-blue-600 border-b pb-2">PERTUMBUHAN</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-600">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" id="weight"
                                value="{{ old('weight', $screening->weight ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-600">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="height" id="height"
                                value="{{ old('height', $screening->height ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('height')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="waist_circumference" class="block text-sm font-medium text-gray-600">Lingkar Perut
                                (cm)</label>
                            <input type="number" step="0.1" name="waist_circumference" id="waist_circumference"
                                value="{{ old('waist_circumference', $screening->waist_circumference ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('waist_circumference')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="blood_pressure" class="block text-sm font-medium text-gray-600">Tekanan
                                Darah</label>
                            <input type="text" name="blood_pressure" id="blood_pressure" placeholder="120/80"
                                value="{{ old('blood_pressure', $screening->blood_pressure ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('blood_pressure')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SKRINING INDERA -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 text-blue-600 border-b pb-2">SKRINING INDERA</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="vision_right" class="block text-sm font-medium text-gray-600">Penglihatan Mata
                                Kanan</label>
                            <input type="text" name="vision_right" id="vision_right" placeholder="6/6"
                                value="{{ old('vision_right', $screening->vision_right ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('vision_right')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="vision_left" class="block text-sm font-medium text-gray-600">Penglihatan Mata
                                Kiri</label>
                            <input type="text" name="vision_left" id="vision_left" placeholder="6/6"
                                value="{{ old('vision_left', $screening->vision_left ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('vision_left')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hearing" class="block text-sm font-medium text-gray-600">Pendengaran</label>
                            <select name="hearing" id="hearing"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="normal"
                                    {{ old('hearing', $screening->hearing ?? '') == 'normal' ? 'selected' : '' }}>Normal
                                </option>
                                <option value="gangguan ringan"
                                    {{ old('hearing', $screening->hearing ?? '') == 'gangguan ringan' ? 'selected' : '' }}>
                                    Gangguan Ringan</option>
                                <option value="gangguan berat"
                                    {{ old('hearing', $screening->hearing ?? '') == 'gangguan berat' ? 'selected' : '' }}>
                                    Gangguan Berat</option>
                            </select>
                            @error('hearing')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="dental" class="block text-sm font-medium text-gray-600">Kondisi Gigi</label>
                            <input type="text" name="dental" id="dental"
                                value="{{ old('dental', $screening->dental ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('dental')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hemoglobin" class="block text-sm font-medium text-gray-600">Kadar Hemoglobin</label>
                            <input type="number" step="0.1" name="hemoglobin" id="hemoglobin"
                                value="{{ old('hemoglobin', $screening->hemoglobin ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('hemoglobin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="disability" class="block text-sm font-medium text-gray-600">Kecacatan</label>
                            <input type="text" name="disability" id="disability"
                                value="{{ old('disability', $screening->disability ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('disability')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fitness" class="block text-sm font-medium text-gray-600">Status Kebugaran</label>
                            <select name="fitness" id="fitness"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="1" {{ old('fitness', $screening->fitness ?? '') ? 'selected' : '' }}>
                                    Bugar</option>
                                <option value="0"
                                    {{ old('fitness', $screening->fitness ?? '') === false ? 'selected' : '' }}>Tidak Bugar
                                </option>
                            </select>
                            @error('fitness')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="referral" class="block text-sm font-medium text-gray-600">Status Rujukan</label>
                            <select name="referral" id="referral"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="tidak perlu"
                                    {{ old('referral', $screening->referral ?? '') == 'tidak perlu' ? 'selected' : '' }}>
                                    Tidak Perlu</option>
                                <option value="perlu"
                                    {{ old('referral', $screening->referral ?? '') == 'perlu' ? 'selected' : '' }}>Perlu
                                    Dirujuk</option>
                                <option value="sudah"
                                    {{ old('referral', $screening->referral ?? '') == 'sudah' ? 'selected' : '' }}>Sudah
                                    Dirujuk</option>
                            </select>
                            @error('referral')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="history.back()"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto calculate BMI when weight or height changes
            const weightInput = document.getElementById('weight');
            const heightInput = document.getElementById('height');

            function calculateBMI() {
                const weight = parseFloat(weightInput.value);
                const height = parseFloat(heightInput.value);

                if (weight && height) {
                    const heightInMeters = height / 100;
                    const bmi = weight / (heightInMeters * heightInMeters);
                    // You could display this somewhere if needed
                    console.log('BMI:', bmi.toFixed(2));
                }
            }

            weightInput.addEventListener('change', calculateBMI);
            heightInput.addEventListener('change', calculateBMI);
        });
    </script>
@endpush
