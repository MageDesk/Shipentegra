<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Sales\Model\Order\Item;

/**
 * Class ItemMapper
 */
class ItemMapper extends AbstractMapper
{
    /**
     * @param Item[] $data
     * @return array
     */
    public function map($data)
    {
        $newItems = [];
        foreach ($data as $item) {
            $newItem = [];
            $newItem['quantity'] = $item->getQtyOrdered();
            $newItem['unitPrice'] = $item->getPrice();
            $newItem['name'] = $item->getName();
            $newItem['sku'] = $item->getSku();
            $newItem['gtip'] = $item->getGtin();
            $newItems[] = $newItem;
        }
        return $newItems;
    }
}
