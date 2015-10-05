<?php

namespace WebIt4MeTest;

use WebIt4Me\AbstractTimeZoneEnum;
use WebIt4Me\TimeZone;

class TimeZoneTest extends \PHPUnit_Framework_TestCase
{

    /** @var  TimeZone */
    private $timeZone;

    public function setUp()
    {
        $this->timeZone = new TimeZone();
    }

    public function test_getAllTimeZone()
    {
        $this->assertCount(
            208,
            $this->timeZone->getAllTimeZone()
        );
    }

    public function test_findTimeZoneByName()
    {
        $TZWithSummerInTheirName = $this->timeZone->findTimeZoneByName('Summer');
        $this->assertCount(
            30,
            $TZWithSummerInTheirName
        );

        $this->assertContainsOnlyInstancesOf(AbstractTimeZoneEnum::class, $TZWithSummerInTheirName);
    }

    /**
     * @dataProvider dpOffsetCounts
     */
    public function test_getTimeZoneForOffset($offset, $count)
    {
        $matches = $this->timeZone->findTimeZoneByOffset($offset);

        $this->assertCount(
            $count,
            $matches,
            sprintf('Found %s timezone for %s offset. expected %s', count($matches), $offset, $count)
        );

        $this->assertContainsOnlyInstancesOf(AbstractTimeZoneEnum::class, $matches);
    }

    public function dpOffsetCounts()
    {
        return [
            ['-1:00', 3],
            ['-10:00', 3],
            ['-11:00', 2],
            ['-12:00', 1],
            ['-2:00', 6],
            ['-2:30', 1],
            ['-3:00', 14],
            ['-3:30', 1],
            ['-4:00', 9],
            ['-4:00 / -3:00', 1],
            ['-4:30', 1],
            ['-5:00', 9],
            ['-5:00 / -4:00', 1],
            ['-6:00', 3],
            ['-6:00 / -5:00', 1],
            ['-7:00', 2],
            ['-7:00 / -6:00', 1],
            ['-9:00', 3],
            ['-9:30', 1],
            ['+0:00', 5],
            ['+1:00', 6],
            ['+10:00', 10],
            ['+10:30', 2],
            ['+10:30 / +9:30', 1],
            ['+11:00', 10],
            ['+11:00 / +10:00', 1],
            ['+11:30', 1],
            ['+12:00', 13],
            ['+12:45', 1],
            ['+13:00', 6],
            ['+13:45', 1],
            ['+14:00', 1],
            ['+2:00', 6],
            ['+3:00', 8],
            ['+3:30', 1],
            ['+4:00', 10],
            ['+4:30', 2],
            ['+5:00', 12],
            ['+5:30', 1],
            ['+5:45', 1],
            ['+6:00', 10],
            ['+6:30', 2],
            ['+7:00', 8],
            ['+8:00', 13],
            ['+8:45', 1],
            ['+9:00', 8],
        ];
    }
    /**
     * @dataProvider dpLocationCounts
     */
    public function test_getTimeZoneForLocation($location, $count)
    {
        $matches = $this->timeZone->findTimeZoneByLocation($location);

        $this->assertCount(
            $count,
            $matches,
            sprintf('Found %s timezone for %s location. expected %s', count($matches), $location, $count)
        );
    }

    public function dpLocationCounts()
    {
        return [
            ['Africa', 11],
            ['Antarctica', 7],
            ['Asia', 66],
            ['Atlantic', 2],
            ['Australia', 12],
            ['Caribbean', 2],
            ['Europe', 14],
            ['Indian Ocean', 3],
            ['North America', 27],
            ['Pacific', 39],
            ['South America', 25],

        ];
    }
}
