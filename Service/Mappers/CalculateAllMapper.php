<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Framework\DataObject\Copy;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use stdClass;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;

/**
 * Class CalculateAllMapper
 */
class CalculateAllMapper extends AbstractMapper
{
    /**
     * @var Copy
     */
    protected Copy $objectCopyService;

    /**
     * @var MethodFactory
     */
    private MethodFactory $methodFactory;

    /**
     * CalculateAllMapper constructor.
     * @param Copy $objectCopyService
     * @param MethodFactory $methodFactory
     */
    public function __construct(Copy $objectCopyService, MethodFactory $methodFactory)
    {
        parent::__construct($objectCopyService);
        $this->methodFactory = $methodFactory;
    }

    /**
     * @param stdClass $data
     * @return Method[]
     */
    public function map($data)
    {
        $methods = [];
        foreach ($data as $rate) {
            /** @var Method $newMethodObject */
            $newMethodObject = $this->methodFactory->create();
            $method = $this->objectCopyService->copyFieldsetToTarget(
                'response_to_rates',
                'to_rate',
                $rate,
                $newMethodObject
            );
            $method->setCarrier('mgdskShpntgr');
            $method->setMethod($rate['serviceName'] . '_' . $rate['serviceType']);
            $method->setCarrierTitle(explode("<br>", $method->getCarrierTitle())[0]);
            $methods[] = $newMethodObject;
        }

        return $methods;
    }
}
