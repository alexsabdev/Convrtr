<?php

namespace Alexsabdev\Convrtr\Commands;

use Alexsabdev\Convrtr\Readers\JSONReader;
use Alexsabdev\Convrtr\Writers\CSVWriter;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JSON2CSVCommand extends Command
{
    /**
     * @return void
     */
    protected function configure() : void
    {
        $this
            ->setName('json2csv')
            ->setDescription('Converts a JSON file to a CSV file')
            ->addArgument('src', InputArgument::REQUIRED, 'Source JSON file')
            ->addArgument('dst', InputArgument::REQUIRED, 'Destination CSV file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln('<info>Converting...</info>');

        $reader = new JSONReader();
        $writer = new CSVWriter();
        $src = $input->getArgument('src');
        $dst = $input->getArgument('dst');

        try {
            $str = $reader->read($src);
            $arr = $reader->parse($str);
            $normArr = $reader->normalize($arr);
            $writer->write($dst, $normArr);
        } catch (Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            exit;
        }

        $output->writeln('<info>Converted successfully!</info>');
    }
}