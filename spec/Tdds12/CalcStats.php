<?php

namespace spec\Tdds12;

use PHPSpec2\ObjectBehavior;

class CalcStats extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([6, 9, 15, -2, 92, 11]);
    }

    function it_should_calculate_minimum_value()
    {
        $this->getMinimumValue()->shouldReturn(-2);
    }

    function it_should_calculate_maximum_value()
    {
        $this->getMaximumValue()->shouldReturn(92);
    }

    function it_should_calculate_number_of_elements()
    {
        $this->countNumberOfElements()->shouldReturn(6);
    }

    function it_should_calculate_average_value()
    {
        $this->getAverageValue()->shouldReturn(21.833333);
    }

    function it_should_calculate_average_value_with_higher_precision()
    {
        $this->getAverageValue(8)->shouldReturn(21.83333333);
    }
}
