@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      {{ __('Muolajalar bo‘yicha hisobot') }}
                      @if(auth()->user()->type == 'nurse')
                        <button id="edit-btn" type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addToJournal">
                          <i class="feather icon-edit-2 mr-2"></i>
                          Hisobot qo'shish
                        </button>
                      @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center" id="reportTable">
                          <thead>
                          <tr class="table-success">
                              <th scope="col">#</th>
                              <th scope="col">Bemorning F.I.O. yoshi</th>
                              <th scope="col">Murojaat sanasi va vaqti</th>
                              <th scope="col">Manzili</th>
                              <th scope="col">Tavsiya (ko‘rsatma) bergan shifokorning F.I.O. Bemorga qo‘yilgan tashxis (hamshira mustaqil bajarganda qator bo‘sh qoldiriladi)</th>
                              <th scope="col">Muolaja nomi</th>
                              <th scope="col">Sog‘lom turmush tarzi bo‘yicha tadbirlar</th>
                              <th scope="col">Boshqalar</th>
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
    @if(auth()->user()->type == 'nurse')
      @include('report.add_journal_modal')
    @endif
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
      const table = $('#reportTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ $link }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'patient_full_name', name: 'patient_full_name'},
          {data: 'patient_visit_time', name: 'patient_visit_time'},
          {data: 'patient_address', name: 'patient_address'},
          {data: 'doctor_diagnosis', name: 'doctor_diagnosis'},
          {data: 'treatment_name', name: 'treatment_name'},
          {data: 'category', name: 'category'},
          {data: 'others', name: 'others'},
        ],
        columnDefs: [
          {
            "aTargets": [1],
            "mRender": function (data, type, full) {
              return `${data} <span>${full.patient_age}</span>`
            }
          },
          {
            "aTargets": [4],
            "mRender": function (data, type, full) {
              return `${data} <span>${full.doctor_full_name}</span>`
            }
          }
        ]
      });

    });
  </script>
@endsection

