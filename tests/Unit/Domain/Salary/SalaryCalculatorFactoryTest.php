<?php declare(strict_types=1);

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculator;
use App\Domain\Salary\SalaryCalculatorFactory;
use PHPUnit\Framework\TestCase;

class SalaryCalculatorFactoryTest extends TestCase
{
    public function testItCanProduceSalaryCalculator()
    {
        $salaryCalculator = SalaryCalculatorFactory::createConfiguredCalculator();
        $this->assertInstanceOf(SalaryCalculator::class, $salaryCalculator);
    }
}
