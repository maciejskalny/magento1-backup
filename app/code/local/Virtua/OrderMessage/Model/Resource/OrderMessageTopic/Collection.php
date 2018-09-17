<?php
/**
 * This file is a order message topics collection.
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
 * Class Virtua_OrderMessage_Model_Resource_OrderMessageTopic_Collection
 */
class Virtua_OrderMessage_Model_Resource_OrderMessageTopic_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Class contructor.
     */
    public function _construct()
    {
        $this->_init('ordermessage/ordermessagetopic');
    }
}
