<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Application\Article\Create\CreateWithDomainService;

use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;
use Masfernandez\ArticleFeature\Domain\Article\Services\CreateArticleDomainService;

class ArticleCreator
{
    private CreateArticleDomainService $createArticleDomainService;

    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository,
    ) {
        $this->createArticleDomainService = new CreateArticleDomainService(
            articleRepository: $articleRepository,
        );
    }

    /**
     * @throws ArticleNameAlreadyExist
     */
    public function execute(CreateArticleCommand $createArticleCommand): void
    {
        $article = $this->createArticleDomainService->execute(
            uuid: $createArticleCommand->getUuid(),
            name: $createArticleCommand->getName(),
        );

        $this->articleRepository->add($article);
    }
}
