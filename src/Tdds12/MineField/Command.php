<?php

namespace Tdds12\MineField;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends BaseCommand
{
    public function configure()
    {
        $this
            ->setName('mine-field:hints')
            ->setDescription('Generate hints for mine fields.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rows    = $this->getHelperSet()->get('dialog')->ask($output, 'Give rows:', 0);
        $columns = $this->getHelperSet()->get('dialog')->ask($output, 'Give columns:', 0);

        $output->writeln('==============');
        $hints = (new Hinter)->generateHints($this->getMineFields($output, $rows, $columns));
        $output->writeln('==============');

        foreach ($hints as $row) {
            $output->writeln($row);
        }
    }

    private function getMineFields(OutputInterface $output, $rows, $columns)
    {
        $answer  = 'exit';
        $mineFields = [];
        $i = 1;

        do {
            $answer = $this->getHelperSet()->get('dialog')->ask($output, '', array());
            $columnsInCurrentRow = strlen($answer);
            if ('exit' != $answer && $columns != $columnsInCurrentRow) {
                throw new \InvalidArgumentException(sprintf('You give "%d" columns but "%d" needed.', $columnsInCurrentRow, $columns));
            }
            $i++;
            $mineFields[] = $answer;
        } while('exit' != $answer && $i <= $rows);

        return $mineFields;
    }
}
