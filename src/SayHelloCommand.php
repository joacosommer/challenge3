<?php 
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SayHelloCommand extends Command{

    public function configure()
    {
        $this->setName('sayHelloTo')
             ->setDescription('Decir hola')
             ->addArgument('name', InputArgument::REQUIRED, 'Your name');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $message = 'Hola, ' . $input->getArgument('name');

        $output->writeln("<info>{$message}</info>");
        return 0;
    }
    
}