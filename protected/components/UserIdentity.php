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
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			// 'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username])) {
			$url = "http://listoprototype.apphb.com/ListoUser.svc/LoginCustomer";
			try {
				$data = array(
					'UserName'=>$this->username,
					'UserPassword'=>$this->password,
					);
				$curl = Yii::app()->curl;
				$curl->setOption(CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
				$data = $curl->post($url, json_encode($data));
				$data = json_decode($data, true);
				if (!isset($data['Data']))
					throw new Exception("Login page error");

				if (!$data['Data'])
					$this->errorCode=self::ERROR_USERNAME_INVALID;
				else
					$this->errorCode=self::ERROR_NONE;
			} catch (Exception $e) {
				throw new CHttpException($e->getMessage());
			}
		} else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;

		return !$this->errorCode;
	}
}