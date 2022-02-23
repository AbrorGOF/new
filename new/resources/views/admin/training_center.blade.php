
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Malaka oshirish markazlari</h4>
            @if(auth()->user()->type == 'admin')
                <button type="button" class="btn btn-primary float-sm-end" data-bs-toggle="modal" data-bs-target="#addTrainingCenter">
                    Qo'shish
                </button>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="worker">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Markaz </td>
                    <td>Manzili</td>
                    <td>Direktori</td>
                    <td>Telefon raqami</td>
                </tr>
                </thead>
                <tbody class="text-center"></tbody>
                <tfoot class="text-center"></tfoot>
            </table>
        </div>
    </div>
    @if(auth()->user()->type == 'admin')
        <div class="modal fade" id="addTrainingCenter" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Malaka oshirish markazi qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="/admin/training/center/add">
                        @csrf
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="card border-top border-0 border-4 border-info">
                                            <div class="card-body">
                                                <div class="border p-4 rounded">
                                                    <div class="row mb-3">
                                                        <label for="title" class="col-sm-3 col-form-label">Markaz nomi</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="title" name="title">
                                                            @error('title')
                                                            <span class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="phone" class="col-sm-3 col-form-label">Telefon raqami</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="phone" name="phone">
                                                            @error('phone')
                                                            <span class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="director" class="col-sm-3 col-form-label">Markaz direktori</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="director" name="director">
                                                            @error('director')
                                                            <span class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="address" class="col-sm-3 col-form-label">Manzili</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                                                            @error('title')
                                                            <span class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

            const table = $('#worker').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/training/center/list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'address', name: 'address'},
                    {data: 'director', name: 'director'},
                    {data: 'phone', name: 'phone'},
                ]
            });

        });
    </script>
@endsection
