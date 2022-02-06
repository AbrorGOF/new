@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a href="/pdf/reference/download"  class="float-right btn btn-info">
                        <i class="fadeIn animated bx bx-cloud-download"></i>
                        Yuklab olish
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="{{ url(auth()->user()->reference)}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 100vh" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
