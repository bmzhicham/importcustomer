<?php
declare(strict_types=1);

namespace BmzHicham\ImportCustomer\Console;

use BmzHicham\ImportCustomer\Orchestrator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ImportCustomerCli extends Command
{
    const PROFILE = 'profile';
    const PATH = 'path';
    protected $_orchestrator;
    
    /** @var \Magento\Framework\App\State **/
    private $_state;
    
    public function __construct(Orchestrator $orchestrator,\Magento\Framework\App\State $state,$name = null)
    {
        $this->_orchestrator = $orchestrator;
        $this->_state = $state;
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $result = $this->_orchestrator->run($input->getArgument(self::PROFILE),$input->getArgument(self::PATH));        
        $output->writeln($result);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("customer:import");
        $this->setDescription(__("iMPORT CUSTOMER JSON/CSV"));
        $this->setDefinition([
             new InputArgument(
                  self::PROFILE,
                   InputArgument::REQUIRED,
                   'Profile'
             ),
             new InputArgument(
                  self::PATH,
                  InputArgument::REQUIRED,
                  'Path'
             )
        ]);

        parent::configure();
    }
    
}