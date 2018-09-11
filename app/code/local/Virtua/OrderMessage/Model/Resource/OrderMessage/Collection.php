<?php

class Virtua_OrderMessage_Model_Resource_OrderMessage_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('ordermessage/ordermessage');
    }
}