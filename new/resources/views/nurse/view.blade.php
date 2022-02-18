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
              <h4>{{ $nurse->surname }} {{ $nurse->name }}</h4>
              @if($nurse->user_status == 'new')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptModal">Ruxsat berish</button>
                <div class="modal fade" id="acceptModal" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <form action="/nurse/accept" method="POST">
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Hamshiraga mustaqil ishlashga ruxsat berish</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="nurse_id" value="{{ $nurse->id }}">
                            <input type="checkbox" id="terms" name="terms">
                            <label for="terms">Hamshira hujjatlarini togriligini tasdiqlaysizmi</label>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                          <button type="submit" class="btn btn-primary">Tasdiqlayman</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <button class="btn btn-outline-danger" id="cancelNurse">Rad etish</button>
              @elseif($nurse->user_status == 'active')
                <button class="btn btn-outline-danger">Bekor qilish</button>
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
  </div>
  @endif

@endsection
@section('script')
  <script>
    $('#cancelNurse').click(function (){
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      })
    })
  </script>
@endsection
