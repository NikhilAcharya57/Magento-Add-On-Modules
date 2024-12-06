<?php
/**
 * Class Cron
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Model;

/**
 * Class Cron
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
class Cron
{
    /**
     * QuoteFactory
     *
     * @var Sales\QuoteFactory
     */
    public $quoteFactory;

    /**
     * HelperData
     *
     * @var \Visionet\AbandonedCart\Helper\Data
     */
    public $helper;

    /**
     * CollectionFactory
     *
     * @var ResourceModel\Cron\CollectionFactory
     */
    public $cronCollection;

    /**
     * Cron constructor.
     *
     * @param Sales\QuoteFactory                    $quoteFactory   quoteFactory
     * @param \Visionet\AbandonedCart\Helper\Data $helper         helper
     * @param ResourceModel\Cron\CollectionFactory  $cronCollection cronCollection
     */
    public function __construct(
        \Visionet\AbandonedCart\Model\Sales\QuoteFactory $quoteFactory,
        \Visionet\AbandonedCart\Helper\Data $helper,
        \Visionet\AbandonedCart\Model\ResourceModel\Cron\CollectionFactory $cronCollection
    ) {
        $this->quoteFactory = $quoteFactory;
        $this->helper = $helper;
        $this->cronCollection = $cronCollection;
    }

    /**
     * CRON FOR ABANDONED CARTS.
     *
     * @return null
     */
    public function abandonedCarts()
    {
        if ($this->jobHasAlreadyBeenRun('visionet_abandoned_cart')) {
            $this->helper->log('Skipping visionet_abandoned_cart job run');
            return;
        }
        $this->quoteFactory->create()->processAbandonedCarts();
    }
    public function carttowishlist()
    {
        if ($this->jobHasAlreadyBeenRun('visionet_from_cart_to_wishlist')) {
            $this->helper->log('Skipping visionet_from_cart_to_wishlist job run');
            return;
        }
        $this->quoteFactory->create()->processWishlists();
    }
    


    /**
     * Check if already ran for same time
     *
     * @param string $jobCode jobCode
     *
     * @return bool
     */
    public function jobHasAlreadyBeenRun($jobCode)
    {
        $currentRunningJob = $this->cronCollection->create()
            ->addFieldToFilter('job_code', $jobCode)
            ->addFieldToFilter('status', 'running')
            ->setPageSize(1);

        if ($currentRunningJob->getSize()) {
            $jobOfSameTypeAndScheduledAtDateAlreadyExecuted =  $this->cronCollection->create()
                ->addFieldToFilter('job_code', $jobCode)
                ->addFieldToFilter('scheduled_at', $currentRunningJob->getFirstItem()->getScheduledAt())
                ->addFieldToFilter('status', ['in' => ['success', 'failed']]);

            return ($jobOfSameTypeAndScheduledAtDateAlreadyExecuted->getSize()) ? true : false;
        }

        return false;
    }
}
