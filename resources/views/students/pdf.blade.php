<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Siswa - {{ $school->name }}</title>
    <style>
        @page {
            margin: 0.5cm 0.5cm;
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 0.5cm;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: center;
            font-size: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f8f9fa;
        }

        .group-header {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .bg-gray {
            background-color: #f8f9fa;
        }

        .bg-blue {
            background-color: #e3f2fd;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Data Siswa</h2>
        <h3>{{ $school->name }}</h3>
        <p>Tanggal: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="bg-gray">No</th>
                <th class="bg-blue">Nama</th>
                <th class="bg-blue">NIK</th>
                <th class="bg-blue">Kelas</th>
                <th class="bg-blue">Jenis Kelamin</th>
                <th class="bg-blue">Tanggal Lahir</th>
                <th class="bg-blue">Tempat Lahir</th>
                <th class="bg-gray">Nama Wali</th>
                <th class="bg-gray">NIK Wali</th>
                <th class="bg-gray">No HP</th>
                <th class="bg-gray">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $key => $student)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td class="text-left">{{ $student->name }}</td>
                    <td>{{ $student->nik }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                    <td class="text-left">{{ $student->birth_place }}</td>
                    <td class="text-left">{{ $student->guardian_name }}</td>
                    <td>{{ $student->guardian_nik }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
