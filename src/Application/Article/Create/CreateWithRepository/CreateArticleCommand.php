<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Application\Article\Create\CreateWithRepository;

class CreateArticleCommand
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $name,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
