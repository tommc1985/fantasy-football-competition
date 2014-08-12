<?php

/**
 * This is the model class for table "round".
 *
 * The followings are the available columns in table 'round':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $competition_id
 * @property string $name
 * @property string $start_datetime
 * @property string $finish_datetime
 * @property integer $legs
 * @property integer $replay
 * @property string $tie_breaker
 * @property integer $order
 * @property string $date_created
 * @property string $date_modified
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Round $parent
 * @property Round[] $rounds
 * @property Competition $competition
 * @property Tie[] $ties
 */
class Round extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'round';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competition_id, name, start_datetime, finish_datetime, tie_breaker, order', 'required'),
			array('parent_id, competition_id, legs, replay, order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('tie_breaker', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, competition_id, name, start_datetime, finish_datetime, legs, replay, tie_breaker, order, date_created, date_modified', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Round', 'parent_id'),
			'rounds' => array(self::HAS_MANY, 'Round', 'parent_id'),
			'competition' => array(self::BELONGS_TO, 'Competition', 'competition_id'),
			'ties' => array(self::HAS_MANY, 'Tie', 'round_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'competition_id' => 'Competition',
			'name' => 'Name',
			'start_datetime' => 'Start Datetime',
			'finish_datetime' => 'Finish Datetime',
			'legs' => 'Legs',
			'replay' => 'Replay',
			'tie_breaker' => 'Tie Breaker',
			'order' => 'Order',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('competition_id',$this->competition_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_datetime',$this->start_datetime,true);
		$criteria->compare('finish_datetime',$this->finish_datetime,true);
		$criteria->compare('legs',$this->legs);
		$criteria->compare('replay',$this->replay);
		$criteria->compare('tie_breaker',$this->tie_breaker,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_modified',$this->date_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Round the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
