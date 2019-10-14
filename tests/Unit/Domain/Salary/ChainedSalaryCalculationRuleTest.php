<?php

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\SalaryCalculationRules\ChainedSalaryCalculationRule;
use App\Domain\Salary\SalaryCalculationRules\SalaryCalculationRuleInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChainedSalaryCalculationRuleTest extends TestCase
{
    public function testCalculatorsChained()
    {
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);

        /** @var SalaryCalculationRuleInterface | MockObject $calculationRule1 */
        $calculationRule1 = $this->createMock(SalaryCalculationRuleInterface::class);
        $calculationRule1->expects($this->once())->method('applyRuleToSalary')->with(1000, $calculationRequest)->willReturn(950.00);

        /** @var SalaryCalculationRuleInterface | MockObject $calculationRule2 */
        $calculationRule2 = $this->createMock(SalaryCalculationRuleInterface::class);
        $calculationRule2->expects($this->once())->method('applyRuleToSalary')->with(950, $calculationRequest)->willReturn(850.00);

        $chainedSalaryCalculationRule = new ChainedSalaryCalculationRule([$calculationRule1, $calculationRule2]);
        $this->assertEquals(850, $chainedSalaryCalculationRule->applyRuleToSalary(1000, $calculationRequest));
    }
}
