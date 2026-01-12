<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Member Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@media print { body { -webkit-print-color-adjust: exact; } }</style>
</head>
<body class="bg-white text-black p-8 font-sans">

    <div class="text-center border-b-2 border-black pb-4 mb-6">
        <h1 class="text-3xl font-bold uppercase tracking-wider">Majapahit Gym</h1>
        <p class="text-sm text-gray-600">Laporan Registrasi Member Baru</p>
        <h2 class="text-xl font-bold mt-2">Periode: Bulan {{ $month }} / {{ $year }}</h2>
    </div>

    <div class="mb-6 border border-gray-300 p-4 rounded bg-gray-50">
        <span class="font-bold">Total Pendaftar Baru:</span> {{ $members->count() }} Orang
    </div>

    <table class="w-full text-left border-collapse text-sm">
        <thead>
            <tr class="bg-gray-200 border-b border-gray-400">
                <th class="py-2 px-2 w-10 text-center">No</th>
                <th class="py-2 px-2">Tanggal Join</th>
                <th class="py-2 px-2">Nama Lengkap</th>
                <th class="py-2 px-2">No. WhatsApp</th>
                <th class="py-2 px-2">Berlaku Sampai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $m)
            <tr class="border-b border-gray-200">
                <td class="py-2 px-2 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-2">{{ $m->join_date->format('d/m/Y') }}</td>
                <td class="py-2 px-2 font-bold">{{ $m->name }}</td>
                <td class="py-2 px-2">{{ $m->phone }}</td>
                <td class="py-2 px-2">{{ $m->expiry_date->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-16 flex justify-end">
        <div class="text-center w-48">
            <p class="mb-16">Bekasi, {{ date('d M Y') }}</p>
            <p class="font-bold border-t border-black pt-2">Admin Gym</p>
        </div>
    </div>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>