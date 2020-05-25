@extends('layouts.app')


@section('content')

<div class="container">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                  
                </div>
            </div>

                <div class="columns">
                    <div class="column card content">
                        <h3>Player Group</h3>
                        <?php foreach($playerGroup as $player => $true){?>
                        <li>{{$player}} <a href="/player/{{$player}}/removeFromPlayerGroup">X</a></li>
                        <?php } ?>
                        <a href="/playerGroup">View group games</a>

                    </div>
                </div>


                <div class="columns">
                    <div class="column card content">
                        <figure class="image is-4by3"><img src="{{$details->avatarfull}}" /></figure>
                        <div class="card-content">
                        <h2> {{ $details->personaname }}</h2>
                        @if(isset($details->realname))
                        <p>{{$details->realname}}</p>
                        @endif
                        <a class="button" href = '/player/{{$details->steamid}}/scan'>Check for unscanned games</a>
                        </div>
                    </div>
                    <div class="content column">

                        <h3>Friends</h3>
                        
                        <ul>
                            @foreach ($friends as $friend)
                            <?php $friendDetails = $friend->steamdetails(); ?>
                                <li><a href = "/player/{{$friendDetails->steamid}}">{{$friendDetails->personaname}}</a> <a href = "/player/{{$friendDetails->steamid}}/addToPlayerGroup">+</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="content column">
                        <h3>Games</h3>

                          <ul>
                            @foreach ($games as $game)
                                <li><a href = "/game/{{$game->appid}}">{{$game->name}}</a></li>
                            
                            @endforeach
                        </ul>
                    </div>
        </div>
    </div>
</div>


@endsection
