<?php

/**
 * This is the model class for table "round".
 *
 * The followings are the available columns in table 'round':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $competition_id
 * @property string $dates
 * @property string $name
 * @property integer $two_legged
 * @property integer $number_of_replays
 * @property integer $away_goals
 * @property string $tie_breaker
 * @property integer $order
 * @property string $date_created
 * @property string $date_modified
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Competition $competition
 * @property Round $parent
 * @property Round[] $rounds
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
			array('competition_id, dates, name', 'required'),
			array('parent_id, competition_id, two_legged, number_of_replays, away_goals, order, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('tie_breaker', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, competition_id, dates, name, two_legged, number_of_replays, away_goals, tie_breaker, order, date_created, date_modified, deleted', 'safe', 'on'=>'search'),
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
			'competition'   => array(self::BELONGS_TO, 'Competition', 'competition_id'),
			'previousRound' => array(self::BELONGS_TO, 'Round', 'parent_id'),
			'rounds'        => array(self::HAS_MANY, 'Round', 'parent_id'),
			'ties'          => array(self::HAS_MANY, 'Tie', 'round_id'),
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
			'dates' => 'Dates',
			'name' => 'Name',
			'two_legged' => 'Two Legged',
			'number_of_replays' => 'Number Of Replays',
			'away_goals' => 'Away Goals',
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
		$criteria->compare('dates',$this->dates,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('two_legged',$this->two_legged);
		$criteria->compare('number_of_replays',$this->number_of_replays);
		$criteria->compare('away_goals',$this->away_goals);
		$criteria->compare('tie_breaker',$this->tie_breaker,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * Executes after a record has been retrieved from the DB
     */
    public function afterFind()
    {
    	$dates = unserialize($this->dates);
    	$this->__set('dates', $dates);

        parent::afterFind();
    }

	/**
	 * Before Save
	 * @return boolean
	 */
	public function beforeSave()
	{
		$dates = $this->dates;

    	if (!$this->number_of_replays) {
    		unset($dates['start_datetime']['replay_1']);
    		unset($dates['finish_datetime']['replay_1']);
    	}

    	if (!$this->two_legged) {
    		unset($dates['start_datetime']['leg_2']);
    		unset($dates['finish_datetime']['leg_2']);
    	}

    	$this->__set('dates', serialize($dates));

	    return parent::beforeSave();
	}

	/**
	 * Options for Two Legged
	 * @return array    Two Legged Options
	 */
	public static function twoLeggedOptions()
	{
		return array(
			'0' => 'No',
			'1' => 'Yes',
		);
	}

	/**
	 * Options for Away Goals
	 * @return array    Away Goals Options
	 */
	public static function awayGoalsOptions()
	{
		return array(
			'0' => 'No',
			'1' => 'Yes',
		);
	}

	/**
	 * Options for Replay
	 * @return array    Replay Options
	 */
	public static function replayOptions()
	{
		return array(
			'0' => 'None',
			'1' => 'One',
		);
	}

	/**
	 * Options for Round Replay
	 * @return array    Tie Breaker Options
	 */
	public static function tiebreakers()
	{
		return array(
			'goals' => 'Goals',
		);
	}
}
