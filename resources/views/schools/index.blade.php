@extends('layouts.main')

@section('title', 'Daftar Sekolah')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Sekolah</h1>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex gap-4 mb-6">
                <button onclick="filterSchools('all')" class="px-4 py-2 text-sm font-medium rounded-md bg-gray-100 hover:bg-gray-200">
                    Semua
                </button>
                <button onclick="filterSchools('SD')" class="px-4 py-2 text-sm font-medium rounded-md bg-blue-100 hover:bg-blue-200">
                    SD
                </button>
                <button onclick="filterSchools('SMP')" class="px-4 py-2 text-sm font-medium rounded-md bg-green-100 hover:bg-green-200">
                    SMP
                </button>
                <button onclick="filterSchools('OTHER')" class="px-4 py-2 text-sm font-medium rounded-md bg-purple-100 hover:bg-purple-200">
                    Lainnya
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Sekolah
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Siswa
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($schools as $school)
                        <tr class="school-row" data-type="{{ $school->type }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $school->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($school->type == 'SD')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        SD
                                    </span>
                                @elseif($school->type == 'SMP')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        SMP
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Lainnya
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $school->students_count }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function filterSchools(type) {
    const rows = document.querySelectorAll('.school-row');
    rows.forEach(row => {
        if (type === 'all' || row.dataset.type === type) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endsection
