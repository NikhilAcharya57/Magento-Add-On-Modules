<?php
/**
 * Class Abandoned
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Model\ResourceModel;

/**
 * Class Abandoned
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
class Abandoned extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * HelperData
     *
     * @var \Visionet\AbandonedCart\Helper\Data
     */
    public $helper;

    /**
     * Initialize resource.
     *
     * @return null
     */
    public function _construct()
    {
        $this->_init('visionet_abandoned_cart', 'id');
    }

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context context
     * @param \Visionet\AbandonedCart\Helper\Data             $data    data
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Visionet\AbandonedCart\Helper\Data $data
    ) {
        $this->helper = $data;
        parent::__construct($context);
    }
}
