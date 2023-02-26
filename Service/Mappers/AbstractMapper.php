<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Framework\DataObject\Copy;
use MageDesk\ShipEntegra\Api\MapperInterface;

/**
 * Class AbstractMapper
 */
abstract class AbstractMapper implements MapperInterface
{
    /**
     * @var Copy
     */
    protected Copy $objectCopyService;

    /**
     * AbstractMapper constructor.
     * @param Copy $objectCopyService
     */
    public function __construct(
        Copy $objectCopyService
    ) {
        $this->objectCopyService = $objectCopyService;
    }

    /**
     * @param $data
     * @return array|void
     */
    abstract public function map($data);
}
