<?php

namespace App\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRules\AgeRespectingSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\CarUsageAwareSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\ChainedSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\TaxedSalaryCalculationRule;
use App\Domain\Salary\TaxCalculationRules\KidsRespectingRule;

/**
 * Class SalaryCalculatorFactory
 */
class SalaryCalculatorFactory
{
    /**
     * @param float $countryTax
     * @param int $ageToRespect
     * @param float $percentsForAge
     * @param int $minKidsToRespect
     * @param float $taxReducerForKids
     * @param float $feeForCar
     *
     * @return SalaryCalculator
     */
    public function createSalaryCalculator(
        float $countryTax,
        int $ageToRespect,
        float $percentsForAge,
        int $minKidsToRespect,
        float $taxReducerForKids,
        float $feeForCar
    ) {
        $taxRule = new TaxedSalaryCalculationRule(
            $countryTax,
            [new KidsRespectingRule($minKidsToRespect, $taxReducerForKids)]
        );

        $amountRule = new ChainedSalaryCalculationRule(
            [
                new AgeRespectingSalaryCalculationRule($ageToRespect, $percentsForAge),
                new CarUsageAwareSalaryCalculationRule($feeForCar),
            ]
        );

        return new SalaryCalculator($amountRule, $taxRule);
    }
}
