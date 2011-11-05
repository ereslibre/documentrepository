<?php

/**
 * This is the model class for table "tbl_character".
 *
 * The followings are the available columns in table 'tbl_character':
 * @property integer $id
 * @property string $name
 * @property string $birth_date
 * @property string $death_date
 * @property string $biography
 * @property string $image
 *
 * The followings are the available model relations:
 * @property CharacterAlias[] $characterAliases
 * @property CharacterPosition[] $characterPositions
 * @property DocumentCharacter[] $documentCharacters
 */
class Character extends CActiveRecord
{
	public $from_position0;
	public $to_position0;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Character the static model class
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
		return 'tbl_character';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, birth_date', 'required'),
			array('name, image', 'length', 'max'=>255),
			array('death_date, biography', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, birth_date, death_date, biography, image', 'safe', 'on'=>'search'),
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
			'characterAliases' => array(self::HAS_MANY, 'CharacterAlias', 'character_id'),
			'characterPositions' => array(self::HAS_MANY, 'CharacterPosition', 'character_id'),
			'documentCharacters' => array(self::HAS_MANY, 'DocumentCharacter', 'character_id'),
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
			'birth_date' => Yii::t('characters', 'Birth Date'),
			'death_date' => Yii::t('characters', 'Death Date'),
			'biography' => Yii::t('characters', 'Biography'),
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
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('death_date',$this->death_date,true);
		$criteria->compare('biography',$this->biography,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$birthDate = DateTime::createFromFormat('d/m/Y', $this->birth_date);
		$this->birth_date = date('Y-m-d', $birthDate->getTimestamp());
		if (!empty($this->death_date) && $this->death_date != Yii::t('app', 'To present')) {
			$deathDate = DateTime::createFromFormat('d/m/Y', $this->death_date);
			$this->death_date = date('Y-m-d', $deathDate->getTimestamp());
		} else {
            $this->death_date = null;
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
		$this->birth_date = date('d/m/Y', strtotime($this->birth_date));
		if (!empty($this->death_date)) {
			$this->death_date = date('d/m/Y', strtotime($this->death_date));
		} else {
            $this->death_date = Yii::t('app', 'To present');
        }
        $baseUrl = Yii::app()->baseUrl;
        if (!empty($this->image)) {
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
