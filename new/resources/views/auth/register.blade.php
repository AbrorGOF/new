<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    @yield("style")
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet" />
    <script src="/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <link href="/css/template/font-awesome.min.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="/assets/css/header-colors.css" />
    <title>HAMSHIRALIK ISHI FAOLIYATI</title>
</head>

<body class="bg-login">
<style>
    #thumbwrap {
        position:relative;
    }
    .thumb span {
        position:absolute;
        visibility:hidden;
    }
    .thumb:hover, .thumb:hover span {
        visibility:visible;
        top:50px;
        left:30px;
        z-index:1;
    }
</style>
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
                                        <form action="/nurse/add" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h5 style="text-align: right !important;">PINFL orqali qidirish</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="search_pinfl" id="search_pinfl" value="{{ old('search_pinfl') }}">
                                                    </div>
                                                    <div class="col-3"></div>
                                                </div>
                                                @csrf
                                                <div class="row">
                                                    <h4 class="text-center">Shaxsiy ma'lumotlar</h4>
                                                    <div class="col-3">
                                                        <label class="form-label">Ism</label>
                                                        <input class="form-control mb-3" type="text" name="name" id="name" value="{{ old('name') }}" required>
                                                        @error('name')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Familiya</label>
                                                        <input class="form-control mb-3" type="text" name="surname" id="surname" value="{{ old('surname') }}" required>
                                                        @error('surname')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Otasini ismi</label>
                                                        <input class="form-control mb-3" type="text" name="patronymic" id="patronymic" value="{{ old('patronymic') }}" required>
                                                        @error('patronymic')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Tugilgan yili</label>
                                                        <input class="form-control mb-3" type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                                                        @error('birth_date')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Pasport</label>
                                                        <input class="form-control mb-3" type="text" name="passport" id="passport" value="{{ old('passport') }}" required>
                                                        @error('passport')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">PINFL</label>
                                                        <input class="form-control mb-3" type="text" name="pinfl" id="pinfl" value="{{ old('pinfl') }}" required>
                                                        @error('pinfl')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Ma'lumoti</label>
                                                        <select class="form-select mb-3" name="degree" id="degree">
                                                            <option>Tanlang</option>
                                                            <option value="1">O'rta maxsus</option>
                                                            <option value="2">Oliy</option>
                                                        </select>
                                                        @error('degree')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label"> Mustaqil hamshira ma’lumotnomasi</label>
                                                        <input class="form-control mb-3" type="file" name="licence_file" value="" required>
                                                        @error('licence_file')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <h4 class="text-center">Diplom ma'lumotlari</h4>
                                                    <div class="col-3">
                                                        <label class="form-label">Diplom bergan muassasa</label>
                                                        <select class="form-select mb-3" name="diploma_institution" id="diploma_institution">
                                                            <option>Tanlang</option>
                                                            @forelse($polyclinics as $polyclinic)
                                                                <option value="{{ $polyclinic->id }}" {{ old('diploma_institution') == $polyclinic->id ? "selected" :""}}>{{ $polyclinic->title }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('diploma_institution')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Diplom raqami</label>
                                                        <input class="form-control mb-3" type="text" name="diploma_number" value="{{ old('diploma_number') }}" required>
                                                        @error('diploma_number')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Diplom berilgan sana</label>
                                                        <input class="form-control mb-3" type="date" name="diploma_date" value="{{ old('diploma_date') }}" required>
                                                        @error('diploma_date')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Diplom nusxasi</label>
                                                        <input class="form-control mb-3" type="file" name="diploma_file" value="" required>
                                                        @error('diploma_file')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <h4 class="text-center">Sertifikat malumotlari</h4>
                                                    <div class="col-3">
                                                        <label class="form-label">Sertifikat bergan muassasa</label>
                                                        <select class="form-select mb-3" name="certificate_institution" id="certificate_institution">
                                                            <option>Tanlang</option>
                                                            @forelse($centers as $center)
                                                                <option value="{{ $center->id }}" {{ old('certificate_institution') == $center->id ? "selected" :""}}>{{ $center->title }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('certificate_institution')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Sertifikat raqami</label>
                                                        <input class="form-control mb-3" type="text" name="certificate_number" value="{{ old('certificate_number') }}">
                                                        @error('certificate_number')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Sertifikat berilgan sana</label>
                                                        <input class="form-control mb-3" type="date" name="certificate_date" value="{{ old('certificate_date') }}">
                                                        @error('certificate_date')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Sertifikat nusxasi</label>
                                                        <input class="form-control mb-3" type="file" name="certificate_file" value="">
                                                        @error('certificate_file')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <h4 class="text-center">Qo'shimcha ma'lumotlari</h4>
                                                    <div class="col-4">
                                                        <label class="form-label">Yo'nalish</label>
                                                        <select class="form-select mb-3" name="category_id" id="category_id" required>
                                                            <option>Tanlang</option>
                                                            @forelse($categories as $category)
                                                                <option value="{{ $category->id }}" >{{ $category->title }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Hamkor muassasa</label>
                                                        <select class="form-select mb-3" name="partner_polyclinic" id="partner_polyclinic" required>
                                                            <option>Tanlang</option>
                                                            @forelse($polyclinics as $polyclinic)
                                                                <option value="{{ $polyclinic->id }}" >{{ $polyclinic->title }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('partner_polyclinic')
                                                        <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Hudud</label>
                                                        <input class="form-control mb-3" type="text" name="area" value="{{ old('area') }}">
                                                        @error('area')
                                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Telefon</label>
                                                        <input class="form-control mb-3" type="number" name="phone" id="phone" value="{{ old('phone') }}" required>
                                                        @error('phone')
                                                        <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Parol</label>
                                                        <input class="form-control mb-3" type="text" name="password" id="password" value="" required>
                                                        @error('password')
                                                        <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5">Saqlash</button>
                                            </div>
                                        </form>
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
    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="/assets/js/app.js"></script>
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
