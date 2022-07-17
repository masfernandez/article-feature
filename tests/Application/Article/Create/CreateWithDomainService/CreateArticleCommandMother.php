<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Tests\Application\Article\Create\CreateWithDomainService;

use Masfernandez\ArticleFeature\Application\Article\Create\CreateWithDomainService\CreateArticleCommand;
use Masfernandez\ArticleFeature\Tests\Shared\FakerMother;

class CreateArticleCommandMother
{
    public static function create(
        ?string $uuid = null,
        ?string $name = null,
    ): CreateArticleCommand {
        return new CreateArticleCommand(
            uuid: $uuid ?? FakerMother::random()->uuid(),
            name: $name ?? FakerMother::random()->word(),
        );
    }
}
