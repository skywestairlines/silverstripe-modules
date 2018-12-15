<?php

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddController extends Command
{
    public function configure()
    {
        $this ->setName('add:controller')->setDescription('Add controller')
            ->setHelp('This command allows you to create a new controller...')
            ->addArgument('name', InputArgument::REQUIRED, 'name of the controller.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

    }

}
