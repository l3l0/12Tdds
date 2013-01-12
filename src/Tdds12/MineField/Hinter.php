<?php

namespace Tdds12\MineField;

class Hinter
{
    private $hintMatrix = array();

    public function generateHints($mineMatrix)
    {
        $this->initializeHintMatrix($mineMatrix);

        foreach ($this->hintMatrix as $rowNumber => $row) {
            foreach(str_split($row) as $colNumber => $element) {
                if ($this->isMine($element)) {
                    $this->incrementSurroundingFields($rowNumber, $colNumber);
                }
            }
        }

        return $this->hintMatrix;
    }

    protected function initializeHintMatrix($mineMatrix)
    {
        $this->hintMatrix = $mineMatrix;
        foreach ($this->hintMatrix as $rowNumber => $row) {
            $this->hintMatrix[$rowNumber] = str_replace('.', '0', $row);
        }
    }

    private function isMine($element)
    {
        return '*' == $element;
    }

    private function incrementSurroundingFields($rowNumber, $colNumber)
    {
        $this->incrementHintField($rowNumber, $colNumber + 1);
        $this->incrementHintField($rowNumber, $colNumber - 1);

        $this->incrementRowFields($rowNumber - 1, $colNumber);
        $this->incrementRowFields($rowNumber + 1, $colNumber);
    }

    private function incrementRowFields($rowNumber, $colNumber)
    {
        $this->incrementHintField($rowNumber, $colNumber - 1);
        $this->incrementHintField($rowNumber, $colNumber);
        $this->incrementHintField($rowNumber, $colNumber + 1);
    }

    private function incrementHintField($rowNumber, $colNumber)
    {
        if (isset($this->hintMatrix[$rowNumber][$colNumber]) && !$this->isMine($this->hintMatrix[$rowNumber][$colNumber])) {
            $this->hintMatrix[$rowNumber][$colNumber] = (int) $this->hintMatrix[$rowNumber][$colNumber] + 1;
        }
    }
}
