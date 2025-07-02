<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerima Bantuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdfcfc;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }
        h1, h3 {
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
        .table thead {
            background-color: #b30000;
            color: white;
            font-size: 0.9rem;
        }
        .table tbody tr:hover {
            background-color: #ffeeee;
            transition: 0.3s;
        }
        .detail-item {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .detail-label {
            font-weight: 600;
            width: 180px;
            color: #b30000;
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
        .alert-info {
            background-color: #fff4f4;
            color: #0056b3;
            border-left: 5px solid #0056b3;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="icon-label">
                <span class="icon-circle"><i class="fa-solid fa-id-card icon-colored"></i></span>
                Detail Penerima Bantuan
            </h1>
            <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                <span class="icon-label">
                    <span class="icon-circle bg-light"><i class="fa-solid fa-arrow-left icon-colored"></i></span>
                    <span class="d-none d-md-inline">Kembali</span>
                </span>
            </a>
        </div>

        <div class="card p-4 mb-4">
            <div class="mb-3">
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-solid fa-id-badge"></i> NIK:</span>
                    {{ $penerima->nik }}
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-regular fa-user"></i> Nama:</span>
                    {{ $penerima->nama }}
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-regular fa-calendar"></i> Tanggal Lahir:</span>
                    {{ $penerima->tanggal_lahir->format('d-m-Y') }}
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-solid fa-venus-mars"></i> Jenis Kelamin:</span>
                    {{ $penerima->jenis_kelamin }}
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-solid fa-location-dot"></i> Alamat:</span>
                    {{ $penerima->alamat }}
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fa-solid fa-circle-check"></i> Status Bantuan:</span>
                    <span class="badge bg-{{ $penerima->status_bantuan == 'Aktif' ? 'success' : 'secondary' }}">
                        {{ $penerima->status_bantuan }}
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="icon-label">
                    <span class="icon-circle"><i class="fa-solid fa-history icon-colored"></i></span>
                    Riwayat Penilaian
                </h3>
                <a href="{{ route('assessment.create', $penerima) }}" class="btn btn-primary">
                    <span class="icon-label">
                        <span class="icon-circle bg-light"><i class="fa-solid fa-plus-circle icon-colored"></i></span>
                        <span class="d-none d-md-inline">Tambah Penilaian</span>
                    </span>
                </a>
            </div>

            @if ($penerima->assessments->isEmpty())
                <div class="alert alert-info">
                    <i class="fa-solid fa-circle-info"></i> Belum ada data penilaian.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-calendar-check"></i> Tanggal Penilaian</th>
                                <th><i class="fa-solid fa-coins"></i> Pendapatan Bulanan</th>
                                <th><i class="fa-solid fa-users"></i> Jml Tanggungan</th>
                                <th><i class="fa-solid fa-home"></i> Kondisi Rumah</th>
                                <th><i class="fa-solid fa-star"></i> Skor</th>
                                <th><i class="fa-solid fa-award"></i> Kategori</th>
                                <th><i class="fa-solid fa-comment-dots"></i> Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penerima->assessments as $assessment)
                                <tr>
                                    <td>{{ $assessment->tanggal_penilaian->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($assessment->pendapatan_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ $assessment->jumlah_tanggungan }}</td>
                                    <td>{{ $assessment->kondisi_rumah }}</td>
                                    <td>{{ $assessment->skor_kelayakan }}</td>
                                    <td>{{ $assessment->kategori_kelayakan }}</td>
                                    <td>{{ $assessment->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>