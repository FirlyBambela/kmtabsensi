@extends('layouts.app')
@section('titlepage', 'Jenis Tunjangan')

@section('content')
@section('navigasi')
    <span>Jenis Tunjangan</span>
@endsection
<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('cabang.create')
                    <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i> Tambah
                        Jenis Tunjangan</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Jenis Tunjangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenistunjangan as $d)
                                        <tr>
                                            <td>{{ $d->kode_jenis_tunjangan }}</td>
                                            <td>{{ $d->jenis_tunjangan }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('jenistunjangan.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit"
                                                                kode_jenis_tunjangan="{{ Crypt::encrypt($d->kode_jenis_tunjangan) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('jenistunjangan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('jenistunjangan.delete', Crypt::encrypt($d->kode_jenis_tunjangan)) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="delete-confirm ml-1">
                                                                    <i class="ti ti-trash text-danger"></i>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    @endcan


                                                </div>
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
    </div>
</div>
<x-modal-form id="modal" size="" show="loadmodal" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btnCreate").click(function(e) {
            $('#modal').modal("show");
            $('#modal').find(".modal-title").text("Tambah Jenis Tunjangan");
            $("#loadmodal").load('/jenistunjangan/create');
        });

        $(".btnEdit").click(function(e) {
            let kode_jenis_tunjangan = $(this).attr("kode_jenis_tunjangan");
            e.preventDefault();
            $('#modal').modal("show");
            $('#modal').find(".modal-title").text("Edit Jenis Tunjangan");
            $("#loadmodal").load(`/jenistunjangan/${kode_jenis_tunjangan}/edit`);
        });
    });
</script>
@endpush
