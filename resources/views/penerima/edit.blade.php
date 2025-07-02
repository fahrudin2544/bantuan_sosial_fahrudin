<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerima Bantuan</title>
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
            background: linear-gradient(180deg, #fff, #fff4f4);
        }
        .btn-primary {
            background-color: #b30000;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #990000;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            transition: all 0.3s ease;
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
            transition: border-color 0.3s ease;
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
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-group .form-control, .form-group .form-select {
            padding-left: 2.5rem;
        }
        .form-group .form-icon {
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            z-index: 10;
        }
        .form-group textarea.form-control {
            padding-left: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="icon-label">
                <span class="icon-circle"><i class="fa-solid fa-user-edit icon-colored"></i></span>
                Edit Penerima Bantuan
            </h1>
            <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                <span class="icon-label">
                    <span class="icon-circle bg-light"><i class="fa-solid fa-arrow-left icon-colored"></i></span>
                    <span class="d-none d-md-inline">Kembali</span>
                </span>
            </a>
        </div>

        <div class="card p-4">
            <form action="{{ route('penerima.update', $penerima) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nik" class="form-label"><i class="fa-solid fa-id-badge form-icon"></i> NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $penerima->nik) }}" required>
                    @error('nik') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="nama" class="form-label"><i class="fa-regular fa-user form-icon"></i> Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $penerima->nama) }}" required>
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir" class="form-label"><i class="fa-regular fa-calendar form-icon"></i> Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penerima->tanggal_lahir->format('Y-m-d')) }}" required>
                    @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin" class="form-label"><i class="fa-solid fa-venus-mars form-icon"></i> Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" {{ old('jenis_kelamin', $penerima->jenis_kelamin) == '' ? 'selected' : '' }}>Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $penerima->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $penerima->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label"><i class="fa-solid fa-location-dot form-icon"></i> Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $penerima->alamat) }}</textarea>
                    @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="status_bantuan" class="form-label"><i class="fa-solid fa-circle-check form-icon"></i> Status Bantuan</label>
                    <select class="form-select" id="status_bantuan" name="status_bantuan" required>
                        <option value="" {{ old('status_bantuan', $penerima->status_bantuan) == '' ? 'selected' : '' }}>Pilih</option>
                        <option value="Aktif" {{ old('status_bantuan', $penerima->status_bantuan) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status_bantuan', $penerima->status_bantuan) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status_bantuan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <span class="icon-label">
                            <span class="icon-circle bg-light"><i class="fa-solid fa-save icon-colored"></i></span>
                            <span class="d-none d-md-inline">Perbarui</span>
                        </span>
                    </button>
                    <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
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