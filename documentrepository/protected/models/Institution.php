<?php

/**
 * This is the model class for table "tbl_institution".
 *
 * The followings are the available columns in table 'tbl_institution':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 *
 * The followings are the available model relations:
 * @property DocumentInstitution[] $documentInstitutions
 */
class Institution extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Institution the static model class
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
		return 'tbl_institution';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name, image', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, image', 'safe', 'on'=>'search'),
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
			'documentInstitutions' => array(self::HAS_MANY, 'DocumentInstitution', 'institution_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'image' => Yii::t('app', 'Image'),
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
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
        if ($this->image == $this->emptyImageUrl()) {
            $this->image = null;
        } else {
            $this->image = basename($this->image);
        }
		return parent::beforeSave();
	}

	protected function afterFind()
	{
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
