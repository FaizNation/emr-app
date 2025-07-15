@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Student Details</h1>
                <a href="{{ route('students.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Personal Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Nama</label>
                            <p class="mt-1 text-gray-900">{{ $student->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">NIK</label>
                            <p class="mt-1 text-gray-900">{{ $student->nik }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tanggal ahir</label>
                            <p class="mt-1 text-gray-900">   {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tempat lahir</label>
                            <p class="mt-1 text-gray-900">{{ $student->birth_place }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Gender</label>
                            <p class="mt-1 text-gray-900">
                                @if (strtolower($student->gender) === 'l')
                                    Laki-laki
                                @elseif(strtolower($student->gender) === 'p')
                                    Perempuan
                                @else
                                    Tidak diketahui
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Academic Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Sekolah</label>
                            <p class="mt-1 text-gray-900">{{ $student->school->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Kelas</label>
                            <p class="mt-1 text-gray-900">{{ $student->class }}</p>
                        </div>
                      
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Contact Information</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Wali</label>
                        <p class="mt-1 text-gray-900">{{ $student->guardian_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">NIK Wali</label>
                        <p class="mt-1 text-gray-900">{{ $student->guardian_nik }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Address</label>
                        <p class="mt-1 text-gray-900">{{ $student->address }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">No Telp</label>
                        <p class="mt-1 text-gray-900">{{ $student->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex space-x-4">
                <a href="{{ route('students.edit', ['school' => $student->school_id, 'student' => $student->id]) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Edit Student
                </a>
                <form
                    action="{{ route('students.destroy', ['school' => $student->school_id, 'student' => $student->id]) }}"
                    method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                        onclick="return confirm('Are you sure you want to delete this student?')">
                        Delete Student
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
