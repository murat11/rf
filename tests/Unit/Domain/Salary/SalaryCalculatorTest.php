<?php

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\SalaryCalculationRules\SalaryCalculationRuleInterface;
use App\Domain\Salary\SalaryCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SalaryCalculatorTest extends TestCase
{
    public function testItCalculatesNetSalaryCorrectly()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('getGrossSalary')->willReturn(100.00);

        /** @var SalaryCalculationRuleInterface | MockObject $amountRule */
        $amountRule = $this->createMock(SalaryCalculationRuleInterface::class);
        $amountRule->expects($this->once())->method('applyRuleToSalary')->with(100.00, $calculationRequest)->willReturn(90.00);

        /** @var SalaryCalculationRuleInterface | MockObject $amountRule */
        $taxRule = $this->createMock(SalaryCalculationRuleInterface::class);
        $taxRule->expects($this->once())->method('applyRuleToSalary')->with(90.00, $calculationRequest)->willReturn(80.00);

        $calculator = new SalaryCalculator($amountRule, $taxRule);
        $netSalary = $calculator->calculateNetSalary($calculationRequest);

        $this->assertEquals(80.00, $netSalary);
    }
}
