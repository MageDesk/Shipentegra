<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;

/**
 * Class CreateOrder
 */
class CreateOrderService extends AbstractService
{
    /**
     * @var string
     */
    protected string $url = 'orders/manual';

    /**
     * @var string
     */
    public const SHIPPING_ADDRESS = 'shippingAddress';
    public const DESCRIPTION = 'description';
    public const SERVICE = 'service';
    public const CURRENCY = 'currency';
    public const ITEMS = 'items';
    public const PACKAGE_QUANTITY = 'packageQuantity';
    public const WEIGHT = 'weight';
    public const WIDTH = 'width';
    public const HEIGHT = 'height';
    public const LENGTH = 'length';
    public const REFERENCE_1 = 'reference1';
    public const IOSS_NUMBER = 'iossNumber';
    public const REMEMBER_MY_ADDRESS = 'rememberMyAddress';
    public const ADDRESS_NAME = 'addressName';

    /**
     * @param array $shippingAddress
     * @return $this
     */
    public function setShippingAddress(array $shippingAddress): CreateOrder
    {
        $this->setBodyParam(self::SHIPPING_ADDRESS, $shippingAddress);

        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): CreateOrder
    {
        $this->setBodyParam(self::DESCRIPTION, $description);

        return $this;
    }

    /**
     * @param string $service
     * @return $this
     */
    public function setService(string $service): CreateOrder
    {
        $this->setBodyParam(self::SERVICE, $service);

        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): CreateOrder
    {
        $this->setBodyParam(self::CURRENCY, $currency);

        return $this;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items): CreateOrder
    {
        $this->setBodyParam(self::ITEMS, $items);

        return $this;
    }

    /**
     * @param int $packageQuantity
     * @return $this
     */
    public function setPackageQuantity(int $packageQuantity): CreateOrder
    {
        $this->setBodyParam(self::PACKAGE_QUANTITY, $packageQuantity);

        return $this;
    }

    /**
     * @param float $weight
     * @return $this
     */
    public function setWeight(float $weight): CreateOrder
    {
        $this->setBodyParam(self::WEIGHT, $weight);

        return $this;
    }

    /**
     * @param float $width
     * @return $this
     */
    public function setWidth(float $width): CreateOrder
    {
        $this->setBodyParam(self::WIDTH, $width);

        return $this;
    }

    /**
     * @param float $height
     * @return $this
     */
    public function setHeight(float $height): CreateOrder
    {
        $this->setBodyParam(self::HEIGHT, $height);

        return $this;
    }

    /**
     * @param float $length
     * @return $this
     */
    public function setLength(float $length): CreateOrder
    {
        $this->setBodyParam(self::LENGTH, $length);

        return $this;
    }

    /**
     * @param string $reference1
     * @return $this
     */
    public function setReference1(string $reference1): CreateOrder
    {
        $this->setBodyParam(self::REFERENCE_1, $reference1);

        return $this;
    }

    /**
     * @param string $iossNumber
     * @return $this
     */
    public function setIossNumber(string $iossNumber): CreateOrder
    {
        $this->setBodyParam(self::IOSS_NUMBER, $iossNumber);

        return $this;
    }

    /**
     * @param bool $rememberMyAddress
     * @return $this
     */
    public function setRememberMyAddress(bool $rememberMyAddress): CreateOrder
    {
        $this->setBodyParam(self::REMEMBER_MY_ADDRESS, $rememberMyAddress);

        return $this;
    }

    /**
     * @param string $addressName
     * @return $this
     */
    public function setAddressName(string $addressName): CreateOrder
    {
        $this->setBodyParam(self::ADDRESS_NAME, $addressName);

        return $this;
    }
}
