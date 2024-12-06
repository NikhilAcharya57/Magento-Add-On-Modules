<?php 

/**  
* @category: PHP
* @package: Visionet/Pincode
* @copyright: Visionet Systems Limited. All rights reserved.
* @license: Visionet Systems Limited
* @author: Nikhil A <nikhil.a@visionetsystems.com>
* @keywords: Module Visionet_Pincode
*/

namespace Visionet\Pincode\Observer; 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Visionet\Pincode\Model\PincodeFactory;

class Update implements ObserverInterface
{
protected $messageManager;

protected $pincodeFactory;

protected $csv;

public $_storeManager;

protected $_scopeConfig;

public function __construct(
    \Magento\Framework\Message\ManagerInterface $messageManager,
    PincodeFactory $pincodeFactory,
    \Magento\Framework\File\Csv $csv,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
)
{    
    $this->messageManager = $messageManager; 
    $this->pincodeFactory = $pincodeFactory;
    $this->csv = $csv;   
    $this->_storeManager = $storeManager;
    $this->_scopeConfig = $scopeConfig;
}

/**
 * Below is the method that will fire whenever the event runs!
 *
 * @param Observer $observer
 */
public function execute(Observer $observer)
{
    try{
        $model = $this->pincodeFactory->create();
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $uploadedCsvFilePath = $this->_scopeConfig->getValue("pincode/general/csv_file_upload", $storeScope);

        $pubMediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $uploadedCsv = $pubMediaUrl."PincodeDir/".$uploadedCsvFilePath;

        if($uploadedCsvFilePath != ''){

            $handle = fopen($uploadedCsv, "r");

            $csv = array_map("str_getcsv", file($uploadedCsv,FILE_SKIP_EMPTY_LINES));
            array_shift($csv);

            // If NASM IDs exist truncate table
            // File uploaded will have IDs already in the database, not just new ones
            if (!empty($model)) {
                $connection = $model->getResource()->getConnection();
                $tableName = $model->getResource()->getMainTable();
                $connection->truncateTable($tableName);
            }

            foreach ($csv as $i=>$row) {
                $country = $row[0]; 
                $state = $row[1]; 
                $fromPincode = $row[2]; 
                $toPincode = $row[3]; 
                $noOfDays = $row[4]; 
                $data = array('country' => $country,
                         'state' => $state,
                         'frompincode' => $fromPincode,
                         'topincode' => $toPincode ,'no_of_days' => $noOfDays);
                $model->setData($data);
                $model->save();      
            }
            $this->messageManager->addSuccessMessage("File uploaded successfully.");    
          
        }
    }catch(Exception $e) {

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/nasmlog.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $error_message = "Unable to read csv file. Error: " . $e->getMessage() . '. See exception.log for full error log.';

        $this->messageManager->addError($error_message);
        $logger->info($e);
    }
}
}
