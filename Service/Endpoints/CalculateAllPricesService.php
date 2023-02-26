<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;

/**
 * Class CalculateAllPricesService
 */
class CalculateAllPricesService extends AbstractService
{
    /**
     * @var string
     */
    protected string $url = 'tools/calculate/all';

    /**
     * @var string
     */
    public const COUNTRY_CODE = 'country';
    public const DESI_VALUE = 'kgDesi';

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): CalculateAllPricesService
    {
        $this->setBodyParam(self::COUNTRY_CODE, $countryCode);

        return $this;
    }

    /**
     * @param float $desiValue
     * @return $this
     */
    public function setDesi(float $desiValue): CalculateAllPricesService
    {
        $this->setBodyParam(self::DESI_VALUE, $desiValue);

        return $this;
    }
}
