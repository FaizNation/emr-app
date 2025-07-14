@extends('layouts.main')

@section('title', 'Tambah Siswa - ' . $school->name)

@section('content')
<div class="container mx-auto">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('students.school', $school) }}" class="text-gray-600 hover:text-gray-900">
                ← Kembali ke Daftar Siswa
            </a>
        </div>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Tambah Siswa Baru</h1>
                <p class="text-gray-600">{{ $school->name }}</p>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('students.store', $school) }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" pattern="[0-9]{16}" title="NIK harus 16 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="birth_place" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="birth_place" id="birth_place" value="{{ old('birth_place') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="class" id="class" value="{{ old('class') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Alamat -->
                    <div class="col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('address') }}</textarea>
                    </div>

                    <!-- Nama Wali -->
                    <div>
                        <label for="guardian_name" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                        <input type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- NIK Wali -->
                    <div>
                        <label for="guardian_nik" class="block text-sm font-medium text-gray-700">NIK Wali</label>
                        <input type="text" name="guardian_nik" id="guardian_nik" value="{{ old('guardian_nik') }}" pattern="[0-9]{16}" title="NIK harus 16 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="class" id="class" value="{{ old('class') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Nama Wali -->
                    <div>
                        <label for="guardian_name" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                        <input type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- NIK Wali -->
                    <div>
                        <label for="guardian_nik" class="block text-sm font-medium text-gray-700">NIK Wali</label>
                        <input type="text" name="guardian_nik" id="guardian_nik" value="{{ old('guardian_nik') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('address') }}</textarea>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Simpan Data Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
