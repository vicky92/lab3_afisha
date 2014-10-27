<tr data-cinema-id = "<?=$item->_id?>">
	<td>
        <a href = "<?=$this->createUrl("films/view", array("id" => $item->_id))?>"><?=$item->title?></a>
	</td>
	<td>
		<a href = "<?=$this->createUrl('films/remove', array('id' => $item->_id))?>">Удалить</a> |
		<a href = "<?=$this->createUrl('films/edit', array('id' => $item->_id))?>">Редактировать</a>
	</td>
</tr>