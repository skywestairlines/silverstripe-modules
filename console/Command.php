<?php

use Symfony\Component\Console\Command\Command as SymCmd;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymCmd
{

    public function __construct()
    {
        parent::__construct();
    }

}
