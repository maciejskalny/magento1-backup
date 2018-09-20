<?php
/**
 * This file is a controller which supports frontend module actions.
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
 * Class Virtua_GuestBook_IndexController
 */
class Virtua_GuestBook_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Rendering guest book page.
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Saves guest to guest book.
     */
    public function saveAction()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            $model = Mage::getModel('guestbook/guestbook');
            $params = Mage::app()->getRequest()->getParams();

            if (!empty($params['name']) && !empty($params['lastname']) && !empty($params['email'])) {
                $data = [
                    'name' => $params['name'],
                    'lastname' => $params['lastname'],
                    'email' => $params['email'],
                    'ip_address' => Mage::helper('core/http')->getRemoteAddr(false)
                ];
                $model->setData($data)->save();

                Mage::getSingleton('core/session')->addSuccess('Success! You are in guest book!');
                $this->sendEmail($params['name'], $params['lastname'], $params['email']);
            } else {
                Mage::getSingleton('core/session')->addError('Error! Something went wrong!');
            }
        }
        $this->_redirect('guestbook');
    }

    public function sendEmail($name, $lastname, $email)
    {
        $html = "To jest testowa wiadomosc";

        $content =
            '<h2>Hello '.$name.' '.$lastname.'!</h2><p>Welcome to our guest book! Create an account as fast as possible and start shopping!</p>';

        $mail = Mage::getModel('core/email');
        $mail->setToName($name.' '.$lastname);
        $mail->setToEmail('m.skalny@wearevirtua.com');
        $mail->setBody($content);
        $mail->setSubject('Welcome to Guest Book');
        $mail->setFromEmail('office@magentoms.com');
        $mail->setType('html');
        $mail->setBodyHTML($html);

        try {
            $mail->send();
            Mage::getSingleton('core/session')->addSuccess('Your request has been sent');
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to send');
            $this->_redirect('');
        }
    }
}
