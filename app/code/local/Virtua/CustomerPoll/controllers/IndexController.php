<?php

class Virtua_CustomerPoll_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {

//        $block = $this->getLayout()->createBlock('core/template');
//
//        $block->setTemplate('wishlist/view.phtml');
//
//        echo $block->toHtml();

        $this->loadLayout();
        $this->renderLayout();

        //Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());

    }
}

