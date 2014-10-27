<?php
class Relation extends EMongoDocument {
	public $cinema_id = null;
    public $film_id = null;
    public $date = null;
    public $date_format = null;
    public $time = null;

	public static function model ($className=__CLASS__) {
		return parent::model ($className);
	}

	public function getCollectionName () { return 'films_relations'; }

	public function rules () {
		return array(
			array ('cinema_id, film_id, date, time', 'required')
        );
	}

}