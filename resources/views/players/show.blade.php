@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Player view</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <h2>{{ $player->name }}</h2>
    <ul>
        @foreach ($player->friends()->get() as $friend)
            <li>{{$friend->name}}</li>
        @endforeach
    </ul>
</div>
@endsection
