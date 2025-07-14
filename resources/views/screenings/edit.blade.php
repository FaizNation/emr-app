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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- BB & TB -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="weight" id="weight" value="{{ old('weight', $screening->weight) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" name="height" id="height" value="{{ old('height', $screening->height) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- LPIMT & Status Gizi -->
                    <div>
                        <label for="lpimt" class="block text-sm font-medium text-gray-700">LPIMT</label>
                        <input type="number" step="0.01" name="lpimt" id="lpimt" value="{{ old('lpimt', $screening->lpimt) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required readonly>
                    </div>

                    <div>
                        <label for="nutrition_status" class="block text-sm font-medium text-gray-700">Status Gizi</label>
                        <select name="nutrition_status" id="nutrition_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sangat Kurus" {{ old('nutrition_status', $screening->nutrition_status) == 'Sangat Kurus' ? 'selected' : '' }}>Sangat Kurus</option>
                            <option value="Kurus" {{ old('nutrition_status', $screening->nutrition_status) == 'Kurus' ? 'selected' : '' }}>Kurus</option>
                            <option value="Normal" {{ old('nutrition_status', $screening->nutrition_status) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Gemuk" {{ old('nutrition_status', $screening->nutrition_status) == 'Gemuk' ? 'selected' : '' }}>Gemuk</option>
                            <option value="Obesitas" {{ old('nutrition_status', $screening->nutrition_status) == 'Obesitas' ? 'selected' : '' }}>Obesitas</option>
                        </select>
                    </div>

                    <!-- Tekanan Darah -->
                    <div>
                        <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" id="blood_pressure" value="{{ old('blood_pressure', $screening->blood_pressure) }}" placeholder="120/80" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Penglihatan -->
                    <div>
                        <label for="vision_right" class="block text-sm font-medium text-gray-700">Mata Kanan</label>
                        <input type="text" name="vision_right" id="vision_right" value="{{ old('vision_right', $screening->vision_right) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="vision_left" class="block text-sm font-medium text-gray-700">Mata Kiri</label>
                        <input type="text" name="vision_left" id="vision_left" value="{{ old('vision_left', $screening->vision_left) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Pendengaran -->
                    <div>
                        <label for="hearing" class="block text-sm font-medium text-gray-700">Pendengaran</label>
                        <select name="hearing" id="hearing" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Normal" {{ old('hearing', $screening->hearing) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Gangguan Ringan" {{ old('hearing', $screening->hearing) == 'Gangguan Ringan' ? 'selected' : '' }}>Gangguan Ringan</option>
                            <option value="Gangguan Sedang" {{ old('hearing', $screening->hearing) == 'Gangguan Sedang' ? 'selected' : '' }}>Gangguan Sedang</option>
                            <option value="Gangguan Berat" {{ old('hearing', $screening->hearing) == 'Gangguan Berat' ? 'selected' : '' }}>Gangguan Berat</option>
                        </select>
                    </div>

                    <!-- Gigi -->
                    <div>
                        <label for="dental" class="block text-sm font-medium text-gray-700">Skrining Gigi</label>
                        <select name="dental" id="dental" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sehat" {{ old('dental', $screening->dental) == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="Karies Ringan" {{ old('dental', $screening->dental) == 'Karies Ringan' ? 'selected' : '' }}>Karies Ringan</option>
                            <option value="Karies Sedang" {{ old('dental', $screening->dental) == 'Karies Sedang' ? 'selected' : '' }}>Karies Sedang</option>
                            <option value="Karies Berat" {{ old('dental', $screening->dental) == 'Karies Berat' ? 'selected' : '' }}>Karies Berat</option>
                        </select>
                    </div>

                    <!-- Anemia -->
                    <div>
                        <label for="anemia" class="block text-sm font-medium text-gray-700">Skrining Anemia</label>
                        <select name="anemia" id="anemia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Normal" {{ old('anemia', $screening->anemia) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Anemia Ringan" {{ old('anemia', $screening->anemia) == 'Anemia Ringan' ? 'selected' : '' }}>Anemia Ringan</option>
                            <option value="Anemia Sedang" {{ old('anemia', $screening->anemia) == 'Anemia Sedang' ? 'selected' : '' }}>Anemia Sedang</option>
                            <option value="Anemia Berat" {{ old('anemia', $screening->anemia) == 'Anemia Berat' ? 'selected' : '' }}>Anemia Berat</option>
                        </select>
                    </div>

                    <!-- Kecacatan -->
                    <div>
                        <label for="disability" class="block text-sm font-medium text-gray-700">Kecacatan</label>
                        <input type="text" name="disability" id="disability" value="{{ old('disability', $screening->disability) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Kebugaran -->
                    <div>
                        <label for="fitness" class="block text-sm font-medium text-gray-700">Kebugaran</label>
                        <select name="fitness" id="fitness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sangat Baik" {{ old('fitness', $screening->fitness) == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="Baik" {{ old('fitness', $screening->fitness) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Cukup" {{ old('fitness', $screening->fitness) == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                            <option value="Kurang" {{ old('fitness', $screening->fitness) == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                        </select>
                    </div>
                </div>

                <!-- Rujukan -->
                <div class="mt-6">
                    <label for="referral" class="block text-sm font-medium text-gray-700">Rujukan</label>
                    <textarea name="referral" id="referral" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('referral', $screening->referral) }}</textarea>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
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
    const lpimtInput = document.getElementById('lpimt');

    function calculateLPIMT() {
        if (weightInput.value && heightInput.value) {
            const weight = parseFloat(weightInput.value);
            const height = parseFloat(heightInput.value) / 100; // convert to meters
            const lpimt = weight / (height * height);
            lpimtInput.value = lpimt.toFixed(2);

            // Auto-select nutrition status based on LPIMT
            const nutritionStatus = document.getElementById('nutrition_status');
            if (lpimt < 17) {
                nutritionStatus.value = 'Sangat Kurus';
            } else if (lpimt < 18.5) {
                nutritionStatus.value = 'Kurus';
            } else if (lpimt < 25) {
                nutritionStatus.value = 'Normal';
            } else if (lpimt < 30) {
                nutritionStatus.value = 'Gemuk';
            } else {
                nutritionStatus.value = 'Obesitas';
            }
        }
    }

    weightInput.addEventListener('input', calculateLPIMT);
    heightInput.addEventListener('input', calculateLPIMT);
});
</script>
@endsection
