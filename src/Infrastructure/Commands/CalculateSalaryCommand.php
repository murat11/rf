<?php declare(strict_types=1);

namespace App\Infrastructure\Commands;

use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryCommand;
use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateSalaryCommand extends Command
{
    private const ARGUMENT_EMPLOYEE_NAME = 'employee-name';
    private const ARGUMENT_SALARY = 'salary';
    private const ARGUMENT_AGE = 'age';
    private const ARGUMENT_KIDS = 'kids';
    private const ARGUMENT_CAR = 'car';

    /**
     * @var CalculateNetSalaryHandler
     */
    private $handler;

    public function __construct(CalculateNetSalaryHandler $handler, string $name = null)
    {
        parent::__construct($name);
        $this->handler = $handler;
    }

    public const NAME = 'salary:calculate';

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName(self::NAME);
        $this->addArgument(self::ARGUMENT_EMPLOYEE_NAME, InputArgument::REQUIRED);
        $this->addArgument(self::ARGUMENT_SALARY, InputArgument::REQUIRED);
        $this->addArgument(self::ARGUMENT_AGE, InputArgument::REQUIRED);
        $this->addArgument(self::ARGUMENT_KIDS, InputArgument::REQUIRED);
        $this->addArgument(self::ARGUMENT_CAR, InputArgument::REQUIRED);
    }

    /**
     * @inheritDoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $employeeName = $input->getArgument(self::ARGUMENT_EMPLOYEE_NAME);

        $result = $this->handler->handle(
            new CalculateNetSalaryCommand(
                $employeeName,
                (float) $input->getArgument(self::ARGUMENT_SALARY),
                (int) $input->getArgument(self::ARGUMENT_AGE),
                (int) $input->getArgument(self::ARGUMENT_KIDS),
                (bool) $input->getArgument(self::ARGUMENT_CAR)
            )
        );

        $output->writeln(sprintf('Net Salary for %s will be %01.2f USD', $employeeName, $result));
    }
}
