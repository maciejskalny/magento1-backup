<?php

class Virtua_CustomerPoll_Adminhtml_WebController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customermenu')
            ->_title($this->__('Poll'));
        $this->renderLayout();
    }
}