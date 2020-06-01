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
                        <figure class="image is-4by3"><img src="{{$details->avatarfull}}" /></figure>
                        <div class="card-content">
                        <h2> {{ $details->personaname }}</h2>
                        <a class = "addLink" href = "/player/{{$details->steamid}}/addToPlayerGroup">Add to player group</a>
                        @if(isset($details->realname))
                        <p>{{$details->realname}}</p>
                        @endif
                        <a class="button" href = '/player/{{$details->steamid}}/scan'>Check for unscanned games</a>
                        </div>
                    </div>
                    <div class="content column">

                        <h3>Friends</h3>
                        
                        <table id="friendsTable">
                            <thead><th>Name</th><th>Add</th></thead>
                            <tbody>
                            @foreach ($friends as $friend)
                            <?php $friendDetails = $friend->steamdetails(); ?>
                                <tr><td><a href = "/player/{{$friendDetails->steamid}}">{{$friendDetails->personaname}}</a> </td><td><a href = "/player/{{$friendDetails->steamid}}/addToPlayerGroup">+</a></td></tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="content column">
                        <h3>Games</h3>

                          <table id="gamesTable">
                            <thead>
                                <th>Title</th>
                            </thead>
                            <tbody>
                            @foreach ($games as $game)
                                <tr><td><a href = "/game/{{$game->appid}}">{{$game->name}}</a></td></tr>                            
                            @endforeach
                        </tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>


@endsection
