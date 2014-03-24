<?php
class MyWebUser extends CWebUser
{
    /** @var User */
    private $_profile = null;

    public function init()
    {
        parent::init();

        if(!$this->isGuest) {
            /** @var $u User */
            $u = User::model()->findByPk($this->id);

            $this->_profile = $u;
        }
    }

    public function getProfile()
    {
        return $this->_profile;
    }

}