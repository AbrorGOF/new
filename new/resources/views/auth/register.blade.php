<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
{{--    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />--}}
<!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>HAMSHIRALIK ISHI FAOLIYATI</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Ro'yxatdan o'tish</h3>
                                        <p>Profilingiz bormi? <a href="{{ route('login') }}">Kabinetga kirish</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        <div class="row g-3">
                                            <div class="col-sm-3">
                                                <label for="search_pinfl" class="form-label">PINFL</label>
                                                <input id="search_pinfl" type="text" class="form-control" name="search_pinfl" value="{{ old('pinfl') }}" autofocus>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="search_category_id" class="form-label">Yo'nalish</label>
                                                <select id="search_category_id" class="form-control" @error('search_category_id') is-invalid @enderror name="search_category_id" required autocomplete="search_category_id">
                                                    <option value="">Yo'nalish</option>
                                                </select>
                                                @error('search_category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="search_region_id" class="form-label">Viloyat</label>
                                                <select id="search_region_id" class="form-control" @error('search_region_id') is-invalid @enderror name="search_region_id" required autocomplete="search_region_id">
                                                    <option value="">Viloyat</option>
                                                </select>
                                                @error('search_region_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="search_nurse" class="form-label"> .</label>
                                                <button type="button" id="search_nurse" class="btn btn-info form-control" onclick="getInfo()">Jo'natish</button>
                                            </div>
                                        </div>
                                        <div class="d-none" id="reg">
                                            <form class="row g-3 mt-3" action="/auth/reg" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <label for="name" class="form-label">Ism</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="surname" class="form-label">Familiya</label>
                                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" >
                                                    @error('surname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="patronym" class="form-label">Otasini ismi</label>
                                                    <input id="patronym" type="text" class="form-control @error('patronym') is-invalid @enderror" name="patronym" value="{{ old('patronym') }}" required autocomplete="patronym" >
                                                    @error('patronym')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <label for="pinfl" class="form-label">PINFL</label>
                                                    <input id="pinfl" type="text" class="form-control @error('pinfl') is-invalid @enderror" name="pinfl" value="{{ old('pinfl') }}" required autocomplete="pinfl">
                                                    @error('pinfl')
                                                        <span class="text-center">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="passport" class="form-label">Pasport</label>
                                                    <input id="passport" type="text" class="form-control @error('passport') is-invalid @enderror" name="passport" value="{{ old('passport') }}" required autocomplete="passport">
                                                    @error('passport')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="degree" class="form-label">Ma'lumoti</label>
                                                    <select id="degree" class="form-control" @error('degree') is-invalid @enderror name="degree" required autocomplete="degree">
                                                        <option value="1">O'rta maxsus</option>
                                                        <option value="2">Oliy</option>
                                                    </select>
                                                    @error('degree')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="institution" class="form-label">Diplom bergan muassasa</label>
                                                    <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" required autocomplete="institution" >
                                                    @error('institution')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="diplom_number" class="form-label">Diplom raqami</label>
                                                    <input id="diplom_number" type="text"class="form-control @error('diplom_number') is-invalid @enderror" name="diplom_number" value="{{ old('diplom_number') }}" required autocomplete="diplom_number">
                                                    @error('diplom_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="diplom_date" class="form-label">Diplom berilgan sana</label>
                                                    <input id="diplom_date" type="date" class="form-control @error('diplom_date') is-invalid @enderror" name="diplom_date" value="{{ old('diplom_date') }}" required autocomplete="diplom_date" >
                                                    @error('diplom_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="certificate_institution" class="form-label">Sertifikat bergan muassasa</label>
                                                    <input id="certificate_institution" type="text" class="form-control @error('certificate_institution') is-invalid @enderror" name="certificate_institution" value="{{ old('certificate_institution') }}" required autocomplete="certificate_institution" >
                                                    @error('certificate_institution')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="certificate_number" class="form-label">Sertifikat raqami</label>
                                                    <input id="certificate_number" type="text" class="form-control @error('certificate_number') is-invalid @enderror" name="certificate_number" value="{{ old('certificate_number') }}" required autocomplete="certificate_number" >
                                                    @error('certificate_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="certificate_date" class="form-label">Sertifikat berilgan sana</label>
                                                    <input id="certificate_date" type="date" class="form-control @error('certificate_date') is-invalid @enderror" name="certificate_date" value="{{ old('certificate_date') }}" required autocomplete="certificate_date" >
                                                    @error('certificate_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="central_polyclinic" class="form-label">Markaziy poliklinika</label>
                                                    <input id="central_polyclinic" type="text" class="form-control @error('central_polyclinic') is-invalid @enderror" name="central_polyclinic" value="{{ old('central_polyclinic') }}" required autocomplete="central_polyclinic" >
                                                    @error('central_polyclinic')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="family_polyclinic" class="form-label">Oilaviy poliklinika</label>
                                                    <input id="family_polyclinic" type="text" class="form-control @error('family_polyclinic') is-invalid @enderror" name="family_polyclinic" value="{{ old('family_polyclinic') }}" required autocomplete="family_polyclinic" >
                                                    @error('family_polyclinic')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="doctor_station" class="form-label">Shifokor punkti</label>
                                                    <input id="doctor_station" type="text" class="form-control @error('doctor_station') is-invalid @enderror" name="doctor_station" value="{{ old('doctor_station') }}" required autocomplete="doctor_station" >
                                                    @error('doctor_station')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12"><h4 class="text-center">Kabinetga kirish uchun</h4> </div>
                                                <div class="col-md-4">
                                                    <label for="phone" class="form-label">Telefon</label>
                                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="password" class="form-label">Parol</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="password_confirmation" class="form-label">Parol qaytadan</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password"><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <input type="hidden" name="category_id" id="category_id">
                                                    <input type="hidden" name="region_id" id="region_id">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--plugins-->
    <script>
        @if (count($errors) > 0)
        $('#reg').removeClass('d-none');
        @endif
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
                            $('#search_category_id').append(`<option value="${value.cat_id}">${value.title}</option>`);
                        });
                    }else{
                        $('#search_category_id')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="">Yo`nalish</option>')
                            .val('')
                        ;
                    }
                    if (regions) {
                        $.each(regions, function(key, value) {
                            $('#search_region_id').append(`<option value="${value.id}">${value.title}</option>`);
                        });
                    }else{
                        $('#search_region_id')
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

            var pinfl = $('#search_pinfl').val();
            var cat_id = $('#search_category_id').val();
            var reg_id = $('#search_region_id').val();
            if (pinfl.length===14) {
                $.ajax({
                    url: '/get/nurse/info',
                    type: "POST",
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }, // More information on this below
                    data:{
                        "_token": "{{ csrf_token() }}",
                        'pinfl':pinfl,
                        'cat_id':cat_id,
                        'reg_id':reg_id
                    },
                    dataType: 'json',
                    success: function(dataResult){
                        if (dataResult.desk && dataResult.imedic){
                            $('#reg').removeClass('d-none');
                            $('#category_id').val(cat_id);
                            $('#region_id').val(reg_id);
                            // desk info
                            var person = dataResult.desk;
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
                            $('#patronym').val(patronym);
                            $('#passport').val(passport);
                            $('#birth_date').val(birthDate);
                            $('#pinfl').val(pinfl);

                            // desk info
                            // imedic
                            var nurse = dataResult.imedic;
                            var nurse_phone = nurse.nurse_phone;
                            var nurse_diplom = nurse.nurse_diplom;
                            var nurse_diplom_number = nurse.nurse_diplom_number;
                            var nurse_diplom_date = nurse.nurse_diplom_date;
                            if (nurse.certificate_date){
                                var certificate_date = nurse.certificate_date;
                                $('#certificate_date').val(certificate_date);
                            }
                            if (nurse.certificate_number){
                                var certificate_number = nurse.certificate_number;
                                $('#certificate_number').val(certificate_number);
                            }
                            $('#phone').val(nurse_phone);
                            $('#institution').val(nurse_diplom);
                            $('#diplom_number').val(nurse_diplom_number);
                            $('#diplom_date').val(nurse_diplom_date);
                            // imedic
                        }else{
                            ('#reg').addClass('d-none');
                            alert(dataResult.error);
                        }

                    }
                });
            }

        }
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
</body>

</html>
