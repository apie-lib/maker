<?php
namespace Apie\Maker\ValueObjects;

use Apie\ApieCommonPlugin\ObjectProviderFactory;
use Apie\Core\ValueObjects\Exceptions\InvalidStringForValueObjectException;
use Apie\Core\ValueObjects\Interfaces\HasRegexValueObjectInterface;
use Apie\Core\ValueObjects\IsStringValueObject;
use Apie\Maker\Concerns\IsClassNameReference;
use ReflectionClass;

final class VendorValueObject implements HasRegexValueObjectInterface
{
    use IsClassNameReference;
    use IsStringValueObject;

    public static function validate(string $input): void
    {
        if (!preg_match(static::getRegularExpression(), $input)) {
            throw new InvalidStringForValueObjectException(
                $input,
                new ReflectionClass(self::class)
            );
        }
        if (!in_array($input, ObjectProviderFactory::create()->getAvailableValueObjects())) {
            throw new InvalidStringForValueObjectException(
                $input,
                new ReflectionClass(self::class)
            );
        }
    }
}
