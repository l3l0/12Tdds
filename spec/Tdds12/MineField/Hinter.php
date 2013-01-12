<?php

namespace spec\Tdds12\MineField;

use PHPSpec2\ObjectBehavior;

class Hinter extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Tdds12\MineField\Hinter');
    }

    function it_should_generate_hints_array_for_3x4_mine_matrix()
    {
        $hints = $this->generateHints(array(
            '*...',
            '..*.',
            '....',
        ));

        $hints->shouldBe(array(
            '*211',
            '12*1',
            '0111',
        ));
    }

    function it_should_generate_hints_array_for_5x4_mine_matrix()
    {
        $hints = $this->generateHints(array(
            '*...',
            '.*..',
            '....',
            '....',
            '*...',
        ));

        $hints->shouldBe(array(
            '*210',
            '2*10',
            '1110',
            '1100',
            '*100',
        ));
    }
}
