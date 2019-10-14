<?php

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\SalaryCalculationRules\TaxedSalaryCalculationRule;
use App\Domain\Salary\TaxCalculationRules\TaxCalculationRuleInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TaxedSalaryCalculationRuleTest extends TestCase
{
    public function testDefaultTaxAppliedCorrectly()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);

        $calculationRule = new TaxedSalaryCalculationRule(20, []);
        $grossSalary = $calculationRule->applyRuleToSalary(100, $calculationRequest);

        $this->assertEquals(80, $grossSalary);
    }

    public function testTaxRulesAppliedAlso()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);

        /** @var TaxCalculationRuleInterface | MockObject $taxCalculationRule */
        $taxCalculationRule = $this->createMock(TaxCalculationRuleInterface::class);
        $taxCalculationRule->expects($this->once())->method('applyOnTax')->with(20, $calculationRequest)->willReturn(10.00);

        $calculationRule = new TaxedSalaryCalculationRule(20, [$taxCalculationRule]);
        $grossSalary = $calculationRule->applyRuleToSalary(100, $calculationRequest);

        $this->assertEquals(90, $grossSalary);
    }
}
