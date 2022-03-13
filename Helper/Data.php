<?php


namespace BmzHicham\ImportCustomer\Helper;

use BmzHicham\ImportCustomer\Action\CreateCustomer;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

     /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    protected $_moduleReader;
    
    /**
     * @var \BmzHicham\ImportCustomer\Action\CreateCustomer
     */
    protected $_createCustomer;

    /**
     * @param \Magento\Framework\App\Helper\Context      $context       
     * @param \Magento\Store\Model\StoreManagerInterface $_storeManager 
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $_storeManager,        
        \Magento\Framework\Module\Dir\Reader $moduleReader,
        \BmzHicham\ImportCustomer\Action\CreateCustomer $createCustomer
    ) {
        parent::__construct($context);        
        $this->_moduleReader = $moduleReader;
        $this->_storeManager = $_storeManager;
        $this->_createCustomer = $createCustomer;
    }

    public function getDirectory()
    {
        $viewDir = $this->_moduleReader->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_VIEW_DIR,
            'BmzHicham_ImportCustomer'
        );
        
        return $viewDir . '/media/';
    }

    
    public function createCustomer(array $customer) 
    {
        $this->_createCustomer->execute($customer);
    }
   
    
}
