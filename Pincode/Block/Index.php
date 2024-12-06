<?php

/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Block;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template 
{
    /**
     * @var \Visionet\Pincode\Helper\Data
   */
   protected $_dataHelper;
   protected $request;
   protected $pincodeFactory;
   protected $day;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param \Visionet\Pincode\Helper\Data $dataHelper
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Visionet\Pincode\Model\PincodeFactory  $pincodeFactory      
    ) {
      
        parent::__construct($context);  
        $this->request=$request; 
        $this->pincodeFactory=$pincodeFactory;
    }

    public function getPincode()   
    {  
      $currentPincode = $this->request->getPostValue("pincode");
      
     
        $collection=$this->pincodeFactory->create()->getCollection();
        foreach($collection as $data)
        {
          $pin=$data->getData();
          $fromPincode=$pin['frompincode'];
          $toPincode=$pin['topincode'];

          if($currentPincode>=$fromPincode && $currentPincode<=$toPincode)
          {
            $day=$pin['no_of_days'];
            
            return $day;
          
          } 
        }
    }
}