<?php

namespace spec\Tdds12\MineField;

use PHPSpec2\ObjectBehavior;

class Command extends ObjectBehavior
{
    /**
     * @param Symfony\Component\Console\Helper\HelperSet $helperSet
     * @param Symfony\Component\Console\Helper\DialogHelper $dialogHelper
     */
    function let($helperSet, $dialogHelper)
    {
        $helperSet->get('dialog')->willReturn($dialogHelper);
        $this->setHelperSet($helperSet);
    }

    function it_should_be_console_command()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }

    function it_should_configured_during_creation()
    {
        $this->getName()->shouldReturn('mine-field:hints');
        $this->getDescription()->shouldReturn('Generate hints for mine fields.');
    }

    /**
     * @param Symfony\Component\Console\Input\InputInterface $input
     * @param Symfony\Component\Console\Output\OutputInterface $output
     * @param Symfony\Component\Console\Helper\DialogHelper $dialogHelper
     */
    function it_should_get_user_input($input, $output, $dialogHelper)
    {
        $dialogHelper->ask($output, 'Give rows:', 0)->shouldBeCalled()->willReturn('3');
        $dialogHelper->ask($output, 'Give columns:', 0)->shouldBeCalled()->willReturn('4');

        $dialogHelper->ask($output, '', array())->willReturn('*...');
        $dialogHelper->ask($output, '', array())->willReturn('.*..');
        $dialogHelper->ask($output, '', array())->willReturn('....');
        $dialogHelper->ask($output, '', array())->willReturn('exit');

        $output->writeln('==============')->shouldBeCalled();
        $output->writeln('*210')->shouldBeCalled();
        $output->writeln('2*10')->shouldBeCalled();
        $output->writeln('1110')->shouldBeCalled();
        $this->run($input, $output);
    }

    /**
     * @param Symfony\Component\Console\Input\InputInterface $input
     * @param Symfony\Component\Console\Output\OutputInterface $output
     * @param Symfony\Component\Console\Helper\DialogHelper $dialogHelper
     */
    function it_should_validate_column_number($input, $output, $dialogHelper)
    {
        $dialogHelper->ask($output, 'Give rows:', 0)->shouldBeCalled()->willReturn('3');
        $dialogHelper->ask($output, 'Give columns:', 0)->shouldBeCalled()->willReturn('4');
        $output->writeln('==============')->shouldBeCalled();
        $dialogHelper->ask($output, '', array())->willReturn('*..');
        $output->writeln(ANY_ARGUMENT)->shouldNotBeCalled();
        $this->shouldThrow(new \InvalidArgumentException('You give "3" columns but "4" needed.'))->duringRun($input, $output);
    }

    /**
     * @param Symfony\Component\Console\Input\InputInterface $input
     * @param Symfony\Component\Console\Output\OutputInterface $output
     * @param Symfony\Component\Console\Helper\DialogHelper $dialogHelper
     */
    function it_should_convert_only_given_amount_of_rows($input, $output, $dialogHelper)
    {
        $dialogHelper->ask($output, 'Give rows:', 0)->shouldBeCalled()->willReturn('3');
        $dialogHelper->ask($output, 'Give columns:', 0)->shouldBeCalled()->willReturn('4');
        $dialogHelper->ask($output, '', array())->willReturn('*...');
        $dialogHelper->ask($output, '', array())->willReturn('.*..');
        $dialogHelper->ask($output, '', array())->willReturn('....');
        $dialogHelper->ask($output, '', array())->willReturn('....');

        $output->writeln('==============')->shouldBeCalled();
        $output->writeln('*210')->shouldBeCalled();
        $output->writeln('2*10')->shouldBeCalled();
        $output->writeln('1110')->shouldBeCalled();
        $output->writeln('0000')->shouldNotBeCalled();

        $this->run($input, $output);
    }
}
