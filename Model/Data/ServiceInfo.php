<?php
/*
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

namespace MageDesk\ShipEntegra\Model\Data;

use MageDesk\ShipEntegra\Api\Data\ServiceInfoInterface;
use Magento\Framework\DataObject;

class ServiceInfo extends DataObject implements ServiceInfoInterface
{
    /**
     * Getter for MethodCode.
     *
     * @return string|null
     */
    public function getMethodCode(): ?string
    {
        return $this->getData(self::METHOD_CODE);
    }

    /**
     * Setter for MethodCode.
     *
     * @param string|null $methodCode
     *
     * @return void
     */
    public function setMethodCode(?string $methodCode): void
    {
        $this->setData(self::METHOD_CODE, $methodCode);
    }

    /**
     * Getter for CarrierCode.
     *
     * @return string|null
     */
    public function getCarrierCode(): ?string
    {
        return $this->getData(self::CARRIER_CODE);
    }

    /**
     * Setter for CarrierCode.
     *
     * @param string|null $carrierCode
     *
     * @return void
     */
    public function setCarrierCode(?string $carrierCode): void
    {
        $this->setData(self::CARRIER_CODE, $carrierCode);
    }

    /**
     * Getter for Service.
     *
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->getData(self::SERVICE) === null ? null
            : (int)$this->getData(self::SERVICE);
    }

    /**
     * Setter for Service.
     *
     * @param int|null $service
     *
     * @return void
     */
    public function setService(?int $service): void
    {
        $this->setData(self::SERVICE, $service);
    }

    /**
     * Getter for Provider.
     *
     * @return string|null
     */
    public function getProvider(): ?string
    {
        return $this->getData(self::PROVIDER);
    }

    /**
     * Setter for Provider.
     *
     * @param string|null $provider
     *
     * @return void
     */
    public function setProvider(?string $provider): void
    {
        $this->setData(self::PROVIDER, $provider);
    }
}
