<?php
namespace Apie\Maker\BoundedContext\Entities;

use Apie\Core\Attributes\FakeMethod;
use Apie\Core\Entities\EntityInterface;
use Apie\Core\Identifiers\CamelCaseSlug;
use Apie\Maker\BoundedContext\Identifiers\PropertyDefinitionIdentifier;
use Apie\Maker\Enums\NullableOption;
use Apie\Maker\Enums\PrimitiveType;
use Apie\Maker\ValueObjects\ClassNameReference;
use Apie\Maker\ValueObjects\VendorValueObject;
use Faker\Generator;

#[FakeMethod('createRandom')]
final class PropertyDefinition implements EntityInterface
{
    public function __construct(
        public VendorValueObject|PrimitiveType|ClassNameReference $type,
        public CamelCaseSlug $name,
        public bool $requiredOnConstruction,
        public bool $writable,
        public bool $readable,
        public NullableOption $nullable = NullableOption::AlwaysNull,
    ) {
    }

    public function getId(): PropertyDefinitionIdentifier
    {
        return PropertyDefinitionIdentifier::fromNative(strtolower($this->name));
    }

    public static function createRandom(Generator $faker): self
    {
        $variableOptions = $faker->randomElement([
            [true, true, true, NullableOption::AlwaysNull],
            [false, true, true, NullableOption::AlwaysNull],
            [true, false, true, NullableOption::AlwaysNull],
            [true, true, true, NullableOption::NeverNullable],
            [false, true, true, NullableOption::NeverNullable],
            [true, false, true, NullableOption::NeverNullable],
            [true, true, true, NullableOption::InitialNull],
            [true, false, true, NullableOption::InitialNull],
        ]);
        return new self(
            $faker->fakeClass($faker->randomElement([VendorValueObject::class, PrimitiveType::class])),
            CamelCaseSlug::createRandom($faker),
            ...$variableOptions
        );
    }
}
