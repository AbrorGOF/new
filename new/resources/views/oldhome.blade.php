@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Bemorlar soni:</h4>
                </div>
                <div class="card-body">
                    <h5> {{ $data['patient_count'] }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Sertifikat berilgan sanasi:</h4>
                </div>
                <div class="card-body">
                    <h5> {{ $data['start_date'] }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Sertifikat tugash sanasi:</h4>
                </div>
                <div class="card-body">
                    <h5> {{ $data['end_date'] }}</h5>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row p-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Mustaqil hamshira shifokorning ko‘rsatmasisiz bajarishi mumkin bo‘lgan tibbiy maslahat va muolajalar</h4>
                </div>
                <div class="card-body">
                    <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="http://cabinet.imedic.uz/storage/nurse_duty.pdf#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 100vh" width="100%"></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Mustaqil hamshira shifokor tavsiyasi (ko‘rsatmasi) asosida bajarishi mumkin bo‘lgan tibbiy maslahat va muolajalar</h4>
                </div>
                <div class="card-body">
                    <iframe class="border-v-rounded-lg border-v-solid border-v-2" class=" mb-3" src="http://cabinet.imedic.uz/storage/nurse_duty_doctor_advice.pdf#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" style="height: 100vh" width="100%"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
