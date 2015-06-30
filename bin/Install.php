<?php
namespace WebIt4Me\TimeZone\Bin;

use Composer\EventDispatcher\Event;
use WebIt4Me\Reader\Csv\Loader;

final class Install
{

    private static $dataSource;

    private static $dataSourcePath = '/../data/timezone.csv';

    private static $timezoneDirPath = '/../src/TimeZone';

    private static $timezoneClassPath = '/../src/AbstractTimeZone.php';

    private static $tempEnumPath = '/Templates/TimezoneEnum.template';

    private static $tempClassPath = '/Templates/AbstractTimeZoneClass.template';

    public static function composer(Event $event)
    {
        echo __METHOD__;
        self::run();
    }

    public static function run()
    {
        self::clear();
        self::generateTimeZoneClassAndItsEnums();
    }

    private static function clear()
    {
        array_map('unlink', glob(self::makePathRelative(self::$timezoneDirPath) . "/*"));
        if (!is_dir(self::makePathRelative(self::$timezoneDirPath))) {
            mkdir(self::makePathRelative(self::$timezoneDirPath));
        }
        if (file_exists(self::makePathRelative(self::$timezoneClassPath))) {
            unlink(self::makePathRelative((self::$timezoneClassPath)));
        }
    }

    private static function makePathRelative($path)
    {
        return __DIR__ . $path;
    }

    private static function generateTimeZoneClassAndItsEnums()
    {
        $names = [];

        foreach (self::loadData() as $timeZone) {
            $names[] = self::createEnumForTimeZone($timeZone);
        }

        self::createTimeZoneClass($names);
    }

    private static function createEnumForTimeZone($timeZone)
    {
        $template = self::renderEnumTemplate($timeZone);
        $content = $template['content'];
        $name = $template['name'];

        file_put_contents(
            self::makePathRelative(self::$timezoneDirPath) . '/' . $name . '.php',
            $content
        );

        return $name;
    }

    private static function renderEnumTemplate($timeZone)
    {
        $temp = file_get_contents(self::makePathRelative(self::$tempEnumPath));

        $abbreviation = $timeZone['Abbreviation'];
        $name = self::sanitize($timeZone['Name']);
        $location = self::sanitize($timeZone['Location']);
        $offset = $timeZone['Offset'];

        $className = self::getClassName($abbreviation, $offset);

        $temp = str_replace(
            ['{className}', '{abbreviation}', '{name}', '{location}', '{offset}'],
            [$className, $abbreviation, $name, $location, $offset],
            $temp
        );

        return ['content' => $temp, 'name' => $className];
    }

    private static function getClassName($abbreviation, $offset)
    {
        $className = $abbreviation;

        while (file_exists(self::makePathRelative(self::$timezoneDirPath) . '/' . $className . '.php')) {
            $suffix = preg_replace('/(UTC\s[+-])([0-9]{1,2})(:)([0-9]{2})(.*)/', '$2$4', $offset);
            $className = $className . $suffix;
        }

        return $className;
    }


    private static function createTimeZoneClass($names)
    {
        $propertyReads = array_map(function ($item) {
            $paddedName = str_pad($item, 12);
            $value = sprintf(' * @property-read     \WebIt4Me\TimeZone\%s $%s the %s timezone.' . PHP_EOL, $paddedName, $paddedName, $item);
            return $value;
        }, $names);

        $t = end($propertyReads);

        $template = file_get_contents(self::makePathRelative(self::$tempClassPath));

        $content = str_replace('{property-reads}', implode('', $propertyReads) . ' *', $template);

        file_put_contents(self::makePathRelative(self::$timezoneClassPath), $content);
    }

    private static function loadData()
    {
        if (is_null(self::$dataSource)) {

            $rows = (new Loader(__DIR__ . self::$dataSourcePath))->readAll();

            foreach ($rows as $row) {
                self::$dataSource[] = $row->toArray();
            }

        }

        return self::$dataSource;
    }

    private static function sanitize($value)
    {
        $what = ['\''];
        $toWhat = ['\\\''];

        return str_replace($what, $toWhat, $value);
    }

}

Install::run();