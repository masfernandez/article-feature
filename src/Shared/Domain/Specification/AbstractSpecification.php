<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Shared\Domain\Specification;

abstract class AbstractSpecification
{
    abstract public function isSatisfiedBy($value): bool;
}
