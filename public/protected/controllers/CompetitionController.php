<?php

class CompetitionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete','rounds','ties'),
				'users'=>array('*'),
			),/*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));

		$this->render('view',array(
			'model'               => $model,
			'tournamentStructure' => $tournamentStructure,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Competition;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Competition']))
		{
			$model->attributes=$_POST['Competition'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Competition']))
		{
			$model->attributes=$_POST['Competition'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Competition');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Competition('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Competition']))
			$model->attributes=$_GET['Competition'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model rounds.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionRounds($id)
	{
		$model=$this->loadModel($id);

		$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Round']))
		{
			$success = true;
			$i = 1;
			while ($i <= $tournamentStructure->getNumberOfRounds()) {
				$round = new Round();
				if (isset($_POST['Round'][$i]['id']) && $_POST['Round'][$i]['id']) {
					$round = Round::model()->findByPk($_POST['Round'][$i]['id']);
				}

				$data = $_POST['Round'][$i];
				$round->attributes=$data;

				if(!$round->save())
					$success = false;

				$i++;
			}

			if($success)
				$this->redirect(array('rounds','id'=>$model->id));
		}

		$existingRounds = $model->rounds;

		if (!$existingRounds) {
			$rounds = array();
			$i = 0;
			while ($i < $tournamentStructure->getNumberOfRounds()) {
				$round = new Round();
				$round->name = $tournamentStructure->getRoundName($i);
				$round->competition_id = $id;
				$round->order = $i;

				$rounds[] = $round;
				$i++;
			}
		} else {
			$rounds = $existingRounds;
		}

		$this->render('rounds',array(
			'model'               => $model,
			'tournamentStructure' => $tournamentStructure,
			'rounds'			  => $rounds,
		));
	}

	/**
	 * Updates a particular model rounds.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionTies($id)
	{
		$model=$this->loadModel($id);

		$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));

		if(isset($_POST['club']) && !$model->rounds[0]->ties) {
			$ties = array();
			$clubNumber = 0;
			$byeNumber = 1;
			foreach ($tournamentStructure->getStructure() as $roundNumber => $roundStructure) {
				$round = $model->rounds[$roundNumber];
				foreach ($roundStructure as $match) {
					$tie = new Tie();
					switch ($match->type) {
						case 'match':
							$tie->attributes=array(
								'round_id'        => $round->id,
								'home_club_id'    => $_POST['club'][$clubNumber],
								'away_club_id'    => $_POST['club'][$clubNumber + 1],
								'name'            => "Tie {$match->match_number}",
								'status'          => 'provisional',
							);
							$clubNumber = $clubNumber + 2;

							$tie->save();

							TournamentBuilder::buildTieMatches($tie);
							break;
						case 'bye':
							$tie->attributes=array(
								'round_id'        => $round->id,
								'home_club_id'    => $_POST['club'][$clubNumber],
								'name'            => "Bye " . $byeNumber,
								'type'            => 'bye',
								'status'          => 'provisional',
							);
							$byeNumber++;
							$clubNumber++;

							$tie->save();
							break;
						case 'tie':
							$tie->attributes=array(
								'round_id'        => $round->id,
								'home_tie_id'     => $ties[$match->home_tie_winner]->id,
								'away_tie_id'     => $ties[$match->away_tie_winner]->id,
								'name'            => "Tie {$match->match_number}",
								'type'            => 'match',
								'status'          => 'provisional',
							);

							$tie->save();
							break;
					}

					$ties[$match->tie_number] = $tie;
				}
			}

			$this->redirect(array('ties','id'=>$model->id));
		}

		$this->render('ties',array(
			'model'               => $model,
			'tournamentStructure' => $tournamentStructure,
		));
	}

	/**
	 * Start a particular Competition
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionstart($id)
	{
		$model=$this->loadModel($id);

		if ($model->status != 'provisional')
			throw new CHttpException(400,'The Competition has already started or finished');

		$model->attributes=array(
			'status' => 'in_progress'
		);

		$model->save();

		foreach ($model->rounds as $round) {
			foreach ($round->ties as $tie) {
				$tie->attributes=array(
					'status' => 'in_progress'
				);

				$tie->save();
			}

			die('Competition Started');
		}

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Competition::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='competition-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
