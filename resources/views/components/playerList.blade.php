 <?php if(isset($playerGroup)){ ?>
 <div class="columns">
                    <div class="column card content">
                        <h3>Player Group</h3>
                        <ul class="playerList">
                        <?php 
                        $player = new \App\Player;
                        foreach($playerGroup->players as $player){
                        	$playerDeets = $player->steamdetails();
                        	?>
                        <li><a href='/player/{{$player->steamId}}'><img src="{{$playerDeets->avatarfull}}" alt='{{$playerDeets->personaname}}' style="width:50px; height:50px;" /><span class='name' >{{$playerDeets->personaname}}</span></a> <a class="remove" href="/player/{{$player->steamId}}/removeFromPlayerGroup">X</a></li>
                        <?php } ?>
                    	</ul>
                        <a href="/playerGroup">View group games</a>

                    </div>
 }
</div>
<?php } ?>