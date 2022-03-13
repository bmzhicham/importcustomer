<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Model\Import;

use SplFileObject;
use BmzHicham\ImportCustomer\Api\ImportProfileInterface;

class Json extends SplFileObject implements ImportProfileInterface
{
    protected $filename;
    protected $_path;

    public function __construct($filename = '', $mode = 'r', $useIncludePath  = false, $context = null)
    {
        parent::__construct($filename, $mode, $useIncludePath, $context);
    }
    
    public function fetchData(): array 
    {     
        $customers_data = [];
        $customers_data = json_decode($this->fread($this->getSize()), true);        
           
        return $customers_data;
    }

}