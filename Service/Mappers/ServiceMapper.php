<?php
/*
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use MageDesk\ShipEntegra\Model\Data\ServiceInfo;
use Magento\Sales\Model\Order;
use MageDesk\ShipEntegra\Api\Data\ServiceInfoInterface;

/**
 * Class ServiceMapper
 */
class ServiceMapper
{
    public const MAP = [
        'EXPRESS' => 1,
        'ECO' => 2,
    ];

    /**
     * Providers
     */
    public const PROVIDER_DHL = 'dhlecommerce';
    public const PROVIDER_UPS = 'ups';
    public const PROVIDER_FEDEX = 'fedex';
    public const PROVIDER_SHIPENTEGRA = '';

    /**
     * @param Order $order
     * @return ServiceInfoInterface
     */
    public function map(Order $order): ServiceInfoInterface
    {
        $shippingMethod = $order->getShippingMethod();
        $shippingMethod = explode('_', $shippingMethod);
        $shippingInfo = new ServiceInfo();
        $shippingInfo->setCarrierCode($shippingMethod[0]);
        $shippingInfo->setMethodCode($shippingMethod[1]);
        $serviceTypeCode = self::MAP[$shippingMethod[2]];
        $shippingInfo->setService($serviceTypeCode);
        $shippingInfo->setProvider($this->getProvider($shippingMethod[1]));
        return $shippingInfo;
    }

    /**
     * @param string $info
     * @return string
     */
    private function getProvider(string $info)
    {
        if(strpos($info, self::PROVIDER_DHL) !== false) {
            return self::PROVIDER_DHL;
        }

        if(strpos($info, self::PROVIDER_UPS) !== false) {
            return self::PROVIDER_UPS;
        }

        if(strpos($info, self::PROVIDER_FEDEX) !== false) {
            return self::PROVIDER_FEDEX;
        }

        return self::PROVIDER_SHIPENTEGRA;
    }
}
