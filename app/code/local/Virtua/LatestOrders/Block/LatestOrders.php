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

        return $latestClients;
    }

    public function prepareClientOrders($email)
    {
        $orders = Mage::getResourceModel('sales/order_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_email', $email);

        return $orders;
    }

    public function showClientsOrders()
    {
        $number = 0;
        foreach ($this->prepareLatestClients() as $client) {
            $number++;

            echo '<div class="card"><div class="card-header" id="heading'.$number.'"><h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$number.'" aria-expanded="true" aria-controls="collapse'.$number.'">'.
                  $client.'</button></h5></div>
                  <div id="collapse'.$number.'" class="collapse show" aria-labelledby="heading'.$number.'" data-parent="#accordion"><div class="card-body">';

            foreach ($this->prepareClientOrders($client) as $order) {
                echo $order['entity_id'].' '.$order['weight'].'<br>';
            }

            echo '</div></div></div>';
        }
    }
}
