@extends('layouts.main')

@section('title', 'Tambah Skrining')

@section('content')
<div class="container mx-auto">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Skrining Kesehatan</h1>
            <a href="{{ route('screenings.index') }}" class="text-gray-600 hover:text-gray-900">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('screenings.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Siswa -->
                    <div class="col-span-2">
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Siswa</label>
                        <select name="student_id" id="student_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->school->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- BB & TB -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="weight" id="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" name="height" id="height" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- LPIMT & Status Gizi -->
                    <div>
                        <label for="lpimt" class="block text-sm font-medium text-gray-700">LPIMT</label>
                        <input type="number" step="0.01" name="lpimt" id="lpimt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="nutrition_status" class="block text-sm font-medium text-gray-700">Status Gizi</label>
                        <select name="nutrition_status" id="nutrition_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sangat Kurus">Sangat Kurus</option>
                            <option value="Kurus">Kurus</option>
                            <option value="Normal">Normal</option>
                            <option value="Gemuk">Gemuk</option>
                            <option value="Obesitas">Obesitas</option>
                        </select>
                    </div>

                    <!-- Tekanan Darah -->
                    <div>
                        <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" id="blood_pressure" placeholder="120/80" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Penglihatan -->
                    <div>
                        <label for="vision_right" class="block text-sm font-medium text-gray-700">Mata Kanan</label>
                        <input type="text" name="vision_right" id="vision_right" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="vision_left" class="block text-sm font-medium text-gray-700">Mata Kiri</label>
                        <input type="text" name="vision_left" id="vision_left" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Pendengaran -->
                    <div>
                        <label for="hearing" class="block text-sm font-medium text-gray-700">Pendengaran</label>
                        <select name="hearing" id="hearing" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Normal">Normal</option>
                            <option value="Gangguan Ringan">Gangguan Ringan</option>
                            <option value="Gangguan Sedang">Gangguan Sedang</option>
                            <option value="Gangguan Berat">Gangguan Berat</option>
                        </select>
                    </div>

                    <!-- Gigi -->
                    <div>
                        <label for="dental" class="block text-sm font-medium text-gray-700">Skrining Gigi</label>
                        <select name="dental" id="dental" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sehat">Sehat</option>
                            <option value="Karies Ringan">Karies Ringan</option>
                            <option value="Karies Sedang">Karies Sedang</option>
                            <option value="Karies Berat">Karies Berat</option>
                        </select>
                    </div>

                    <!-- Anemia -->
                    <div>
                        <label for="anemia" class="block text-sm font-medium text-gray-700">Skrining Anemia</label>
                        <select name="anemia" id="anemia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Normal">Normal</option>
                            <option value="Anemia Ringan">Anemia Ringan</option>
                            <option value="Anemia Sedang">Anemia Sedang</option>
                            <option value="Anemia Berat">Anemia Berat</option>
                        </select>
                    </div>

                    <!-- Kecacatan -->
                    <div>
                        <label for="disability" class="block text-sm font-medium text-gray-700">Kecacatan</label>
                        <input type="text" name="disability" id="disability" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Kebugaran -->
                    <div>
                        <label for="fitness" class="block text-sm font-medium text-gray-700">Kebugaran</label>
                        <select name="fitness" id="fitness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>

                <!-- Rujukan -->
                <div class="mt-6">
                    <label for="referral" class="block text-sm font-medium text-gray-700">Rujukan</label>
                    <textarea name="referral" id="referral" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Simpan Data Skrining
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
        }
    }

    weightInput.addEventListener('input', calculateLPIMT);
    heightInput.addEventListener('input', calculateLPIMT);
});
</script>
@endsection
