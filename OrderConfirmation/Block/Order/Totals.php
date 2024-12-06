<?php

namespace Visionet\OrderConfirmation\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Totals extends Template
{

    protected $_checkoutSession;

    protected $_orderCollectionFactory;

    public function __construct(
        Context $context, 
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
       
     
        $this->_checkoutSession = $checkoutSession;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        
        parent::__construct($context, $data);
    }

    public function getSubTotals()
    {
        $entityId = $this->getOrderId();
   
        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('entity_id', $entityId);
     
        foreach ($collection as $items) {
            $baseSubTotal=$items->getBaseSubTotal();
        } 

        return $baseSubTotal;

      
    }

    public function getDiscountInfo()
    {
        $entityId = $this->getOrderId();

        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('entity_id', $entityId);

        foreach ($collection as $items) {
            $discountCoupon=$items->getCouponCode();

            if($discountCoupon!=NULL)
            {
                $discountAmount=$items->getBaseDiscountAmount();
                $discountData=[$discountCoupon,$discountAmount];
            }
            else {
                $discountAmount=$items->getBaseDiscountAmount();
                $discountData=['Not Applied',$discountAmount];
            }
        }

        return $discountData;

    }

    public function getShippingCharge()
    {
        $entityId = $this->getOrderId();

        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('entity_id', $entityId);

        foreach ($collection as $items) {
            $shippingCharge=$items->getBaseShippingAmount();
        
        }

        return $shippingCharge;
    }

    public function getOrderId()
    {
        $order = $this->_checkoutSession->getLastRealOrder();
        $orderId=$order->getEntityId(); 
        return $orderId;
    }
}
