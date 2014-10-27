<h1><?=$model->title?></h1>

<h2>Список сеансов на фильм "<?=$model->title?>".</h2>

<?php
    $cinemates = Film::getCinemates( $model->_id );
    
    foreach($cinemates as $cinemate) {
        ?>
            <h3><a href = "<?=$this->createUrl('cinema/view', array('id' => $cinemate->_id))?>"><?=$cinemate->title?></a> <small>(<?=$cinemate->city_id?>)</small></h3>
            <i><?=$cinemate->adress?></i> <br /><br />
            <?php
                // Получаем информацию о каждом сеансе
                $dates = Cinema::getSessionsByFilm($cinemate->_id, $model->_id);
        
                foreach ($dates as $date => $sessions) {
                    ?>
                        <b><?=$date?></b> <br />
                        <table style = "width: 40%" border = "1">
                            <?php
                                foreach ($sessions as $session) {
                                    ?>
                                        <tr>
                                            <td><?=$session->film?></td>
                                            <td><?=$session->time?></td>
                                        </tr>    
                                    <?php
                                }
                            ?>
                        </table>
                    <?php
                }
            ?>
            <br /><br />
        <?php
    }
?>