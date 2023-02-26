<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Sales\Model\Order\Item;
use MageDesk\ShipEntegra\Service\Endpoints\GetOrderService;

/**
 * Class ItemLabelMapper
 */
class ItemLabelMapper extends AbstractMapper
{
    /**
     * @var GetOrderService
     */
    private $getOrderService;

    /**
     * @var array
     */
    private $shipEntegraOrderItems;

    /**
     * @param GetOrderService $getOrderService
     */
    public function __construct(GetOrderService $getOrderService)
    {
        $this->getOrderService = $getOrderService;
    }

    /**
     * @param Item[] $data
     * @param string|null $orderId
     * @return array
     */
    public function map($data, $orderId = null)
    {
        $newItems = [];
        foreach ($data as $item) {
            $newItem = [];
            $newItem['declaredQuantity'] = $item->getQtyOrdered();
            $newItem['declaredPrice'] = $item->getPrice();
            $newItem['gtip'] = $item->getGtin() ?? 1;
            if($orderId) {
                $newItem['itemId'] = $this->getItemIdByOrder($orderId, $item->getSku());
            } else {
                $newItem['itemId'] = $item->getId();
            }
            $newItems[] = $newItem;
        }
        return $newItems;
    }

    /**
     * @param $orderId
     * @param $sku
     * @return mixed|null
     */
    private function getItemIdByOrder($orderId, $sku)
    {
        return $this->getShipentegraOrderItems($orderId)[$sku] ?? null;
    }

    /**
     * @param $orderId
     * @return array
     */
    private function getShipentegraOrderItems($orderId)
    {
        if($this->shipEntegraOrderItems){
            return $this->shipEntegraOrderItems;
        }

        $order = $this->getOrderService->setOrderId($orderId)->execute();
        $items = $order['generalInfo']['items'];
        $shipEntegraOrderItems = [];
        foreach ($items as $item) {
            $shipEntegraOrderItems[$item['sku']] = $item['itemId'];
        }
        $this->shipEntegraOrderItems = $shipEntegraOrderItems;
        return $shipEntegraOrderItems;
    }
}
