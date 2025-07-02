<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penilaian Penerima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdfcfc;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }
        h1 {
            color: #b30000;
            font-weight: 700;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: none;
        }
        .btn-primary {
            background-color: #b30000;
            border: none;
        }
        .btn-primary:hover {
            background-color: #990000;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        label {
            font-weight: 600;
            color: #b30000;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #b30000;
            box-shadow: 0 0 0 0.2rem rgba(179, 0, 0, 0.25);
        }
        .form-control:hover, .form-select:hover {
            border-color: #b30000;
        }
        .form-icon {
            color: #b30000;
            margin-right: 8px;
        }
        .icon-label {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .icon-circle {
            background-color: #f8d7da;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon-colored {
            font-size: 1rem;
            color: #b30000;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="icon-label">
                <span class="icon-circle"><i class="fa-solid fa-clipboard-check icon-colored"></i></span>
                Tambah Penilaian untuk {{ $penerima->nama }}
            </h1>
            <a href="{{ route('penerima.show', $penerima) }}" class="btn btn-secondary">
                <span class="icon-label">
                    <span class="icon-circle bg-light"><i class="fa-solid fa-arrow-left icon-colored"></i></span>
                    <span class="d-none d-md-inline">Kembali</span>
                </span>
            </a>
        </div>

        <div class="card p-4">
            <form action="{{ route('assessment.store', $penerima) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pendapatan_bulanan" class="form-label">
                        <i class="fa-solid fa-money-bill-wave form-icon"></i> Pendapatan Bulanan (Rp)
                    </label>
                    <input type="number" class="form-control" id="pendapatan_bulanan" name="pendapatan_bulanan" value="{{ old('pendapatan_bulanan') }}" required>
                    @error('pendapatan_bulanan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_tanggungan" class="form-label">
                        <i class="fa-solid fa-users form-icon"></i> Jumlah Tanggungan
                    </label>
                    <input type="number" class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan" value="{{ old('jumlah_tanggungan') }}" required>
                    @error('jumlah_tanggungan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi_rumah" class="form-label">
                        <i class="fa-solid fa-home form-icon"></i> Kondisi Rumah
                    </label>
                    <select class="form-select" id="kondisi_rumah" name="kondisi_rumah" required>
                        <option value="" {{ old('kondisi_rumah') == '' ? 'selected' : '' }}>Pilih</option>
                        <option value="Layak Huni" {{ old('kondisi_rumah') == 'Layak Huni' ? 'selected' : '' }}>Layak Huni</option>
                        <option value="Kurang Layak" {{ old('kondisi_rumah') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
                        <option value="Tidak Layak" {{ old('kondisi_rumah') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                    </select>
                    @error('kondisi_rumah') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">
                        <i class="fa-solid fa-sticky-note form-icon"></i> Catatan (Opsional)
                    </label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                    @error('catatan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_penilaian" class="form-label">
                        <i class="fa-solid fa-calendar-alt form-icon"></i> Tanggal Penilaian
                    </label>
                    <input type="date" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" value="{{ old('tanggal_penilaian') }}" required>
                    @error('tanggal_penilaian') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <span class="icon-label">
                            <span class="icon-circle bg-light"><i class="fa-solid fa-save icon-colored"></i></span>
                            <span class="d-none d-md-inline">Simpan</span>
                        </span>
                    </button>
                    <a href="{{ route('penerima.show', $penerima) }}" class="btn btn-secondary">
                        <span class="icon-label">
                            <span class="icon-circle bg-light"><i class="fa-solid fa-arrow-left icon-colored"></i></span>
                            <span class="d-none d-md-inline">Kembali</span>
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>