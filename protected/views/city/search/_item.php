<tr data-cinema-id = "<?=$item->city_name?>">
	<td>
        <a href = "<?=$this->createUrl("cinema/search", array("city" => $item->city_name))?>"><?=$item->city_name?></a>
	</td>
	<td>
		<a href = "<?=$this->createUrl('city/remove', array('id' => $item->city_name))?>">Удалить</a> |
		<a href = "<?=$this->createUrl('city/edit', array('id' => $item->city_name))?>">Редактировать</a>
	</td>
</tr>