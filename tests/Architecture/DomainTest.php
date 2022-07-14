<?php

declare(strict_types=1);

namespace App\Tests\Architecture;

use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;

class DomainTest extends ArchitectureTest
{
    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::haveClassName('App\Domain\*'))
            ->excludingClassesThat(Selector::haveClassName('App\Domain\AdminUser\*'))
            ->andExcludingClassesThat(Selector::haveClassName('App\Domain\User\*'))
            ->canOnlyDependOn()
            ->classesThat(Selector::haveClassName('App\SharedKernel\Domain\*'))
            ->andClassesThat(Selector::haveClassName('App\Domain\*'))
            ->build()
        ;
    }
}
