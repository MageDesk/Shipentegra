<?php
/*
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

namespace MageDesk\ShipEntegra\Controller\Adminhtml\Actions;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use MageDesk\ShipEntegra\Service\Engines\CreateLabelEngine;
use Magento\Framework\App\Request\Http;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;

class GetLabel extends \Magento\Backend\App\Action
{
    /**
     * @var CreateLabelEngine
     */
    private $createLabelEngine;

    /**
     * @var ResultInterface
     */
    private $result;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var Http
     */
    private $request;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var Redirect
     */
    private $redirect;

    /**
     * @param CreateLabelEngine $createLabelEngine
     * @param Http $request
     * @param OrderRepositoryInterface $orderRepository
     * @param Redirect $redirect
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CreateLabelEngine $createLabelEngine,
        Http $request,
        OrderRepositoryInterface $orderRepository,
        Redirect $redirect
    ) {
        parent::__construct($context);
        $this->createLabelEngine = $createLabelEngine;
        $this->request = $request;
        $this->orderRepository = $orderRepository;
        $this->redirect = $redirect;
    }

    /**
     * Execute action based on request and return result
     *
     * @return void
     * @throws NotFoundException|\Exception
     */
    public function execute()
    {
        $orderId= $this->request->getParam('orderId');
        $order = $this->orderRepository->get($orderId);
        $request = $this->createLabelEngine->execute($order);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $this->_redirect($this->_redirect->getRefererUrl());
    }
}
