<?php
/**
 * This file is a order message model.
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
 * Class Virtua_OrderMessage_Model_OrderMessage
 */
class Virtua_OrderMessage_Model_OrderMessage extends Mage_Core_Model_Abstract
{
    /**
     * Class constructor.
     */
    protected function _construct()
    {
        $this->_init('ordermessage/ordermessage');
    }
}
