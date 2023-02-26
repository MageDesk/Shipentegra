<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;

/**
 * Class CreateLabelService
 */
class CreateLabelService extends AbstractService
{
    /**
     * @var string
     */
    protected string $url = 'logistics/labels/shipentegra';

    /**
     * @var string
     */
    public const ORDER_ID = 'orderId';
    public const SPECIAL_SERVICE = 'specialService';
    public const VERPACKG = 'verpackg';
    public const INSURANCE = 'insurance';
    public const CONTENT = 'content';
    public const WEIGHT = 'weight';
    public const IOSS_NUMBER = 'iossNumber';
    public const CURRENCY = 'currency';
    public const ITEMS = 'items';

    /**
     * @param string $provider
     * @return $this
     */
    public function setProvider(string $provider): CreateLabelService
    {
        $this->_data[EndpointDataInterface::URL] = $this->_data[EndpointDataInterface::URL] . '/' . $provider;

        return $this;
    }

    /**
     * @param string $orderId
     * @return CreateLabelService
     */
    public function setOrderId(string $orderId): CreateLabelService
    {
        $this->setBodyParam(self::ORDER_ID, $orderId);

        return $this;
    }

    /**
     * @param string $specialService
     * @return CreateLabelService
     */
    public function setSpecialService(string $specialService): CreateLabelService
    {
        $this->setBodyParam(self::SPECIAL_SERVICE, $specialService);

        return $this;
    }

    /**
     * @param string $verpackg
     * @return CreateLabelService
     */
    public function setVerpackg(string $verpackg): CreateLabelService
    {
        $this->setBodyParam(self::VERPACKG, $verpackg);

        return $this;
    }

    /**
     * @param string $insurance
     * @return CreateLabelService
     */
    public function setInsurance(string $insurance): CreateLabelService
    {
        $this->setBodyParam(self::INSURANCE, $insurance);

        return $this;
    }

    /**
     * @param string $content
     * @return CreateLabelService
     */
    public function setContent(string $content): CreateLabelService
    {
        $this->setBodyParam(self::CONTENT, $content);

        return $this;
    }

    /**
     * @param string $weight
     * @return CreateLabelService
     */
    public function setWeight(string $weight): CreateLabelService
    {
        $this->setBodyParam(self::WEIGHT, $weight);

        return $this;
    }

    /**
     * @param string $iossNumber
     * @return CreateLabelService
     */
    public function setIossNumber(string $iossNumber): CreateLabelService
    {
        $this->setBodyParam(self::IOSS_NUMBER, $iossNumber);

        return $this;
    }

    /**
     * @param string $currency
     * @return CreateLabelService
     */
    public function setCurrency(string $currency): CreateLabelService
    {
        $this->setBodyParam(self::CURRENCY, $currency);

        return $this;
    }

    /**
     * @param array $items
     * @return CreateLabelService
     */
    public function setItems(array $items): CreateLabelService
    {
        $this->setBodyParam(self::ITEMS, $items);

        return $this;
    }
}
