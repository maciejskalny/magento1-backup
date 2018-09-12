<?php

class Virtua_OrderMessage_Model_Resource_OrderMessageTopic extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('ordermessage/ordermessagetopic', 'topic_id');
    }
}