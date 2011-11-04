<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 */
class User extends CActiveRecord
{
	public $repeatpassword;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, repeatpassword', 'required'),
			array('username, password, repeatpassword', 'length', 'max'=>255),
			array('username', 'filter', 'filter'=>'strtolower'),
			array('password', 'compare', 'compareAttribute' => 'repeatpassword'),
			array('username', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => Yii::t('login', 'Username'),
			'password' => Yii::t('login', 'Password'),
			'repeatpassword' => Yii::t('login', 'Repeat Password'),
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$salt = $this->generateKey();
		$this->setAttribute('salt', $salt);
		$this->setAttribute('password', sha1("{$this->password}$salt"));
		return parent::beforeSave();
	}

	private function generateKey($length = 16) {
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= chr(mt_rand(33, 126));
		}
		return $key;
	}

}
