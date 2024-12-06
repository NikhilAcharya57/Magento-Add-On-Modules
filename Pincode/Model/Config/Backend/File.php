<?php
/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Model\Config\Backend;

class File extends \Magento\Config\Model\Config\Backend\File
{
    public function _getAllowedExtensions() {
        return ['csv'];   
    }
}