<tr data-cinema-id = "<?=$item->id?>">
	<td>
	    <a href = "<?=$this->createUrl("cinema/view", array("id" => $item->_id))?>">
	        <?=$item->title?>
        </a>
	</td>
	<td>
        <a href = "<?=$this->createUrl("cinema/search", array("city" => $item->city_id))?>"><?=$item->city_id?></a>
    </td>
	<td>
        <?=$item->adress?>
    </td>
	<td>
		<a href = "<?=$this->createUrl('cinema/remove', array('id' => $item->_id))?>">Удалить</a> | 
		<a href = "<?=$this->createUrl('cinema/edit', array('id' => $item->_id))?>">Редактировать</a>
	</td>
</tr>