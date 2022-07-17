<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Domain\Article;

/**
 * @method Article|null     search($uuid)
 * @method Article|null     searchOneBy(array $criteria, array $orderBy = null)
 * @method Article[]        searchAll()
 * @method Article[]        matchBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method int              countBy(array $criteria)
 */
interface ArticleRepositoryInterface
{
    public function add(Article $article): void;

    public function remove(Article $article): void;
}
