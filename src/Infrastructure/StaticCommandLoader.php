<?php declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryHandler;
use App\Domain\Salary\SalaryCalculatorFactory;
use App\Infrastructure\Commands\CalculateSalaryCommand;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class StaticCommandLoader implements CommandLoaderInterface
{

    /**
     * @var array
     */
    private $commands = [];

    public function __construct()
    {
        $this->initCommands();
    }

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        if (!self::has($name)) {
            throw new CommandNotFoundException(sprintf('Command "%s" does not exist.', $name));
        }

        return $this->commands[$name];
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return isset($this->commands[$name]);
    }

    /**
     * @inheritDoc
     */
    public function getNames()
    {
        return array_keys($this->commands);
    }

    /**
     * @todo refactor commands initialization
     */
    private function initCommands(): void
    {
        $this->commands = [
            CalculateSalaryCommand::NAME => new CalculateSalaryCommand(
                new CalculateNetSalaryHandler(
                    SalaryCalculatorFactory::createConfiguredCalculator()
                )
            ),
        ];
    }
}
