<?php

class Virtua_OrderMessage_Model_Observer extends Varien_Event_Observer
{
    /**
     *
     * This function is called when $order->load() is done.
     * Here we read our custom fields value from database and set it in order object.
     * @param unknown_type $evt
     */
    public function saveOrderMessage($observer)
    {
        $message = 'test';

        $order = $observer->getEvent()->getOrder();

        $orderId = $order->getId();
        $orderCustomer = $order->getCustomerId();

        Mage::log(Mage::app()->getRequest()->getParams(), null, 'system.log', true);
        //Mage::log($test, null, 'system.log', true);

        //$param = Mage::app()->getRequest()->getParam('namespace_reviewfield', '');

        $param = Mage::app()->getRequest()->getParam('namespace_reviewfield', '');
        //$observer->getEvent-getOrder()->setMyField((string) $param);


        //$observer->getOrder()->setMyField((string) $param);

        $data = array(
            'order_id' => $orderId,
            'customer_id' => $orderCustomer,
            'topic_id' => 3,
            'message' => $param
        );

        $model = Mage::getModel('ordermessage/ordermessage');
        $model->setData($data)->save();
    }
}