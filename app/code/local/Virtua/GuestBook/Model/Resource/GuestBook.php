<?php

class Virtua_GuestBook_Model_Resource_GuestBook extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('guestbook/guestbook', 'guest_id');
    }
}