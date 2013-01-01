<?php

namespace spec\Tdds12;

use PHPSpec2\ObjectBehavior;

class NumberSpeller extends ObjectBehavior
{
    function it_should_spell_out_number()
    {
        $this->spellOut(0)->shouldReturn('zero');
        $this->spellOut(1)->shouldReturn('one');
        $this->spellOut(2)->shouldReturn('two');
        $this->spellOut(3)->shouldReturn('three');
        $this->spellOut(9)->shouldReturn('nine');
    }

    function it_should_spell_out_tens_numbers()
    {
        $this->spellOut(10)->shouldReturn('ten');
        $this->spellOut(11)->shouldReturn('eleven');
        $this->spellOut(12)->shouldReturn('twelve');
        $this->spellOut(13)->shouldReturn('thirteen');
        $this->spellOut(14)->shouldReturn('fourteen');
        $this->spellOut(20)->shouldReturn('twenty');
        $this->spellOut(81)->shouldReturn('eighty one');
        $this->spellOut(82)->shouldReturn('eighty two');
        $this->spellOut(93)->shouldReturn('ninety three');
        $this->spellOut(99)->shouldReturn('ninety nine');
    }

    function it_should_spell_out_hundreds_numbers()
    {
        $this->spellOut(100)->shouldReturn('one hundred');
        $this->spellOut(300)->shouldReturn('three hundred');
        $this->spellOut(380)->shouldReturn('three hundred eighty');
        $this->spellOut(310)->shouldReturn('three hundred and ten');
        $this->spellOut(311)->shouldReturn('three hundred and eleven');
        $this->spellOut(312)->shouldReturn('three hundred and twelve');
    }

    function it_should_spell_out_thousands_number()
    {
        $this->spellOut(1000)->shouldReturn('one thousand');
        $this->spellOut(1001)->shouldReturn('one thousand and one');
        $this->spellOut(1501)->shouldReturn('one thousand, five hundred and one');
        $this->spellOut(1500)->shouldReturn('one thousand and five hundred');
        $this->spellOut(12609)->shouldReturn('twelve thousand, six hundred and nine');
        $this->spellOut(512607)->shouldReturn('five hundred and twelve thousand, six hundred and seven');
    }

    function it_should_spell_out_millions_number()
    {
        $this->spellOut(43112603)->shouldReturn('forty three million, one hundred and twelve thousand, six hundred and three');
    }

    function it_should_spell_out_billions_number()
    {
        $this->spellOut(100000000001)->shouldReturn('one hundred billion and one');
    }

    function it_should_spell_out_trillion_number()
    {
        $this->spellOut(10000000000100)->shouldReturn('ten trillion one hundred');
        $this->spellOut(10000000000104)->shouldReturn('ten trillion, one hundred and four');
    }
}
