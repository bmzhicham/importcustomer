<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Factory;

use Exception;
use BmzHicham\ImportCustomer\Model\Import\Csv;
use BmzHicham\ImportCustomer\Model\Import\Json;


class ImporterFactory
{    
    public function make(string $profile,string $fileName) : ?Object
    {
        $profile = strtolower($profile);
        switch ($profile) {
            case 'sample-csv':
                return new Csv($fileName);
            case 'sample-json':
                return new Json($fileName);                   
        }  

        return new Exception("No profile found"); 
    }
}