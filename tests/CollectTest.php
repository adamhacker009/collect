<?php

use PHPUnit\Framework\TestCase;
use Collect\Collect;
class CollectTest extends TestCase
{
    public function testOnlyWithMultipleArguments(): void
    {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collection = new Collect($data);
        $result = $collection->only('a', 'c')->toArray();

        $this->assertEquals(['a' => 1, 'c' => 3], $result);
    }

    public function testOnlyWithArrayArgument(): void
    {
        $data = ['x' => 10, 'y' => 20, 'z' => 30];
        $collection = new Collect($data);
        $result = $collection->only(['y', 'z'])->toArray();

        $this->assertEquals(['y' => 20, 'z' => 30], $result);
    }

    public function testFirstReturnsFirstElement(): void
    {
        $data = ['first' => 'foo', 'second' => 'bar'];
        $collection = new Collect($data);

        $this->assertSame('foo', $collection->first());
    }

    public function testCountReturnsNumberOfItems(): void
    {
        $data = ['one', 'two', 'three'];
        $collection = new Collect($data);

        $this->assertSame(3, $collection->count());
    }

    public function testToArrayReturnsUnderlyingArray(): void
    {
        $data = ['apple' => 'red', 'banana' => 'yellow'];
        $collection = new Collect($data);

        $this->assertEquals($data, $collection->toArray());
    }

    public function testChainingMethods(): void
    {
        $data = ['a' => 100, 'b' => 200, 'c' => 300];
        $collection = new Collect($data);

        $countAfterOnly = $collection->only('a', 'b')->count();
        $this->assertSame(2, $countAfterOnly);

        $toArrayAfterOnly = $collection->only(['b', 'c'])->toArray();
        $this->assertEquals(['b' => 200, 'c' => 300], $toArrayAfterOnly);
    }
}