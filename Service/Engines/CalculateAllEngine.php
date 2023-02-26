<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Engines;

use MageDesk\ShipEntegra\Service\Endpoints\CalculateAllPricesService;
use MageDesk\ShipEntegra\Service\Calculations\VolumeCalculationService;
use MageDesk\ShipEntegra\Service\RequestClient\ClientService;
use MageDesk\ShipEntegra\Service\Mappers\CalculateAllMapper;
use Magento\Checkout\Model\Session as CheckoutSession;

class CalculateAllEngine
{
    /**
     * @var CalculateAllPricesService
     */
    private $calculateAllPricesService;

    /**
     * @var VolumeCalculationService
     */
    private $volumeCalculationService;

    /**
     * @var ClientService
     */
    private $clientService;

    /**
     * @var CalculateAllMapper
     */
    private $calculateAllMapper;

    /**
     * @var CheckoutSession
     */
    private $checkoutSession;

    /**
     * @param CalculateAllPricesService $calculateAllPricesService
     * @param VolumeCalculationService $volumeCalculationService
     * @param ClientService $clientService
     * @param CalculateAllMapper $calculateAllMapper
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        CalculateAllPricesService $calculateAllPricesService,
        VolumeCalculationService $volumeCalculationService,
        ClientService $clientService,
        CalculateAllMapper $calculateAllMapper,
        CheckoutSession $checkoutSession
    ) {
        $this->calculateAllPricesService = $calculateAllPricesService;
        $this->volumeCalculationService = $volumeCalculationService;
        $this->clientService = $clientService;
        $this->calculateAllMapper = $calculateAllMapper;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * @param $request
     * @return array
     * @throws \Exception
     */
    public function execute($request): array
    {
        $items = $this->checkoutSession->getQuote()->getAllItems();
        $desi = $this->volumeCalculationService->execute($items);
        $this->calculateAllPricesService->setDesi($desi);
        $this->calculateAllPricesService->setCountryCode($request->getDestCountryId());

        $response = $this->clientService->execute($this->calculateAllPricesService);
        if(!isset($response['prices'])) {
            return [];
        }
        $rates = $this->calculateAllMapper->map($response['prices']);

        return $rates;
    }
}
