<?php
class Cinema extends EMongoDocument {
    public $id = null;
	public $title = null;
	public $city_id = null;
    public $adress = null;

	public static function model ($className=__CLASS__) {
		return parent::model ($className);
	}

	public function getCollectionName () { return 'cinema'; }


	public function rules () {
		return array(
			array ('title, city_id, adress', 'required'), 
			array ('title', 'length', 'min' => 3, 'max' => 120, ),
            array ('adress', 'length', 'min' => 3, 'max' => 180, ),
        );
	}

	public function attributeLabels () {
		return array(
			array ('title', 'Название кинотеатра'),
			array ('city_id', 'Город'),
            array ('adress', 'Адрес'),
		);
	}
    
    public static function getSessionsByFilm ( $cinema_id, $film_id ) {
        $film_model = Film::model()->findByPK( $film_id );
        
        $dates = Relation::model()->getDb()->command(
            array(
                "distinct" => "films_relations", 
                "key" => "date",
                "query" => array (
                    "cinema_id" => (string) $cinema_id,
                    "film_id" => (string) $film_id,
                )
            ));
        
        $dates = $dates['values'];
       
        $items = array();
        
        foreach ($dates as $date) {
            // Получим список сенсов на день из текущей итерации
           $criteria = new EMongoCriteria();
            
            $criteria->cinema_id = (string) $cinema_id;
            $criteria->date = $date;
            $criteria->film_id = (string) $film_id;

            $relations = Relation::model()->findAll( $criteria );
            
            foreach ($relations as $session) {
                $items[$date][] = (object) array (
                    "film" => $film_model->title,
                    "time" => $session->time
                );
            }
        }
        return $items;
    } 
    
    
    public function relations()
    {
        return array(
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }
}