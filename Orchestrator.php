<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer;

use BmzHicham\ImportCustomer\Helper\Data;
use BmzHicham\ImportCustomer\Api\ImportProfileInterface;
use BmzHicham\ImportCustomer\Factory\ImporterFactory;
use BmzHicham\ImportCustomer\Strategy\ImporterStrategy;

class Orchestrator
{   
    protected $_helper; 
    protected $_importerStrategy;
    protected $_importerFactory;

    public function __construct(
        Data $helper,
        ImporterStrategy $importerStrategy,
        ImporterFactory $importerFactory) {
        $this->_helper = $helper;    
        $this->_importerStrategy = $importerStrategy;
        $this->_importerFactory = $importerFactory;
    }

    public function run(string $profile,string $fileName): ?string 
    {     
        $fileName = $this->_helper->getDirectory().$fileName;
        $importer = $this->_importerFactory->make($profile,$fileName);   
        if($importer instanceof ImportProfileInterface) {
            $this->_importerStrategy->setStrategy($importer);
            $customers_data = $this->_importerStrategy->fetchData();
            foreach($customers_data as $customer) {
                $this->_helper->createCustomer($customer);
            } 
            return 'All customer data has been successfully imported!!';           
        } else {
            throw $importer; 
        }     
    }    
    
}