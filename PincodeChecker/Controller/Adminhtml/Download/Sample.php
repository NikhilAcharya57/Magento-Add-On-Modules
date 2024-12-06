<?php
/**  
* @category: PHP
* @package: Visionet/PincodeChecker
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_PincodeChecker
*/

namespace Visionet\PincodeChecker\Controller\Adminhtml\Download;
use Magento\Framework\App\Filesystem\DirectoryList;

class Sample extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }
    public function execute()
    { 
        /*To download sample csv file*/
        $filePath = 'media/SamplePincode/sample_pincode.csv';
        $downloadName = 'sample_pincode.csv';
        $content['type'] = 'filename';
        $content['value'] = $filePath;
        $content['rm'] = 0; // If you will set here 1 then, it will remove file from location.
        return $this->fileFactory->create($downloadName, $content, DirectoryList::PUB);
    }
}
