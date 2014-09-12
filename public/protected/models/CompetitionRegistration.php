<?php

/**
 * This is the model class for table "competition_registration".
 *
 * The followings are the available columns in table 'competition_registration':
 * @property integer $id
 * @property integer $competition_id
 * @property integer $club_id
 * @property string $identifier
 * @property string $date_created
 * @property string $date_modified
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Club $club
 * @property Competition $competition
 * @property Match[] $matches
 * @property Match[] $matches1
 * @property Tie[] $ties
 * @property Tie[] $ties1
 */
class CompetitionRegistration extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competition_registration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competition_id, club_id, identifier, date_created, date_modified', 'required'),
			array('competition_id, club_id, deleted', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, competition_id, club_id, identifier, date_created, date_modified, deleted', 'safe', 'on'=>'search'),
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
			'club'        => array(self::BELONGS_TO, 'Club', 'club_id'),
			'competition' => array(self::BELONGS_TO, 'Competition', 'competition_id'),
			'awayMatches' => array(self::HAS_MANY, 'Match', 'away_club_id'),
			'homeMatches' => array(self::HAS_MANY, 'Match', 'home_club_id'),
			'awayTies'    => array(self::HAS_MANY, 'Tie', 'away_club_id'),
			'homeTies'    => array(self::HAS_MANY, 'Tie', 'home_club_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'competition_id' => 'Competition',
			'club_id' => 'Club',
			'identifier' => 'Identifier',
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
		$criteria->compare('competition_id',$this->competition_id);
		$criteria->compare('club_id',$this->club_id);
		$criteria->compare('identifier',$this->identifier,true);
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
	 * @return CompetitionRegistration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
