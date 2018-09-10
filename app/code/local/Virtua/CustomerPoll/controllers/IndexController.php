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

        $collectionQuestions = Mage::getModel('customerpoll/customerpollquestions')->getCollection();
        $poll = $collectionQuestions->addFieldToFilter('customerpoll_id', 12)->getColumnValues('question');
    }

    /**
     * Saving poll results
     */
    public function saveAction()
    {
        $model = Mage::getModel('customerpoll/customerpoll');
        $vote = Mage::app()->getRequest()->getParam('storepoll');
        $pollNumber = Mage::app()->getRequest()->getParam('pollnumber');

        $collectionQuestions = Mage::getModel('customerpoll/customerpollquestions')->getCollection();
        $poll = $collectionQuestions->addFieldToFilter('customerpoll_id', $pollNumber)->getColumnValues('question');

        if (!empty($poll)) {
            if ($vote == 'yes' || $vote == 'no') {
                $entity = $model->getCollection()
                    ->addFieldToFilter('customerpoll_id', $pollNumber)
                    ->addFieldToFilter('option', $vote)
                    ->getFirstItem();

                if ($entity['option'] == null) {
                    $data = array(
                        'customerpoll_id' => $pollNumber,
                        'option' => $vote,
                        'count' => 1
                    );
                    $model->setData($data)->save();
                } else {
                    $count = (int)$entity['count'];
                    $count = $count + 1;
                    $entity->setData('count', $count)->save();
                }

                Mage::getSingleton('core/session')->addSuccess('Success! Your vote has been saved.');
            } else {
                Mage::getSingleton('core/session')->addError('Error! You can choose only yes or no.');
            }

            $this->_redirect('customerpoll');
        } else {
            Mage::getSingleton('core/session')->addError('Error! There is no question with that id.');
        }
    }
}
