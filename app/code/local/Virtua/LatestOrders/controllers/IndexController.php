<?php

class Virtua_LatestOrders_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if(!Mage::getSingleton('customer/session')->isLoggedIn()){
            $this->_redirect("customer/account/login");
        }

        $this->loadLayout();
        $this->renderLayout();
    }
}