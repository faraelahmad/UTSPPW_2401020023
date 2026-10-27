
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Laboratorium</title>
</head>
<body>
    <h1>Sistem Inventaris Laboratorium</h1>

    @if (session('berhasil'))
        <p>{{ session('berhasil') }}</p>
    @endif

    @if (session('gagal'))
        <p>{{ session('gagal') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <h3>Terjadi kesalahan:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <hr>

    <h2>Tambah Inventaris</h2>

    <form action="{{ route('inventaris.store') }}" method="POST">
        @csrf

        <p>
            <label for="kode_barang">Kode Barang:</label><br>
            <input
                type="text"
                id="kode_barang"
                name="kode_barang"
                maxlength="10"
                value="{{ old('kode_barang') }}"
                required
            >
        </p>

        <p>
            <label for="nama_barang">Nama Barang:</label><br>
            <input
                type="text"
                id="nama_barang"
                name="nama_barang"
                minlength="3"
                maxlength="100"
                value="{{ old('nama_barang') }}"
                required
            >
        </p>

        <p>
            <label for="nomor_aset">Nomor Aset:</label><br>
            <input
                type="text"
                id="nomor_aset"
                name="nomor_aset"
                minlength="5"
                maxlength="30"
                value="{{ old('nomor_aset') }}"
                required
            >
        </p>

        <p>
            <label for="tahun_perolehan">Tahun Perolehan:</label><br>
            <input
                type="number"
                id="tahun_perolehan"
                name="tahun_perolehan"
                min="2000"
                max="2026"
                value="{{ old('tahun_perolehan') }}"
                required
            >
        </p>

        <p>
            <label for="ruang_id">Ruang:</label><br>
            <select id="ruang_id" name="ruang_id" required>
                <option value="">-- Pilih Ruang --</option>

                @foreach ($daftarRuang as $ruang)
                    <option
                        value="{{ $ruang['id'] }}"
                        @selected(old('ruang_id') == $ruang['id'])
                    >
                        {{ $ruang['nama_ruang'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Simpan Inventaris</button>
    </form>

    <hr>

    <h2>Cari dan Filter Inventaris</h2>

    <form action="{{ route('inventaris.index') }}" method="GET">
        <p>
            <label for="cari">Kata Kunci:</label><br>
            <input
                type="text"
                id="cari"
                name="cari"
                value="{{ $kataKunci }}"
                placeholder="Kode, nama, atau nomor aset"
            >
        </p>

        <p>
            <label for="filter_ruang">Filter Ruang:</label><br>
            <select id="filter_ruang" name="ruang_id">
                <option value="">Semua Ruang</option>

                @foreach ($daftarRuang as $ruang)
                    <option
                        value="{{ $ruang['id'] }}"
                        @selected((string) $filterRuang === (string) $ruang['id'])
                    >
                        {{ $ruang['nama_ruang'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Cari</button>
        <a href="{{ route('inventaris.index') }}">Reset</a>
    </form>

    <hr>

    <h2>Daftar Inventaris</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Nomor Aset</th>
                <th>Tahun Perolehan</th>
                <th>Status Usia Aset</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($daftarInventaris as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barang['kode_barang'] }}</td>
                    <td>{{ $barang['nama_barang'] }}</td>
                    <td>{{ $barang['nomor_aset'] }}</td>
                    <td>{{ $barang['tahun_perolehan'] }}</td>

                    <td>
                        @if ($barang['tahun_perolehan'] >= 2023)
                            Baru
                        @else
                            Lama
                        @endif
                    </td>

                    <td>{{ $barang['nama_ruang'] }}</td>

                    <td>
                        <a href="{{ url('/inventaris/' . $barang['id'] . '/edit') }}">
                            Edit
                        </a>

                        <form
                            action="{{ url('/inventaris/' . $barang['id']) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data inventaris.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
