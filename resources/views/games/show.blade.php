@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Game view</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  


                <div class="columns">
                    <div class="column">
                    <h2 class="is-primary">{{ $game->name }}</h2>  
                    <ul>
                        @foreach ($game->categories()->get() as $category)
                            <li>{{$category->name}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="column">
                    {{ $game->description}}
                    </div>
                  
                </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
