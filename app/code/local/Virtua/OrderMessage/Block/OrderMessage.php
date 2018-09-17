<?php
/**
 * Module block which supports frontend.
 *
 * PHP version 7.1.21
 *
 * @category  Block
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_OrderMessage_Block_OrderMessage
 */
class Virtua_OrderMessage_Block_OrderMessage extends Mage_Core_Block_Template
{
    /**
     * @return array
     */
    public function prepareTopics()
    {
        $topics = Mage::getModel('ordermessage/ordermessagetopic')->getCollection()->getData();
        return $topics;
    }
}
