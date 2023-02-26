<?php
/*
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

namespace MageDesk\ShipEntegra\Service\Engines;

use MageDesk\ShipEntegra\Service\Mappers\TrackMapper;
use MageDesk\ShipEntegra\Service\Endpoints\GetTrackService;
use Magento\Framework\DataObject;
use Magento\Shipping\Model\Tracking\Result;

class TrackEngine
{
    /**
     * @var GetTrackService
     */
    private $getTrackService;

    /**
     * @var TrackMapper
     */
    private $trackMapper;

    /**
     * @param GetTrackService $getTrackService
     * @param TrackMapper $trackMapper
     */
    public function __construct(
        GetTrackService $getTrackService,
        TrackMapper $trackMapper
    ) {
        $this->getTrackService = $getTrackService;
        $this->trackMapper = $trackMapper;
    }

    /**
     * @param string $orderId
     * @return Result
     */
    public function execute(string $orderId): Result
    {
        $track = $this->getTrackService->setOrderId($orderId)->execute();
        return $this->trackMapper->map($track);
    }
}
