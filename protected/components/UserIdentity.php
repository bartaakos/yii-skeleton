<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id = null;

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
        /** @var $record User */
        $record = User::model()->findByAttributes(array('username' => $this->username));
        $log = new Log();
        $log->user_id = $record !== null ? $record->id : null;
        $log->type = Log::TYPE_LOGIN;

        if ($record === null || ($record->status != User::STATUS_ACTIVE)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $log->info = 'invalid username: ' . $this->username;
        } elseif ($record->password !== $record->encrypt($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            $log->info = 'invalid password';
        } else {
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
            $log->info = 'success';
            Yii::app()->db->createCommand()->update('user', array('last_login_time' => new CDbExpression('NOW()')), 'id='.$record->id); // update_time nem frissul
        }
        $log->save(false);
        return !$this->errorCode;
    }

    /**
     * Returns the unique identifier for the identity.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Creates an authenticated user object
     * @static
     * @param  $id integer
     * @param  $username string
     * @return UserIdentity
     */
    public static function createAuthenticatedIdentity($id,$username)
    {
        $identity = new self($id, '');
        $identity->_id = $id;
        $identity->username = $username;
        $identity->errorCode = self::ERROR_NONE;
        return $identity;
    }
}