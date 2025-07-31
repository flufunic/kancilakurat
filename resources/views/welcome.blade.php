<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KANCIL AKURAT</title>
    <link rel="shortcut icon" href="{{ asset('/storage/image/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            position: relative;
            padding: 0;
        }

        .header img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            opacity: 0.4;
        }

        .header h1 {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.5rem;
            font-weight: bold;
            z-index: 2;
        }

        .login-button {
            position: absolute;
            right: 20px;
            top: 20px;
            background: #fff;
            color: #2c5364;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            z-index: 2;
        }

        .menu {
            background: #ffffff;
            text-align: center;
            padding: 15px 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .menu button {
            background: #2c5364;
            color: #fff;
            border: none;
            padding: 10px 18px;
            margin: 5px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .menu button:hover {
            background: #1b2e3d;
        }

        main {
            flex: 1;
        }

        table {
            width: 90%;
            margin: 20px auto;
            background: white;
            border-collapse: collapse;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        table.visible {
            display: table;
            opacity: 1;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2c5364;
            color: white;
        }

        caption {
            font-size: 1.4rem;
            margin: 15px 0;
            color: #2c5364;
            font-weight: bold;
        }

        .struktur-img {
            width: 90%;
            margin: 30px auto;
            display: none;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .struktur-img.visible {
            display: flex;
        }

        .struktur-img img {
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            border: 2px solid #ccc;
        }

        .dipa-list {
            width: 90%;
            margin: 30px auto;
            display: none;
        }

        .dipa-list.visible {
            display: block;
        }

        .dipa-list li {
            margin-bottom: 10px;
        }

        .dipa-list a {
            color: #2c5364;
            font-weight: bold;
        }

        footer {
            background: #2c5364;
            padding: 15px;
            text-align: center;
            color: #fff;
            font-size: 0.9em;
        }
        .headline {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            font-weight: bold;
            z-index: 2;
            color: white;
            text-align: center;
            white-space: nowrap;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .link-as-text {
            color: inherit;
            text-decoration: none;
        }


    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('/storage/imigrasi.jpg') }}" alt="Header Background">
        <div class="headline">
            <br>
            <br>
            <span>Kantor Imigrasi Kelas I TPI Cilacap</span> 
            <br>
            <span>KANCIL AKURAT</span>
        </div>

        @if(Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="login-button">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="login-button">Login</a>
            @endauth
        @endif
    </div>

    <div class="menu">
         <button onclick="showSection('dipa')">DIPA</button>
        <button onclick="showSection('realisasi')">Realisasi</button>
        <button onclick="showSection('rencana')">Rencana</button>
       
    </div>

    <main>
        <table id="realisasi">
            <caption>Data Realisasi</caption>
            <thead>
                <tr>
                    <th>Seksi/Bagian</th>
                    <th>Sisa Anggaran</th>
                    <th>Link Dokumen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($realisasi as $item)
                    <tr>
                        <td>{{ $item->nama_seksi }}</td>
                        <td>{{ "Rp " . number_format($item->sisa_anggaran, 2, ',', '.') }}</td>
                        <td><a href="{{ $item->link_spreadsheet }}" target="_blank">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <table id="rencana">
            <caption>Data Rencana</caption>
            
            <thead>
                <tr>
                    <th>Seksi/Bagian</th>
                    <th>Penarikan Dana Presisi</th>
                    <th>Minggu 1</th>
                    <th>Minggu 2</th>
                    <th>Minggu 3</th>
                    <th>Minggu 4</th>
                    <th>Saldo</th>
                    <th>
                       <a href="{{ route('kancil.index', ['sort' => request('sort') === 'asc' ? 'desc' : 'asc']) }}" style="color: inherit; text-decoration: none;">
                            Bulan
                            @if(request('sort') === 'asc')
                                ↑
                            @elseif(request('sort') === 'desc')
                                ↓
                            @endif
                        </a>

                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rencana as $item)
                    <tr>
                        <td>{{ $item->nama_seksi }}</td>
                        <td>Rp{{ number_format($item->saldo_tahunan, 0, ',', '.') }}</td>
                        <td>{{ "Rp " . number_format($item->minggu_1, 2, ',', '.') }}</td>
                        <td>{{ "Rp " . number_format($item->minggu_2, 2, ',', '.') }}</td>
                        <td>{{ "Rp " . number_format($item->minggu_3, 2, ',', '.') }}</td>
                        <td>{{ "Rp " . number_format($item->minggu_4, 2, ',', '.') }}</td>
                        <td>{{ $item->sisa_saldo_bulan }}</td>
                        <td>{{ $item->bulan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div id="dipa" class="dipa-list">
            <h2>Data DIPA</h2>
            <ul>
                @foreach($dipa as $item)
                    <li>{{ $item->nama }} – <a href="{{ secure_asset('storage/dipas/' . $item->file_pdf) }}" target="_blank">Lihat PDF</a></li>
                @endforeach
            </ul>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} KANCIL AKURAT. All rights reserved.
    </footer>

    <script>
        const sections = ['realisasi', 'rencana', 'dipa'];

        function showSection(id) {
            sections.forEach(section => {
                const el = document.getElementById(section);
                if (!el) return;

                if (section === id) {
                    el.classList.add('visible');
                } else {
                    el.classList.remove('visible');
                }
            });
        }

        showSection('realisasi');
    </script>

</body>
</html>
