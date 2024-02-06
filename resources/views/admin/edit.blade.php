@extends('layouts.dashboard')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Admin</h1>
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

    <form action="{{ route('post.proses-ubah.admin', $detail_admin->id) }}" method="post">
      @csrf
      @method('PATCH')

      <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $detail_admin->nama) }}">

          @error('nama')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

      </div>

      <div class="form-group row">
        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>

        <div class="col-sm-10">
          <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan', $detail_admin->jabatan) }}">

          @error('jabatan')
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
