@extends('layouts.app')


@section('content')
<script type="text/javascript">
    $(document).ready( function () {
    $('#gamesTable').DataTable();
} );
</script>
<div class="container">


<table id="gamesTable">
    <thead>
        <tr>
            <th>Title</th>
            <th>Players</th>
            <th>Metacritic %</th>
            <?php 
            foreach($playerGroup->players as $player ){
                $playerDeets = $player->steamdetails(); 
                ?>
                <td><img src="{{$playerDeets->avatarfull}}" alt='{{$playerDeets->personaname}}' style="width:100px; height:100px;" /></td>
                <?php
                } 
            ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach($games as $game){
        if($game->name != ""){ ?>
        <tr>
            <td><?php echo $game->name; ?></td>
            <td><?php echo count($playerCounts[$game->steamId]);?></td>
            <td><?php echo $game->metacritic;?></td>
            <?php foreach($playerGroup->players as $player ){
                if(array_key_exists($player->steamId, $playerCounts[$game->steamId])){
                    echo "<td class='owned'>yep</td>";
                }
                else{
                    echo "<td class='unowned'>nop</td>";
                }
            }  ?>       
        </tr>
        <?php
    }
    } ?>

</tbody>
</table>
    </div>
</div>


@endsection
