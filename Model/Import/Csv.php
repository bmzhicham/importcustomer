<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Model\Import;

use SplFileObject;
use LimitIterator;
use BmzHicham\ImportCustomer\Api\ImportProfileInterface;


class Csv extends SplFileObject implements ImportProfileInterface
{
    protected $filename;
    protected $_path;

    public function __construct($filename = '', $mode = 'r', $useIncludePath  = false, $context = null)
    {        
        parent::__construct($filename, $mode, $useIncludePath, $context);
        $this->setFlags(SplFileObject::READ_CSV);
        $this->setCsvControl(',');
    }

    public function fetchData(): array 
    {  
        $customers_data = [];
        $header = $this->current();
        foreach(new LimitIterator($this, 1) as $line){
            if (!in_array(null, $line, true)) {
                $customers_data[] = array_combine($header,$line);
            }
        }   
        return $customers_data;
    }

}