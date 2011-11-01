<?php

/**
 * This is the model class for table "tbl_document".
 *
 * The followings are the available columns in table 'tbl_document':
 * @property integer $id
 * @property string $document
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property DocumentCharacter[] $documentCharacters
 * @property DocumentInstitution[] $documentInstitutions
 * @property DocumentEvent[] $documentEvents
 */
class Document extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Document the static model class
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
		return 'tbl_document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document, name', 'required'),
			array('name, catalog', 'length', 'max'=>255),
			array('description, language_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, document, name, catalog, description, language_id', 'safe', 'on'=>'search'),
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
			'documentCharacters' => array(self::HAS_MANY, 'DocumentCharacter', 'document_id'),
			'documentInstitutions' => array(self::HAS_MANY, 'DocumentInstitution', 'document_id'),
			'documentEvents' => array(self::HAS_MANY, 'DocumentEvent', 'document_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'document' => 'Document',
			'name' => 'Name',
			'catalog' => 'Catalog',
			'description' => 'Description',
			'language_id' => 'Language'
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
		$criteria->compare('document',$this->document,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('catalog',$this->catalog,true);
		$criteria->compare('language_id',$this->catalog,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function afterFind()
	{
        $baseUrl = Yii::app()->baseUrl;
        if ($this->document) {
            $this->document = "$baseUrl/repository/{$this->document}";
        } else {
            $this->document = "$baseUrl/images/noimage.gif";
        }
		return parent::afterFind();
	}
}
