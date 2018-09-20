<?php
/**
 * This file is preparing columns for guest book grid.
 *
 * PHP version 7.1.21
 *
 * @category  Grid
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_GuestBook_Block_Adminhtml_GuestBook_Grid
 */
class Virtua_GuestBook_Block_Adminhtml_GuestBook_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('guestbook/guestbook')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('guest_id', array(
            'header' => Mage::helper('guestbook')->__('ID'),
            'index'  => 'guest_id'
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('guestbook')->__('Name'),
            'index'  => 'name'
        ));

        $this->addColumn('lastname', array(
            'header' => Mage::helper('guestbook')->__('Lastname'),
            'index'  => 'lastname'
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('guestbook')->__('Email'),
            'index'  => 'email'
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('guestbook')->__('IP Address'),
            'index'  => 'ip_address'
        ));

        return parent::_prepareColumns();
    }
}
