<?php

class Virtua_CustomerPoll_Adminhtml_WebController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customermenu')
            ->_title($this->__('Poll'));
        $this->renderLayout();

        $model = Mage::getModel('customerpoll/customerpoll');

        Zend_Debug::dump($model->load(1));
    }

//    public function indexxAction()
//    {
//        $this->loadLayout();
//        $this->renderLayout();
//
//        $model = Mage::getModel('customerpoll/customerpoll');
//        $vote = Mage::app()->getRequest()->getParam('storepoll');
//
//        if ($vote == 'yes' || $vote == 'no') {
//            if (empty($model->load($vote, 'option')->getOrigData())) {
//                $data = array(
//                    'option' => $vote,
//                    'count' => 1
//                );
//                $model->setData($data)->save();
//            } else {
//                $count = (int)$model->load($vote, 'option')->getOrigData()['count'];
//                $count = $count + 1;
//                $model->load($vote, 'option')->setData('count', $count)->save();
//            }
//        }
//    }
}