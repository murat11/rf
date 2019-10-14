<?php declare(strict_types=1);

namespace App\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRules\AgeRespectingSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\CarUsageAwareSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\ChainedSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\TaxedSalaryCalculationRule;
use App\Domain\Salary\TaxCalculationRules\KidsRespectingRule;

/**
 * Class SalaryCalculatorFactory
 * @todo Calculator configuration from config files
 */
class SalaryCalculatorFactory
{
    private const COUNTRY_TAX = 20;
    private const MIN_KIDS_TO_RESPECT = 3;
    private const TAX_REDUCER_FOR_KIDS = 2;
    private const MIN_AGE_TO_RESPECT = 50;
    private const PERCENT_FOR_AGE = 7;
    private const FEE_FOR_CAR = 500;

    /**
     * @return SalaryCalculator
     */
    public static function createConfiguredCalculator()
    {
        $taxRule = new TaxedSalaryCalculationRule(
            self::COUNTRY_TAX,
            [new KidsRespectingRule(self::MIN_KIDS_TO_RESPECT, self::TAX_REDUCER_FOR_KIDS)]
        );

        $amountRule = new ChainedSalaryCalculationRule(
            [
                new AgeRespectingSalaryCalculationRule(self::MIN_AGE_TO_RESPECT, self::PERCENT_FOR_AGE),
                new CarUsageAwareSalaryCalculationRule(self::FEE_FOR_CAR),
            ]
        );

        return new SalaryCalculator($amountRule, $taxRule);
    }
}
