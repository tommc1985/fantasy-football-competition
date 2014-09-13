<?php

/**
 * This is an extension of CActiveRecord used for operations that affect all DB Records
 */

class ActiveRecord extends CActiveRecord
{

    /**
     * Executes after a record has been retrieved from the DB
     */
    public function afterFind()
    {
        parent::afterFind();
    }

    /**
     * Defines default scope of records
     */
    public function defaultScope()
    {
        return array(
            'alias' => $this->tableName(),
            'condition'=>$this->tableName().".deleted=0",
        );
    }

    /**
     * Executes before a record is to be deleted
     * Overrides hard-delete with soft-delete
     */
    public function beforeDelete()
    {
        $this->deleted = 1;
        $this->save();
        return false;
    }

    /**
     * Executes before a record is saved
     * @return boolean continue status from parent method
     */
    public function beforeSave()
    {
        if($this->isNewRecord){
            if(array_key_exists('date_created',$this->attributes)) {
                $this->date_created = date('Y-m-d H:i:s');
            }
        }

        if(array_key_exists('date_modified',$this->attributes)) {
            $this->date_modified = date('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }

    /**
     * Fetch Model
     * @param  string $className The class name
     * @return Model             The Model
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

}