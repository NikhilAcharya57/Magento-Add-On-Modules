<?php

/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Model\Config;

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
        $url = $this->urlInterface->getUrl('pincode/download/sample');

       return '<a href="' . $url . '">Download sample file</a>.';

   }
}

