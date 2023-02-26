<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;

/**
 * Class GetTrackService
 */
class GetTrackService extends AbstractService
{
    /**
     * @var string
     */
    protected string $url = 'logistics/shipments/activities?trackingNumber=';

    /**
     * @var string
     */
    protected string $type = self::GET_METHOD;

    /**
     * @param string $orderId
     * @return $this
     */
    public function setOrderId(string $orderId): GetTrackService
    {
        $this->setUrl($this->getUrl() . $orderId);

        return $this;
    }
}
