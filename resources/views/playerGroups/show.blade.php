@extends('layouts.app')


@section('content')
<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
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
<table>
<?php foreach( $playerGroup->players as $player){
    $playerDeets = $player->steamdetails(); ?>
    <tr><td><?php echo $playerDeets->personaname;?></td></tr>

<?php
} ?>
</table>

<table>
    <?php foreach($games as $game){
  //      dd($playerCounts);
        ?>
        <tr>
            <td><?php echo $game->name; ?></td>
            <td><?php echo count($playerCounts[$game->steamId]);?></td>
            <td><?php echo $game->metacritic;?></td>
        </tr>
        <?php
    } ?>


</table>
    </div>
</div>


@endsection
