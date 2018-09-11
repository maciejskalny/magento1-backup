<?php

class Virtua_OrderMessage_Model_Observer extends Varien_Event_Observer
{
    public function saveOrderMessage($observer)
    {
        $event = $observer->getEvent();
        $model = $event->getPage();

        Zend_Debug::dump($model->getData());
        die();
    }
}