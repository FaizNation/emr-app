@extends('layouts.main')

@section('title', 'Daftar Siswa - ' . $school->name)

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-900">
            ← Kembali ke Daftar Sekolah
        </a>
    </div>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Daftar Siswa</h1>
            <p class="text-gray-600">{{ $school->name }}</p>
        </div>
        <a href="{{ route('students.create', $school) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Tambah Siswa
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NIK
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Kelamin
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $student->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $student->nik }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $student->class }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('students.show', [$school, $student]) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                                <a href="{{ route('students.edit', [$school, $student]) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                <form action="{{ route('students.destroy', [$school, $student]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data siswa untuk sekolah ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
