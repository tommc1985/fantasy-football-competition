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
		    array('status'=>'started')
		);

		foreach ($competitions  as $competition) {
			foreach ($competition->sources as $source) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_URL,$source->url);
				$data = curl_exec($ch);
				curl_close ($ch);
				unset($ch);

				$sourceDataModel = new SourceData;
				$sourceDataModel->attributes = array(
					'competition_source_id' => $source->id,
					'url'                   => $source->url,
					'data'                  => $data,
					'success'               => 1,

				);
				$sourceDataModel->save();
				unset($sourceDataModel);
			}
		}

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
