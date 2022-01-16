@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">
                        Mustaqil hamshira tomonidan Sog‘liqni saqlash vazirligi axborot dasturiga kiritiladigan chorak
                        davomida aholiga ko‘rsatilgan tibbiy maslahat va muolajalar to‘g‘risidagi hisobot
                    </h5>
                </div>
                <div class="card-body">
                    <h5 class="text-center">Shakl</h5>
                    <ul>
                        <li>1. Qoraqalpog‘iston Respublikasi, viloyat yoki Toshkent shahar:__________________</li>
                        <li>2. Tuman (shahar): _________________________________________________________</li>
                        <li>3. Hudud: _________________________________________________________________</li>
                        <li>4. Ruxsatnoma raqami va sanasi: ____________________________________________</li>
                        <li>5. Hamshiraning F.I.O. ______________________________________________________</li>
                    </ul>
                    <table class="table table-bordered mb-5">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Hisobot nomi</th>
                                <th colspan="4">choraklar</th>
                                <th rowspan="2">jami</th>
                            </tr>
                            <tr>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>IV</th>
                            </tr>
                        </thead>
                        <tbody >
                            @forelse($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ @$category->quarterlies->first }}</td>
                                    <td>{{ @$category->quarterlies->second }}</td>
                                    <td>{{ @$category->quarterlies->third }}</td>
                                    <td>{{ @$category->quarterlies->fourth }}</td>
                                    <td>{{ @$category->quarterlies->first + @$category->quarterlies->second + @$category->quarterlies->third + @$category->quarterlies->fourth}} </td>
                                </tr>
                                @if($category->id == 2)
                                <tr class="text-center">
                                    <td colspan="7">Hamshiraning o‘zi mustaqil amalga oshirgan muolajalar va tadbirlar</td>
                                </tr>
                                @endif
                                @if($category->id == 9)
                                <tr class="text-center">
                                    <td colspan="7">Shifokor tavsiyasi bilan amalga oshirilgan muolajalar</td>
                                </tr>
                                @endif
                            @empty
                            @endforelse



                            <tr >
                                <th scope="row">4.10</th>
                                <td>Jami</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
