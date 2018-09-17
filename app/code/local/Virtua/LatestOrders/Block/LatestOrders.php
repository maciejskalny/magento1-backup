<?php

class Virtua_LatestOrders_Block_LatestOrders extends Mage_Core_Block_Template
{

    public function prepareLatestClients()
    {
        $model = Mage::getModel('sales/order');
        $collection = $model->getCollection();

        $lastItemId = (int)$collection->getLastItem()->getId();
        $start = $lastItemId - 9;

        for($i = $start; $i<=$lastItemId; $i++)
        {
            //echo $i."<br>";
            $tab = $model->load($i);
            Zend_Debug::dump($tab['base_grand_total']);
        }

        //Zend_Debug::dump($lastItemId);

    }
}