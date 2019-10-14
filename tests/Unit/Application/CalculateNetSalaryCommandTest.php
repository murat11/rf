<?php declare(strict_types=1);

namespace App\Test\Unit\Application;

use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryCommand;
use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryHandler;
use App\Domain\Salary\SalaryCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CalculateNetSalaryCommandTest extends TestCase
{
    public function testItCanHandleCommand()
    {
        $command = $this->createMock(CalculateNetSalaryCommand::class);

        /** @var MockObject | SalaryCalculator $salaryCalculator */
        $salaryCalculator = $this->createMock(SalaryCalculator::class);
        $salaryCalculator->expects($this->once())->method('calculateNetSalary')->with($command)->willReturn(150.00);

        $handler = new CalculateNetSalaryHandler($salaryCalculator);
        $this->assertEquals(150, $handler->handle($command));
    }
}
