<?php
/**
 * This file is a controller which supports admin panel actions.
 *
 * PHP version 7.1.21
 *
 * @category  Controller
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_GuestBook_Adminhtml_GuestBookController
 */
class Virtua_GuestBook_Adminhtml_GuestBookController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('guestbook/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')
                ->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    /**
     * Rendering layout.
     */
    public function indexAction()
    {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('guestbook/adminhtml_guestbook'));
        $this->renderLayout();
    }

    /**
     * Creates grid.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('importedit/adminhtml_ordermessage_grid')->toHtml()
        );
    }
}