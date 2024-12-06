<?php

/**  
* @category: PHP
* @package: Visionet/PincodeChecker
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_PincodeChecker
*/

namespace Visionet\PincodeChecker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $context;
    protected $request;

    public function __construct(Context $context,\Magento\Framework\App\RequestInterface $request)
    {
        $this->context = $context;
        $this->request=$request;
        parent::__construct($context);
    }

    public function isEnable()
    {
        /*Check wheather PincodeChecker module enabled or not*/
        return $this->scopeConfig->getValue('pincode/general/enable', ScopeInterface::SCOPE_STORE);
    }
}