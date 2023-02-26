<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

declare(strict_types=1);

namespace MageDesk\ShipEntegra\DataProvider;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

/**
 * Unishipper config provider.
 */
class ConfigDataProvider
{
    /**
     * Xml path to Unishipper config tab.
     *
     * Unishipper config path.
     *
     * @var string
     */
    private const CONFIG_PATH = 'carriers/mgdskShpntgr/';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param WriterInterface $configWriter
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
    }

    /**
     * Provides Getaway url for request executing
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH . 'url');
    }

    /**
     * Provides User Name config value.
     *
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH . 'clientId');
    }

    /**
     * Provides configured Token.
     *
     * @return string|null
     */
    public function getClientSecret(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH . 'clientSecret');
    }

    /**
     * Provides configured Token.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH . 'accessToken');
    }

    /**
     * Set configured Token.
     *
     * @param string $accessToken
     * @return void
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->configWriter->save(self::CONFIG_PATH . 'accessToken', $accessToken);
    }

    /**
     * @return bool
     */
    public function getIsUseDefault(): bool
    {
        return (bool)$this->scopeConfig->getValue(self::CONFIG_PATH . 'advanced/use_deafult');
    }

    /**
     * @return float
     */
    public function getDeafultVolWeight(): float
    {
        return (float)$this->scopeConfig->getValue(self::CONFIG_PATH . 'advanced/default_vol_weight');
    }

    /**
     * @return string
     */
    public function getDefaultCalculationMethod(): string
    {
        return (string)$this->scopeConfig->getValue(self::CONFIG_PATH . 'advanced/default_calculation_method');
    }
}
