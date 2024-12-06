<?php
 
namespace Visionet\Stock\Block;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    private $getSalableQtyDataBySku;
    private $customer;
    protected $request;
    private $stockFactory;
    private $messageManager;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        StockItemRepository $stockItemRepository,
        GetSalableQuantityDataBySku $getSalableQtyDataBySku,
        \Magento\Customer\Model\Session $customer,
        \Magento\Framework\App\RequestInterface $request,
        \Visionet\Stock\Model\StockFactory $stockFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->stockItemRepository = $stockItemRepository;
        $this->getSalableQtyDataBySku = $getSalableQtyDataBySku;
        $this->customer = $customer;
        $this->request=$request; 
        $this->stockFactory = $stockFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context, $data);
    }
 
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
 
    public function getCurrentProduct()
    {
       
        return $this->_registry->registry('current_product');
    }

    public function getSalableQtyBySku($sku)
    {
         $salable = $this->getSalableQtyDataBySku->execute($sku);
         return $salable;
        
    }

    public function storeData()
    {
        $product=$this->getCurrentProduct();
        $id=$product->getId();
        //$productName=$product->getName();
        $customerId=$this->customer->getId();
        //print_r($this->customer);
        $customerName=$this->customer->getName();

        $email = $this->request->getPostValue("email");

        $data=['customer_id' => $customerId,'customer_name'=>$customerName,'email'=>$email,'product_id'=>$id];
        $model = $this->stockFactory->create();
        $model->addData($data);
        try{
            $model->save();
            $this->messageManager->addSuccessMessage(_("Email sent successfully"));
        }
        catch (\Exception $e) {
           $this->messageManager->addErrorMessage(__("Something went wrong..."));
        }

    }

    public function getCustomer()
        {
            return $this->customer;
        }
}
 
?>