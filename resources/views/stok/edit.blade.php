@extends('layouts.dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Stok</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
  </div>

  <div class="card-body">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('post.proses-ubah.stok', $detail_stok->id) }}" method="post">
      @csrf
      @method('PATCH')

      <div class="form-group row">
        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang', $detail_stok->nama_barang) }}">

          @error('nama_barang')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>

      <div class="form-group row">
        <label for="jumlah_stok" class="col-sm-2 col-form-label">Edisi</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('jumlah_stok') is-invalid @enderror" name="jumlah_stok" value="{{ old('jumlah_stok', $detail_stok->jumlah_stok) }}">

          @error('jumlah_stok')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>

      <div class="form-group row">
        <label for="jumlah_stok" class="col-sm-2 col-form-label">Admin</label>

        <div class="col-sm-10">
          <select class="admin-id form-control custom-select" name="admin_ke">
            <option value="">Pilih Opsi</option>
            @foreach($data_admin as $admin)
              <option value="{{ $admin->id }}" {{ old('admin_id', $detail_stok->admin_id) == $admin->id ? 'selected' : '' }}>{{ $admin->nama }}</option>
            @endforeach
          </select>

          @error('admin_ke')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>


      <button type="submit" class="btn btn-success">
        Simpan
      </button>

    </form>
  </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.admin-id').select2();
  });
</script>
@endpush
