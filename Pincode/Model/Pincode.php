<?php

/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Model;
use Magento\Framework\Model\AbstractModel;

class Pincode extends AbstractModel
{   
    const CACHE_TAG = 'pincode_checker';
	protected $_cacheTag = 'pincode_checker';
	protected $_eventPrefix = 'pincode_checker';

    protected function _construct()
    {
        $this->_init(ResourceModel\Pincode::class);
    }
}
