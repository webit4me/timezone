<?php

namespace WebIt4Me;

abstract class AbstractTimeZoneEnum {

    public static function getAbbreviation()
    {
        return static::ABBREVIATION;
    }

    public static function getName()
    {
        return static::NAME;
    }

    public static function getLocation()
    {
        return static::LOCATION;
    }

    public static function getOffset()
    {
        return static::OFFSET;
    }
}