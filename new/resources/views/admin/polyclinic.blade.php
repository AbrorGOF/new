
@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="v-text-h3">
                    {{ __('Tibbiyot birlashmalari') }}
                </h5>
                <button type="button" class="btn btn-primary float-sm-end" data-bs-toggle="modal" data-bs-target="#addPolyclinic">
                    Qo'shish
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-5" id="polyclinic">
                    <thead>
                    <tr>
                        <th  width="10px" scope="col">#</th>
                        <th scope="col">Nomlanishi</th>
                        <th scope="col">Manzili</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPolyclinic" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tibbiyot muassasasini yaratish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/admin/polyclinic/add">
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
                                                <label class="col-sm-3 col-form-label">Malaka oshirish markazi</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select mb-3" name="training_center_id" id="training_center_id" required>
                                                        <option>Tanlang</option>
                                                        @forelse($centers as $center)
                                                            <option value="{{ $center->id }}" >{{ $center->title }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @error('training_center_id')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Viloyat</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select mb-3" name="region_id" id="region_id" required>
                                                        <option>Tanlang</option>
                                                        @forelse($regions as $region)
                                                            <option value="{{ $region->id }}" >{{ $region->title }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @error('region_id')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="address" class="col-sm-3 col-form-label">Manzil</label>
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
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        // $('#training_center_id').select2();
        $(function () {
            const table = $('#polyclinic').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/polyclinic/list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'address', name: 'address'},
                ]
            });

        });
    </script>
@endsection


