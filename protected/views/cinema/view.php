<h1>Кинотеатр "<?=$model->title?>"</h1>
<table style = "width: 100%;">
    <tr>
        <td style = "width: 70%; padding-right: 50px;">
            <h2>Список сеансов</h2>
            <a href = "<?=$this->createUrl("relations/add", array("cinema_id" => $model->_id))?>">Добавить сеанс</a>

            <?php
                $dates = Relation::model()->getDb()->command(
                    array(
                        "distinct" => "films_relations", 
                        "key" => "date",
                        "query" => array (
                            "cinema_id" => (string) $model->_id,
                        )
                    ));
                
                $dates = $dates['values'];
                
                foreach ($dates as $date) {
                    // Получим список сеансов на день из текущей итерации
                    
                    $criteria = new EMongoCriteria();
                    
                    $criteria->cinema_id = (string) $model->_id;
                    $criteria->date = $date;
                    
                    $sessions = Relation::model()->findAll( $criteria );
                    
                    ?>
                        <h4><?=$date?></h4>
                        <table style = "width: 100%;" border = "1">
                        <?php

                        foreach ($sessions as $session) {
                            $film = Film::model()->findByPK(new MongoID($session->film_id));
                            
                                ?>
                                    <tr>
                                        <td style = "width: 200px;"><a href = "<?=$this->createUrl('films/view', array("id" => $film->_id))?>"><?=$film->title?></a></td>
                                        <td style = "width: 200px;"><?=$session->time?></td>
                                        <td style = "width: 200px;">
                                            <a href="<?=$this->createUrl('relations/remove', array("id" => $session->_id))?>">удалить сеанс</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                        </table>
                    <?php
                }
            ?>
        </td>
        <td style = "width: 30%; vertical-align: top;">
            <h2>Информация</h2>
            <?php
                // Определим город
                $city = City::model()->findByPK( $model->city_id );
            ?>

            <b>Город:</b> <br >
            <a href = "<?=$this->createUrl("cinema/search", array("city" => $city->city_name))?>"><?=$city->city_name?></a> 
            <br /><br />

            <b>Адрес:</b> <br />
            <i><?=$model->adress?></i>
        </td>
    </tr>
</table>
