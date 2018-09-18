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

        $this->showLatestClients($latestClients);
    }

    public function prepareClientOrders($email)
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $client = $collection->addFieldToFilter('customer_email', $email)->getColumnValues('entity_id', 'base_grand_total', 'weight');
        return $client;
    }

    public function showLatestClients($latestClients)
    {
        foreach ($latestClients as $client) {
            echo '<div class="dropdown"><button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.
                $client.'</button><div class="dropdown-menu">';

            foreach ($this->prepareClientOrders($client) as $order) {
                echo '<button class="dropdown-item" type="button"> ID: '.$order['entity_id'].' Price: '.$order['base_grand_total'].' Weight: '.$order['weight'].'</button>';
            }

            echo '</div></div>';
        }
    }

}