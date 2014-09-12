<?php

/**
 * This is the model class for table "match".
 *
 * The followings are the available columns in table 'match':
 * @property integer $id
 * @property integer $tie_id
 * @property integer $home_club_id
 * @property integer $away_club_id
 * @property string $name
 * @property integer $home_club_points
 * @property integer $away_club_points
 * @property integer $home_club_tie_breaker
 * @property integer $away_club_tie_breaker
 * @property string $start_datetime
 * @property string $finish_datetime
 * @property integer $leg_number
 * @property integer $replay
 * @property string $status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property CompetitionRegistration $awayClub
 * @property CompetitionRegistration $homeClub
 * @property Tie $tie
 */
class Match extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'match';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tie_id, start_datetime, finish_datetime, date_created, date_modified', 'required'),
			array('tie_id, home_club_id, away_club_id, home_club_points, away_club_points, home_club_tie_breaker, away_club_tie_breaker, leg_number, replay, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tie_id, home_club_id, away_club_id, name, home_club_points, away_club_points, home_club_tie_breaker, away_club_tie_breaker, start_datetime, finish_datetime, leg_number, replay, status, date_created, date_modified, deleted', 'safe', 'on'=>'search'),
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
			'awayClub' => array(self::BELONGS_TO, 'CompetitionRegistration', 'away_club_id'),
			'homeClub' => array(self::BELONGS_TO, 'CompetitionRegistration', 'home_club_id'),
			'tie' => array(self::BELONGS_TO, 'Tie', 'tie_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tie_id' => 'Tie',
			'home_club_id' => 'Home Club',
			'away_club_id' => 'Away Club',
			'name' => 'Name',
			'home_club_points' => 'Home Club Points',
			'away_club_points' => 'Away Club Points',
			'home_club_tie_breaker' => 'Home Club Tie Breaker',
			'away_club_tie_breaker' => 'Away Club Tie Breaker',
			'start_datetime' => 'Start Datetime',
			'finish_datetime' => 'Finish Datetime',
			'leg_number' => 'Leg Number',
			'replay' => 'Replay',
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
		$criteria->compare('tie_id',$this->tie_id);
		$criteria->compare('home_club_id',$this->home_club_id);
		$criteria->compare('away_club_id',$this->away_club_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('home_club_points',$this->home_club_points);
		$criteria->compare('away_club_points',$this->away_club_points);
		$criteria->compare('home_club_tie_breaker',$this->home_club_tie_breaker);
		$criteria->compare('away_club_tie_breaker',$this->away_club_tie_breaker);
		$criteria->compare('start_datetime',$this->start_datetime,true);
		$criteria->compare('finish_datetime',$this->finish_datetime,true);
		$criteria->compare('leg_number',$this->leg_number);
		$criteria->compare('replay',$this->replay);
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
	 * @return Match the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
