# Another test task
## Installation and running with docker
Docker and docker-compose required
   
   1. Clone code from github  `git clone git@github.com:murat11/rf.git`
   1. cd into the projects directory 
   1. run `make build` to build docker image and fetch dependencies with `composer` 
   1. run `make run` to run console commands with predefined input parameters to see how it calculates salary
   1. run `make test` to run unit-tests 
   
Non-UNIX users (who can't use `make` utility) use following commands for last 3 steps:
```
    docker-compose -f docker/docker-compose.yml build
    docker-compose -f docker/docker-compose.yml run --rm php composer install
```
    
```
    docker-compose -f docker/docker-compose.yml run --rm php bin/console   salary:calculate  Alice 6000 26 2 0
    docker-compose -f docker/docker-compose.yml run --rm php bin/console   salary:calculate  Bob 4000 52 0 1
    docker-compose -f docker/docker-compose.yml run --rm php bin/console   salary:calculate  Charlie 5000 36 3 1
```

```
    docker-compose -f docker/docker-compose.yml run --rm php vendor/bin/phpunit tests/ --cache-result-file=var/cache/.phpunit.result.cache
```

### Couple of words about the code 
I tried implement it in accordance with Clean Architecture principals where internal layer is Domain, it's wrapped by Application
 and Infrastructure is most outside (framework) level. Dependencies are directed from outside to inside.    
 
Also there is a bit of CQRS here i.e each variant of system usage is described as UseCase (`src/Application/UseCase`). 
All work related to specific usecase is handled by Handlers (`\App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryHandler`) 
and `Command` is just a representation of input data for usecase (`\App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryCommand`).       

As for salary calculation itself, in order to make it extensible with minor code changes (but open for extend) 
I implemented in a way where calculation logic is placed in Rules `\App\Domain\Salary\SalaryCalculationRules\SalaryCalculationRuleInterface`.
We can create more rules and add them to Calculator if logic changes in future. 
In general it's based on following business logic: first we calculate gross salary, then apply taxes on it, 
so in `\App\Domain\Salary\SalaryCalculator` I deliberately set two arguments: first - rules for salary amount modification,
second - rules for applying taxes. Since tax amount also variable, I've added some rule-based logic for tax calculation.      

TODOs: 
 - add command bus - i.e a service which takes usecase Command, finds handler and makes handler do all processing;
   besides it, CommandBus usually performs other duties like Command validation, logging, monitoring, etc...
 - calculator could be configured using app configuration parameters specified somewhere not in php files, Symfony config files for example
 - Symfony console command handling is also simplified as possible
    
    
 
 

