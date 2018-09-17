<?php
/**
 * This file is a controller of frontend module actions.
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
 * Class Virtua_OrderMessage_IndexController
 */
class Virtua_OrderMessage_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Rendering main layout.
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
