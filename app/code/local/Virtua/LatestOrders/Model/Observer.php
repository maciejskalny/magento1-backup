<?php

class Virtua_LatestOrders_Model_Observer extends Varien_Event_Observer
{
    public function addToTopMenu(Varien_Event_Observer $observer)
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();

            $node = new Varien_Data_Tree_Node([
                'name' => 'Latest orders',
                'id' => 'latestorders',
                'url' => Mage::getBaseUrl() . '/latestorders',
            ], 'id', $tree, $menu);

            $menu->addChild($node);
        }
    }
}