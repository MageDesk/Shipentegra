<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model\Carrier;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Directory\Helper\Data;
use Magento\Directory\Model\CountryFactory;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrierOnline;
use Magento\Shipping\Model\Rate\Result;
use MageDesk\ShipEntegra\Service\RequestClient\ClientService;
use MageDesk\ShipEntegra\Service\Endpoints\CalculateAllPricesService;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Shipping\Model\Shipment\Request;
use Magento\Shipping\Model\Simplexml\ElementFactory;
use Magento\Shipping\Model\Tracking\Result\AbstractResult;
use Magento\Shipping\Model\Tracking\Result\StatusFactory;
use Psr\Log\LoggerInterface as Logger;
use MageDesk\ShipEntegra\Service\Engines\CalculateAllEngine;
use Magento\Framework\Xml\Security;

/**
 * Class Shipping
 */
class Shipping extends \Magento\Shipping\Model\Carrier\AbstractCarrierOnline implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'mgdskShpntgr';

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * @var CalculateAllEngine
     */
    private $calculateAllEngine;

    /**
     * @var array
     */
    protected static $_quotesCache = [];

    /**
     * @var string
     */
    protected $_activeFlag = 'active';

    /**
     * @var \Magento\Directory\Helper\Data
     */
    protected $_directoryData = null;

    /**
     * @var \Magento\Shipping\Model\Simplexml\ElementFactory
     */
    protected $_xmlElFactory;

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateFactory;

    /**
     * @var \Magento\Shipping\Model\Tracking\ResultFactory
     */
    protected $_trackFactory;

    /**
     * @var \Magento\Shipping\Model\Tracking\Result\ErrorFactory
     */
    protected $_trackErrorFactory;

    /**
     * @var \Magento\Shipping\Model\Tracking\Result\StatusFactory
     */
    protected $_trackStatusFactory;

    /**
     * @var \Magento\Directory\Model\RegionFactory
     */
    protected $_regionFactory;

    /**
     * @var \Magento\Directory\Model\CountryFactory
     */
    protected $_countryFactory;

    /**
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    protected $_currencyFactory;

    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $stockRegistry;

    /**
     * Raw rate request data
     *
     * @var \Magento\Framework\DataObject|null
     */
    protected $_rawRequest = null;

    /**
     * @var Security
     */
    protected $xmlSecurity;

    /**
     * Shipping constructor.
     *
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param CalculateAllEngine $calculateAllEngine
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param Logger $logger
     * @param Security $xmlSecurity
     * @param ElementFactory $xmlElFactory
     * @param ResultFactory $rateFactory
     * @param \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory
     * @param \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory
     * @param StatusFactory $trackStatusFactory
     * @param RegionFactory $regionFactory
     * @param CountryFactory $countryFactory
     * @param CurrencyFactory $currencyFactory
     * @param Data $directoryData
     * @param StockRegistryInterface $stockRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        CalculateAllEngine $calculateAllEngine,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        Security $xmlSecurity,
        \Magento\Shipping\Model\Simplexml\ElementFactory $xmlElFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Directory\Helper\Data $directoryData,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->calculateAllEngine = $calculateAllEngine;
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $xmlSecurity,
            $xmlElFactory,
            $rateFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $data = []
        );
    }

    /**
     * get allowed methods
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['mgdskShpntgr' => 'ShipEntegra'];
    }

    /**
     * @return false
     */
    public function isCityRequired()
    {
        return false;
    }

    /**
     * @return false
     */
    public function isZipCodeRequired($countryId = null)
    {
        return false;
    }

    /**
     * Check if carrier has shipping tracking option available
     *
     * @return bool
     */
    public function isTrackingAvailable()
    {
        return true;
    }

    /**
     * Check if carrier has shipping label option available
     *
     * @return bool
     */
    public function isShippingLabelsAvailable()
    {
        return true;
    }

    /**
     * @param \Magento\Framework\DataObject $request
     * @return \Magento\Framework\DataObject
     */
    protected function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
        return new \Magento\Framework\DataObject();
    }

    /**
     * @param $trackings
     * @return \Magento\Shipping\Model\Tracking\Result
     */
    public function getTracking($trackings)
    {
        $info = new \Magento\Shipping\Model\Tracking\Result();
        $track = new AbstractResult();
        $info->append($track);
        return $info;
    }

    /**
     * @param \Magento\Framework\DataObject $request
     * @return $this|bool|Shipping|\Magento\Framework\DataObject
     */
    public function processAdditionalValidation(\Magento\Framework\DataObject $request)
    {
        return $this;
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     * @throws \Exception
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $methods = $this->calculateAllEngine->execute($request);

        foreach ($methods as $method) {
            $result->append($method);
        }

        return $result;
    }
}
