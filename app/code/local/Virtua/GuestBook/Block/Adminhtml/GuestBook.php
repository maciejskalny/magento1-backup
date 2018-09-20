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
 * Class Virtua_GuestBook_Block_Adminhtml_GuestBook
 */
class Virtua_GuestBook_Block_Adminhtml_GuestBook extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor.
     */
    public function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'guestbook';
        $this->_controller = 'adminhtml_guestbook';
        $this->_headerText = Mage::helper('guestbook')->__('Guest Book');
    }
}