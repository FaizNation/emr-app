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
            <div class="flex items-center space-x-2">
                <a style="background-color: rgb(29, 111, 66) !important"  href="{{ route('screenings.export.excel', $school) }}"
                    class="mr-2 text-white px-4 py-2 rounded-md hover:bg-green-600 flex items-center">
                    <i class="mdi mdi-microsoft-excel text-xl mr-2"></i>
                    Export Excel
                </a>
                <a style="background-color: red !important" href="{{ route('screenings.export.pdf', $school) }}"
                    class="mr-2 text-white px-4 py-2 rounded-md hover:bg-red-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6" class="w-5 h-5 mr-2">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('screenings.create', $school) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Skrining
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                        <thead>
                            <tr class="divide-x divide-stone-950">
                                <th class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200"
                                    colspan="3">Informasi Siswa</th>
                                <th class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-b-2 border-gray-200"
                                    colspan="6">Pertumbuhan</th>
                                <th class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-b-2 border-gray-200"
                                    colspan="7">Skrining Indera</th>
                                <th class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200"
                                    colspan="3">Informasi Tambahan</th>
                            </tr>
                            <tr class="divide-x divide-stone-950">

                                <th
                                    class="px-4 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                    No</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                    Nama Siswa</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r-2 border-gray-300">
                                    Kelas</th>

                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    BB</th>
                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    TB</th>
                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    IMT</th>
                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    LP</th>
                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Status Gizi</th>
                                <th
                                    class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Tekanan Darah</th>

                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Penglihatan Kanan</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Penglihatan Kiri</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Pendengaran</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Gigi</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Anemia</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Kecacatan</th>
                                <th
                                    class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Kebugaran</th>

                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rujuk</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Skrining</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-950">
                            @forelse($screenings as $key => $screening)
                                <tr class="divide-x divide-stone-950">

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-gray-50 border-r border-gray-200">
                                        {{ $screenings->firstItem() + $key }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-gray-50 border-r border-gray-200">
                                        {{ $screening->student->name }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-gray-50 border-r-2 border-gray-300">
                                        {{ $screening->student->class }}</td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r border-gray-200">
                                        {{ $screening->weight }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r border-gray-200">
                                        {{ $screening->height }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r border-gray-200">
                                        {{ $screening->bmi }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r border-gray-200">
                                        {{ $screening->waist_circumference }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r border-gray-200">
                                        {{ $screening->nutritional_status }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-blue-50 border-r-2 border-gray-300">
                                        {{ $screening->blood_pressure }}</td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-l border-r border-gray-200">
                                        {{ $screening->vision_right }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r border-gray-200">
                                        {{ $screening->vision_left }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r border-gray-200">
                                        {{ $screening->hearing }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r border-gray-200">
                                        {{ $screening->dental }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r border-gray-200">
                                        {{ $screening->hemoglobin }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r border-gray-200">
                                        {{ $screening->disability }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-green-50 border-r-2 border-gray-300">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $screening->fitness == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $screening->fitness == 1 ? 'Bugar' : 'Tidak Bugar' }}
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-gray-50 border-r border-gray-200">
                                        {{ $screening->referral }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-gray-50 border-r border-gray-200">
                                        {{ $screening->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-l border-gray-200">
                                        <a href="{{ route('screenings.edit', [$school, $screening]) }}"
                                            class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                        <form action="{{ route('screenings.destroy', [$school, $screening]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="19" class="px-6 py-4 text-center text-gray-500">
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
