@extends('layouts.main')

@section('title', 'Data Lengkap Siswa')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Laporan Data Lengkap Siswa</h1>
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex items-center gap-4 flex-wrap lg:flex-nowrap">
                    <!-- Search Input -->
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" id="search" name="search" placeholder="Cari nama siswa atau sekolah..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10">
                    </div>

                    <!-- Academic Year Filter -->
                    <div class="w-44">
                        <select id="academic_year" name="academic_year"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10">
                            @foreach ($academicYears as $year => $academicYear)
                                <option value="{{ $year }}" @selected($year == $currentAcademicYear)>
                                    TA {{ $academicYear }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- School Type Filter -->
                    <div class="w-44">
                        <select id="school_type" name="school_type"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10">
                            <option value="">Semua Sekolah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="OTHER">OTHER</option>
                        </select>
                    </div>

                    <!-- Screening Status Filter -->
                    <div class="w-44">
                        <select id="screening_status" name="screening_status"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10">
                            <option value="">Status Skrining</option>
                            <option value="1">Sudah Skrining</option>
                            <option value="0">Belum Skrining</option>
                        </select>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="w-56">
                        <select id="sort_by" name="sort_by"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-10">
                            <optgroup label="Urutan Umum">
                                <option value="name_asc">Nama (A-Z)</option>
                                <option value="name_desc">Nama (Z-A)</option>
                                <option value="school_asc">Sekolah (A-Z)</option>
                                <option value="school_desc">Sekolah (Z-A)</option>
                            </optgroup>
                            <optgroup label="Filter Berdasarkan Sekolah">
                                @foreach ($schools->groupBy('type') as $type => $schoolGroup)
                            <optgroup label="{{ $type }}">
                                @foreach ($schoolGroup as $school)
                                    <option value="school_id_{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <!-- Export Button -->
                    <a id="export-excel" style="background-color: rgb(29, 111, 66) !important"
                        href="{{ route('comprehensive.export.excel') }}"
                        class="mr-2 text-white px-4 py-2 rounded-md hover:bg-green-600 flex items-center cursor-pointer">
                        <i class="mdi mdi-microsoft-excel text-xl mr-2"></i>
                        Export Excel
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="divide-x divide-stone-950">
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200"
                                colspan="12">Informasi Siswa</th>
                            <th class="px-6 py-3 bg-blue-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-b-2 border-gray-200"
                                colspan="6">Pertumbuhan</th>
                            <th class="px-6 py-3 bg-green-100 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-b-2 border-gray-200"
                                colspan="7">Skrining Indera</th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200"
                                colspan="3">Informasi Tambahan</th>
                        </tr>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                No</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Nama</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                NIK</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Kelas</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Jenis Kelamin</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Tanggal Lahir</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Tempat Lahir</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Nama Wali</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                NIK Wali</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                No HP</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Alamat</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200">
                                Sekolah</th>
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
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rujuk</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Skrining</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="students-table">
                        @include('comprehensive.table')
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let typingTimer;
            const searchInput = document.getElementById('search');
            const schoolTypeSelect = document.getElementById('school_type');
            const screeningStatusSelect = document.getElementById('screening_status');

            function performSearch() {
                const searchValue = searchInput.value;
                const schoolType = schoolTypeSelect.value;
                const screeningStatus = screeningStatusSelect.value;
                const sortBy = document.getElementById('sort_by').value;
                const academicYear = document.getElementById('academic_year').value;

                fetch(`{{ route('comprehensive.search') }}?search=${searchValue}&school_type=${schoolType}&screening_status=${screeningStatus}&sort=${sortBy}&academic_year=${academicYear}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('students-table').innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            const debouncedSearch = (function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performSearch, 300);
            });

            searchInput.addEventListener('input', debouncedSearch);
            searchInput.addEventListener('keydown', () => clearTimeout(typingTimer));
            schoolTypeSelect.addEventListener('change', performSearch);
            screeningStatusSelect.addEventListener('change', performSearch);
            document.getElementById('sort_by').addEventListener('change', performSearch);
            document.getElementById('academic_year').addEventListener('change', performSearch);

            // Update export link with current parameters
            function updateExportLink() {
                const searchValue = searchInput.value;
                const schoolType = schoolTypeSelect.value;
                const screeningStatus = screeningStatusSelect.value;
                const sortBy = document.getElementById('sort_by').value;
                const academicYear = document.getElementById('academic_year').value;

                const exportLink = document.getElementById('export-excel');
                const baseUrl = "{{ route('comprehensive.export.excel') }}";
                const params = new URLSearchParams();

                if (searchValue) params.append('search', searchValue);
                if (schoolType) params.append('school_type', schoolType);
                if (screeningStatus) params.append('screening_status', screeningStatus);
                if (sortBy) params.append('sort', sortBy);
                if (academicYear) params.append('academic_year', academicYear);

                exportLink.href = `${baseUrl}?${params.toString()}`;
            }

            // Update export link when any filter changes
            searchInput.addEventListener('input', updateExportLink);
            schoolTypeSelect.addEventListener('change', updateExportLink);
            screeningStatusSelect.addEventListener('change', updateExportLink);
            document.getElementById('sort_by').addEventListener('change', updateExportLink);
            document.getElementById('academic_year').addEventListener('change', updateExportLink);
        });
    </script>
@endsection
