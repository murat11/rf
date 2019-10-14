<?php declare(strict_types=1);

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculator;
use App\Domain\Salary\SalaryCalculatorFactory;
use PHPUnit\Framework\TestCase;

class SalaryCalculatorFactoryTest extends TestCase
{
    public function testItCanProduceSalaryCalculator()
    {
        $calculatorFactory = new SalaryCalculatorFactory();
        $salaryCalculator = $calculatorFactory->createSalaryCalculator(0.5, 67, 0.05, 3, 0.02, 50);
        $this->assertInstanceOf(SalaryCalculator::class, $salaryCalculator);
    }
}
