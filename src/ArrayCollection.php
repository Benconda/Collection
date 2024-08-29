<?php

declare(strict_types=1);

namespace BenConda\Collection;

use BenConda\Collection\Modifier\ModifierInterface;
use Traversable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \ArrayIterator<TKey, TValue>
 */
final class ArrayCollection implements \IteratorAggregate
{
    /**
     * @param array<TKey, TValue> $array
     */
    public function __construct(
        private array $array = []
    )
    {

    }

    /**
     * @param TValue $value
     */
    public function add(mixed $value): void
    {
        $this->array[] = $value;
    }

    public function remove(mixed $value): bool
    {
        $key = Collection::from($this->array)
            ->filter(fn($item) => $item === $value)
            ->firstKey();

        if ($key === null) {
            return false;
        }

        unset($this->array[$key]);

        return true;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->array);
    }
}
