<?php

/**  
* @category: PHP
* @package: Visionet/PincodeChecker
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_PincodeChecker
*/

namespace Visionet\PincodeChecker\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pincode extends AbstractDb
{
    const MAIN_TABLE = 'pincode_checker';
    const ID_FIELD_NAME = 'id';
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
