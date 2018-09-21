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
 * Class Virtua_OrderMessage_Adminhtml_OrderMessageController
 */
class Virtua_OrderMessage_Adminhtml_OrderMessageController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('ordermessage/items')
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
        $this->_addContent($this->getLayout()->createBlock('ordermessage/adminhtml_ordermessage'));
        $this->renderLayout();
    }

    /**
     * @throws Mage_Core_Exception
     */
    public function editAction()
    {
        $ordermessageId    = $this->getRequest()->getParam('id');
        $ordermessageModel = Mage::getModel('ordermessage/ordermessagetopic')->load($ordermessageId);

        if ($ordermessageModel->getId() || $ordermessageId == 0) {
            Mage::register('ordermessage_data', $ordermessageModel);
            $this->loadLayout();
            $this->_setActiveMenu('ordermessage/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')
                ->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')
                ->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('ordermessage/adminhtml_ordermessage_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ordermessage')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * Supports creating and editing.
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Supports saving.
     */
    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $postData          = $this->getRequest()->getPost();
                $ordermessageModel = Mage::getModel('ordermessage/ordermessagetopic');
                $ordermessageModel->setId($this->getRequest()->getParam('id'))
                    ->setTopic($postData['topic'])->save();

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setOrderMessageData(false);
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setOrderMessageData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * Supports removing.
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $ordermessageModel = Mage::getModel('ordermessage/ordermessagetopic');
                $ordermessageModel->setId($this->getRequest()->getParam('id'))->delete();

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            }
        }

        $this->_redirect('*/*/');
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
