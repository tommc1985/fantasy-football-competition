<?php

class ProcessController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	public $headerMenu=array();

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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$competitions = Competition::model()->findAllByAttributes(
		    array('status'=>'in_progress')
		);

		echo '<pre>';
		foreach ($competitions  as $competition) {
			$processCompetition = new ProcessCompetition($competition);

			$processCompetition->process();
		}
		die();

		$this->render('index');
	}

	/**
	 * Process History.
	 */
	public function actionHistory()
	{
		$dataProvider=new SourceData('search');
		$dataProvider->unsetAttributes();  // clear any default values
		$this->render('history',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
