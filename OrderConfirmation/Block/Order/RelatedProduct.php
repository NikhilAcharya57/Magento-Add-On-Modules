<?php

namespace Visionet\OrderConfirmation\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory;
use Magento\Catalog\Model\Product;
use Magento\Framework\UrlInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;


class RelatedProduct extends Template
{

    protected $_checkoutSession;
    protected $_orderCollectionFactory;
    protected $searchCriteriaBuilder;
    protected $quoteItemCollectionFactory;
    protected $product;
    protected $_urlBuilder;
    private $productRepository;
   

    public function __construct(
        Context $context, 
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,   
        CollectionFactory $quoteItemCollectionFactory,
        Product $product, 
        UrlInterface $urlBuilder,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
       
        $this->_checkoutSession = $checkoutSession;
        $this->_orderCollectionFactory = $orderCollectionFactory;  
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->quoteItemCollectionFactory = $quoteItemCollectionFactory;
        $this->productItem = $product;
        $this->_urlBuilder = $urlBuilder;
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

  
   
    public function getRelatedProduct()
    {
        
        $entityId = $this->getOrderId();

        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('entity_id', $entityId);
     
        
        foreach ($collection as $items) {
            $quoteId=$items->getQuoteId();
        }

        $quoteItemCollection = $this->quoteItemCollectionFactory->create()
        ->addFieldToFilter('quote_id', $quoteId);

        $relatedProductIds = array();
        foreach($quoteItemCollection as $item)
        {
            $Id=$item->getProductId();

            $product = $this->productRepository->getById($Id);
            $reId = $product->getRelatedProductIds(); 
            $product=Null;
            if($reId)
            {
                foreach($reId as $relProductId)
                {
                    array_push($relatedProductIds, $relProductId);
                }
            }
        }

        $relatedProductIds = array_unique($relatedProductIds);

        foreach($quoteItemCollection as $item)
        {
            $Id=$item->getProductId();
            //array_diff($relatedProductIds, array($Id));

            foreach (array_keys($relatedProductIds, $Id) as $key) {
                unset($relatedProductIds[$key]);
            }
        }
    
        return $relatedProductIds;
    }

    public function getProductName($productId)
    {
        $product = $this->productItem->load($productId);
        return $product->getName();
    }
    
    public function getOrderId()
    {
        $order = $this->_checkoutSession->getLastRealOrder();
        $orderId=$order->getEntityId(); 
        return $orderId;
    }
    
    public function redirectPDP($productId)
    {
            $product = $this->productItem->load($productId);
            $productUrl = $this->_urlBuilder->getUrl('', ['_direct' => $product->getUrlKey() . '.html']);
           
            return $productUrl;
    }

   
}
