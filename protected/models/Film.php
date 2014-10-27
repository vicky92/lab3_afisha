<?php
class Film extends EMongoDocument {
	public $title = null;

	public static function model ($className=__CLASS__) {
		return parent::model ($className);
	}

	public function getCollectionName () { return 'films'; }

	public function rules () {
		return array(
			array ('title', 'required'), 
			array ('title', 'length', 'min' => 3, 'max' => 40, ),
            
        );
	}
    
    public static function getCinemates ( $film_id ) {
        $relations = Relation::model()->getDb()->command (
            array(
                "distinct"      => "films_relations", 
                "key"           => "cinema_id",
                "query"         => array (
                    "film_id"   => (string) $film_id,
                )
            )
        );
        
        $items = array();
        
        foreach ($relations['values'] as $cinema) {
            $criteria = new EMongoCriteria();
        
            $criteria->cinema_id = $cinema;
            
            $relation = Relation::model()->find( $criteria );
            
            $cinema = Cinema::model()->findByPK( new MongoID($relation->cinema_id) );
            $city = City::model()->findByPK( $cinema->city_id );
            
            $cinema->city_id = $city->city_name;
            $items[] = $cinema;
        }
        
        return $items;
    }
    
	public function attributeLabels () {
		return array(
			array ('title', 'Название')
		);
	}
}