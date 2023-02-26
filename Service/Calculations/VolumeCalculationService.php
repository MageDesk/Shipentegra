<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Calculations;

use MageDesk\ShipEntegra\Service\Calculations\LaffAlgorithmService;
use Magento\Quote\Model\Quote\Address\RateRequest;
use MageDesk\ShipEntegra\Model\Data\VolumeCalculation;
use MageDesk\ShipEntegra\DataProvider\ConfigDataProvider;
use Magento\Sales\Model\Order\Item;

/**
 * Class VolumeCalculationService
 */
class VolumeCalculationService extends VolumeCalculation
{

    public const VOLUME_MULTIPLIER = 5000;

    /**
     * @var LaffAlgorithmService
     */
    private LaffAlgorithmService $laffAlgorithmService;

    /**
     * @var ConfigDataProvider
     */
    private ConfigDataProvider $configDataProvider;

    /**
     * @var array $containerDimensions
     */
    private array $containerDimensions = [
        'length' => 0,
        'width' => 0,
        'height' => 0
    ];

    /**
     * @var float $containerVolume
     */
    private float $containerVolume = 0;

    /**
     * @var float $totalWeight
     */
    private float $totalWeight = 0;

    /**
     * VolumeCalculationService constructor.
     * @param LaffAlgorithmService $laffAlgorithmService
     * @param ConfigDataProvider $configDataProvider
     */
    public function __construct(
        LaffAlgorithmService $laffAlgorithmService,
        ConfigDataProvider $configDataProvider
    ) {
        $this->laffAlgorithmService = $laffAlgorithmService;
        $this->configDataProvider = $configDataProvider;
    }

    /**
     * @param array $allItems
     * @return float
     */
    public function execute(array $allItems): float
    {
        $this->arrangeItems($allItems);
        $calculationMethod = $this->configDataProvider->getDefaultCalculationMethod();

        if($this->getIsItemsValid() && $calculationMethod == 'laff'){
            return $this->calculateLaffAlgorithm();
        } else {
            return max($this->getTotalWeight(), $this->getTotalVolWeight());
        }
    }

    /**
     * @param array $allItems
     * @return void
     */
    private function arrangeItems(array $allItems): void
    {
        $items = [];
        $totalWeight = 1;
        $isItemsValid = 1;
        $totalVolWeight = 0;
        $useAlwaysVolWeight = $this->configDataProvider->getIsUseDefault();
        $defaultVolWeight = $this->configDataProvider->getDeafultVolWeight();

        /** @var Item $item */
        foreach ($allItems as $item) {

            $totalWeight += $item->getRowWeight();

            $qty = $item->getQty() ?? $item->getQtyOrdered();
            if($useAlwaysVolWeight){
                $totalVolWeight += ($defaultVolWeight * $qty);
            } else {
                $totalVolWeight += $qty *
                    ($item->getProduct()->getVolWeight() ?? $defaultVolWeight);
            }

            if($item->getProduct()->getLength() == 0 ||
                $item->getProduct()->getWidth() == 0 ||
                $item->getProduct()->getHeight() == 0) {
                $isItemsValid = 0;
            }

            if(!$isItemsValid){
                continue;
            }

            array_fill(count($items), count($items) + $qty, [
                'length' => $item->getProduct()->getLength(),
                'width' => $item->getProduct()->getWidth(),
                'height' => $item->getProduct()->getHeight()
            ]);
        }

        $this->setTotalWeight($totalWeight);
        $this->setTotalVolWeight($totalVolWeight);
        $this->setItems($items);
        $this->setIsItemsValid($isItemsValid);
    }

    /**
     * @return float
     */
    private function calculateLaffAlgorithm(): float
    {
        $items = $this->getItems();
        $containerVolume = $this->laffAlgorithmService->pack($items);
        $this->setContainerDimentions($this->laffAlgorithmService->get_container_dimensions());
        $this->setContainerVolume($containerVolume);
        $weightVolume = $containerVolume / self::VOLUME_MULTIPLIER;
        $this->setContainerVolWeight($weightVolume);
        return max($totalVolWeight, $weightVolume);
    }
}
