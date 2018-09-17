<?php
/**
 * Module block which supports admin panel.
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
 * Class Virtua_OrderMessage_Block_Adminhtml_OrderMessage
 */
class Virtua_OrderMessage_Block_Adminhtml_OrderMessage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor.
     */
    public function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'ordermessage';
        $this->_controller = 'adminhtml_ordermessage';
        $this->_headerText = Mage::helper('ordermessage')->__('Item Manager');
    }

    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('virtua_ordermessage_admin/ordermessage/edit');
    }
}
