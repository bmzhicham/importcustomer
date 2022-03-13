<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Api;

interface ImportProfileInterface
{
    public function fetchData(): array;
}