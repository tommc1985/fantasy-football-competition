<?php

/**
 * This is the model class for table "tie".
 *
 * The followings are the available columns in table 'tie':
 * @property integer $id
 * @property integer $round_id
 * @property integer $home_tie_id
 * @property integer $away_tie_id
 * @property integer $home_club_id
 * @property integer $away_club_id
 * @property string $name
 * @property integer $home_club_points
 * @property integer $away_club_points
 * @property integer $home_club_tie_breaker
 * @property integer $away_club_tie_breaker
 * @property string $start_datetime
 * @property string $finish_datetime
 * @property string $type
 * @property string $status
 * @property string $date_modified
 * @property string $date_created
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property ClubRegistration $awayClub
 * @property Tie $awayTie
 * @property Tie[] $ties
 * @property ClubRegistration $homeClub
 * @property Tie $homeTie
 * @property Tie[] $ties1
 * @property Round $round
 */
class Tie extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('round_id, start_datetime, finish_datetime', 'required'),
			array('round_id, home_tie_id, away_tie_id, home_club_id, away_club_id, home_club_points, away_club_points, home_club_tie_breaker, away_club_tie_breaker', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('type', 'length', 'max'=>5),
			array('status', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, round_id, home_tie_id, away_tie_id, home_club_id, away_club_id, name, home_club_points, away_club_points, home_club_tie_breaker, away_club_tie_breaker, start_datetime, finish_datetime, type, status, date_modified, date_created', 'safe', 'on'=>'search'),
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
			'awayClub' => array(self::BELONGS_TO, 'ClubRegistration', 'away_club_id'),
			'awayTie' => array(self::BELONGS_TO, 'Tie', 'away_tie_id'),
			'awayTies' => array(self::HAS_MANY, 'Tie', 'away_tie_id'),
			'homeClub' => array(self::BELONGS_TO, 'ClubRegistration', 'home_club_id'),
			'homeTie' => array(self::BELONGS_TO, 'Tie', 'home_tie_id'),
			'homeTies' => array(self::HAS_MANY, 'Tie', 'home_tie_id'),
			'round' => array(self::BELONGS_TO, 'Round', 'round_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'round_id' => 'Round',
			'home_tie_id' => 'Home Tie',
			'away_tie_id' => 'Away Tie',
			'home_club_id' => 'Home Club',
			'away_club_id' => 'Away Club',
			'name' => 'Name',
			'home_club_points' => 'Home Club Points',
			'away_club_points' => 'Away Club Points',
			'home_club_tie_breaker' => 'Home Club Tie Breaker',
			'away_club_tie_breaker' => 'Away Club Tie Breaker',
			'start_datetime' => 'Start Datetime',
			'finish_datetime' => 'Finish Datetime',
			'type' => 'Type',
			'status' => 'Status',
			'date_modified' => 'Date Modified',
			'date_created' => 'Date Created',
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
		$criteria->compare('round_id',$this->round_id);
		$criteria->compare('home_tie_id',$this->home_tie_id);
		$criteria->compare('away_tie_id',$this->away_tie_id);
		$criteria->compare('home_club_id',$this->home_club_id);
		$criteria->compare('away_club_id',$this->away_club_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('home_club_points',$this->home_club_points);
		$criteria->compare('away_club_points',$this->away_club_points);
		$criteria->compare('home_club_tie_breaker',$this->home_club_tie_breaker);
		$criteria->compare('away_club_tie_breaker',$this->away_club_tie_breaker);
		$criteria->compare('start_datetime',$this->start_datetime,true);
		$criteria->compare('finish_datetime',$this->finish_datetime,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
