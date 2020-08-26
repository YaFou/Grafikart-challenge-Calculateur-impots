<?php

namespace YaFou\TaxCalculator\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use YaFou\TaxCalculator\TaxCalculator;

class TaxCalculatorTest extends TestCase
{
    /** @var TaxCalculator */
    private static $calculator;

    public static function setUpBeforeClass(): void
    {
        self::$calculator = new TaxCalculator();
    }

    /**
     * @dataProvider provideSalariesAndTaxes
     */
    public function testCalculateTax(int $salary, float $tax): void
    {
        $result = self::$calculator->calculateTax($salary);
        $this->assertSame($tax, $result->getTax());
    }

    public function provideSalariesAndTaxes(): Generator
    {
        yield [5000, 0];
        yield [11000, (11000 - 10064) * .11];

        yield [
            32000,
            (25659 - 10064) * .11 +
            (32000 - 25659) * .3
        ];

        yield [
            80000,
            (25659 - 10064) * .11 +
            (73369 - 25659) * .3 +
            (80000 - 73369) * .41
        ];

        yield [
            180000,
            (25659 - 10064) * .11 +
            (73369 - 25659) * .3 +
            (157806 - 73369) * .41 +
            (180000 - 157806) * .45
        ];

        yield [10064, 0];
        yield [25659, (25659 - 10064) * .11];

        yield [
            73369,
            (25659 - 10064) * .11 +
            (73369 - 25659) * .3
        ];

        yield [
            157806,
            (25659 - 10064) * .11 +
            (73369 - 25659) * .3 +
            (157806 - 73369) * .41
        ];
    }

    /**
     * @dataProvider provideSalariesTaxesCoupleAndChildren
     */
    public function testCalculateTaxWithCoupleAndChildren(int $salary, float $tax, int $children = 0): void
    {
        $result = self::$calculator->calculateTax($salary, true, $children);
        $this->assertSame($tax, $result->getTax());
    }

    public function provideSalariesTaxesCoupleAndChildren(): Generator
    {
        yield [5000, 0];
        yield [11000, 0];
        yield [40000, (40000 / 2 - 10064) * .11 * 2];

        yield [
            55950,
            ((25659 - 10064) * .11 +
            (55950 / 2 - 25659) * .3) * 2
        ];

        yield [
            55950,
            (55950 / 2.5 - 10064) * .11 * 2.5,
            1
        ];

        yield [
            55950,
            (55950 / 3 - 10064) * .11 * 3,
            2
        ];

        yield [
            200000,
            ((25659 - 10064) * .11 +
            (200000 / 4 - 25659) * .3) * 4,
            4
        ];
    }
}
