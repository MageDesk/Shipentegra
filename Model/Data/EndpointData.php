<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */
declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model\Data;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;
use Magento\Framework\DataObject;

/**
 * Class EndpointData
 */
class EndpointData extends DataObject implements EndpointDataInterface
{
    /**
     * Getter for Url.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->getData(self::URL);
    }

    /**
     * Setter for Url.
     *
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void
    {
        $this->setData(self::URL, $url);
    }

    /**
     * Getter for Type.
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Setter for Type.
     *
     * @param string|null $type
     *
     * @return void
     */
    public function setType(?string $type): void
    {
        $this->setData(self::TYPE, $type);
    }

    /**
     * Getter for Body.
     *
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->getData(self::BODY);
    }

    /**
     * Setter for Body.
     *
     * @param array|null $body
     *
     * @return void
     */
    public function setBody(?array $body): void
    {
        $this->setData(self::BODY, $body);
    }

}
