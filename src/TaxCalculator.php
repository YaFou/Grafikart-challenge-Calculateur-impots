<?php

namespace YaFou\TaxCalculator;

class TaxCalculator
{
    private const GROUPS = [
        10064 => 0,
        25659 => .11,
        73369 => .3,
        157806 => .41,
        PHP_INT_MAX => .45
    ];

    public function calculateTax(int $salary, bool $couple = false, int $children = 0): TaxResult
    {
        $quotient = $couple ? 2 + $children * .5 : 1;
        $newSalary = $salary / $quotient;
        $tax = 0;
        $lastThreshold = 0;

        foreach (self::GROUPS as $threshold => $percentage) {
            if ($threshold >= $newSalary) {
                $tax += ($newSalary - $lastThreshold) * $percentage;

                break;
            }

            $tax += ($threshold - $lastThreshold) * $percentage;
            $lastThreshold = $threshold;
        }

        $tax = $tax * $quotient;

        return new TaxResult($salary, $tax);
    }
}
