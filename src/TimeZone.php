<?php

namespace WebIt4Me;

use WebIt4Me\TimeZone\UTC;

/**
 * Class TimeZone
 *
 * @package WebIt4Me
 */
final class TimeZone extends AbstractTimeZone
{
    private $timeZoneEnums;

    /**
     * Returns an array of all timezone's with the given $keyword in their name.
     *
     * @param string $keyword
     * @return AbstractTimeZoneEnum[]
     */
    public function findTimeZoneByName($keyword)
    {
        $matchingEnums = [];
        $enums = $this->getAllTimeZone();

        foreach ($enums as $enum) {
            if (strstr($enum::getName(), $keyword)) {
                $matchingEnums[$enum->getName()] = $enum;
            }
        }

        return $matchingEnums;
    }

    /**
     * Find all timezone classes having the given offset
     *
     * @param string $offset e.g. +3:30, 0:00
     * @return AbstractTimeZoneEnum[]
     */
    public function findTimeZoneByOffset($offset)
    {
        $offset = $this->sanitizeOffset($offset);

        $matchingEnums = [];
        $enums = $this->getAllTimeZone();

        foreach ($enums as $enum) {
            if ($enum::getOffset() === $offset) {
                $matchingEnums[$enum->getName()] = $enum;
            }
        }

        return $matchingEnums;
    }

    /**
     * Find all timezone classes for the given location
     * e.g
     * 'Africa'
     * 'Antarctica'
     * 'Asia'
     * 'Atlantic'
     * 'Australia'
     * 'Caribbean'
     * 'Europe'
     * 'Indian Ocean'
     * 'Military'
     * 'North America'
     * 'Pacific'
     * 'South America'
     *
     * @param string $location
     * @return AbstractTimeZoneEnum[]
     */
    public function findTimeZoneByLocation($location)
    {
        $matchingEnums = [];
        $enums = $this->getAllTimeZone();

        foreach ($enums as $enum) {
            if ($enum::getLocation() === $location) {
                $matchingEnums[$enum->getName()] = $enum;
            }
        }

        return $matchingEnums;
    }

    /**
     * Return Array of all existing timezones
     *
     * @return AbstractTimeZoneEnum[]
     */
    public function getAllTimeZone()
    {
        if (is_null($this->timeZoneEnums)) {
            foreach (Tree::from(__DIR__ . '/TimeZone')['TimeZone'] as $file) {
                $fullName = sprintf('WebIt4Me\TimeZone\%s', str_replace('.php', '', $file));
                $this->timeZoneEnums[str_replace('WebIt4Me\\TimeZone\\', '', $fullName)] = new $fullName;
            }
        }

        return $this->timeZoneEnums;
    }

    /**
     * Prepend and return offset with 'UTC '
     *
     * @param string $offset
     * @return string
     */
    private function sanitizeOffset($offset)
    {
        if (false === strpos($offset, 'UTC')) {
            $offset = 'UTC ' . $offset;
        }

        return $offset;
    }

}