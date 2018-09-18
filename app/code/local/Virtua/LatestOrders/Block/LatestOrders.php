<?php
/**
 * This file is a block which supports showing latest customers.
 *
 * PHP version 7.1.21
 *
 * @category  Block
 * @package   Virtua_Internship
 * @author    Maciej Skalny <contact@wearevirtua.com>
 * @copyright 2018 Copyright (c) Virtua (http://wwww.wearevirtua.com)
 * @license   GPL http://opensource.org/licenses/gpl-license.php
 * @link      https://bitbucket.org/wearevirtua/magento1ms/
 */

/**
 * Class Virtua_LatestOrders_Block_LatestOrders
 */
class Virtua_LatestOrders_Block_LatestOrders extends Mage_Core_Block_Template
{
    /**
     * @return array
     */
    public function prepareLatestClients()
    {
        $modelOrders = Mage::getModel('sales/order');
        $collectionOrders = $modelOrders->getCollection();

        $limit = 10;
        $lastId = (int)$collectionOrders->getLastItem()->getId();
        $count = 0;

        for ($i = $lastId; $i > 0; $i --) {
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

    /**
     * @param $email
     * @return array
     */
    public function prepareClientOrders($email)
    {
        $orders = Mage::getResourceModel('sales/order_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_email', $email);

        return $orders;
    }

    /**
     * Shows latest clients with orders on frontend.
     */
    public function showClientsOrders()
    {
        $number = 0;

        foreach ($this->prepareLatestClients() as $client) {
            $number++;

            echo '<div class="card"><div class="card-header" id="heading'.$number.'"><h5 class="mb-0">

                  <button class="btn btn-link" data-toggle="collapse" 
                    data-target="#collapse'.$number.'" aria-expanded="true" aria-controls="collapse'.$number.'">'.
                $client.' ('.count($this->prepareClientOrders($client)).')</button></h5></div>
                    
                  <div id="collapse'.$number.'" class="collapse" 
                    aria-labelledby="heading'.$number.'" data-parent="#accordion"><div class="card-body">';

            foreach ($this->prepareClientOrders($client) as $order) {
                echo '<div class="row"><div class="col"><span class="badge badge-dark">Order ID</span> '.
                        $order['entity_id'].
                     '</div>

                      <div class="col"><span class="badge badge-light">Price</span> '.
                        $order['base_grand_total'].
                     '</div>
                      
                      <div class="col"><span class="badge badge-light">Shipping amount</span> '.
                        $order['base_shipping_amount'].
                     '</div>
                      
                      <div class="col"><span class="badge badge-secondary">Weight</span> '.
                        $order['weight'].
                     '</div></div><hr>';
            }

            echo '</div></div></div>';
        }
    }
}
