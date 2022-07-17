<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Tests\Application\Article\Create\CreateWithDomainService;

use Masfernandez\ArticleFeature\Application\Article\Create\CreateWithDomainService\ArticleCreator;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;
use Mockery;
use PHPUnit\Framework\TestCase;

class ArticleCreatorTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateAnAlbum(): void
    {
        $command = CreateArticleCommandMother::create();

        // mocks
        $articleRepository = Mockery::mock(ArticleRepositoryInterface::class);
        $articleRepository
            ->allows()
            ->countBy(['name' => $command->getName()])
            ->andReturns(0);

        $articleRepository
            ->shouldReceive('add')
            ->with(Mockery::any());

        (new ArticleCreator($articleRepository))->execute($command);
    }

    /**
     * @test
     */
    public function itShouldNotCreateAnAlbum(): void
    {
        $command = CreateArticleCommandMother::create();

        // mocks
        $articleRepository = Mockery::mock(ArticleRepositoryInterface::class);
        $articleRepository
            ->allows()
            ->countBy(['name' => $command->getName()])
            ->andReturns(1);

        $articleRepository
            ->shouldReceive('add')
            ->with(Mockery::any());

        // test use case
        $this->expectException(ArticleNameAlreadyExist::class);
        (new ArticleCreator($articleRepository))->execute($command);
    }
}
