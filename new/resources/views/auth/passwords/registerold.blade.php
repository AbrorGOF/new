@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        @if(session()->get('check_cert'))
                            <h3 class="text-danger">{{ session()->get('check_cert') }}</h3>
                            @php
                                Illuminate\Support\Facades\Session::forget('check_cert');
                            @endphp
                        @else
                            Ro'yxatdan o'tish
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="search_pinfl" class="col-md-4 col-form-label text-md-end">{{ __('PINFL') }}</label>
                            <div class="col-md-6">
                                <input id="search_pinfl" type="text" class="form-control" name="search_pinfl" value="{{ old('pinfl') }}" onkeyup="getInfo()" autofocus>
                            </div>
                        </div>
                        <form method="POST" action="/auth/reg" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <h4 class="text-center">Shaxsiy ma'lumotlar</h4>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Ism') }}</label>
                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="pinfl" class="col-md-3 col-form-label text-md-end">{{ __('PINFL') }}</label>

                                        <div class="col-md-9">
                                            <input id="pinfl" type="text" class="form-control @error('pinfl') is-invalid @enderror" name="pinfl" value="{{ old('pinfl') }}" required autocomplete="pinfl">

                                            @error('pinfl')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="surname" class="col-md-3 col-form-label text-md-end">{{ __('Familiya') }}</label>
                                        <div class="col-md-9">
                                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" >
                                            @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="passport" class="col-md-3 col-form-label text-md-end">{{ __('Passport') }}</label>
                                        <div class="col-md-9">
                                            <input id="passport" type="text" class="form-control @error('passport') is-invalid @enderror" name="passport" value="{{ old('passport') }}" required autocomplete="passport">

                                            @error('passport')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="patronym" class="col-md-3 col-form-label text-md-end">{{ __('Otasini ismi') }}</label>

                                        <div class="col-md-9">
                                            <input id="patronym" type="text" class="form-control @error('patronym') is-invalid @enderror" name="patronym" value="{{ old('patronym') }}" required autocomplete="patronym" >

                                            @error('patronym')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center">Diplom ma'lumotlari</h4>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="institution" class="col-md-3 col-form-label text-md-end">{{ __('Muassasa nomi') }}</label>
                                        <div class="col-md-9">
                                            <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" required autocomplete="institution" >
                                            @error('institution')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="degree" class="col-md-3 col-form-label text-md-end">{{ __('Ma`lumoti') }}</label>

                                        <div class="col-md-9">
                                            <select id="degree" class="form-control" @error('degree') is-invalid @enderror name="degree" required autocomplete="degree">
                                                <option value="1">O'rta maxsus</option>
                                                <option value="2">Oliy</option>
                                            </select>
                                            @error('degree')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="diplom_number" class="col-md-3 col-form-label text-md-end">{{ __('Diplom raqami') }}</label>

                                        <div class="col-md-9">
                                            <input id="diplom_number" type="text"class="form-control @error('diplom_number') is-invalid @enderror" name="diplom_number" value="{{ old('diplom_number') }}" required autocomplete="diplom_number">

                                            @error('diplom_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="diplom_file" class="col-md-3 col-form-label text-md-end">{{ __('Diplom nusxasi') }}</label>
                                        <div class="col-md-9">
                                            <input id="diplom_file" type="file" class="form-control @error('diplom_file') is-invalid @enderror" name="diplom_file" value="{{ old('diplom_file') }}" required autocomplete="diplom_file">
                                            @error('diplom_file')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="diplom_date" class="col-md-3 col-form-label text-md-end">{{ __('Berilgan sana') }}</label>

                                        <div class="col-md-9">
                                            <input id="diplom_date" type="date" class="form-control @error('diplom_date') is-invalid @enderror" name="diplom_date" value="{{ old('diplom_date') }}" required autocomplete="diplom_date" >

                                            @error('diplom_date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center">Malaka oshirganlik sertifikat ma'lumotlari</h4>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="certificate_institution" class="col-md-3 col-form-label text-md-end">{{ __('Muassasa nomi') }}</label>
                                        <div class="col-md-9">
                                            <input id="certificate_institution" type="text" class="form-control @error('certificate_institution') is-invalid @enderror" name="certificate_institution" value="{{ old('certificate_institution') }}" required autocomplete="certificate_institution" >
                                            @error('certificate_institution')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="certificate_file" class="col-md-3 col-form-label text-md-end">{{ __('Sertifikat nusxasi') }}</label>
                                        <div class="col-md-9">
                                            <input id="certificate_file" type="file" class="form-control @error('certificate_file') is-invalid @enderror" name="certificate_file" value="{{ old('certificate_file') }}" required autocomplete="certificate_file">
                                            @error('certificate_file')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="certificate_number" class="col-md-3 col-form-label text-md-end">{{ __('Sertifikat raqami') }}</label>
                                        <div class="col-md-9">
                                            <input id="certificate_number" type="text" class="form-control @error('certificate_number') is-invalid @enderror" name="certificate_number" value="{{ old('certificate_number') }}" required autocomplete="certificate_number" >
                                            @error('certificate_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="region_id" class="col-md-3 col-form-label text-md-end">{{ __('Viloyat') }}</label>
                                        <div class="col-md-9">
                                            <select id="region_id" class="form-control" @error('region_id') is-invalid @enderror name="region_id" required autocomplete="region_id">
                                                <option value="">Viloyat</option>
                                            </select>
                                            @error('region_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="certificate_date" class="col-md-3 col-form-label text-md-end">{{ __('Berilgan sana') }}</label>
                                        <div class="col-md-9">
                                            <input id="certificate_date" type="date" class="form-control @error('certificate_date') is-invalid @enderror" name="certificate_date" value="{{ old('certificate_date') }}" required autocomplete="certificate_date" >
                                            @error('certificate_date')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category_id" class="col-md-3 col-form-label text-md-end">Yo'nalish</label>
                                        <div class="col-md-9">
                                            <select id="category_id" class="form-control" @error('category_id') is-invalid @enderror name="category_id" required autocomplete="category_id">
                                                <option value="">Yo'nalish</option>
                                            </select>
                                            @error('certificate_date')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center">Hamkorlikda ishlaydigan birlamchi tibbiy-sanitariya yordami muassasasi</h4>
                                <div class="row mb-5">
                                    <label for="central_polyclinic" class="col-md-3 col-form-label text-md-end">{{ __('Markaziy poliklinika nomi') }}</label>
                                    <div class="col-md-7">
                                        <input id="central_polyclinic" type="text" class="form-control @error('central_polyclinic') is-invalid @enderror" name="central_polyclinic" value="{{ old('central_polyclinic') }}" required autocomplete="central_polyclinic" >
                                        @error('central_polyclinic')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="family_polyclinic" class="col-md-3 col-form-label text-md-end">{{ __('Oilaviy poliklinika nomi') }}</label>
                                    <div class="col-md-7">
                                        <input id="family_polyclinic" type="text" class="form-control @error('family_polyclinic') is-invalid @enderror" name="family_polyclinic" value="{{ old('family_polyclinic') }}" required autocomplete="family_polyclinic" >
                                        @error('family_polyclinic')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="doctor_station" class="col-md-3 col-form-label text-md-end">{{ __('Oilaviy shifokor punkti nomi') }}</label>
                                    <div class="col-md-7">
                                        <input id="doctor_station" type="text" class="form-control @error('doctor_station') is-invalid @enderror" name="doctor_station" value="{{ old('doctor_station') }}" required autocomplete="doctor_station" >
                                        @error('doctor_station')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center">Kabinetga kirish uchun</h4>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-3 col-form-label text-md-end">{{ __('Telefon') }}</label>
                                        <div class="col-md-9">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Parol') }}</label>
                                        <div class="col-md-9">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="password_confirmation" class="col-md-3 col-form-label text-md-end">{{ __('Parol qaytadan') }}</label>
                                        <div class="col-md-9">
                                            <input id="password_confirmation" type="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Saqlash') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('js/main.js')}}"></script>

<script>
    window.addEventListener('load', function() {
        $.ajax({
            url: '/select/options',
            type: "GET",
            dataType: 'json',
            success: function(dataResult){
                var cats = dataResult.data.cats;
                var regions = dataResult.data.regions;
                if (cats) {
                    $.each(cats, function(key, value) {
                        $('#category_id').append(`<option value="${value.cat_id}">${value.title}</option>`);
                    });
                }else{
                    $('#category_id')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Yo`nalish</option>')
                        .val('')
                    ;
                }
                if (regions) {
                    $.each(regions, function(key, value) {
                        $('#region_id').append(`<option value="${value.id}">${value.title}</option>`);
                    });
                }else{
                    $('#region_id')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Viloyat</option>')
                        .val('')
                    ;
                }
            }
        });
        // $(document).ready(function () {
        //     $('#phone').inputmask({"mask": "+\\9\\98 99 999-99-99"}); //specifying options
        //     // $('#search_pinfl').inputmask({"mask": "9-999999-999-999-9"}); //specifying options
        //     $('#pinfl').inputmask({"mask": "9-999999-999-999-9"}); //specifying options
        //     $('#passport').inputmask({"mask": "AA-9999999"}); //specifying options
        // });
    });

    function getInfo() {

        var num = $('#search_pinfl').val();
        if (num.length===14) {
            $.ajax({
                url: '/get/nurse/info',
                type: "POST",
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }, // More information on this below
                data:{"_token": "{{ csrf_token() }}", ' pinfl':num},
                dataType: 'json',
                success: function(dataResult){
                    var person = dataResult.result;
                    var fullName= person.fullName
                    fullName = fullName.split(" ",4);
                    var surname = fullName[0];
                    var name = fullName[1];
                    if (fullName[3]) {
                        var patronym = fullName[2]+' '+fullName[3];
                    }else{
                        var patronym = fullName[2];
                    }
                    var day = num.slice(1,3);
                    var month = num.slice(3,5);
                    var year = num.slice(5,7);
                    if (year.slice(0,1)<5) {
                        year = '20'+year;
                    }else{
                        year = '19'+year;
                    }
                    var birthDate = year+'-'+month+'-'+day;
                    var passport = person.passSeries+person.passNumber
                    $('#name').val(name);
                    $('#surname').val(surname);
                    $('#patronym').val(patronym);
                    $('#passport').val(passport);
                    $('#birth_date').val(birthDate);
                    $('#pinfl').val(num);
                }
            });
        }

    }

</script>
