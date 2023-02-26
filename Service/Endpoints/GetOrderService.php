<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;

/**
 * Class GetOrderService
 */
class GetOrderService extends AbstractService
{
    /**
     * @var string
     */
    protected string $url = 'orders/manual';

    /**
     * @var string
     */
    protected string $type = self::GET_METHOD;

    /**
     * @param string $orderId
     * @return $this
     */
    public function setOrderId(string $orderId): GetOrderService
    {
        $this->setUrl($this->getUrl() . '/' . $orderId);

        return $this;
    }

}
