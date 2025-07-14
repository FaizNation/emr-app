@extends('layouts.main')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container mx-auto">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Siswa Baru</h1>
            <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-900">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('students.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" id="nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="birth_place" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="birth_place" id="birth_place" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Sekolah -->
                    <div>
                        <label for="school_id" class="block text-sm font-medium text-gray-700">Sekolah</label>
                        <select name="school_id" id="school_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Sekolah</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="class" id="class" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- Nama Wali -->
                    <div>
                        <label for="guardian_name" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                        <input type="text" name="guardian_name" id="guardian_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- NIK Wali -->
                    <div>
                        <label for="guardian_nik" class="block text-sm font-medium text-gray-700">NIK Wali</label>
                        <input type="text" name="guardian_nik" id="guardian_nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
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
