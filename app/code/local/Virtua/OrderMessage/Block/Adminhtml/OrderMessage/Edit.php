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
 * Class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit
 */
class Virtua_OrderMessage_Block_Adminhtml_OrderMessage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'ordermessage';
        $this->_controller = 'adminhtml_ordermessage';
        $this->_mode       = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');

        $this->_headerText = $newOrEdit . ' ' . $this->__('Topic');
    }
}
