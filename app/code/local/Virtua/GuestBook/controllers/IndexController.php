<?php

class Virtua_GuestBook_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        $model = Mage::getModel('guestbook/guestbook');
        $params = Mage::app()->getRequest()->getParams();
        //if(!empty($params['email']))
        //Mage::log($params, null, 'guestbook.log', true);

        if (!empty($params['name']) && !empty($params['lastname']) && !empty($params['email'])) {
            $data = [
                'name' => $params['name'],
                'lastname' => $params['lastname'],
                'email' => $params['email'],
                'ip_address' => '192.168.0.1'
            ];

            $model->setData($data)->save();
            Mage::getSingleton('core/session')->addSuccess('Success! You are in guest book!');
        } else {
            Mage::getSingleton('core/session')->addError('Error! Something went wrong!');
        }

        $this->_redirect('guestbook');
    }
}