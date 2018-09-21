<?php
/**
 * This file is an event observer.
 *
 * PHP version 7.1.21
 *
 * @category  Model
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_OrderMessage_Model_Observer
 */
class Virtua_OrderMessage_Model_Observer extends Varien_Event_Observer
{
    /**
     * @param $observer
     */
    public function saveOrderMessage($observer)
    {
        $collectionTopic = Mage::getModel('ordermessage/ordermessagetopic')->getCollection();

        $order      = $observer->getEvent()->getOrder();
        $orderId    = $order->getId();
        $customerId = $order->getCustomerId();
        $topicId    = Mage::app()->getRequest()->getParam('ordermessage-topic', '');
        $message    = Mage::app()->getRequest()->getParam('ordermessage-message', '');

        $validation = null;

        if ($topicId != 0 && !empty($collectionTopic->addFieldToFilter('topic_id', $topicId)->getColumnValues('topic')) && $message != null) {
            $validation = true;
        } elseif ($topicId == null && $message != null) {
            $validation = true;
        }

        if ($validation) {
            $data = [
                'order_id'    => $orderId,
                'customer_id' => $customerId,
                'topic_id'    => $topicId,
                'message'     => $message
            ];

            $modelMessage = Mage::getModel('ordermessage/ordermessage');
            $modelMessage->setData($data)->save();
        }
    }
}
