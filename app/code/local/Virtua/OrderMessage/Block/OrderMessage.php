<?php

class Virtua_OrderMessage_Block_OrderMessage extends Mage_Core_Block_Template
{
    public function prepareTopics()
    {
        $topics = Mage::getModel('ordermessage/ordermessagetopic')->getCollection()->getData();
        return $topics;
    }
}