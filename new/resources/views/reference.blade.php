
<! DOCTYPE html>
<html>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .br-bottom
        {
            border-bottom: 1px solid;
            margin: auto;
            width: fit-content;
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <p class="text-center" style="text-align: center">
                        Sog‘liqni saqlash vazirligi axborot dasturida Sog‘liqni saqlash<br>
                        vazirligida mustaqil hamshira faoliyati bilan shug‘ullanish bo‘yicha<br>
                        ro‘yxatdan o‘tganligini tasdiqlovchi<br>
                        <strong>GUVOHNOMA</strong><br>
                        {{ auth()->id() }}-son
                    </p>
                    <p class="text-center" style="text-align: center">{{ auth()->user()->name }} {{ auth()->user()->surname }} {{ auth()->user()->patronym }}</p><br>
                    <p class="text-left" style="margin-bottom: 15px; text-align: left">
                        o‘zini o‘zi band qilgan “hamshiralik ishi” faoliyatini amalga oshiruvchi hamshira sifatida
                        {{ $date }}da ro‘yxatga olindi.
                    </p>
                    <p class="text-left" style="text-align: left">
                        Faoliyatni amalga oshirish manzili:<br>
                        1. Qoraqalpog‘iston Respublikasi, Toshkent sh., viloyat: {{ $address['region'] }}<br>
                        2. Tuman (shahar): {{ $address['district'] }}<br>
                        3. Hudud:
                        <br><br>
                        Hamkorlikda ishlaydigan birlamchi tibbiyot tashkiloti:_____________________________<br>
                        ______________________________________________________________________________________
                    </p>
                    <table>
                        <tr>
                            <td><img src="data:image/png;base64,{{DNS2D::getBarcodePNG($qrcode, 'QRCODE')}}" alt="barcode" /></td>
                            <td><p class="text-left" style="text-align: left; margin-left: 10px;">Ushbu ma’lumotnoma axborot tizimining yagona reyestridagi ma’lumotlar asosida shakllantirilgan elektron hujjatning
                                    nusxasidir</p></td>
                        </tr>
                    </table>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </body>
</html>
