<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Penerima Bantuan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fdfcfc;
      color: #333;
      font-family: 'Segoe UI', sans-serif;
    }
    h1 {
      color: #b30000;
      font-weight: 700;
      font-size: 1.75rem;
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
    .btn-outline-warning {
      border-color: #b30000;
      color: #b30000;
    }
    .btn-outline-warning:hover {
      background-color: #b30000;
      color: white;
    }
    .btn-outline-danger:hover {
      background-color: #e60000;
      color: white;
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
    .filter-toggle-btn {
      cursor: pointer;
      background-color: #fae5e5;
      border: none;
      padding: 8px 12px;
      border-radius: 8px;
      color: #b30000;
      transition: all 0.3s ease;
    }
    .filter-toggle-btn:hover {
      background-color: #b30000;
      color: white;
    }
    label {
      font-weight: 600;
    }
    .aksi-btn {
      display: flex;
      gap: 6px;
    }
    .aksi-btn .btn {
      padding: 5px 10px;
      font-size: 0.75rem;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .alert-success {
      background-color: #fff4f4;
      color: #28a745;
      border-left: 5px solid #28a745;
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
      <span class="icon-circle"><i class="fa-solid fa-hands-holding-circle icon-colored"></i></span>
      Daftar Penerima Bantuan Sosial
    </h1>
    <div class="d-flex gap-2">
      <button class="filter-toggle-btn" onclick="toggleFilter()">
        <span class="icon-label">
          <span class="icon-circle"><i class="fa-solid fa-sliders icon-colored"></i></span>
          <span class="d-none d-md-inline">Filter</span>
        </span>
      </button>
      <a href="{{ route('penerima.create') }}" class="btn btn-primary">
        <span class="icon-label">
          <span class="icon-circle bg-light"><i class="fa-solid fa-plus icon-colored"></i></span>
          <span class="d-none d-md-inline">Tambah</span>
        </span>
      </a>
    </div>
  </div>

  <div id="filterSection" class="card p-4 mb-4" style="display: none;">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="icon-label text-danger">
        <i class="fa-solid fa-filter-circle-dollar"></i> Filter Data
      </h5>
      <button class="filter-toggle-btn" onclick="toggleFilter()">
        <i class="fa-solid fa-eye-slash"></i>
      </button>
    </div>
    <form method="GET">
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Kategori Kelayakan</label>
          <select class="form-select" name="kategori_kelayakan">
            <option value="">Semua</option>
            <option value="Sangat Layak" {{ request('kategori_kelayakan') == 'Sangat Layak' ? 'selected' : '' }}>Sangat Layak</option>
            <option value="Layak" {{ request('kategori_kelayakan') == 'Layak' ? 'selected' : '' }}>Layak</option>
            <option value="Kurang Layak" {{ request('kategori_kelayakan') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
            <option value="Tidak Layak" {{ request('kategori_kelayakan') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Pendapatan Min (Rp)</label>
          <input type="number" class="form-control" name="pendapatan_min" value="{{ request('pendapatan_min') }}" />
        </div>
        <div class="col-md-3">
          <label class="form-label">Pendapatan Max (Rp)</label>
          <input type="number" class="form-control" name="pendapatan_max" value="{{ request('pendapatan_max') }}" />
        </div>
        <div class="col-md-3">
          <label class="form-label">Jml Tanggungan (Min)</label>
          <input type="number" class="form-control" name="jumlah_tanggungan" value="{{ request('jumlah_tanggungan') }}" />
        </div>
        <div class="col-md-3">
          <label class="form-label">Kondisi Rumah</label>
          <select class="form-select" name="kondisi_rumah">
            <option value="">Semua</option>
            <option value="Layak Huni" {{ request('kondisi_rumah') == 'Layak Huni' ? 'selected' : '' }}>Layak Huni</option>
            <option value="Kurang Layak" {{ request('kondisi_rumah') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
            <option value="Tidak Layak" {{ request('kondisi_rumah') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
          </select>
        </div>
        <div class="col-md-3 align-self-end">
          <button type="submit" class="btn btn-primary me-2">
            <i class="fa-solid fa-magnifying-glass"></i> Filter
          </button>
          <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-rotate-left"></i> Reset
          </a>
        </div>
      </div>
    </form>
  </div>

  @if (session('success'))
    <div class="alert alert-success">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th><i class="fa-solid fa-id-badge"></i> NIK</th>
            <th><i class="fa-regular fa-user"></i> Nama</th>
            <th><i class="fa-regular fa-calendar"></i> Tanggal Lahir</th>
            <th><i class="fa-solid fa-venus-mars"></i> Jenis Kelamin</th>
            <th><i class="fa-solid fa-location-dot"></i> Alamat</th>
            <th><i class="fa-solid fa-circle-check"></i> Status</th>
            <th><i class="fa-solid fa-ranking-star"></i> Kelayakan</th>
            <th><i class="fa-solid fa-ellipsis-vertical"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penerima as $item)
            <tr>
              <td>{{ $item->nik }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
              <td>{{ $item->jenis_kelamin }}</td>
              <td>{{ $item->alamat }}</td>
              <td><span class="badge bg-{{ $item->status_bantuan == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status_bantuan }}</span></td>
              <td>{{ $item->assessments->last()->kategori_kelayakan ?? '-' }}</td>
              <td>
                <div class="aksi-btn">
                  <a href="{{ route('penerima.show', $item) }}" class="btn btn-outline-info"><i class="fa-solid fa-eye"></i></a>
                  <a href="{{ route('penerima.edit', $item) }}" class="btn btn-outline-warning"><i class="fa-solid fa-pen"></i></a>
                  <form action="{{ route('penerima.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @if ($penerima->isEmpty())
        <div class="text-center p-3 text-muted">
          <i class="fa-solid fa-circle-info"></i> Tidak ada data yang ditemukan.
        </div>
      @endif
    </div>
    {{ $penerima->links() }}
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleFilter() {
    const filter = document.getElementById('filterSection');
    filter.style.display = (filter.style.display === 'none' || filter.style.display === '') ? 'block' : 'none';
  }
</script>
</body>
</html>