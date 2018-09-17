<?php

class Virtua_LatestOrders_Block_LatestOrders extends Mage_Core_Block_Template
{

    public function prepareLatestClients()
    {
        $limit = 2;
        $modelOrders = Mage::getModel('sales/order');
        $collectionOrders = $modelOrders->getCollection();
        $modelCustomers = Mage::getModel('customer/customer');
        $lastItemId = (int)$collectionOrders->getLastItem()->getId();

        $latestClients = [];
        $count = 0;
        for ($i = $lastItemId; $i>0; $i--) {
            $validation = true;
            $newClient = $modelOrders->load($i)['customer_email'];

            foreach ($latestClients as $client) {
                if ($client == $newClient) {
                    $validation = false;
                    break;
                }
            }

            if ($validation) {
                $latestClients[$i] = $newClient;
                $count++;
                if ($count == $limit) {
                    break;
                }
            }
        }

        foreach ($latestClients as $client) {
            echo '<a href="#">'.$client.'</a><br><br>';
            $this->prepareClientOrders($client);
            echo '<br><br>';
        }
    }

    public function prepareClientOrders($email)
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $client = $collection->addFieldToFilter('customer_email', $email)->getColumnValues('entity_id', 'base_grand_total', 'weight');

        foreach($client as $row)
        {
            echo 'ID: '.$row['entity_id'].' Price: '.$row['base_grand_total'].' Weight: '.$row['weight'].'<br>';
        }

    }

}