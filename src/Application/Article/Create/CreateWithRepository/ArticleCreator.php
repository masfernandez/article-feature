<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Application\Article\Create\CreateWithRepository;

use Masfernandez\ArticleFeature\Domain\Article\Article;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;

class ArticleCreator
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository,
    ) {
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public function execute(CreateArticleCommand $createArticleCommand): void
    {
        $article = Article::CreateWithRepository(
            articleRepository: $this->articleRepository,
            uuid:              $createArticleCommand->getUuid(),
            name:              $createArticleCommand->getName(),
        );

        $this->articleRepository->add($article);
    }
}
