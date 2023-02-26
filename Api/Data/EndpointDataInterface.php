<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Api\Data;

/**
 * Interface EndpointDataInterface
 */
interface EndpointDataInterface
{
    /**
     * String constants for property names
     */
    public const URL = "url";
    public const TYPE = "type";
    public const BODY = "body";
    public const URL_VALUE = '';
    public const TYPE_VALUE = '';

    /**
     * Getter for Url.
     *
     * @return string|null
     */
    public function getUrl(): ?string;

    /**
     * Setter for Url.
     *
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void;

    /**
     * Getter for Type.
     *
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * Setter for Type.
     *
     * @param string|null $type
     *
     * @return void
     */
    public function setType(?string $type): void;

    /**
     * Getter for Body.
     *
     * @return array|null
     */
    public function getBody(): ?array;

    /**
     * Setter for Body.
     *
     * @param array|null $body
     *
     * @return void
     */
    public function setBody(?array $body): void;
}
