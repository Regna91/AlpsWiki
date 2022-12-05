<?php

namespace AlpsWiki\Factory;

use AlpsWiki\Entity\Folder;
use AlpsWiki\Repository\FolderRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Folder>
 *
 * @method        Folder|Proxy create(array|callable $attributes = [])
 * @method static Folder|Proxy createOne(array $attributes = [])
 * @method static Folder|Proxy find(object|array|mixed $criteria)
 * @method static Folder|Proxy findOrCreate(array $attributes)
 * @method static Folder|Proxy first(string $sortedField = 'id')
 * @method static Folder|Proxy last(string $sortedField = 'id')
 * @method static Folder|Proxy random(array $attributes = [])
 * @method static Folder|Proxy randomOrCreate(array $attributes = [])
 * @method static FolderRepository|RepositoryProxy repository()
 * @method static Folder[]|Proxy[] all()
 * @method static Folder[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Folder[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Folder[]|Proxy[] findBy(array $attributes)
 * @method static Folder[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Folder[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Folder> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Folder> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Folder> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Folder> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Folder> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Folder> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Folder> random(array $attributes = [])
 * @phpstan-method static Proxy<Folder> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<FolderRepository> repository()
 * @phpstan-method static list<Proxy<Folder>> all()
 * @phpstan-method static list<Proxy<Folder>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Folder>> createSequence(array|callable $sequence)
 * @phpstan-method static list<Proxy<Folder>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Folder>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Folder>> randomSet(int $number, array $attributes = [])
 */
final class FolderFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->unique()->words(3,true),
            'description' => self::faker()->paragraph(),
            'enabled' => self::faker()->boolean(),
            'hidden' => self::faker()->boolean(),
            'sorting' => self::faker()->unique()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Folder $folder): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Folder::class;
    }
}
