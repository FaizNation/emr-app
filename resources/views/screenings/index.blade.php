@extends('layouts.main')

@section('title', 'Skrining Kesehatan - ' . $school->name)

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('screenings.index') }}" class="text-gray-600 hover:text-gray-900">
            ← Kembali ke Daftar Sekolah
        </a>
    </div>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Skrining Kesehatan</h1>
            <p class="text-gray-600">{{ $school->name }}</p>
        </div>
        <a href="{{ route('screenings.create', $school) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Tambah Skrining
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Siswa
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Gizi
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tekanan Darah
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Skrining
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($screenings as $screening)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $screening->student->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $screening->student->class }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $screening->nutrition_status }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $screening->blood_pressure }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $screening->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('screenings.show', [$school, $screening]) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                                <a href="{{ route('screenings.edit', [$school, $screening]) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                <form action="{{ route('screenings.destroy', [$school, $screening]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data skrining untuk sekolah ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $screenings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
