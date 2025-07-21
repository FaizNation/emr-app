@forelse($students as $student)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 text-sm text-gray-500 border-l border-r border-gray-200">
            {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->nik }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->class }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->gender }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">
            {{ $student->birth_date ? $student->birth_date->format('d/m/Y') : '-' }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->birth_place }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->guardian_name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->guardian_nik }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->phone }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->address }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->school->name }}</td>
        @if ($student->screening)
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->weight }} kg</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->height }} cm</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->bmi }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->waist_circumference }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->nutritional_status }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->blood_pressure }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->vision_right }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->vision_left }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->hearing }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->dental }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->hemoglobin }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">{{ $student->screening->disability }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $student->screening->fitness == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $student->screening->fitness == 1 ? 'Bugar' : 'Tidak Bugar' }}
                </span></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">
                {{ $student->screening->referral }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">
                {{ $student->screening->created_at->format('d/m/Y') }}</td>
        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-200">
                <span
                    class="px-2 py-1 text-xs rounded-full font-medium {{ $student->screening->is_referred ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    {{ $student->screening->is_referred ? 'Ya' : 'Tidak' }}
                </span>
            </td> --}}

        @else
            <td colspan="15" class="px-6 py-4 text-sm text-center text-gray-500">
                Belum ada data skrining
            </td>
        @endif
    </tr>
@empty
    <tr>
        <td colspan="27" class="px-6 py-4 text-center text-gray-500">
            Tidak ada data yang ditemukan
        </td>
    </tr>
@endforelse
