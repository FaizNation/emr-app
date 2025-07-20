@extends('layouts.main')

@section('title', 'Daftar Sekolah')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Sekolah</h1>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <button onclick="filterSchools('all')"
                            class="px-4 py-2 text-sm font-medium rounded-md bg-gray-100 hover:bg-gray-200 filter-button active">
                            Semua
                        </button>
                        <button onclick="filterSchools('SD')"
                            class="px-4 py-2 text-sm font-medium rounded-md bg-blue-100 hover:bg-blue-200 filter-button">
                            SD
                        </button>
                        <button onclick="filterSchools('SMP')"
                            class="px-4 py-2 text-sm font-medium rounded-md bg-green-100 hover:bg-green-200 filter-button">
                            SMP
                        </button>
                        <button onclick="filterSchools('OTHER')"
                            class="px-4 py-2 text-sm font-medium rounded-md bg-purple-100 hover:bg-purple-200 filter-button">
                            Lainnya
                        </button>
                    </div>
                    <div class="relative w-64">
                        <input type="text" id="searchInput" placeholder="Cari sekolah..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pl-10"
                            onkeyup="searchSchools()">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Sekolah
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <button onclick="toggleSort()" class="flex items-center space-x-1 group">
                                        <span>Jumlah Siswa</span>
                                        <span class="sort-icon inline-block transition-transform duration-200">
                                            <svg class="h-4 w-4 text-gray-400 group-hover:text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                            </svg>
                                        </span>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($schools as $school)
                                <tr class="school-row" data-type="{{ $school->type }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $school->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($school->type == 'SD')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                SD
                                            </span>
                                        @elseif($school->type == 'SMP')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                SMP
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
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
        let currentFilter = 'all';
        let currentSort = 'none'; // 'none', 'asc', 'desc'

        function filterSchools(type) {
            currentFilter = type;

            // Update button styles
            document.querySelectorAll('.filter-button').forEach(button => {
                button.classList.remove('active', 'ring-2', 'ring-offset-2');
                if (button.textContent.trim().toUpperCase().includes(type) || (type === 'all' && button.textContent
                        .trim() === 'Semua')) {
                    button.classList.add('active', 'ring-2', 'ring-offset-2');
                }
            });

            // Apply both filter and search
            applyFiltersAndSearch();
        }

        function searchSchools() {
            applyFiltersAndSearch();
        }

        function toggleSort() {
            // Cycle through sort states: none -> asc -> desc -> none
            currentSort = currentSort === 'none' ? 'asc' : currentSort === 'asc' ? 'desc' : 'none';

            // Update sort icon
            const sortIcon = document.querySelector('.sort-icon');
            if (currentSort === 'asc') {
                sortIcon.classList.add('rotate-180');
                sortIcon.classList.remove('rotate-0', 'opacity-0');
            } else if (currentSort === 'desc') {
                sortIcon.classList.remove('rotate-180');
                sortIcon.classList.add('rotate-0');
            } else {
                sortIcon.classList.add('opacity-0');
            }

            applyFiltersAndSearch();
        }

        function applyFiltersAndSearch() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            let rows = Array.from(document.querySelectorAll('.school-row'));
            let hasVisibleRows = false;

            // Filter rows first
            rows.forEach(row => {
                const schoolName = row.querySelector('td:first-child').textContent.toLowerCase();
                const matchesFilter = currentFilter === 'all' || row.dataset.type === currentFilter;
                const matchesSearch = schoolName.includes(searchTerm);

                if (matchesFilter && matchesSearch) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Sort visible rows if sort is active
            if (currentSort !== 'none') {
                const visibleRows = rows.filter(row => row.style.display !== 'none');
                visibleRows.sort((a, b) => {
                    const countA = parseInt(a.querySelector('td:nth-child(3)').textContent.trim());
                    const countB = parseInt(b.querySelector('td:nth-child(3)').textContent.trim());
                    return currentSort === 'asc' ? countA - countB : countB - countA;
                });

                // Reorder rows in the DOM
                const tbody = document.querySelector('tbody');
                visibleRows.forEach(row => tbody.appendChild(row));
            }

            // Show or hide no results message
            const existingNoResults = document.getElementById('noResults');
            if (!hasVisibleRows) {
                if (!existingNoResults) {
                    const noResults = document.createElement('tr');
                    noResults.id = 'noResults';
                    noResults.innerHTML = `
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    <div class="flex flex-col items-center py-4">
                        <svg class="h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Tidak ada sekolah yang ditemukan</p>
                    </div>
                </td>
            `;
                    document.querySelector('tbody').appendChild(noResults);
                }
            } else if (existingNoResults) {
                existingNoResults.remove();
            }
        }

        // Add CSS for active filter buttons
        const style = document.createElement('style');
        style.textContent = `
    .filter-button.active {
        ring-color: currentColor;
        ring-offset-color: white;
    }
    .filter-button.active.bg-gray-100 { @apply ring-gray-400; }
    .filter-button.active.bg-blue-100 { @apply ring-blue-400; }
    .filter-button.active.bg-green-100 { @apply ring-green-400; }
    .filter-button.active.bg-purple-100 { @apply ring-purple-400; }
`;
        document.head.appendChild(style);
    </script>
@endsection
