<?php
/**
 * This file supports actions of 'Customer' option in admin panel
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
 * Class Virtua_CustomerPoll_Adminhtml_AdminCustomerPollController
 */
class Virtua_CustomerPoll_Adminhtml_AdminCustomerPollController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Rendering poll layout
     */
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customermenu')
            ->_title($this->__('Poll'));
        $this->renderLayout();
    }
}
