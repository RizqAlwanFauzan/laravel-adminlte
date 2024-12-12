<x-layouts.app :title="$title">
    <div class="row">
        <div class="col-12" id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Tambah Anggota
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse {{ $errors->hasBag('store') ? 'show' : '' }}" data-parent="#accordion">
                    <form action="{{ route('data-keanggotaan.anggota.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fg-01">NIK <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('nik', 'store') is-invalid @enderror"" id="fg-01" name="nik" value="{{ $errors->hasBag('store') ? old('nik') : '' }}" placeholder="Isikan NIK">
                                @error('nik', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fg-02">Nama Anggota <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('nama', 'store') is-invalid @enderror"" id="fg-02" name="nama" value="{{ $errors->hasBag('store') ? old('nama') : '' }}" placeholder="Isikan nama anggota">
                                @error('nama', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fg-03">Jenis Kelamin <span class="text-red">*</span></label>
                                <select class="form-control select2 @error('jenis_kelamin', 'store') is-invalid @enderror" id="fg-03" name="jenis_kelamin">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ $errors->hasBag('store') && old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $errors->hasBag('store') && old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fg-04">Nama Grup <span class="text-red">*</span></label>
                                <select class="form-control select2 @error('grup_id', 'store') is-invalid @enderror" id="fg-04" name="grup_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($grup as $id => $nama)
                                        <option value="{{ $id }}" {{ $errors->hasBag('store') && old('grup_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                @error('grup_id', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fg-05">Alamat <span class="text-red">*</span></label>
                                <textarea class="form-control @error('alamat', 'store') is-invalid @enderror" id="fg-05" name="alamat" rows="3" placeholder="Isikan alamat">{{ $errors->hasBag('store') ? old('alamat') : '' }}</textarea>
                                @error('alamat', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                            Daftar Anggota
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="collapse {{ $errors->hasBag('store') ? '' : 'show' }}" data-parent="#accordion">
                    <div class="card-body">
                        <table id="table-anggota" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Grup</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><span class="badge badge-light">{{ $item->nik }}</span></td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->grup->nama }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-xs btn-menu" data-toggle="modal" data-target="#modal-detail" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-warning btn-xs btn-menu text-white" data-toggle="modal" data-target="#modal-ubah" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs btn-menu" data-toggle="modal" data-target="#modal-hapus" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-3">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-key mr-1"></i> NIK</strong>
                            <p id="nik" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-user mr-1"></i> Nama Anggotta</strong>
                            <p id="nama_anggota" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>
                            <p id="jenis_kelamin" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-sitemap mr-1"></i> Nama Grup</strong>
                            <p id="nama_grup" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-map-marked mr-1"></i> alamat</strong>
                            <p id="alamat" class="m-0"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-ubah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $errors->hasBag('update') ? old('id') : '' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fg-11">NIK <span class="text-red">*</span></label>
                            <input type="text" class="form-control @error('nik', 'update') is-invalid @enderror"" id="fg-11" name="nik" value="{{ $errors->hasBag('update') ? old('nik') : '' }}" placeholder="Isikan NIK">
                            @error('nik', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-12">Nama Anggota <span class="text-red">*</span></label>
                            <input type="text" class="form-control @error('nama', 'update') is-invalid @enderror"" id="fg-12" name="nama" value="{{ $errors->hasBag('update') ? old('nama') : '' }}" placeholder="Isikan nama anggota">
                            @error('nama', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-13">Jenis Kelamin <span class="text-red">*</span></label>
                            <select class="form-control select2 @error('jenis_kelamin', 'update') is-invalid @enderror" id="fg-13" name="jenis_kelamin">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ $errors->hasBag('update') && old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $errors->hasBag('update') && old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-14">Nama Grup <span class="text-red">*</span></label>
                            <select class="form-control select2 @error('grup_id', 'update') is-invalid @enderror" id="fg-14" name="grup_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($grup as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('grup_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('grup_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-15">Alamat <span class="text-red">*</span></label>
                            <textarea class="form-control @error('alamat', 'update') is-invalid @enderror" id="fg-15" name="alamat" rows="3" placeholder="Isikan alamat">{{ $errors->hasBag('update') ? old('alamat') : '' }}</textarea>
                            @error('alamat', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p class="m-0 text-center">Apakah anda yakin untuk menghapus data Anggota dengan nik <span id="nik" class="text-bold"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('assets/myassets/dist/js/pages/data-keanggotaan/anggota.js') }}"></script>
    @endsection
</x-layouts.app>
