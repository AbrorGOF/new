@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Muolajalar bo‘yicha hisobot') }}
                        <button id="edit-btn" type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addToJournal">
                            <i class="feather icon-edit-2 mr-2"></i>
                            Hisobot qo'shish
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered text-center">
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
                            <tbody>
                            @forelse($patients as $data)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $data->patient_full_name }} {{ $data->patient_age }}</td>
                                    <td>{{ $data->patient_visit_time }}</td>
                                    <td>{{ $data->patient_address }}</td>
                                    <td>{{ $data->doctor_full_name }} {{ $data->doctor_diagnosis }}</td>
                                    <td>{{ $data->treatment_name }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->others }}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addToJournal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Hisobot qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" method="POST" action="/report/journal/add">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('patient_full_name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('patient_full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Bemor FIO') }}" type="text" name="patient_full_name" id="patient_full_name" value="{{ old('patient_full_name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('patient_full_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('patient_full_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('patient_age') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('patient_age') ? ' is-invalid' : '' }}" placeholder="{{ __('Bemor yoshi') }}" type="number" name="patient_age" id="patient_age" value="{{ old('patient_age') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('patient_age'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('patient_age') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('doctor_full_name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('doctor_full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Shifokor FIO') }}" type="text" name="doctor_full_name" id="doctor_full_name" value="{{ old('doctor_full_name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('doctor_full_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('doctor_full_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('treatment_name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('treatment_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Muolaja nomi') }}" type="text" name="treatment_name" id="treatment_name" value="{{ old('treatment_name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('treatment_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('treatment_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('patient_visit_time') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('patient_visit_time') ? ' is-invalid' : '' }}" placeholder="{{ __('Murojaat sanasi') }}" type="datetime-local" name="patient_visit_time" id="patient_visit_time" value="{{ old('patient_visit_time') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('patient_visit_time'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('patient_visit_time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('patient_address') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('patient_address') ? ' is-invalid' : '' }}" placeholder="{{ __('Bemor manzili') }}" type="text" name="patient_address" id="patient_address" value="{{ old('patient_address') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('patient_address'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('patient_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('doctor_diagnosis') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <input class="form-control{{ $errors->has('doctor_diagnosis') ? ' is-invalid' : '' }}" placeholder="{{ __('Shifokor tashxisi') }}" type="text" name="doctor_diagnosis" id="doctor_diagnosis" value="{{ old('doctor_diagnosis') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('doctor_diagnosis'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('doctor_diagnosis') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <select class="form-control" name="category_id" required>
                                            <option>Tadbirlar</option>
                                            @forelse($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }} @if($category->type == 2) (Doktor tafsiyasi) @elseif($category->type == 1) (Mustaqil) @endif</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" placeholder="Boshqalar" name="others"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">{{ __('Saqlash') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

