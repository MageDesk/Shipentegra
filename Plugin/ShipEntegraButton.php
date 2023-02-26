<?php

namespace MageDesk\ShipEntegra\Plugin;

use Magento\Framework\Exception\LocalizedException;
use Magento\Shipping\Block\Adminhtml\View;
use Magento\Shipping\Block\Adminhtml\View\Form;
use MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder\CollectionFactory;

/**
 * Class ShipEntegraButton
 */
class ShipEntegraButton
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * ShipEntegraButton constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param Form $form
     * @param $result
     * @return void
     * @throws LocalizedException
     */
    public function afterGetCreateLabelButton(Form $form, $result)
    {
        if($this->getCarrierCode($form) != 'mgdskShpntgr') {
            return $result;
        }

        $orderId = $form->getShipment()->getOrder()->getId();
        $orderIncrementId = $form->getShipment()->getOrder()->getIncrementId();
        $shipEntegraOrder = $this->collectionFactory->create()
            ->addFieldToFilter('order_id', $orderId)
            ->getFirstItem();

        if($shipEntegraOrder->getLabel()) {
            return $form->getLayout()->createBlock(
                \Magento\Backend\Block\Widget\Button::class
            )->setData(
                [
                    'label' => __('Download ShipEntegra Label...'),
                    'onclick' => 'window.open(\''. $shipEntegraOrder->getLabel() .'\', \'_blank\')',
                    'class' => 'action-create-label'
                ]
            )->toHtml();
        }

        return $form->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Button::class
        )->setData(
            [
                'label' => __('Create ShipEntegra Label...'),
                'onclick' => 'setLocation(\''. $form->getUrl('mgdsk_shpntgr/actions/getlabel', ['orderId' => $orderId]) .'\', \'_blank\')',
                'class' => 'action-create-label'
            ]
        )->toHtml();
    }

    /**
     * @param Form $subject
     * @return string
     */
    private function getCarrierCode(Form $subject)
    {
        $shippingMethod = $subject->getShipment()->getOrder()->getShippingMethod(true)->getCarrierCode();
        return $shippingMethod;
    }
}
