<?php
/**
 * Class Index
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Controller\Cart;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Request
     *
     * @var string
     */
    protected $request;

    /**
     * QuoteFactory
     *
     * @var \Magento\Quote\Model\QuoteFactory
     */
    protected $quoteRepository;

    /**
     * Session
     *
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * ResultFactory
     *
     * @var ResultFactory
     */
    protected $resultRedirect;

    /**
     * Index constructor.
     *
     * @param \Magento\Framework\App\Action\Context $context         context
     * @param \Magento\Quote\Model\QuoteFactory     $quoteRepository quoteRepository
     * @param \Magento\Checkout\Model\Session       $checkoutSession checkoutSession
     * @param ResultFactory                         $result          result
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Quote\Model\QuoteFactory $quoteRepository,
        \Magento\Checkout\Model\Session $checkoutSession,
        ResultFactory $result
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->checkoutSession = $checkoutSession;
        $this->resultRedirect = $result;
        parent::__construct($context);
    }

    /**
     * Execute
     *
     * @return mixed
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $quoteId = $params['quote'];
        $quote = $this->quoteRepository->create()->load($quoteId);
        $this->checkoutSession->replaceQuote($quote);

        
        $redirectUrl = $this->_url->getUrl('checkout/cart');
        $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($redirectUrl);
        return $resultRedirect;
    }
}

