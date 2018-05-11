<?php

namespace Alexsabdev\Convrtr\Commands;

use Alexsabdev\Convrtr\Readers\CSVReader;
use Alexsabdev\Convrtr\Writers\JSONWriter;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CSV2JSONCommand
 * @package Alexsabdev\Convrtr\Commands
 */
class CSV2JSONCommand extends Command
{
    /**
     * @return void
     */
    protected function configure() : void
    {
        $this
            ->setName('csv2json')
            ->setDescription('Converts a CSV file to a JSON file')
            ->addArgument('src', InputArgument::REQUIRED, 'Source CSV file')
            ->addArgument('dst', InputArgument::REQUIRED, 'Destination JSON file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln('<info>Converting...</info>');

        $reader = new CSVReader();
        $writer = new JSONWriter();
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