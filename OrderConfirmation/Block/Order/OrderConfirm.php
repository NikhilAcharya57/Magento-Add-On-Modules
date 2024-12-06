<?php

namespace Visionet\OrderConfirmation\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Magento\Sales\Api\OrderRepositoryInterface;

use Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory;

use Magento\Catalog\Api\ProductRepositoryInterface;


use Magento\Sales\Model\Order;



class OrderConfirm extends Template
{

    protected $_checkoutSession;

    protected $_orderCollectionFactory;

    protected $quoteItemCollectionFactory;

    protected $_productRepository;

    protected $order;

    protected $orderRepository;



    public function __construct(
        Context $context,
      
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        CollectionFactory $quoteItemCollectionFactory,
        ProductRepositoryInterface $productRepository,
        //OrderRepositoryInterface $orderRepository,
        Order $order,
    
        array $data = []
    ) {
       
     
        $this->_checkoutSession = $checkoutSession;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->quoteItemCollectionFactory = $quoteItemCollectionFactory;

        $this->_productRepository = $productRepository;
        $this->order=$order;
       // $this->orderRepository=$orderRepository;
     
        parent::__construct($context, $data);
    }

    public function getCurrentOrder()
    {
        $entityId = $this->getOrderId();
      

        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('entity_id', $entityId);
     
        foreach ($collection as $items) {
            $quoteId=$items->getQuoteId();
            break;
        }

        $quoteItemCollection = $this->quoteItemCollectionFactory->create()
        ->addFieldToFilter('quote_id', $quoteId);

        return $quoteItemCollection;

      
    }

    public function getOrderId()
    {

        $order = $this->_checkoutSession->getLastRealOrder();
        if ($order) {
            $orderId = $order->getEntityId();
        }

        return $orderId;
    }

    public function getProductImage($productId)
    {
        $store = $this->_storeManager->getStore();
        $product = $this->_productRepository->getById($productId);

        $productImageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' .$product->getImage();
        $productUrl = $product->getProductUrl();
        return $productImageUrl;

    }
}
