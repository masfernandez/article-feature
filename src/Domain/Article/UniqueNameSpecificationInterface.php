<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Domain\Article;

use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;

interface UniqueNameSpecificationInterface
{
    /**
     * @throws ArticleNameAlreadyExist
     */
    public function isUnique(string $name): bool;
}
