<?php
/**
 * This file is an event observer.
 *
 * PHP version 7.1.21
 *
 * @category  Observer
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_LatestOrders_Model_Observer
 */
class Virtua_LatestOrders_Model_Observer extends Varien_Event_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
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
