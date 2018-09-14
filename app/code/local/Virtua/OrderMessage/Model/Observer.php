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
        Mage::log(Mage::app()->getRequest()->getParams());
//        $order = $evt->getOrder();
//        $model = Mage::getModel('custom/custom_order');
//        $data = $model->getByOrder($order->getId());
//        foreach($data as $key => $value){
//            $order->setData($key,$value);
//        }

        $order = $observer->getEvent()->getOrder();
        $orderIds = $order->getId();

        Mage::log($orderIds);

        $data = array(
            'order_id' => $orderIds,
            'customer_id' => 2,
            'topic_id' => 3,
            'message' => 'To jest testowa wiadomosc'
        );

        $model = Mage::getModel('ordermessage/ordermessage');
        $model->setData($data)->save();
    }
}