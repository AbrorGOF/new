
@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Doktorlar ro'yxati</h4>
            <button type="button" class="btn btn-primary float-sm-end" data-bs-toggle="modal" data-bs-target="#addWorker">
                Qo'shish
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="worker">
                <thead>
                <tr>
                    <td>#</td>
                    <td>name</td>
                    <td>surname</td>
                    <td>position</td>
                    <td>polyclinic_id</td>
                    <td>region_id</td>
                    <td>training_center_id</td>
                </tr>
                </thead>
                <tbody class="text-center"></tbody>
                <tfoot class="text-center"></tfoot>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addWorker" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Muassasa hodimini qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <h5 style="text-align: right !important;">PINFL orqali qidirish</h5>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="search_pinfl" id="search_pinfl">
                    </div>
                    <div class="col-3"></div>
                </div>
                <form action="/doctor/add" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Ism</label>
                                <input class="form-control mb-3" type="text" name="name" id="name" value="{{ @$subject->name }}" required>
                                @error('name')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Familiya</label>
                                <input class="form-control mb-3" type="text" name="surname" id="surname" value="{{ @$subject->surname }}" required>
                                @error('surname')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Otasini ismi</label>
                                <input class="form-control mb-3" type="text" name="patronymic" id="patronymic" value="{{ @$subject->patronymic }}" required>
                                @error('patronymic')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Pasport</label>
                                <input class="form-control mb-3" type="text" name="passport" id="passport" value="{{ @$subject->passport }}" required>
                                @error('passport')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">PINFL</label>
                                <input class="form-control mb-3" type="text" name="pinfl" id="pinfl" value="{{ @$subject->pinfl }}" required>
                                @error('pinfl')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Tugilgan yili</label>
                                <input class="form-control mb-3" type="date" name="birth_date" id="birth_date" value="{{ @$subject->birth_date }}" required>
                                @error('birth_date')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Viloyat</label>
                                <select class="form-select mb-3" name="region_id" id="region_id">
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
                            <div class="col-4">
                                <label class="form-label">Tibbiyot muassasasi</label>
                                <select class="form-select mb-3" name="polyclinic_id" id="polyclinic_id">
                                    <option>Tanlang</option>
                                    @forelse($polyclinics as $polyclinic)
                                        <option value="{{ $polyclinic->id }}" >{{ $polyclinic->title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('polyclinic_id')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Lavozimi</label>
                                <input class="form-control mb-3" type="text" name="position" value="{{ @$subject->position }}" required>
                                @error('position')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Telefon</label>
                                <input class="form-control mb-3" type="number" name="phone" id="phone" value="{{ @$subject->phone }}" required>
                                @error('phone')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Parol</label>
                                <input class="form-control mb-3" type="text" name="password" id="password" value="{{ @$subject->password }}" required>
                                @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
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
    <script>
        $(function () {
            const table = $('#worker').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/doctor/list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'position', name: 'position'},
                    {data: 'polyclinic_id', name: 'polyclinic_id'},
                    {data: 'region_id', name: 'region_id'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });
        $( "#search_pinfl" ).keyup(function() {
            const pinfl = $( "#search_pinfl" ).val();
            if (pinfl.length===14) {
                $.ajax({
                    url: '/admin/get/info',
                    type: "POST",
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }, // More information on this below
                    data:{
                        "_token": "{{ csrf_token() }}",
                        'pinfl':pinfl,
                    },
                    dataType: 'json',
                    success: function(dataResult){
                        if (dataResult.success){
                            // desk info
                            var person = dataResult.success;
                            var fullName= person.fullName
                            fullName = fullName.split(" ",4);
                            var surname = fullName[0];
                            var name = fullName[1];
                            var patronym = '';
                            if (fullName[3]) {
                                patronym = fullName[2]+' '+fullName[3];
                            }else{
                                patronym = fullName[2];
                            }
                            var day = pinfl.slice(1,3);
                            var month = pinfl.slice(3,5);
                            var year = pinfl.slice(5,7);
                            if (year.slice(0,1)<5) {
                                year = '20'+year;
                            }else{
                                year = '19'+year;
                            }
                            var birthDate = year+'-'+month+'-'+day;
                            var passport = person.passSeries+person.passNumber
                            $('#name').val(name);
                            $('#surname').val(surname);
                            $('#patronymic').val(patronym);
                            $('#passport').val(passport);
                            $('#birth_date').val(birthDate);
                            $('#pinfl').val(pinfl);

                            // desk info
                        }else{
                            alert(dataResult.error);
                        }
                    }
                });
            }
        });
    </script>
@endsection
