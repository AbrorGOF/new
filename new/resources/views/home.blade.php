@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Bemorlar soni:</p>
                            <h4 class="my-1 text-warning">{{ $data['patient_count'] }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="bx bx-donate-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Sertifikat berilgan sanasi:</p>
                            <h4 class="my-1 text-info">{{ $data['start_date'] }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bx-message-square-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Sertifikat tugash sanasi:</p>
                            <h4 class="my-1 text-danger">{{ $data['end_date'] }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="bx bx-message-square-error"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">O‘zini o‘zi band qilgan shaxs sifatida “<strong>hamshiralik ishi</strong>” faoliyatini amalga oshirish tartibi
                        to‘g‘risida<br>
                        <strong>NIZOM</strong></h5>
                    <hr>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Umumiy qoidalar
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">

                                    <li>
                                        1. Ushbu Nizom o‘zini o‘zi band qilgan shaxs sifatida “hamshiralik ishi” faoliyatini amalga
                                        oshirish tartibini belgilaydi.
                                    </li>
                                    <li>
                                        2. Mazkur Nizomning amal qilishi tibbiy faoliyat bilan shug‘ullanuvchi yuridik shaxslarga
                                        tatbiq etilmaydi.
                                    </li>
                                    <li>
                                        3. O‘zini o‘zi band qilgan shaxs sifatida “hamshiralik ishi” faoliyati bilan shug‘ullanishga o‘rta
                                        tibbiy (hamshiralik ishi, davolash ishi, akusherlik ishi) yoki oliy hamshiralik ishi bo‘yicha oliy
                                        ma’lumotga ega bo‘lgan, davlat yoki nodavlat tibbiyot tashkilotida ishlamaydigan shaxslarga
                                        (keyingi o‘rinlarda — hamshira) ruxsat etiladi.
                                    </li>
                                    <li>
                                        4. O‘zini o‘zi band qilgan shaxs sifatida “hamshiralik ishi” bilan shug‘ullanadigan shaxslar
                                        faoliyati yuzasidan O‘zbekiston Respublikasi Sog‘liqni saqlash vazirligining axborot dasturi orqali
                                        Respublika o‘rta tibbiyot va farmatsevtika xodimlari malakasini oshirish va ularni ixtisoslashtirish
                                        markazi tomonidan monitoring olib boriladi.
                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Mustaqil hamshiraning huquqlari va majburiyatlari
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">	<strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
