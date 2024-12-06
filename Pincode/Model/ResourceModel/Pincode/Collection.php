<?php

/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Model\ResourceModel\Pincode;

use Visionet\Pincode\Model\Pincode;
use Visionet\Pincode\Model\ResourceModel\Pincode as PinResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Pincode::class, PinResourceModel::class);    
    }

  
}
