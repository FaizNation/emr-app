<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Skrining Kesehatan - {{ $school->name }}</title>
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

        .bg-green {
            background-color: #e8f5e9;
        }

        .text-green {
            color: #22c55e;
        }

        .text-red {
            color: #ef4444;
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
        <h2>Laporan Skrining Kesehatan</h2>
        <h3>{{ $school->name }}</h3>
        <p>Tanggal: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th colspan="3" class="group-header">Informasi Siswa</th>
                <th colspan="6" class="group-header">Pertumbuhan</th>
                <th colspan="7" class="group-header">Skrining Indera</th>
                <th colspan="2" class="group-header">Informasi Tambahan</th>
            </tr>
            <tr>
                <th class="bg-gray">No</th>
                <th class="bg-gray">Nama Siswa</th>
                <th class="bg-gray">Kelas</th>
                <th class="bg-blue">BB</th>
                <th class="bg-blue">TB</th>
                <th class="bg-blue">IMT</th>
                <th class="bg-blue">LP</th>
                <th class="bg-blue">Status Gizi</th>
                <th class="bg-blue">Tekanan Darah</th>
                <th class="bg-green">Penglihatan Kanan</th>
                <th class="bg-green">Penglihatan Kiri</th>
                <th class="bg-green">Pendengaran</th>
                <th class="bg-green">Gigi</th>
                <th class="bg-green">Anemia</th>
                <th class="bg-green">Kecacatan</th>
                <th class="bg-green">Kebugaran</th>
                <th class="bg-gray">Rujuk</th>
                <th class="bg-gray">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $key => $screening)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $screening->student->name }}</td>
                    <td>{{ $screening->student->class }}</td>
                    <td>{{ $screening->weight }}</td>
                    <td>{{ $screening->height }}</td>
                    <td>{{ $screening->bmi }}</td>
                    <td>{{ $screening->waist_circumference }}</td>
                    <td>{{ $screening->nutritional_status }}</td>
                    <td>{{ $screening->blood_pressure }}</td>
                    <td>{{ $screening->vision_right }}</td>
                    <td>{{ $screening->vision_left }}</td>
                    <td>{{ $screening->hearing }}</td>
                    <td>{{ $screening->dental }}</td>
                    <td>{{ $screening->hemoglobin }}</td>
                    <td>{{ $screening->disability }}</td>
                    <td>{{ $screening->fitness == 1 ? 'Bugar' : 'Tidak Bugar' }}</td>
                    <td>{{ $screening->referral }}</td>
                    <td>{{ $screening->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
