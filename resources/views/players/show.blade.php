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
    <h2><img src="{{$details->avatarfull}}" /> {{ $details->personaname }}</h2>
    @if(isset($details->realname))
    <p>{{$details->realname}}</p>
    @endif
    
    <ul>
        @foreach ($friends as $friend)
        <?php $friendDetails = $friend->steamdetails(); ?>
            <li><a href = "/player/{{$friendDetails->steamid}}">{{$friendDetails->personaname}}</a></li>
        @endforeach
    </ul>

      <ul>
        @foreach ($games as $game)
            <li><a href = "/game/{{$game->appid}}">{{$game->name}}</a></li>
        
        @endforeach
    </ul>
</div>
@endsection
