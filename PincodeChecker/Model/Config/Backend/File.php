<?php
/**  
* @category: PHP
* @package: Visionet/PincodeChecker
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_PincodeChecker
*/

namespace Visionet\PincodeChecker\Model\Config\Backend;

class File extends \Magento\Config\Model\Config\Backend\File
{
    /*Validate to allow only csv file*/ 
    public function _getAllowedExtensions() {
        return ['csv'];   
    }
}