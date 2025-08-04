@extends('layout.home-layout')

@section('title', 'Home | Siswa')

@section('main-content')
    <div class="home-content">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="main-content-home">
            <div class="content-home p-5">
                @include('components.navbar')
                <div class="table-manage">

                    <div class="table px-4 py-3">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dataSiswa">
                                {{-- data akan di isikan lewat ajax --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah data --}}
    <!-- Modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"">Tambah data siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Harap isi semua data sebelum menyimpan!
                    </div>
                    <div class="form-modal-add">
                        <form id="siswa-form">
                            @csrf
                            <div class="mb-3">
                                <label for="">NIS</label>
                                <input type="text" name="nis"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="nama"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                    class="for-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="alert alert-danger" role="alert">
                                Masukan kolom alamat dengan lengkap!
                            </div>
                            <div class="mb-3">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="" cols="5" rows="5"
                                    class="form-control focus-ring focus-ring-warning border border-warning "></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal tambah data --}}
    {{-- modal uddate data --}}
     <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"">Edit data siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-modal-update">
                        <form id="siswa-form-update">
                            @csrf
                            <input type="hidden" id="id"">
                            <div class="mb-3">
                                <label for="">NIS</label>
                                <input type="text" name="nis" id="nis"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas" id="kelas"
                                    class="form-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    class="for-control border border-warning focus-ring focus-ring-warning">
                            </div>
                            <div class="mb-3">
                                <label for="">Alamat</label>
                                <textarea name="alamat"  cols="5" rows="5" id="alamat"
                                    class="form-control focus-ring focus-ring-warning border border-warning "></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal uddate data --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
