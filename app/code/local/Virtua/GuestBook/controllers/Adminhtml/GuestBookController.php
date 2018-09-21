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

    /**
     * Admin mass action. Sending welcome emails.
     */
    public function sendWelcomeEmailAction()
    {
        try {
            $guests = $this->getRequest()->getParam('massaction');
            $model = Mage::getModel('guestbook/guestbook');
            $collection = $model->getCollection();
            $fail = 0;

            foreach ($guests as $guest) {
                $entity = $model->load($guest);

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
                } else {
                    $fail++;
                }
            }

            if ($fail == 0) {
                Mage::getSingleton('adminhtml/session')->addSuccess('Success!');
            } elseif ($fail == sizeof($guests)) {
                Mage::getSingleton('adminhtml/session')
                    ->addError('Something goes wrong. All emails were to customers that received emails before.');
            } else {
                Mage::getSingleton('adminhtml/session')
                    ->addWarning(
                        'Something goes wrong. There were '. $fail.
                        ' emails to customers that received emails before. Messages to others have been sent.'
                    );
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

        $this->_redirect('*/*/index');
    }
}
