<?php
/**
 * Class Collection
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Model\ResourceModel\Abandoned;

/**
 * Class Collection
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * IdFieldName
     *
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize resource collection.
     *
     * @return null
     */
    public function _construct()
    {
        $this->_init(
            \Visionet\AbandonedCart\Model\Abandoned::class,
            \Visionet\AbandonedCart\Model\ResourceModel\Abandoned::class
        );
    }
}
