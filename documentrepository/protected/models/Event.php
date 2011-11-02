<?php

/**
 * This is the model class for table "tbl_event".
 *
 * The followings are the available columns in table 'tbl_event':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $image
 *
 * The followings are the available model relations:
 * @property DocumentEvent[] $documentEvents
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Event the static model class
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
		return 'tbl_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date', 'required'),
			array('name, image', 'length', 'max'=>255),
			array('description, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, start_date, end_date, image', 'safe', 'on'=>'search'),
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
			'documentEvents' => array(self::HAS_MANY, 'DocumentEvent', 'event_id'),
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
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'image' => 'Image',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$startDate = DateTime::createFromFormat('d/m/Y', $this->start_date);
		$this->start_date = date('Y-m-d', $startDate->getTimestamp());
		if (!empty($this->end_date)) {
			$endDate = DateTime::createFromFormat('d/m/Y', $this->end_date);
			$this->end_date = date('Y-m-d', $endDate->getTimestamp());
		} else {
            $this->end_date = null;
        }
        if ($this->image == $this->emptyImageUrl()) {
            $this->image = null;
        } else {
            $this->image = basename($this->image);
        }
		return parent::beforeSave();
	}

	protected function afterFind()
	{
		$this->start_date = date('d/m/Y', strtotime($this->start_date));
		if ($this->end_date) {
			$this->end_date = date('d/m/Y', strtotime($this->end_date));
		}
        $baseUrl = Yii::app()->baseUrl;
        if ($this->image) {
            $this->image = "$baseUrl/repository/{$this->image}";
        } else {
            $this->image = $this->emptyImageUrl();
        }
		return parent::afterFind();
	}

    private function emptyImageUrl()
    {
        $baseUrl = Yii::app()->baseUrl;
        return "$baseUrl/images/noimage.gif";
    }
}
