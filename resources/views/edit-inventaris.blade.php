
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventaris Laboratorium</title>
</head>
<body>
    <h1>Edit Inventaris Laboratorium</h1>

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

    <form action="{{ url('/inventaris/' . $barang['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="kode_barang">Kode Barang:</label><br>
            <input
                type="text"
                id="kode_barang"
                name="kode_barang"
                maxlength="10"
                value="{{ old('kode_barang', $barang['kode_barang']) }}"
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
                value="{{ old('nama_barang', $barang['nama_barang']) }}"
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
                value="{{ old('nomor_aset', $barang['nomor_aset']) }}"
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
                value="{{ old('tahun_perolehan', $barang['tahun_perolehan']) }}"
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
                        @selected(old('ruang_id', $barang['ruang_id']) == $ruang['id'])
                    >
                        {{ $ruang['nama_ruang'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('inventaris.index') }}">Kembali</a>
    </form>
</body>
</html>
