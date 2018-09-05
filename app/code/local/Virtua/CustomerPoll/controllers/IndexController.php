<?php
/**
 * This file supports customer poll actions on frontend
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
 * Class Virtua_CustomerPoll_IndexController
 */
class Virtua_CustomerPoll_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Rendering layout and supports poll actions on database
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        $model = Mage::getModel('customerpoll/customerpoll');
        $vote = Mage::app()->getRequest()->getParam('storepoll');

        if ($vote == 'yes' || $vote == 'no') {
            if (empty($model->load($vote, 'option')->getOrigData())) {
                $data = array(
                    'option' => $vote,
                    'count' => 1
                );
                $model->setData($data)->save();
            } else {
                $count = (int)$model->load($vote, 'option')->getOrigData()['count'];
                $count = $count + 1;
                $model->load($vote, 'option')->setData('count', $count)->save();
            }
        }
    }
}
