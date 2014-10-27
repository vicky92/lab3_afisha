<?php
class RelationsController extends CController {
	public function actionSearch () {
        $criteria = new EMongoCriteria();
        
       
        if (!empty($_POST['start'])) {
            $criteria->addCond("date_format", ">=", strtotime($_POST['start']));
        }
        
        if (!empty($_POST['end'])) {
            $criteria->addCond("date_format", "<=", strtotime($_POST['end']));
        }
        
        $model = Relation::model()->findAll($criteria);
        
        $this->render("index", array("items" => $model));
	}
    
	/*
	* Добавление нового сеанса
	*/
	public function actionAdd () {
		$model = new Relation;

        if (!empty($_GET['cinema_id'])) {
            $cinema_id = intval($_GET['cinema_id']);
            $model->cinema_id = $cinema_id;
        }
        
		if (isset ($_POST['add'])) {
			$model->attributes = $_POST['add'];
            $model->date_format = strtotime($_POST['add']['date'] . ' ' . $_POST['add']['time']);
			if ($model->validate()) {
				if ($model->save()) {
                    $this->redirect(
                        $this->createUrl("cinema/view", array ("id" => $_POST['add']['cinema_id'], "message" => "add_success"))
                    );
                } else {
                    $this->redirect(
                        $this->createUrl("relations/add", array ("message" => "add_error"))
                    );
                }
			}
		}
		$this->render('add', array('model' => $model));
	}

	/*
	* Удаление элемента
	*/
	public function actionRemove ($id) {
		$model = Relation::model()->findByPK(new MongoID($id));
        $cinema_id = $model->cinema_id;
        
		if ($model->delete()) {
			$this->redirect(
                $this->createUrl("cinema/view", array ("id" => $cinema_id, "message" => "remove_success"))
            );
		} else {
			die('Не удалось удалить город.');
		}
	}

	/*
	* Просмотр элемента
	*/
	public function actionView ($id) {
		$model = Relation::model()->findByPK(new MongoID($id));

		$this->render('view', array('model' => $model));
	}
}