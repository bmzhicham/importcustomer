<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Action;

use Magento\Framework\App\RequestFactory;
use Magento\Customer\Model\CustomerExtractor;
use Magento\Customer\Api\AccountManagementInterface;

class CreateCustomer
{
    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var CustomerExtractor
     */
    protected $customerExtractor;

    /**
     * @var AccountManagementInterface
     */
    protected $customerAccountManagement;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param RequestFactory $requestFactory
     * @param CustomerExtractor $customerExtractor
     * @param AccountManagementInterface $customerAccountManagement
     */
    public function __construct(
        RequestFactory $requestFactory,
        CustomerExtractor $customerExtractor,
        AccountManagementInterface $customerAccountManagement
    ) {
        $this->requestFactory = $requestFactory;
        $this->customerExtractor = $customerExtractor;
        $this->customerAccountManagement = $customerAccountManagement;
    }

    /**
     * Retrieve sources
     *
     * @return array
     */
    public function execute($customer)
    {
        
        $customerData = [
            'firstname' => $customer['fname'],
            'lastname' => $customer['lname'],
            'email' => $customer['emailaddress'],
        ];

        $password = 'CustomerPass123';

        $request = $this->requestFactory->create();
        $request->setParams($customerData);

        try {
            $customer = $this->customerExtractor->extract('customer_account_create', $request);
            $customer = $this->customerAccountManagement->createAccount($customer, $password);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}