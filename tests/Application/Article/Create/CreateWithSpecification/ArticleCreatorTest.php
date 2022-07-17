<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Tests\Application\Article\Create\CreateWithSpecification;

use Masfernandez\ArticleFeature\Application\Article\Create\CreateWithSpecification\ArticleCreator;
use Masfernandez\ArticleFeature\Domain\Article\ArticleRepositoryInterface;
use Masfernandez\ArticleFeature\Domain\Article\Exception\ArticleNameAlreadyExist;
use Masfernandez\ArticleFeature\Domain\Article\UniqueNameSpecificationInterface;
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
        $articleRepository       = Mockery::mock(ArticleRepositoryInterface::class);
        $uniqueNameSpecification = Mockery::mock(UniqueNameSpecificationInterface::class);

        $uniqueNameSpecification
            ->shouldReceive('isUnique')
            ->with($command->getName())
            ->andReturn(true);

        $articleRepository
            ->shouldReceive('add')
            ->with(Mockery::any());

        (new ArticleCreator($articleRepository, $uniqueNameSpecification))->execute($command);
    }

    /**
     * @test
     */
    public function itShouldNotCreateAnAlbum(): void
    {
        $command = CreateArticleCommandMother::create();

        // mocks
        $articleRepository       = Mockery::mock(ArticleRepositoryInterface::class);
        $uniqueNameSpecification = Mockery::mock(UniqueNameSpecificationInterface::class);

        $uniqueNameSpecification
            ->shouldReceive('isUnique')
            ->with($command->getName())
            ->andReturn(false);

        $articleRepository
            ->shouldReceive('add')
            ->with(Mockery::any());

        // test use case
        $this->expectException(ArticleNameAlreadyExist::class);
        (new ArticleCreator($articleRepository, $uniqueNameSpecification))->execute($command);
    }
}
