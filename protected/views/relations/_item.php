<?php
    $film = Film::model()->findByPK( new MongoID($item->film_id) );
    $cinema = Cinema::model()->findByPK( new MongoID($item->cinema_id) );
    $city = City::model()->findByPK( $cinema->city_id );
?>
<tr data-cinema-id = "<?=$item->_id?>">
    <td>
        <a href = "<?=$this->createUrl("films/view", array("id" => $film->_id))?>"><?=$film->title?></a>
	</td>
    <td>
        <a href = "<?=$this->createUrl("cinema/view", array("id" => $cinema->_id))?>"><?=$cinema->title?></a>
	</td>
    <td>
        <?=$item->date?> <?=$item->time?> 
	</td>
	<td>
        <a href = "<?=$this->createUrl("cinema/search", array("city" => $city->city_name))?>"><?=$city->city_name?></a>
	</td>
	<td>
		<a href = "<?=$this->createUrl('relations/remove', array('id' => $item->_id))?>">Удалить сеанс</a>
	</td>
</tr>