<?php
namespace WebIt4MeTest;

use WebIt4Me\AbstractTimeZoneEnum;
use WebIt4Me\TimeZone;
use WebIt4Me\Tree;
use WebIt4Me\TimeZone\Bin\Install;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    private static $installerRan = false;
    /**
     * @dataProvider getAllEnums
     */
    public function testAllEnums($enum, $name)
    {
        /** @var AbstractTimeZoneEnum $enumInstance */
        $enumInstance = new $enum;
        $this->assertInstanceOf(AbstractTimeZoneEnum::class, $enumInstance);
        $this->assertNotNull($enumInstance::getAbbreviation());
        $this->assertNotNull($enumInstance::getName());
        $this->assertNotNull($enumInstance::getLocation());
        $this->assertNotNull($enumInstance::getOffset());

        $timeZone = new TimeZone();
        $this->assertInstanceOf(AbstractTimeZoneEnum::class, $timeZone->$name);
    }

    public function getAllEnums()
    {

        if (false === self::$installerRan) {
            Install::run();
            self::$installerRan = true;
        }
        $timeZoneEnumDir = '/../src/TimeZone';

        $enumFiles = Tree::from(__DIR__ . $timeZoneEnumDir)['TimeZone'];
        $enums = array_map(function ($item) {
            $name = str_replace('.php', '', $item);
            return ['WebIt4Me\\TimeZone\\' . $name, $name];
        }, $enumFiles);
        return $enums;
    }
}
