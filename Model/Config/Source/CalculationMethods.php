<?php

namespace MageDesk\ShipEntegra\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CalculationMethods
 */
class CalculationMethods implements OptionSourceInterface
{
    /**
     * @var array
     */
    private array $options = [
        [
            'value' => 'laff',
            'label' => 'Laff Algorithm'
        ],
        [
            'value' => 'sum',
            'label' => 'Sum of Items Volume'
        ]
    ];

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->options;
    }
}
