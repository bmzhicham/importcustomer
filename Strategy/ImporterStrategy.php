<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Strategy;

use BmzHicham\ImportCustomer\Api\ImportProfileInterface;

class ImporterStrategy
{
    protected $_strategy;

    
    public function getStrategy()
    {
        return $this->_strategy;
    }

    public function setStrategy(ImportProfileInterface $strategy)
    {
        $this->_strategy = $strategy;
    }
    public function fetchData()
    {
       return $this->_strategy->fetchData();
    }
}