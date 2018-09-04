<?php

class Virtua_CustomerPoll_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        $vote = Mage::app()->getRequest()->getParam('storepoll');

        if ($vote == "yes" || $vote == "no") {
            $resource = Mage::getSingleton('core/resource');
            $table = $resource->getTableName('customerpoll');
            $writeAdapter = $resource->getConnection('core_write');
            $readAdapter = $resource->getConnection('core_read');

            $select = "SELECT `option_id` FROM `customerpoll` WHERE `option`='{$vote}';";
            $row = $readAdapter->fetchAll($select);

            if(empty($row))
            {
                $query = "INSERT INTO {$table} (`option`,`count`) VALUES ('{$vote}', 1);";
                $writeAdapter->query($query);
            } else {
                $count = "SELECT `count` FROM `customerpoll` WHERE `option`='{$vote}';";
                $count = $readAdapter->fetchAll($count);
                $count = $count['count']+1;
                $query = "UPDATE {$table} SET `count` = '{$count}' WHERE `option` = '{$vote}';";
                $writeAdapter->query($query);
            }
        }
    }
}
