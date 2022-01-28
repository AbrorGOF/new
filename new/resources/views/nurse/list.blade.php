@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Hamshiralar') }}
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-5">
                            <thead>
                            <tr class="table-success">
                                <th scope="col">#</th>
                                <th scope="col">F.I.O</th>
                                <th scope="col">Muolaja nomi</th>
                                <th scope="col">Sog‘lom </th>
                                <th scope="col">Boshqalar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($nurses as $data)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $data->name }} {{ $data->surname }}</td>
                                    <td>{{ $data->passport }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->category_id }}</td>
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
@endsection


