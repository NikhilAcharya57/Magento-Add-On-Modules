<?php
/**
 * Class Quote
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@visionet-technologies.com>
 * @license  https://www.visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Model\Sales;

use Visionet\AbandonedCart\Model\ResourceModel\Campaign;

/**
 * Class Quote
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@visionet-technologies.com>
 * @license  https://www.visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.visionet-technologies.com
 */
class Quote
{
    //customer
    const XML_PATH_LOSTBASKET_CUSTOMER_ENABLED_1 = 'visionet_abandoned_cart/customers/enabled_1';

    const XML_PATH_LOSTBASKET_CUSTOMER_ENABLED_2 = 'visionet_abandoned_cart/customers/enabled_2';

    const XML_PATH_LOSTBASKET_CUSTOMER_ENABLED_3 = 'visionet_abandoned_cart/customers/enabled_3';

    const XML_PATH_LOSTBASKET_CUSTOMER_ENABLED_4 = 'visionet_abandoned_cart/customers/enabled_4';

    const XML_PATH_LOSTBASKET_CUSTOMER_INTERVAL_1 = 'visionet_abandoned_cart/customers/send_after_1';

    const XML_PATH_LOSTBASKET_CUSTOMER_INTERVAL_2 = 'visionet_abandoned_cart/customers/send_after_2';

    const XML_PATH_LOSTBASKET_CUSTOMER_INTERVAL_3 = 'visionet_abandoned_cart/customers/send_after_3';

    const XML_PATH_LOSTBASKET_CUSTOMER_INTERVAL_4 = 'visionet_abandoned_cart/customers/send_after_4';

    const XML_PATH_LOSTBASKET_CUSTOMER_TEMPLATE_1 = 'visionet_abandoned_cart/customers/template1';

    const XML_PATH_LOSTBASKET_CUSTOMER_TEMPLATE_2 = 'visionet_abandoned_cart/customers/template2';

    const XML_PATH_LOSTBASKET_CUSTOMER_TEMPLATE_3 = 'visionet_abandoned_cart/customers/template3';

    const XML_PATH_LOSTBASKET_CUSTOMER_TEMPLATE_4 = 'visionet_abandoned_cart/customers/template4';

    //guest
    const XML_PATH_LOSTBASKET_GUEST_ENABLED_1 = 'visionet_abandoned_cart/guests/enabled_1';

    const XML_PATH_LOSTBASKET_GUEST_ENABLED_2 = 'visionet_abandoned_cart/guests/enabled_2';

    const XML_PATH_LOSTBASKET_GUEST_ENABLED_3 = 'visionet_abandoned_cart/guests/enabled_3';

    const XML_PATH_LOSTBASKET_GUEST_ENABLED_4 = 'visionet_abandoned_cart/guests/enabled_4';

    const XML_PATH_LOSTBASKET_GUEST_INTERVAL_1 = 'visionet_abandoned_cart/guests/send_after_1';

    const XML_PATH_LOSTBASKET_GUEST_INTERVAL_2 = 'visionet_abandoned_cart/guests/send_after_2';

    const XML_PATH_LOSTBASKET_GUEST_INTERVAL_3 = 'visionet_abandoned_cart/guests/send_after_3';

    const XML_PATH_LOSTBASKET_GUEST_INTERVAL_4 = 'visionet_abandoned_cart/guests/send_after_4';

    const XML_PATH_LOSTBASKET_GUEST_TEMPLATE_1 = 'visionet_abandoned_cart/guests/template1';

    const XML_PATH_LOSTBASKET_GUEST_TEMPLATE_2 = 'visionet_abandoned_cart/guests/template2';

    const XML_PATH_LOSTBASKET_GUEST_TEMPLATE_3 = 'visionet_abandoned_cart/guests/template3';

    const XML_PATH_LOSTBASKET_GUEST_TEMPLATE_4 = 'visionet_abandoned_cart/guests/template4';

    const CUSTOMER_LOST_BASKET_ONE = 1;

    const CUSTOMER_LOST_BASKET_TWO = 2;

    const CUSTOMER_LOST_BASKET_THREE = 3;

    const CUSTOMER_LOST_BASKET_FOUR = 4;

    const GUEST_LOST_BASKET_ONE = 1;

    const GUEST_LOST_BASKET_TWO = 2;

    const GUEST_LOST_BASKET_THREE = 3;

    const GUEST_LOST_BASKET_FOUR = 4;

    //wishlist
    const XML_PATH_WISHLIST_ENABLED1='visionet_abandoned_cart/wishlist/enabled1';

    const XML_PATH_WISHLIST_INTERVAL = 'visionet_abandoned_cart/wishlist/interval';

  


    public $abandonedFactory;

    public $abandonedCollectionFactory;

    public $quoteCollectionFactory;

    public $campaignResource;

    public $helper;

    public $scopeConfig;

    public $storeManager;

    public $campaignFactory;

    public $campaignCollection;

    public $timeZone;

    public $totalCustomers = 0;

    public $totalGuests = 0;

    public $abandonedResource;

    public $frameworkTemplate;

    public $transportBuilder;

    public $inlineTranslation;
    
    public $_productRepository;
    
    public $_wishlistRepository;

    public $quoteRepository;

    public $_wishlistCollectionFactory;

    /**
     * Quote constructor.
     *
     * @param \Visionet\AbandonedCart\Model\AbandonedFactory                          $abandonedFactory           abandonedFactory
     * @param Campaign\CollectionFactory                                                $campaignCollection         campaignCollection
     * @param Campaign                                                                  $campaignResource           campaignResource
     * @param \Visionet\AbandonedCart\Model\CampaignFactory                           $campaignFactory            campaignFactory
     * @param \Visionet\AbandonedCart\Helper\Data                                     $helper                     helper
     * @param \Visionet\AbandonedCart\Model\ResourceModel\Abandoned\CollectionFactory $abandonedCollectionFactory abandonedCollectionFactory
     * @param \Visionet\AbandonedCart\Model\ResourceModel\Abandoned                   $abandonedResource          abandonedResource
     * @param \Magento\Store\Model\StoreManagerInterface                                $storeManager               storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface                        $scopeConfig                scopeConfig
     * @param \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory                $quoteCollectionFactory     quoteCollectionFactory
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface                      $timezone                   timezone
     * @param \Magento\Framework\Mail\Template\TransportBuilder                         $transportBuilder           transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface                        $inlineTranslation          inlineTranslation,
     * @param \Magento\Framework\View\Element\Template                                  $frameworkTemplate          frameworkTemplate
     */
    public function __construct(
        \Visionet\AbandonedCart\Model\AbandonedFactory $abandonedFactory,
        \Visionet\AbandonedCart\Model\ResourceModel\Campaign\CollectionFactory $campaignCollection,
        \Visionet\AbandonedCart\Model\ResourceModel\Campaign $campaignResource,
        \Visionet\AbandonedCart\Model\CampaignFactory $campaignFactory,
        \Visionet\AbandonedCart\Helper\Data $helper,
        \Visionet\AbandonedCart\Model\ResourceModel\Abandoned\CollectionFactory $abandonedCollectionFactory,
        \Visionet\AbandonedCart\Model\ResourceModel\Abandoned $abandonedResource,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\View\Element\Template $frameworkTemplate,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Wishlist\Model\WishlistFactory $wishlistRepository,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory $wishlistCollectionFactory
        
        
    ) {
        $this->helper = $helper;
        $this->abandonedFactory = $abandonedFactory;
        $this->abandonedCollectionFactory = $abandonedCollectionFactory;
        $this->abandonedResource = $abandonedResource;
        $this->campaignCollection = $campaignCollection;
        $this->campaignResource = $campaignResource;
        $this->campaignFactory = $campaignFactory;
        $this->storeManager = $storeManager;
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->scopeConfig = $scopeConfig;
        $this->timeZone = $timezone;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->frameworkTemplate = $frameworkTemplate;
        $this->_productRepository = $productRepository;
        $this->_wishlistRepository= $wishlistRepository;
        $this->quoteRepository = $quoteRepository;
        $this->_wishlistCollectionFactory = $wishlistCollectionFactory;
    }

    /**
     * ProcessAbandonedCarts
     *
     * @return mixed
     */
    public function processAbandonedCarts()
    {
        $result = [];
        $stores = $this->helper->getStores();

        foreach ($stores as $store) {
            $storeId = $store->getId();
            $websiteId = $store->getWebsiteId();
            
            $firstCustomerEnabled = $this->isLostBasketCustomerEnabled(self::CUSTOMER_LOST_BASKET_ONE, $storeId);
            $secondCustomerEnabled = $this->isLostBasketCustomerEnabled(self::CUSTOMER_LOST_BASKET_TWO, $storeId);
            $thirdCustomerEnabled = $this->isLostBasketCustomerEnabled(self::CUSTOMER_LOST_BASKET_THREE, $storeId);
            $fourthCustomerEnabled = $this->isLostBasketCustomerEnabled(self::CUSTOMER_LOST_BASKET_FOUR, $storeId);

            $firstGuestEnabled = $this->isLostBasketGuestEnabled(self::GUEST_LOST_BASKET_ONE, $storeId);
            $secondGuestEnabled = $this->isLostBasketGuestEnabled(self::GUEST_LOST_BASKET_TWO, $storeId);
            $thirdGuestEnabled = $this->isLostBasketGuestEnabled(self::GUEST_LOST_BASKET_THREE, $storeId);
            $fourthGuestEnabled = $this->isLostBasketGuestEnabled(self::GUEST_LOST_BASKET_FOUR, $storeId);

       
            //customer
            if ($firstCustomerEnabled) {
                $result[$storeId]['firstCustomer'] = $this->processCustomerFirstAbandonedCart($storeId);
            }

            //second customer
            if ($firstCustomerEnabled && $secondCustomerEnabled) {
                $result[$storeId]['secondCustomer'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::CUSTOMER_LOST_BASKET_TWO
                );
            }

            //third customer
            if ($firstCustomerEnabled && $secondCustomerEnabled && $thirdCustomerEnabled) {
                $result[$storeId]['thirdCustomer'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::CUSTOMER_LOST_BASKET_THREE
                );
            }

            //fourth customer
            if ($firstCustomerEnabled && $secondCustomerEnabled && $fourthCustomerEnabled) {
                $result[$storeId]['fourthCustomer'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::CUSTOMER_LOST_BASKET_FOUR
                );
            }

            //guest
            if ($firstGuestEnabled) {
                $result[$storeId]['firstGuest'] = $this->processGuestFirstAbandonedCart($storeId);
            }

            //second guest
            if ($firstGuestEnabled && $secondGuestEnabled) {
                $result[$storeId]['secondGuest'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::GUEST_LOST_BASKET_TWO,
                    true
                );
            }
            //third guest
            if ($firstGuestEnabled && $secondGuestEnabled && $thirdGuestEnabled) {
                $result[$storeId]['thirdGuest'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::GUEST_LOST_BASKET_THREE,
                    true
                );
            }
            //fourth guest
            if ($firstGuestEnabled && $secondGuestEnabled && $thirdGuestEnabled && $fourthGuestEnabled) {
                $result[$storeId]['fourthGuest'] = $this->processExistingAbandonedCart(
                    $storeId,
                    $websiteId,
                    self::GUEST_LOST_BASKET_FOUR,
                    true
                );
            }
        }

        return $result;
    }

    /**
     * ProcessCustomerFirstAbandonedCart
     *
     * @param int $storeId storeId
     *
     * @return int|string
     */
    public function processCustomerFirstAbandonedCart($storeId)
    {
        $result = 0;
        $abandonedNum = 1;

        $sendAfter = $this->getSendAfterIntervalForCustomerLogged($storeId, $abandonedNum);
        $fromTime = new \DateTime('now', new \DateTimezone('Asia/Kolkata'));

        $fromTime->sub($sendAfter);
        $toTime = clone $fromTime;
        $fromTime->sub(\DateInterval::createFromDateString('30 mins'));

        //format time
        $fromDate = $fromTime->format('Y-m-d H:i:s');
        $toDate = $toTime->format('Y-m-d H:i:s');

        //active quotes
        $quoteCollection = $this->getStoreQuotes($fromDate, $toDate, false, $storeId);

        if ($quoteCollection->getSize()) {
            $this->helper->log('Customer 1 Abandoned Cart: ' . $fromDate . ' - ' . $toDate);
        }

        foreach ($quoteCollection as $quote) {
        $quoteId = $quote->getId();
        $storeId = $quote->getStoreId();
        $email = $quote->getCustomerEmail();
        $items = $quote->getAllItems();
        $customerId = $quote->getCustomerId();
        $itemIds = $this->getQuoteItemIds($items);
        foreach($items as $item){
            if ($this->isLostBasketWishlistEnabled($storeId)) {
            $flag=0;
            $productId=$item->getProductId();
            $buyRequest = $item->getBuyRequest();
            try {
                        
                $product = $this->_productRepository->getById($productId, false, $storeId);
                
                $wishlistProduct = $this->_wishlistCollectionFactory->create()->addCustomerIdFilter($customerId);
                if(count($wishlistProduct)==0)
                {
                    $this->saveProductToWishlist($product,$customerId,$buyRequest);                   
                }
                
                else{
                $productIds = null;
                foreach ($wishlistProduct as $wishlist) {

                    $productIds[] = $wishlist->getProductId();

                }
                foreach($productIds as $id)
                {
                    if($id==$productId)
                    {
                        $flag=1;
                        break;
                    }
                }

                if($flag==0)
                {
                    $this->saveProductToWishlist($product,$customerId,$buyRequest);                   
                }
                
                
            }

            } catch (NoSuchEntityException $e) {
                $product = null;
            }
            }

        }  

        $abandonedModel = $this->abandonedFactory->create()->loadByQuoteId($quoteId, $storeId);
        if ($this->abandonedCartAlreadyExists($abandonedModel) && $this->shouldNotSendAbandonedCartAgain($abandonedModel, $quote)) {
            if ($this->shouldDeleteAbandonedCart($quote)) {
                $this->deleteAbandonedCart($abandonedModel);
            }
            continue;
        }

        //create abandoned cart
        $this->createAbandonedCart($abandonedModel, $quote, $itemIds);
        $template = $this->getLostBasketCustomerTemplate($abandonedNum, $storeId);

        //send campaign; check if valid to be sent
        if ($this->isLostBasketCustomerEnabled(self::CUSTOMER_LOST_BASKET_ONE, $storeId)) {
            $this->sendEmailCampaign($email, $quote, self::CUSTOMER_LOST_BASKET_ONE, $template);
        }
        $this->totalCustomers++;
        $result = $this->totalCustomers;
        }

        return $result;
    }

    /**
     * ProcessGuestFirstAbandonedCart
     *
     * @param int $storeId storeId
     *
     * @return int
     */
    public function processGuestFirstAbandonedCart($storeId)
    {
        $result = 0;
        $abandonedNum = 1;

        $sendAfter = $this->getSendAfterIntervalForGuest($storeId, $abandonedNum);
        $fromTime = new \DateTime('now', new \DateTimezone('UTC'));

        $fromTime->sub($sendAfter);
        $toTime = clone $fromTime;
        $fromTime->sub(\DateInterval::createFromDateString('10 mins'));

        //format time
        $fromDate   =  $fromTime->format('Y-m-d H:i:s');
        $toDate     =  $toTime->format('Y-m-d H:i:s');

        //active quotes
        $quoteCollection = $this->getStoreQuotes($fromDate, $toDate, true, $storeId);

        if ($quoteCollection->getSize()) {
            $this->helper->log('Guest AC 1 ' . $fromDate . ' - ' . $toDate);
        }

        foreach ($quoteCollection as $quote) {
            $quoteId = $quote->getId();
            $storeId = $quote->getStoreId();
            $items = $quote->getAllItems();
            $email = $quote->getCustomerEmail();
            $websiteId = $this->storeManager->getStore($storeId)->getWebsiteId();
            $itemIds = $this->getQuoteItemIds($items);

            $abandonedModel = $this->abandonedFactory->create()->loadByQuoteId($quoteId, $storeId);

            if ($this->abandonedCartAlreadyExists($abandonedModel) && $this->shouldNotSendAbandonedCartAgain($abandonedModel, $quote)) {
                if ($this->shouldDeleteAbandonedCart($quote)) {
                    $this->deleteAbandonedCart($abandonedModel);
                }
                continue;
            }

            //create abandoned cart
            $this->createAbandonedCart($abandonedModel, $quote, $itemIds);
            $template = $this->getLostBasketGuestTemplate($abandonedNum, $storeId);
            //send campaign; check if valid to be sent
            if ($this->isLostBasketGuestEnabled(self::GUEST_LOST_BASKET_ONE, $storeId)) {
                $this->sendEmailCampaign($email, $quote, self::GUEST_LOST_BASKET_ONE, $template);
            } $items = $quote->getAllItems();

            $this->totalGuests++;
            $result = $this->totalGuests;
        }

        return $result;
    }

    /**
     * ProcessExistingAbandonedCart function
     *
     * @param int     $storeId   storeId
     * @param int     $websiteId websiteId
     * @param int     $number    number
     * @param boolean $guest     guest
     *
     * @return void
     */
    public function processExistingAbandonedCart($storeId, $websiteId, $number, $guest = false)
    {
        $result = 0;
        $fromTime = new \DateTime('now', new \DateTimezone('UTC'));

        if ($guest) {
            $interval = $this->getSendAfterIntervalForGuest($storeId, $number);
            $template = $this->getLostBasketGuestTemplate($number, $storeId);
            $message = 'Guest';
        } else {
            $interval = $this->getSendAfterIntervalForCustomerLogged($storeId, $number);
            $template = $this->getLostBasketCustomerTemplate($number, $storeId);
            $message = 'Customer';
        }

        $fromTime->sub($interval);
        $toTime = clone $fromTime;
        $fromTime->sub(\DateInterval::createFromDateString('10 mins'));

        $fromDate   = $fromTime->format('Y-m-d H:i:s');
        $toDate     = $toTime->format('Y-m-d H:i:s');

        //get abandoned carts already sent
        $abandonedCollection = $this->getAbandonedCartsForStore(
            $number,
            $fromDate,
            $toDate,
            $storeId,
            $guest
        );

        //quote collection based on the updated date from abandoned cart table
        $quoteIds = $abandonedCollection->getColumnValues('quote_id');

        if (empty($quoteIds)) {
            return $result;
        }

        $quoteCollection = $this->getProcessedQuoteByIds($quoteIds, $storeId);

        //found abandoned carts
        if ($quoteCollection->getSize()) {
            $this->helper->log($message . ' Abandoned Cart #' . $number . ', from: ' . $fromDate . ' - ' . $toDate . ', storeId '. $storeId);
        }

        foreach ($quoteCollection as $quote) {
            $quoteId = $quote->getId();
            $storeId = $quote->getStoreId();
            $email = $quote->getCustomerEmail();

            $abandonedModel = $this->abandonedFactory->create()->loadByQuoteId($quoteId, $storeId);

            //number of items changed or not active anymore
            if ($this->isItemsChanged($quote, $abandonedModel)) {
                if ($this->shouldDeleteAbandonedCart($quote)) {
                    $this->deleteAbandonedCart($abandonedModel);
                }
                continue;
            }
            $abandonedModel->setAbandonedCartNumber($number)
                ->setQuoteUpdatedAt($quote->getUpdatedAt())
                ->save();

            $this->sendEmailCampaign($email, $quote, $number, $template);
            $result++;
        }

        return $result;
    }

    /**
     * IsLostBasketCustomerEnabled
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function isLostBasketCustomerEnabled($num, $storeId)
    {
        return $this->scopeConfig->isSetFlag(
            constant('self::XML_PATH_LOSTBASKET_CUSTOMER_ENABLED_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * IsLostBasketGuestEnabled
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function isLostBasketGuestEnabled($num, $storeId)
    {
        return $this->scopeConfig->isSetFlag(
            constant('self::XML_PATH_LOSTBASKET_GUEST_ENABLED_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }/**
     * IsLostBasketWishlistEnabled
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function isLostBasketWishlistEnabled($storeId)
    {
        return $this->scopeConfig->isSetFlag(
            constant('self::XML_PATH_WISHLIST_ENABLED1'),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }



    /**
     * GetLostBasketSendAfterForCustomer
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function getLostBasketSendAfterForCustomer($num, $storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_LOSTBASKET_CUSTOMER_INTERVAL_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetLostBasketSendAfterForGuest
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return mixed
     */
    public function getLostBasketSendAfterForGuest($num, $storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_LOSTBASKET_GUEST_INTERVAL_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    /**
     * GetLostBasketSendAfterForWishlist
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function getLostBasketSendAfterForWishlist($storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_WISHLIST_INTERVAL'),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetLostBasketCustomerTemplate
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return mixed
     */
    public function getLostBasketCustomerTemplate($num, $storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_LOSTBASKET_CUSTOMER_TEMPLATE_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetLostBasketGuestTemplate
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return mixed
     */
    public function getLostBasketGuestTemplate($num, $storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_LOSTBASKET_GUEST_TEMPLATE_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetStoreQuotes
     *
     * @param date $from    from
     * @param date $to      to
     * @param bool $guest   guest
     * @param int  $storeId storeId
     *
     * @return \DateInterval
     */
    public function getStoreQuotes($from = null, $to = null, $guest = false, $storeId = 0)
    {
        $updated = [
            'from' => $from,
            'to' => $to,
            'datetime' => true,
        ];

        $salesCollection = $this->quoteCollectionFactory->create()
            ->addFieldToFilter('items_count', ['gt' => 0])
            ->addFieldToFilter('customer_email', ['neq' => ''])
            ->addFieldToFilter('store_id', $storeId)
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('main_table.updated_at', $updated);

        //guests
        if ($guest) {
            $salesCollection->addFieldToFilter('main_table.customer_id', ['null' => true]);
        } else {
            //customers
            $salesCollection->addFieldToFilter('main_table.customer_id', ['notnull' => true]);
        }

        return $salesCollection;
    }

    /**
     * GetSendAfterIntervalForCustomer
     *
     * @param int $storeId storeId
     * @param int $num     num
     *
     * @return \DateInterval
     */
    public function getSendAfterIntervalForCustomerLogged($storeId, $num)
    {
        $timeInterval = $this->getLostBasketSendAfterForCustomer($num, $storeId);
        if ($num == 1) {
            $interval = \DateInterval::createFromDateString($timeInterval . ' minutes');
        } else {
            $interval = \DateInterval::createFromDateString($timeInterval . ' hours');
        }

        return $interval;
    }

    /**
     * GetSendAfterIntervalForGuest
     *
     * @param int $storeId storeId
     * @param int $num     num
     *
     * @return \DateInterval
     */
    public function getSendAfterIntervalForGuest($storeId, $num)
    {
        $timeInterval = $this->getLostBasketSendAfterForGuest($num, $storeId);

        if ($num == 1) {
            $interval = \DateInterval::createFromDateString($timeInterval . ' minutes');
        } else {
            $interval = \DateInterval::createFromDateString($timeInterval . ' hours');
        }

        return $interval;
    }

    /**
     * GetSendAfterIntervalForGuest
     *
     * @param int $storeId storeId
     * @param int $num     num
     *
     * @return \DateInterval
     */
    public function getSendAfterIntervalForWishlist($storeId)
    {
        $timeInterval = $this->getLostBasketSendAfterForWishlist($storeId);
        $interval = \DateInterval::createFromDateString($timeInterval . ' minutes');
        return $interval;
    }

    /**
     * GetQuoteItemIds
     *
     * @param string $allItemsIds allItemsIds
     *
     * @return array
     */
    public function getQuoteItemIds($allItemsIds)
    {
        $itemIds = [];
        foreach ($allItemsIds as $item) {
            $itemIds[] = $item->getProductId();
        }

        return $itemIds;
    }

    /**
     * IsItemsChanged
     *
     * @param string $quote          quote
     * @param string $abandonedModel abandonedModel
     *
     * @return bool
     */
    public function isItemsChanged($quote, $abandonedModel)
    {
        if ($quote->getItemsCount() != $abandonedModel->getItemsCount()) {
            return true;
        } else {
            //number of items matches
            $quoteItemIds = $this->getQuoteItemIds($quote->getAllItems());
            $abandonedItemIds = explode(',', $abandonedModel->getItemsIds());

            //quote items not same
            if (!$this->isItemsIdsSame($quoteItemIds, $abandonedItemIds)) {
                return true;
            }

            return false;
        }
    }

    /**
     * CreateAbandonedCart
     *
     * @param string $abandonedModel abandonedModel
     * @param string $quote          quote
     * @param int    $itemIds        itemIds
     *
     * @return mixed
     */
    public function createAbandonedCart($abandonedModel, $quote, $itemIds)
    {
        $abandonedModel->setQuoteId($quote->getId())
            ->setStoreId($quote->getStoreId())
            ->setCustomerId($quote->getCustomerId())
            ->setEmail($quote->getCustomerEmail())
            ->setQuoteUpdatedAt($quote->getUpdatedAt())
            ->setAbandonedCartNumber(1)
            ->setItemsCount($quote->getItemsCount())
            ->setItemsIds(implode(',', $itemIds))
            ->save();
    }

    /**
     * SendEmailCampaign
     *
     * @param string $email     email
     * @param string $quote     quote
     * @param int    $number    number
     * @param string $template  template
     *
     * @return mixed
     */
    public function sendEmailCampaign($email, $quote, $number, $template)
    {
        $storeId = $quote->getStoreId();
        $customerId = $quote->getCustomerId();
        $customerName = $this->helper->getCustomerName($customerId);
        $message = ($customerId)? 'Customer Abandoned Cart #' . $number : 'Guest Abandoned Cart #' . $number;
        $campaign = $this->campaignFactory->create()
            ->setEmail($email)
            ->setCustomerId($customerId)
            ->setQuoteId($quote->getId())
            ->setMessage($message)
            ->setStoreId($storeId);

        $this->campaignResource->save($campaign);

        $this->sendAbandonedEmail($storeId, $email, $quote, $customerName, $template);
    }

    /**
     * SendAbandonedEmail function
     *
     * @param int    $storeId      storeId
     * @param string $email        email
     * @param string $quote        quote
     * @param string $customerName customerName
     * @param string $template     template
     *
     * @return void
     */
    public function sendAbandonedEmail($storeId, $email, $quote, $customerName, $template)
    {
        $quoteUrl = $this->frameworkTemplate->getUrl('visionet_abandoned_cart/cart/index', ['quote'=>$quote->getId()]);
        $templateOptions = ['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $storeId];
        $templateVars = [
            'store' => $this->storeManager->getStore($storeId),
            'customer_name' => $customerName,
            'items' => $quote->getAllItems(),
            'quoteurl' => $quoteUrl
        ];

        $from = ['name' => $this->scopeConfig->getValue("trans_email/ident_sales/name", \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId), 'email' => $this->scopeConfig->getValue("trans_email/ident_sales/email", \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId)];
        $this->inlineTranslation->suspend();
        $transport = $this->transportBuilder->setTemplateIdentifier($template)
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($email)
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
    }

    /**
     * AbandonedCartAlreadyExists function
     *
     * @param string $abandonedModel abandonedModel
     *
     * @return void
     */
    public function abandonedCartAlreadyExists($abandonedModel)
    {
        return $abandonedModel->getId();
    }

    /**
     * shouldNotSendAbandonedCartAgain
     *
     * @param string $abandonedModel abandonedModel
     * @param string $quote          quote
     *
     * @return bool
     */
    public function shouldNotSendAbandonedCartAgain($abandonedModel, $quote)
    {
        return !$quote->getIsActive() || $quote->getItemsCount() == 0 || !$this->isItemsChanged($quote, $abandonedModel);
    }

    /**
     * ShouldDeleteAbandonedCart
     *
     * @param string $quote quote
     *
     * @return bool
     */
    public function shouldDeleteAbandonedCart($quote)
    {
        return !$quote->getIsActive() || $quote->getItemsCount() == 0;
    }

    /**
     * DeleteAbandonedCart
     *
     * @param string $abandonedModel abandonedModel
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function deleteAbandonedCart($abandonedModel)
    {
        $this->abandonedResource->delete($abandonedModel);
    }

    /**
     * GetAbandonedCartsForStore
     *
     * @param int  $number  number
     * @param date $from    from
     * @param date $to      to
     * @param int  $storeId storeId
     * @param bool $guest   guest
     *
     * @return mixed
     */
    public function getAbandonedCartsForStore($number, $from, $to, $storeId, $guest = false)
    {
        $updated = [
            'from' => $from,
            'to'   => $to,
            'date' => true
        ];

        $abandonedCollection = $this->abandonedCollectionFactory->create()
            ->addFieldToFilter('abandoned_cart_number', --$number)
            ->addFieldToFilter('store_id', $storeId)
            ->addFieldToFilter('quote_updated_at', $updated);

        if ($guest) {
            $abandonedCollection->addFieldToFilter('customer_id', ['null' => true]);
        } else {
            $abandonedCollection->addFieldToFilter('customer_id', ['notnull' => true]);
        }

        return $abandonedCollection;
    }

    /**
     * GetProcessedQuoteByIds
     *
     * @param int $quoteIds quoteIds
     * @param int $storeId  storeId
     *
     * @return mixed
     */
    public function getProcessedQuoteByIds($quoteIds, $storeId)
    {
        $quoteCollection = $this->quoteCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => $quoteIds]);

        return $quoteCollection;
    }

    /**
     * Compare items ids.
     *
     * @param int $quoteItemIds     quoteItemIds
     * @param int $abandonedItemIds abandonedItemIds
     *
     * @return bool
     */
    public function isItemsIdsSame($quoteItemIds, $abandonedItemIds)
    {
        return $quoteItemIds == $abandonedItemIds;
    }

    public function saveProductToWishlist($product,$customerId,$buyRequest)
    {
        //load wishlist by customer id
        $wishlist = $this->_wishlistRepository->create()->loadByCustomerId($customerId, true);

        $result = $wishlist->addNewItem($product, $buyRequest); 

        $wishlist->save();
    } 
    
}