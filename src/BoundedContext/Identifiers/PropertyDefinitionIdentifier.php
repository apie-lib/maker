<?php
namespace Apie\Maker\BoundedContext\Identifiers;

use Apie\Core\Identifiers\IdentifierInterface;
use Apie\Core\Identifiers\Ulid;
use Apie\Maker\BoundedContext\Entities\PropertyDefinition;
use ReflectionClass;

final class PropertyDefinitionIdentifier extends Ulid implements IdentifierInterface
{
    public static function getReferenceFor(): ReflectionClass
    {
        return new ReflectionClass(PropertyDefinition::class);
    }
}
