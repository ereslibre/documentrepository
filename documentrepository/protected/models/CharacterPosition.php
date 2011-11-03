<?php

/**
 * This is the model class for table "tbl_character_position".
 *
 * The followings are the available columns in table 'tbl_character_position':
 * @property integer $id
 * @property integer $character_id
 * @property integer $position_id
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property Character $character
 * @property Position $position
 */
class CharacterPosition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CharacterPosition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_character_position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('character_id, position_id, start_date', 'required'),
			array('character_id, position_id', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, character_id, position_id, start_date, end_date', 'safe', 'on'=>'search'),
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
			'character' => array(self::BELONGS_TO, 'Character', 'character_id'),
			'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'character_id' => 'Character',
			'position_id' => 'Position',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('character_id',$this->character_id);
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$startDate = DateTime::createFromFormat('d/m/Y', $this->start_date);
		$this->start_date = date('Y-m-d', $startDate->getTimestamp());
        if (!empty($this->end_date) && ($this->end_date != 'To Present')) {
            $endDate = DateTime::createFromFormat('d/m/Y', $this->end_date);
    		$this->end_date = date('Y-m-d', $endDate->getTimestamp());
        } else {
            $this->end_date = null;
        }
		return parent::beforeSave();
	}

	protected function afterFind()
	{
		$this->start_date = date('d/m/Y', strtotime($this->start_date));
        if ($this->end_date) {
    		$this->end_date = date('d/m/Y', strtotime($this->end_date));
        } else {
            $this->end_date = 'To Present';
        }
		return parent::afterFind();
	}
}
