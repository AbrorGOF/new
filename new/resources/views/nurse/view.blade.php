@extends('layouts.app')

@section('content')
  @if(empty($nurse))
    @include('404')
  @else
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <div class="mt-3">
                <h4>
                  {{ $nurse->surname }} {{ $nurse->name }}
                  @if($nurse->status == 'canceled')
                  @endif
                </h4>
                @if($nurse->user_status == 'new' && $nurse->status == 'active')
                  <button type="button" class="btn btn-success"id="acceptNurse">Ruxsat berish</button>
                  <button class="btn btn-outline-danger" id="cancelNurse">Rad etish</button>
                @else
                  @if($nurse->user_status == 'active')
                    <button class="btn btn-outline-danger">Bekor qilish</button>
                  @endif
                @endif
              </div>
            </div>
            <hr class="my-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">FIO</h6>
                <span class="text-secondary">{{ $nurse->surname }} {{ $nurse->name }} {{ $nurse->patronymic }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Pasport</h6>
                <span class="text-secondary">{{ $nurse->passport }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">PINFL</h6>
                <span class="text-secondary">{{ $nurse->pinfl }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Viloyat (shahar)</h6>
                <span class="text-secondary">{{ $nurse->region_title }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Faoliyat hududi</h6>
                <span class="text-secondary">{{ $nurse->area }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Hamkor tashkilot</h6>
                <span class="text-secondary">{{ $nurse->polyclinic_title }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Yo'nalish</h6>
                <span class="text-secondary">{{ $nurse->category_title }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5>Soliq tomonida berilgan QR-kodli ma’lumotnoma</h5>
          </div>
          <div class="card-body">
            <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="{{ url(str_replace('public', 'storage', $nurse->licence))}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 48.5vh" width="100%"></iframe>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5>Hamshira diplomi</h5>
          </div>
          <div class="card-body">
            <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="{{ url(str_replace('public', 'storage', $diploma->file))}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 48.5vh" width="100%"></iframe>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5>Hamshira sertifikati</h5>
          </div>
          <div class="card-body">
            <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="{{ url(str_replace('public', 'storage', $certificate->file))}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 48.5vh" width="100%"></iframe>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5>Hamshira guvohnomasi</h5>
          </div>
          <div class="card-body">
            <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="{{ url(str_replace('public', 'storage', $nurse->reference))}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 48.5vh" width="100%"></iframe>
          </div>
        </div>
      </div>
  </div>
  @endif

@endsection
@section('script')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    $('#cancelNurse').click(function (){
      Swal.fire({
        title: 'Rad etish sababini kiriting!',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off',
          id:'reason'
        },
        showCancelButton: true,
        confirmButtonText: 'Yuborish',
        cancelButtonText: 'Yopish',
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
      }).then(function () {
        if ($('#reason').val())
        {
          const data = { 'reason': $('#reason').val()};
          const headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          axios.post('/nurse/cancel/{{ $nurse->id }}', data, {
            headers: headers
          })
            .then((response) => {
              if (response.data.status == 'canceled'){
                Swal.fire({
                  icon: 'success',
                  title: response.data.message,
                  showConfirmButton: false,
                  timer: 1500
                })
              }else{
                Swal.fire({
                  icon: 'error',
                  title: response.data.message,
                  showConfirmButton: true
                })
              }
            })
            .catch((error) => {
              Swal.fire({
                icon: 'error',
                title: 'Kutilmagan xatolik',
                showConfirmButton: false,
                timer: 1500
              })
            })
        }
      })
    })
    $('#acceptNurse').click(function (){
      Swal.fire({
        title: 'Hamshirani tasdiqlash',
        input: 'checkbox',
        inputValue: 0,
        inputId: 'accept',
        inputPlaceholder:
          'Hamshira ma`lumotlari tog`riligini tasdiqlayman',
        confirmButtonText:
          'Saqlash <i class="fa fa-arrow-right"></i>',
        inputValidator: (result) => {
          return !result && 'Ma`lumot togriligini tasdiqlang!'
        }
      }).then(function () {
        if ($('#swal2-checkbox').val() == 1)
        {
          axios.get('/nurse/accept/{{ $nurse->id }}')
            .then((response) => {
              if (response.data.status == 'canceled'){
                Swal.fire({
                  icon: 'success',
                  title: response.data.message,
                  showConfirmButton: false,
                  timer: 1500
                })
              }else{
                Swal.fire({
                  icon: 'error',
                  title: response.data.message,
                  showConfirmButton: true
                })
              }
            })
            .catch((error) => {
              Swal.fire({
                icon: 'error',
                title: 'Kutilmagan xatolik',
                showConfirmButton: false,
                timer: 1500
              })
            })
        }
      })
    })
  </script>
@endsection
