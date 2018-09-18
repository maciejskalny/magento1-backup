<?php

class Virtua_GuestBook_Model_GuestBook extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('guestbook/guestbook');
    }
}