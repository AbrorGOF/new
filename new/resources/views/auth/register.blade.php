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
                                                      <input name="diploma_institution"  class="form-control mb-3" type="text" value="{{ old('diploma_institution') }}" required>
{{--                                                        <select class="form-select mb-3" name="diploma_institution" id="diploma_institution">--}}
{{--                                                            <option>Tanlang</option>--}}
{{--                                                            @forelse($polyclinics as $polyclinic)--}}
{{--                                                                <option value="{{ $polyclinic->id }}" {{ old('diploma_institution') == $polyclinic->id ? "selected" :""}}>{{ $polyclinic->title }}</option>--}}
{{--                                                            @empty--}}
{{--                                                            @endforelse--}}
{{--                                                        </select>--}}
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
    $('#addNurse').modal('show');
    @endif
    $(function () {
        const table = $('#nurses').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/nurse/list",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'surname', name: 'surname'},
                {data: 'passport', name: 'passport'},
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

</body>

</html>
