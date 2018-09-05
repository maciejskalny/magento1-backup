<?php

class Virtua_CustomerPoll_IndexController extends Mage_Core_Controller_Front_Action
{
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
