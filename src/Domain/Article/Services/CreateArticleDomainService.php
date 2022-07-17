<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Domain\Article\Services;

use Masfernandez\ArticleFeature\Domain\Article\Article;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;

class CreateArticleDomainService
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository
    ) {
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public function execute(
        string $uuid,
        string $name,
    ): Article {
        if ($this->articleRepository->countBy(['name' => $name]) !== 0) {
            throw new ArticleNameAlreadyExist();
        }

        return Article::CreateWithDomainService(
            uuid: $uuid,
            name: $name,
        );
    }
}
