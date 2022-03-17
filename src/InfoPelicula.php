<?php 
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Client;

class InfoPelicula extends Command{
    public function configure()
    {
        $this->setName('show')
             ->setDescription('Mostrar tabla con info pelicula')
             ->addArgument('movieName', InputArgument::REQUIRED, 'Movie name')
             ->addOption('fullPlot', null, InputOPTION::VALUE_NONE, 'Full plot');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $client = new Client(['base_uri' => 'http://www.omdbapi.com/?apikey=78e88e5e&t=' . $input->getArgument('movieName')]);
        if($input->getOption('fullPlot')){
            $client = new Client(['base_uri' => 'http://www.omdbapi.com/?apikey=78e88e5e&t=' . $input->getArgument('movieName') . '&plot=full']);
        }

        $response = $client->request('GET');
        $body = $response->getBody();

        $jsonInfo = json_decode($body, true);
        $titulo = $jsonInfo["Title"] . " - " . $jsonInfo["Year"];
        $output->writeln("<info>{$titulo}</info>");
        $table->setHeaders(['Title','Data']);
        $rows = [];
        foreach($jsonInfo as $dato => $value)
        {
            if ($dato != 'Ratings'){
                $rows[] = [$dato,$jsonInfo[$dato]];
            }
        }
        $table->addRows($rows);
        $table->render();
        return 0;
    }
}