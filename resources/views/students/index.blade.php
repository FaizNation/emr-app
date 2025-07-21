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
            <div class="flex items-center space-x-4">
                <a style="background-color: rgb(29, 111, 66) !important"
                    href="{{ route('students.export.excel', ['school' => $school, 'academic_year' => request('academic_year', $currentAcademicYear)]) }}"
                    class="mr-2 text-white px-4 py-2 rounded-md hover:bg-green-600 flex items-center">
                    <i class="mdi mdi-microsoft-excel text-xl mr-2"></i>
                    Export Excel
                </a>
                <a style="background-color: red !important"
                    href="{{ route('students.export.pdf', ['school' => $school, 'academic_year' => request('academic_year', $currentAcademicYear)]) }}"
                    class="mr-2 text-white px-4 py-2 rounded-md hover:bg-red-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" className="size-6" class="w-5 h-5 mr-2">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('students.create', $school) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Tambah Siswa
                </a>

            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <!-- Search Form -->
                <div class="mb-6">
                    <form action="{{ route('students.school', $school) }}" method="GET" class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari berdasarkan nama siswa, NIK, atau kelas..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="w-44">
                            <select name="academic_year"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($academicYears as $year => $label)
                                    <option value="{{ $year }}" @selected($year == $currentAcademicYear)>
                                        TA {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Cari
                        </button>
                        @if (request('search') || request('academic_year'))
                            <a href="{{ route('students.school', $school) }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="divide-x divide-stone-950 ">
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Nama
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    NIK
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Kelas
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Jenis Kelamin
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Tanggal Lahir
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Tempat Lahir
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Nama Wali
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Nik Wali
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    No HP
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"">
                                    Alamat
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                      @forelse($students as $key => $student)
                            <tr class="divide-x divide-gray-900">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-l border-r border-gray-200"">
                                    {{ $students->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-200"">
                                    {{ $student->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->nik }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->class }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->birth_place }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->guardian_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->guardian_nik }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200"">
                                    {{ $student->address }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-r border-gray-200"">
                                    <a href="{{ route('students.edit', [$school, $student]) }}"
                                        class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                    <form action="{{ route('students.destroy', [$school, $student]) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                                </>
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
                    {{ $students->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
