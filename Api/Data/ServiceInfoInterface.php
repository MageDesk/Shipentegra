<?php
/*
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

namespace MageDesk\ShipEntegra\Api\Data;

interface ServiceInfoInterface
{
    /**
     * String constants for property names
     */
    public const METHOD_CODE = "method_code";
    public const CARRIER_CODE = "carrier_code";
    public const SERVICE = "service";
    public const PROVIDER = "provider";

    /**
     * Getter for MethodCode.
     *
     * @return string|null
     */
    public function getMethodCode(): ?string;

    /**
     * Setter for MethodCode.
     *
     * @param string|null $methodCode
     *
     * @return void
     */
    public function setMethodCode(?string $methodCode): void;

    /**
     * Getter for CarrierCode.
     *
     * @return string|null
     */
    public function getCarrierCode(): ?string;

    /**
     * Setter for CarrierCode.
     *
     * @param string|null $carrierCode
     *
     * @return void
     */
    public function setCarrierCode(?string $carrierCode): void;

    /**
     * Getter for Service.
     *
     * @return int|null
     */
    public function getService(): ?int;

    /**
     * Setter for Service.
     *
     * @param int|null $service
     *
     * @return void
     */
    public function setService(?int $service): void;

    /**
     * Getter for Provider.
     *
     * @return string|null
     */
    public function getProvider(): ?string;

    /**
     * Setter for Provider.
     *
     * @param string|null $provider
     *
     * @return void
     */
    public function setProvider(?string $provider): void;
}
