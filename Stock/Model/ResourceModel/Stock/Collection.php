<?php

namespace Visionet\Stock\Model\ResourceModel\Pincode;

use Visionet\Stock\Model\Stock;
use Visionet\Stock\Model\ResourceModel\Stock as StockResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Stock::class, StockResourceModel::class);    
    }

  
}
