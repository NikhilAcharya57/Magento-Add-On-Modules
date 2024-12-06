<?php

namespace Visionet\Stock\Model;
use Magento\Framework\Model\AbstractModel;

class Stock extends AbstractModel
{   
    const CACHE_TAG = 'visionet_stock';
	protected $_cacheTag = 'visionet_stock';
	protected $_eventPrefix = 'visionet_stock';

    protected function _construct()
    {
        $this->_init(ResourceModel\Stock::class);
    }
}
