<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = User::model()->find(array('select'    => 'salt',
											  'condition' => 'username = :username',
											  'params'    => array(':username' => $this->username)));
		if ($username === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			return false;
		}
		$login = User::model()->find(array('select'    => '*',
										   'condition' => 'username = :username and password = :password',
										   'params'    => array(':username' => $this->username,
																':password' => sha1("{$this->password}{$username->salt}"))));
		if ($login === null) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			return false;
		}
		$this->errorCode=self::ERROR_NONE;
		return true;
	}
}
