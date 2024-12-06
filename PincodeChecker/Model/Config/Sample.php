<?php

/**  
* @category: PHP
* @package: Visionet/PincodeChecker
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_PincodeChecker
*/

namespace Visionet\PincodeChecker\Model\Config;

use Magento\Framework\UrlInterface;

class Sample implements \Magento\Config\Model\Config\CommentInterface
{
    protected $urlInterface;

    public function __construct(
        UrlInterface $urlInterface
    ) {
        $this->urlInterface = $urlInterface;
    }

    public function getCommentText($elementValue)
    {
        /*Create a link to download sample file*/ 
        $url = $this->urlInterface->getUrl('pincode/download/sample');

        return '<a href="' . $url . '">Download sample file</a>.';

   }
}

