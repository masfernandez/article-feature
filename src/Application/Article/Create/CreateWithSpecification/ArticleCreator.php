<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Application\Article\Create\CreateWithSpecification;

use Masfernandez\ArticleFeature\Domain\Article\Article;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;
use Masfernandez\ArticleFeature\Domain\Article\UniqueNameSpecificationInterface;

class ArticleCreator
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository,
        private readonly UniqueNameSpecificationInterface $uniqueNameSpecification,
    ) {
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public function execute(CreateArticleCommand $createArticleCommand): void
    {
        $article = Article::CreateWithSpecification(
            uniqueNameSpecification: $this->uniqueNameSpecification,
            uuid:                    $createArticleCommand->getUuid(),
            name:                    $createArticleCommand->getName(),
        );

        $this->articleRepository->add($article);
    }
}
