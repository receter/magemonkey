<?php

/**
 * Cron controller
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_MageMonkey
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class Ebizmarts_MageMonkey_CronController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $before = strtotime(now());
        Mage::log($before, null, 'santiago.log', true);
        $cron = Mage::getModel('ebizmarts_abandonedcart/cron');
        $values = $cron->abandoned();
        Mage::log($values, null, 'santiago.log', true);
        //$delay = rand(5, 60);
        //sleep($delay);
        $numberResponse = rand(0, 1);
        if($numberResponse == 0){
            $responseCode = 500;
        }else{
            $responseCode = 200;
        }
        $after = strtotime(now());
        Mage::log($after, null, 'santiago.log', true);
        $delay = ($after - $before);
        $data = array();
        $data['code'] = $responseCode;
        $data['delay'] = $delay;
        $data = array_merge($data, $values);

        $this->getResponse()
            ->setHeader('Content-Type', 'application/json', true)
            ->setHttpResponseCode($responseCode)
            ->setBody(json_encode($data));
    }
}