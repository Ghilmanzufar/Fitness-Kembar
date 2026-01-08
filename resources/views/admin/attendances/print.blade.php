<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-white text-black p-8 font-sans">

    <div class="text-center border-b-2 border-black pb-4 mb-6">
        <h1 class="text-3xl font-bold uppercase tracking-wider">Majapahit Gym</h1>
        <p class="text-sm text-gray-600">Jl. Raya Majapahit No. 1, Indonesia</p>
        <h2 class="text-xl font-bold mt-4">{{ $title }}</h2>
    </div>

    <div class="mb-6 bg-gray-100 p-4 rounded border border-gray-300">
        <div class="flex justify-between items-center">
            <span class="font-bold">Total Pengunjung:</span>
            <span class="text-2xl font-bold">{{ $attendances->count() }} Orang</span>
        </div>
        <div class="text-xs text-gray-500 mt-1">
            Dicetak pada: {{ date('d M Y H:i') }} oleh Admin
        </div>
    </div>

    <div class="w-full">
        @forelse($groupedData as $date => $dailyAttendances)
            
            <div class="bg-gray-200 px-4 py-2 font-bold text-sm border-l-4 border-black mt-6 mb-2 flex justify-between">
                <span>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</span>
                <span>{{ $dailyAttendances->count() }} Pengunjung</span>
            </div>

            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-400">
                        <th class="py-2 w-20">Jam</th>
                        <th class="py-2">Nama Member</th>
                        <th class="py-2">No. HP</th>
                        <th class="py-2 w-32 text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyAttendances as $absen)
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-600">{{ $absen->created_at->format('H:i') }}</td>
                        <td class="py-2 font-bold">{{ $absen->member->name }}</td>
                        <td class="py-2 text-gray-600">{{ $absen->member->phone }}</td>
                        <td class="py-2 text-right">
                            <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs">Hadir</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        @empty
            <div class="text-center py-10 text-gray-500 italic">
                Tidak ada data kehadiran pada periode ini.
            </div>
        @endforelse
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>