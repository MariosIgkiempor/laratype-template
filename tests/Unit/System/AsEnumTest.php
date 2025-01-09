<?php

declare(strict_types=1);

use App\Enums\Concerns\AsEnum;

enum TestEnum: string
{
    use AsEnum;

    case One = 'one';
    case Two = 'two';
}

it('can create a list of names', function (): void {
    expect(TestEnum::names())->toBeArray()->toEqual(['One', 'Two']);
});

it('can create a list of values', function (): void {
    expect(TestEnum::values())->toBeArray()->toEqual(['one', 'two']);
});

it('can convert itself to an array', function (): void {
    expect(TestEnum::array())->toBeArray()->toEqual(['one' => 'One', 'two' => 'Two']);
});
