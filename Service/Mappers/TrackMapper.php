<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;
use Magento\Sales\Model\Order\Item;
use Magento\Shipping\Model\Tracking\Result\AbstractResult;

/**
 * Class ItemMapper
 */
class TrackMapper extends AbstractMapper
{
    /**
     * @param Item[] $data
     * @return array
     */
    public function map($data)
    {
        $info = new \Magento\Shipping\Model\Tracking\Result();
        $trackinfo = new AbstractResult();
        $trackinfo->setStatus($data['status']);
        $trackinfo->setService($data['summary']);
        $trackinfo->setTracking($data['trackingNumber']);
        $info->append($trackinfo);
        return $info;
    }
}
