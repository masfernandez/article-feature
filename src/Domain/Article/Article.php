<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Domain\Article;

use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;

class Article
{
    private function __construct(
        private string $uuid,
        private string $name,
    ) {
    }

    public static function CreateWithDomainService(
        string $uuid,
        string $name,
    ): static {
        return new self(
            uuid: $uuid,
            name: $name,
        );
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public static function CreateWithRepository(
        ArticleRepositoryInterface $articleRepository,
        string $uuid,
        string $name,
    ): static {
        if ($articleRepository->countBy(['name' => $name]) !== 0) {
            throw new ArticleNameAlreadyExist();
        }
        return new self(
            uuid: $uuid,
            name: $name,
        );
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public static function CreateWithSpecification(
        UniqueNameSpecificationInterface $uniqueNameSpecification,
        string $uuid,
        string $name,
    ): static {
        if (!$uniqueNameSpecification->isUnique($name)) {
            throw new ArticleNameAlreadyExist();
        }
        return new self(
            uuid: $uuid,
            name: $name,
        );
    }
}
