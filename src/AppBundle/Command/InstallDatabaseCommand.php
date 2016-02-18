<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class InstallDatabaseCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('app:init')
            ->setDescription('Will initialize the application (database)')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var KernelInterface $kernel */
        $kernel = $this->getContainer()->get('kernel');
        $app = new Application($kernel);
        $app->setAutoExit(false);
        $commands = [
            ['command' => 'doctrine:database:drop', '--force' => true, '--if-exists' => true,],
            ['command' => 'doctrine:database:create',],
            ['command' => 'doctrine:schema:create',],
        ];

        foreach ($commands as $command) {
            $app->run(new ArrayInput($command));
        }

        return 0;
    }
}