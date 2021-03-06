<?php

/**
 * This is the model class for table "competition".
 *
 * The followings are the available columns in table 'competition':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property string $source
 * @property string $status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property CompetitionRegistration[] $competitionRegistrations
 * @property CompetitionSource[] $competitionSources
 * @property Round[] $rounds
 */
class Competition extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug, type, source, date_created, date_modified', 'required'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>255),
			array('type', 'length', 'max'=>10),
			array('source', 'length', 'max'=>9),
			array('status', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug, type, source, status, date_created, date_modified, deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'registrations' => array(self::HAS_MANY, 'CompetitionRegistration', 'competition_id'),
			'sources'       => array(self::HAS_MANY, 'CompetitionSource', 'competition_id'),
			'rounds'        => array(self::HAS_MANY, 'Round', 'competition_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'slug' => 'Slug',
			'type' => 'Type',
			'source' => 'Source',
			'status' => 'Status',
			'date_created' => 'Date Created',
			'date_modified' => 'Date Modified',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Competition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Types of Competition
	 * @return array    Competition Types
	 */
	public static function types()
	{
		return array(
			'knockout'   => 'Knockout',
			/*'league'     => 'League',
			'tournament' => 'Tournament'*/
		);
	}

	/**
	 * Sourced to be used for the Competition
	 * @return array    Competition Sources
	 */
	public static function sources()
	{
		return array(
			'telegraph' => 'Telegraph',
		);
	}

	/**
	 * Fetch Source Data
	 * @return array    Competition Sources
	 */
	public function fetchSourceData()
	{
		foreach ($this->sources as $source) {
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
}
