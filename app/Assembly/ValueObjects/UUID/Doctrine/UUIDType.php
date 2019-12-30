<?php
namespace App\Assembly\ValueObjects\UUID\Doctrine;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Psr\Log\InvalidArgumentException;

/**
 * Class UUIDType
 * @package App\Assembly\ValueObjects\UUID\Doctrine
 */
class UUIDType extends Type
{
    /**
     * Name of identity
     */
    const NAME = 'uuid';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'uuid';
    }

    /**
     * Converts a value from its database representation to its PHP representation
     * of this type.
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return UUID|null
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!is_string($value) || $value === '') {
            return null;
        }

        if ($value instanceof UUID) {
            return $value;
        }

        try {
            $uuid = new UUID($value);
        } catch (InvalidArgumentException $exception) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $uuid;
    }

    /**
     * Converts a value from its PHP representation to its database representation
     * of this type.
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return null|string
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!is_string($value) || $value === '') {
            return null;
        }

        if ($value instanceof UUID) {
            return $value->toString();
        }

        throw ConversionException::conversionFailed($value, static::NAME);
    }
}
