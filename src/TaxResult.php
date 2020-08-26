<?php

namespace YaFou\TaxCalculator;

class TaxResult
{
    private $salary;
    private $tax;
    private $balance;

    public function __construct(int $salary, float $tax)
    {
        $this->salary = $salary;
        $this->tax = round($tax, 2);
        $this->balance = round($salary - $tax, 2);
    }

    public function getSalary(): int
    {
        return $this->salary;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
