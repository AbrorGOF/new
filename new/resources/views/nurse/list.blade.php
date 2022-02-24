@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Hamshiralar</h5>
                        <button type="button" class="btn btn-primary float-sm-end" data-bs-toggle="modal" data-bs-target="#addNurse">
                            Qo'shish
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center" id="nurses">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>F.I.O</th>
                                    <th>Telefon</th>
                                    <th>Hudud </th>
                                    <th>Pasport</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('nurse.add_modal')
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        @if (count($errors) > 0)
        $('#addNurse').modal('show');
        @endif
        $(function () {
            const table = $('#nurses').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/nurse/list",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'phone.phone', name: 'phone'},
                    {data: 'area', name: 'area'},
                    {data: 'passport', name: 'passport'},
                    {data: 'status', name: 'status'},
                ],
                columnDefs: [
                  {
                      "aTargets": [1],
                      "mRender": function (data, type, full) {
                      return `<a href="/nurse/show/${full.id}">${data}</a>`
                      }
                  },
                  {
                    "aTargets": [5],
                    "mRender": function (data, type, full) {
                      let status;
                      if (data === 'active'){
                        status = `<span class="badge bg-primary">Aktiv</span>`;
                      }else if(data === 'canceled'){
                        status = `<span class="badge bg-danger">Rad etilgan</span>`;
                      }else if(data === 'Blocked'){
                        status = `<span class="badge bg-danger">Bekor qilingan</span>`;
                      }
                      return status;
                    }
                  }
                ]
            });
            $('#nurses').on('click', 'tbody tr', function() {
                // window.location.href = '/nurse/view/'+table.row( this ).id();
            });
            $('tr').css('cursor','pointer');
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


