@extends('layouts.main')


@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Student</h1>
                <a href="{{ route('students.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>

            <form action="{{ route('students.update', ['school' => $student->school_id, 'student' => $student->id]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4 text-gray-700">Personal Information</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $student->name) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nik" class="block text-sm font-medium text-gray-600">NIK</label>
                                <input type="text" name="nik" id="nik" value="{{ old('nik', $student->nik) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('nik')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-600">Date of
                                    Birth</label>
                                <input type="date" name="birth_date" id="birth_date"
                                    value="{{ old('birth_date', $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') : '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <p class="mt-1 text-sm text-gray-600">
                                    Current:
                                    {{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d M Y') : '-' }}
                                </p>
                                @error('birth_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="birth_place" class="block text-sm font-medium text-gray-600">Tempat
                                    lahir</label>
                                <input type="text" name="birth_place" id="birth_place"
                                    value="{{ old('birth_place', $student->birth_place) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('birth_place')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-600">Gender</label>
                                <select name="gender" id="gender"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4 text-gray-700">Academic Information</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="class" class="block text-sm font-medium text-gray-600">Kelas</label>
                                <input type="text" name="class" id="class"
                                    value="{{ old('class', $student->class) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('class')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Contact Information</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="guardian_name" class="block text-sm font-medium text-gray-600">Nama wali</label>
                            <input type="text" name="guardian_name" id="guardian_name"
                                value="{{ old('guardian_name', $student->guardian_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('guardian_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guardian_nik" class="block text-sm font-medium text-gray-600">NIK wali</label>
                            <input type="text" name="guardian_nik" id="guardian_nik"
                                value="{{ old('guardian_nik', $student->guardian_nik) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('guardian_nik')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-600">Contact
                                Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" onclick="history.back()"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
