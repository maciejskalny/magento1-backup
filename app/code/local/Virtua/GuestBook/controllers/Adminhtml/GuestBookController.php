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
                ->__('Guest Book'), Mage::helper('adminhtml')->__('Guest Book'));

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

    public function sendWelcomeEmailAction()
    {
        $guests = $this->getRequest()->getParam('guests');


            $model = Mage::getModel('guestbook/guestbook');
            $collection = $model->getCollection();

            foreach ($guests as $guest)
            {
                $entity = $collection->addFieldToFilter('guest_id', $guest)->getFirstItem();

                if ($entity['is_welcome_email_send'] == 'no') {
                    $mail = Mage::getModel('core/email')
                        ->setToEmail($entity['email'])
                        ->setBody('Hello, have a nice day!')
                        ->setSubject('Magento1ms guest book')
                        ->setFromEmail('office@magentoms.com')
                        ->setFromName('Magentoms')
                        ->setType('html');
                    $mail->send();
                    $entity->setData('is_welcome_email_send', 'yes')->save();
                }
            }

        $this->_redirect('*/*/index');
    }
}
