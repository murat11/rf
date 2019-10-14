<?php

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\SalaryCalculationRules\AgeRespectingSalaryCalculationRule;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AgeRespectingSalaryCalculationRuleTest extends TestCase
{
    public function testItCanApplyRuleCorrectly()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('getAge')->willReturn(50);


        $calculationRule = new AgeRespectingSalaryCalculationRule(50, 10);
        $grossSalary = $calculationRule->applyRuleToSalary(10, $calculationRequest);

        $this->assertEquals(11, $grossSalary);
    }

    public function testItsNotAppliesForYoungsters()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('getAge')->willReturn(49);


        $calculationRule = new AgeRespectingSalaryCalculationRule(50, 10);
        $grossSalary = $calculationRule->applyRuleToSalary(10, $calculationRequest);

        $this->assertEquals(10, $grossSalary);
    }
}
