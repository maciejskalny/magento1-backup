<?php

class Virtua_CustomerPoll_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        $resource = Mage::getSingleton('core/resource');
        $writeAdapter = $resource->getConnection('core_write');
        $table = $resource->getTableName('customerpoll');

        $query = "INSERT INTO {$table} (`option`,`count`) VALUES ('yes', 0);";
        $writeAdapter->query($query);
    }
}

