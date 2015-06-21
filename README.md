[![Build Status](https://travis-ci.org/webit4me/timezone.svg?branch=master)](https://travis-ci.org/webit4me/timezone)
[![Coverage Status](https://coveralls.io/repos/webit4me/timezone/badge.svg?branch=master)](https://coveralls.io/r/webit4me/timezone?branch=master)
# Timezone
An object oriented representation of all timezones including their name, abbreviation , location and their time different

## Installation

### Using Composer
```bash
composer require  webit4me/timezone dev-master
composer install-timezone -d vendor/webit4me/timezone
```

#### Cloning from the GitHub
```bash
git clone https://github.com/webit4me/timezone.git
cd timezone
php ./bin/Install.php  
```

## Usage

### Calling TimeZone enums statically
```php
use WebIt4Me\TimeZone;

$timeZoneName = TimeZone\ACDT::getName();
$timeZoneAbbr = TimeZone\ACDT::getAbbreviation();
$timeZoneLoc = TimeZone\ACDT::getLocation();
$timeZoneOffset = TimeZone\ACDT::getOffset();

var_dump($timeZoneName, $timeZoneAbbr, $timeZoneLoc, $timeZoneOffset);
```
outputs:
```
string(26) "Coordinated Universal Time"
string(3) "UTC"
string(9) "Worldwide"
```

### Instantiating new TimeZone

#### To get TimeZone enums using the magic getter
```php
use WebIt4Me\TimeZone;

$timeZone = new TimeZone();
$timeZoneName = $timeZone->UTC->getName();
$timeZoneAbbr = $timeZone->UTC->getAbbreviation();
$timeZoneLoc = $timeZone->UTC->getLocation();
$timeZoneOffset = $timeZone->UTC->getOffset();

var_dump($timeZoneName, $timeZoneAbbr, $timeZoneLoc, $timeZoneOffset);
```
outputs:
```
string(26) "Coordinated Universal Time"
string(3) "UTC"
string(9) "Worldwide"
```
#### To get full list or use search functionalities
```php
<?php
include __DIR__ . '/vendor/autoload.php';

use \WebIt4Me\TimeZone;

/**
 * Forget this bit, its just to print the result in a table
 * @param $timeZones
 */
function printTimeZone($timeZones)
{
    $padding = [6,19,15,41];

    echo str_repeat('-', array_sum($padding)+9) . PHP_EOL;
    echo sprintf(
        "| %s| %s| %s| %s| %s",
        str_pad('Abbr', $padding[0], ' '),
        str_pad('Offset', $padding[1], ' '),
        str_pad('Location', $padding[2], ' '),
        str_pad('Name', $padding[3], ' '),
        PHP_EOL
    );
    echo str_repeat('-', array_sum($padding)+9) . PHP_EOL;
    foreach ($timeZones as $tz){
        echo sprintf(
            "| %s| %s| %s| %s| %s",
            str_pad($tz->getAbbreviation(), $padding[0], ' '),
            str_pad($tz->getOffset(), $padding[1], ' '),
            str_pad($tz->getLocation(), $padding[2], ' '),
            str_pad($tz->getName(), $padding[3], ' '),
            PHP_EOL
        );
    }
    echo str_repeat('-', array_sum($padding)+9) . PHP_EOL;
    echo  PHP_EOL;
}


/**
 * Here is the real use case
 */
$timeZone = new TimeZone();

$timeZonesInEurope = $timeZone->findTimeZoneByLocation('Europe');
$timeZonesWithEuropeanInTheirName = $timeZone->findTimeZoneByName('European');
$timeZonesWithOffset900 = $timeZone->findTimeZoneByOffset('+9:00');
$timeZonesAll = $timeZone->getAllTimeZone();

printTimeZone($timeZonesInEurope);
printTimeZone($timeZonesWithEuropeanInTheirName);
printTimeZone($timeZonesWithOffset900);
printTimeZone($timeZonesAll);

```
output:
```
------------------------------------------------------------------------------------------
| Abbr  | Offset             | Location       | Name                                     | 
------------------------------------------------------------------------------------------
| BST   | UTC +1:00          | Europe         | British Summer Time                      | 
| CEST  | UTC +2:00          | Europe         | Central European Summer Time             | 
| CET   | UTC +1:00          | Europe         | Central European Time                    | 
| EEST  | UTC +3:00          | Europe         | Eastern European Summer Time             | 
| EET   | UTC +2:00          | Europe         | Eastern European Time                    | 
| FET   | UTC +3:00          | Europe         | Further-Eastern European Time            | 
| GMT   | UTC +0:00          | Europe         | Greenwich Mean Time                      | 
| IST   | UTC +1:00          | Europe         | Irish Standard Time                      | 
| KUYT  | UTC +4:00          | Europe         | Kuybyshev Time                           | 
| MSD   | UTC +4:00          | Europe         | Moscow Daylight Time                     | 
| MSK   | UTC +3:00          | Europe         | Moscow Standard Time                     | 
| SAMT  | UTC +4:00          | Europe         | Samara Time                              | 
| WEST  | UTC +1:00          | Europe         | Western European Summer Time             | 
| WET   | UTC +0:00          | Europe         | Western European Time                    | 
------------------------------------------------------------------------------------------

------------------------------------------------------------------------------------------
| Abbr  | Offset             | Location       | Name                                     | 
------------------------------------------------------------------------------------------
| CEST  | UTC +2:00          | Europe         | Central European Summer Time             | 
| CET   | UTC +1:00          | Europe         | Central European Time                    | 
| EEST  | UTC +3:00          | Europe         | Eastern European Summer Time             | 
| EET   | UTC +2:00          | Europe         | Eastern European Time                    | 
| FET   | UTC +3:00          | Europe         | Further-Eastern European Time            | 
| WEST  | UTC +1:00          | Europe         | Western European Summer Time             | 
| WET   | UTC +0:00          | Europe         | Western European Time                    | 
------------------------------------------------------------------------------------------

------------------------------------------------------------------------------------------
| Abbr  | Offset             | Location       | Name                                     | 
------------------------------------------------------------------------------------------
| AWDT  | UTC +9:00          | Australia      | Australian Western Daylight Time         |
| IRKST | UTC +9:00          | Asia           | Irkutsk Summer Time                      | 
| JST   | UTC +9:00          | Asia           | Japan Standard Time                      | 
| KST   | UTC +9:00          | Asia           | Korea Standard Time                      | 
| PWT   | UTC +9:00          | Pacific        | Palau Time                               | 
| TLT   | UTC +9:00          | Asia           | East Timor Time                          | 
| WIT   | UTC +9:00          | Asia           | Eastern Indonesian Time                  | 
| YAKT  | UTC +9:00          | Asia           | Yakutsk Time                             | 
------------------------------------------------------------------------------------------

------------------------------------------------------------------------------------------
| Abbr  | Offset             | Location       | Name                                     | 
------------------------------------------------------------------------------------------
| ACDT  | UTC +10:30         | Australia      | Australian Central Daylight Time         | 
| ACT   | UTC -5:00          | South America  | Acre Time                                | 
| ACT   | UTC +10:30 / +9:30 | Australia      | Australian Central Time                  | 
| ACWST | UTC +8:45          | Australia      | Australian Central Western Standard Time | 
| ADT   | UTC -3:00          | North America  | Atlantic Daylight Time                   | 
| ADT   | UTC +3:00          | Asia           | Arabia Daylight Time                     | 
| AEDT  | UTC +11:00         | Australia      | Australian Eastern Daylight Time         | 
| AEST  | UTC +10:00         | Australia      | Australian Eastern Standard Time         | 
| AET   | UTC +11:00 / +10:00| Australia      | Australian Eastern Time                  | 
| AFT   | UTC +4:30          | Asia           | Afghanistan Time                         | 
| AKDT  | UTC -8:00          | North America  | Alaska Daylight Time                     | 
| AKST  | UTC -9:00          | North America  | Alaska Standard Time                     | 
| ALMT  | UTC +6:00          | Asia           | Alma-Ata Time                            | 
| AMST  | UTC -3:00          | South America  | Amazon Summer Time                       | 
| AMST  | UTC +5:00          | Asia           | Armenia Summer Time                      | 
| AMT   | UTC -4:00          | South America  | Amazon Time                              | 
| AMT   | UTC +4:00          | Asia           | Armenia Time                             | 
| ANAST | UTC +12:00         | Asia           | Anadyr Summer Time                       | 
| ANAT  | UTC +12:00         | Asia           | Anadyr Time                              | 
| AQTT  | UTC +5:00          | Asia           | Aqtobe Time                              | 
| ART   | UTC -3:00          | South America  | Argentina Time                           | 
| AST   | UTC -4:00          | North America  | Atlantic Standard Time                   | 
| AST   | UTC +3:00          | Asia           | Arabia Standard Time                     | 
| AT    | UTC -4:00 / -3:00  | North America  | Atlantic Time                            | 
| AWDT  | UTC +9:00          | Australia      | Australian Western Daylight Time         | 
| AWST  | UTC +8:00          | Australia      | Australian Western Standard Time         | 
| AZOST | UTC +0:00          | Atlantic       | Azores Summer Time                       | 
| AZOT  | UTC -1:00          | Atlantic       | Azores Time                              | 
| AZST  | UTC +5:00          | Asia           | Azerbaijan Summer Time                   | 
| AZT   | UTC +4:00          | Asia           | Azerbaijan Time                          | 
| AoE   | UTC -12:00         | Pacific        | Anywhere on Earth                        |
| BNT   | UTC +8:00          | Asia           | Brunei Darussalam Time                   | 
| BOT   | UTC -4:00          | South America  | Bolivia Time                             | 
| BRST  | UTC -2:00          | South America  | Braslia Summer Time                      | 
| BRT   | UTC -3:00          | South America  | Braslia Time                             | 
| BST   | UTC +1:00          | Europe         | British Summer Time                      | 
| BST   | UTC +11:00         | Pacific        | Bougainville Standard Time               | 
| BST   | UTC +6:00          | Asia           | Bangladesh Standard Time                 | 
| BTT   | UTC +6:00          | Asia           | Bhutan Time                              |
| CAST  | UTC +8:00          | Antarctica     | Casey Time                               | 
| CAT   | UTC +2:00          | Africa         | Central Africa Time                      | 
| CCT   | UTC +6:30          | Indian Ocean   | Cocos Islands Time                       | 
| CDT   | UTC -4:00          | Caribbean      | Cuba Daylight Time                       | 
| CDT   | UTC -5:00          | North America  | Central Daylight Time                    | 
| CEST  | UTC +2:00          | Europe         | Central European Summer Time             | 
| CET   | UTC +1:00          | Europe         | Central European Time                    | 
| CHADT | UTC +13:45         | Pacific        | Chatham Island Daylight Time             | 
| CHAST | UTC +12:45         | Pacific        | Chatham Island Standard Time             | 
| CHOT  | UTC +8:00          | Asia           | Choibalsan Time                          | 
| CHUT  | UTC +10:00         | Pacific        | Chuuk Time                               | 
| CKT   | UTC -10:00         | Pacific        | Cook Island Time                         | 
| CLST  | UTC -3:00          | South America  | Chile Summer Time                        | 
| CLT   | UTC -4:00          | South America  | Chile Standard Time                      | 
| COT   | UTC -5:00          | South America  | Colombia Time                            | 
| CST   | UTC -5:00          | Caribbean      | Cuba Standard Time                       | 
| CST   | UTC -6:00          | North America  | Central Standard Time                    | 
| CST   | UTC +8:00          | Asia           | China Standard Time                      | 
| CT    | UTC -6:00 / -5:00  | North America  | Central Time                             | 
| CVT   | UTC -1:00          | Africa         | Cape Verde Time                          | 
| CXT   | UTC +7:00          | Australia      | Christmas Island Time                    | 
| ChST  | UTC +10:00         | Pacific        | Chamorro Standard Time                   |
| DAVT  | UTC +7:00          | Antarctica     | Davis Time                               | 
| DDUT  | UTC +10:00         | Antarctica     | Dumont-d'Urville Time                    |
| EASST | UTC -5:00          | Pacific        | Easter Island Summer Time                | 
| EAST  | UTC -5:00          | Pacific        | Easter Island Standard Time              | 
| EAT   | UTC +3:00          | Africa         | Eastern Africa Time                      | 
| ECT   | UTC -5:00          | South America  | Ecuador Time                             | 
| EDT   | UTC -4:00          | North America  | Eastern Daylight Time                    | 
| EEST  | UTC +3:00          | Europe         | Eastern European Summer Time             | 
| EET   | UTC +2:00          | Europe         | Eastern European Time                    | 
| EGST  | UTC +0:00          | North America  | Eastern Greenland Summer Time            | 
| EGT   | UTC -1:00          | North America  | East Greenland Time                      | 
| EST   | UTC -5:00          | North America  | Eastern Standard Time                    | 
| ET    | UTC -5:00 / -4:00  | North America  | Eastern Time                             |
| FET   | UTC +3:00          | Europe         | Further-Eastern European Time            | 
| FJST  | UTC +13:00         | Pacific        | Fiji Summer Time                         | 
| FJT   | UTC +12:00         | Pacific        | Fiji Time                                | 
| FKST  | UTC -3:00          | South America  | Falkland Islands Summer Time             | 
| FKT   | UTC -4:00          | South America  | Falkland Island Time                     | 
| FNT   | UTC -2:00          | South America  | Fernando de Noronha Time                 |
| GALT  | UTC -6:00          | Pacific        | Galapagos Time                           | 
| GAMT  | UTC -9:00          | Pacific        | Gambier Time                             | 
| GET   | UTC +4:00          | Asia           | Georgia Standard Time                    | 
| GFT   | UTC -3:00          | South America  | French Guiana Time                       | 
| GILT  | UTC +12:00         | Pacific        | Gilbert Island Time                      | 
| GMT   | UTC +0:00          | Europe         | Greenwich Mean Time                      | 
| GST   | UTC -2:00          | South America  | South Georgia Time                       | 
| GST   | UTC +4:00          | Asia           | Gulf Standard Time                       | 
| GYT   | UTC -4:00          | South America  | Guyana Time                              |
| HADT  | UTC -9:00          | North America  | Hawaii-Aleutian Daylight Time            | 
| HAST  | UTC -10:00         | North America  | Hawaii-Aleutian Standard Time            | 
| HKT   | UTC +8:00          | Asia           | Hong Kong Time                           | 
| HOVT  | UTC +7:00          | Asia           | Hovd Time                                |
| ICT   | UTC +7:00          | Asia           | Indochina Time                           | 
| IDT   | UTC +3:00          | Asia           | Israel Daylight Time                     | 
| IOT   | UTC +6:00          | Indian Ocean   | Indian Chagos Time                       | 
| IRDT  | UTC +4:30          | Asia           | Iran Daylight Time                       | 
| IRKST | UTC +9:00          | Asia           | Irkutsk Summer Time                      | 
| IRKT  | UTC +8:00          | Asia           | Irkutsk Time                             | 
| IRST  | UTC +3:30          | Asia           | Iran Standard Time                       | 
| IST   | UTC +1:00          | Europe         | Irish Standard Time                      | 
| IST   | UTC +2:00          | Asia           | Israel Standard Time                     | 
| IST   | UTC +5:30          | Asia           | India Standard Time                      | 
| JST   | UTC +9:00          | Asia           | Japan Standard Time                      |
| KGT   | UTC +6:00          | Asia           | Kyrgyzstan Time                          | 
| KOST  | UTC +11:00         | Pacific        | Kosrae Time                              | 
| KRAST | UTC +8:00          | Asia           | Krasnoyarsk Summer Time                  | 
| KRAT  | UTC +7:00          | Asia           | Krasnoyarsk Time                         | 
| KST   | UTC +9:00          | Asia           | Korea Standard Time                      | 
| KUYT  | UTC +4:00          | Europe         | Kuybyshev Time                           |
| LHDT  | UTC +11:00         | Australia      | Lord Howe Daylight Time                  | 
| LHST  | UTC +10:30         | Australia      | Lord Howe Standard Time                  | 
| LINT  | UTC +14:00         | Pacific        | Line Islands Time                        |
| MAGST | UTC +12:00         | Asia           | Magadan Summer Time                      | 
| MAGT  | UTC +10:00         | Asia           | Magadan Time                             | 
| MART  | UTC -9:30          | Pacific        | Marquesas Time                           | 
| MAWT  | UTC +5:00          | Antarctica     | Mawson Time                              | 
| MDT   | UTC -6:00          | North America  | Mountain Daylight Time                   | 
| MHT   | UTC +12:00         | Pacific        | Marshall Islands Time                    | 
| MMT   | UTC +6:30          | Asia           | Myanmar Time                             | 
| MSD   | UTC +4:00          | Europe         | Moscow Daylight Time                     | 
| MSK   | UTC +3:00          | Europe         | Moscow Standard Time                     | 
| MST   | UTC -7:00          | North America  | Mountain Standard Time                   | 
| MT    | UTC -7:00 / -6:00  | North America  | Mountain Time                            | 
| MUT   | UTC +4:00          | Africa         | Mauritius Time                           | 
| MVT   | UTC +5:00          | Asia           | Maldives Time                            | 
| MYT   | UTC +8:00          | Asia           | Malaysia Time                            |
| NCT   | UTC +11:00         | Pacific        | New Caledonia Time                       | 
| NDT   | UTC -2:30          | North America  | Newfoundland Daylight Time               | 
| NFT   | UTC +11:30         | Australia      | Norfolk Time                             | 
| NOVST | UTC +7:00          | Asia           | Novosibirsk Summer Time                  | 
| NOVT  | UTC +6:00          | Asia           | Novosibirsk Time                         | 
| NPT   | UTC +5:45          | Asia           | Nepal Time                               | 
| NRT   | UTC +12:00         | Pacific        | Nauru Time                               | 
| NST   | UTC -3:30          | North America  | Newfoundland Standard Time               | 
| NUT   | UTC -11:00         | Pacific        | Niue Time                                | 
| NZDT  | UTC +13:00         | Pacific        | New Zealand Daylight Time                | 
| NZST  | UTC +12:00         | Pacific        | New Zealand Standard Time                |
| OMSST | UTC +7:00          | Asia           | Omsk Summer Time                         | 
| OMST  | UTC +6:00          | Asia           | Omsk Standard Time                       | 
| ORAT  | UTC +5:00          | Asia           | Oral Time                                |
| PDT   | UTC -7:00          | North America  | Pacific Daylight Time                    | 
| PET   | UTC -5:00          | South America  | Peru Time                                | 
| PETST | UTC +12:00         | Asia           | Kamchatka Summer Time                    | 
| PETT  | UTC +12:00         | Asia           | Kamchatka Time                           | 
| PGT   | UTC +10:00         | Pacific        | Papua New Guinea Time                    | 
| PHOT  | UTC +13:00         | Pacific        | Phoenix Island Time                      | 
| PHT   | UTC +8:00          | Asia           | Philippine Time                          | 
| PKT   | UTC +5:00          | Asia           | Pakistan Standard Time                   | 
| PMDT  | UTC -2:00          | North America  | Pierre & Miquelon Daylight Time          | 
| PMST  | UTC -3:00          | North America  | Pierre & Miquelon Standard Time          | 
| PONT  | UTC +11:00         | Pacific        | Pohnpei Standard Time                    | 
| PST   | UTC -8:00          | North America  | Pacific Standard Time                    | 
| PST   | UTC -8:00          | Pacific        | Pitcairn Standard Time                   | 
| PT    | UTC -8:00 / -7:00  | North America  | Pacific Time                             | 
| PWT   | UTC +9:00          | Pacific        | Palau Time                               | 
| PYST  | UTC -3:00          | South America  | Paraguay Summer Time                     | 
| PYT   | UTC -4:00          | South America  | Paraguay Time                            |
| QYZT  | UTC +6:00          | Asia           | Qyzylorda Time                           |
| RET   | UTC +4:00          | Africa         | Reunion Time                             | 
| ROTT  | UTC -3:00          | Antarctica     | Rothera Time                             |
| SAKT  | UTC +10:00         | Asia           | Sakhalin Time                            | 
| SAMT  | UTC +4:00          | Europe         | Samara Time                              | 
| SAST  | UTC +2:00          | Africa         | South Africa Standard Time               | 
| SBT   | UTC +11:00         | Pacific        | Solomon Islands Time                     | 
| SCT   | UTC +4:00          | Africa         | Seychelles Time                          | 
| SGT   | UTC +8:00          | Asia           | Singapore Time                           | 
| SRET  | UTC +11:00         | Asia           | Srednekolymsk Time                       | 
| SRT   | UTC -3:00          | South America  | Suriname Time                            | 
| SST   | UTC -11:00         | Pacific        | Samoa Standard Time                      | 
| SYOT  | UTC +3:00          | Antarctica     | Syowa Time                               |
| TAHT  | UTC -10:00         | Pacific        | Tahiti Time                              | 
| TFT   | UTC +5:00          | Indian Ocean   | French Southern and Antarctic Time       | 
| TJT   | UTC +5:00          | Asia           | Tajikistan Time                          | 
| TKT   | UTC +13:00         | Pacific        | Tokelau Time                             | 
| TLT   | UTC +9:00          | Asia           | East Timor Time                          | 
| TMT   | UTC +5:00          | Asia           | Turkmenistan Time                        | 
| TOT   | UTC +13:00         | Pacific        | Tonga Time                               | 
| TVT   | UTC +12:00         | Pacific        | Tuvalu Time                              |
| ULAT  | UTC +8:00          | Asia           | Ulaanbaatar Time                         |
| UYST  | UTC -2:00          | South America  | Uruguay Summer Time                      | 
| UYT   | UTC -3:00          | South America  | Uruguay Time                             | 
| UZT   | UTC +5:00          | Asia           | Uzbekistan Time                          |
| VET   | UTC -4:30          | South America  | Venezuelan Standard Time                 | 
| VLAST | UTC +11:00         | Asia           | Vladivostok Summer Time                  | 
| VLAT  | UTC +10:00         | Asia           | Vladivostok Time                         | 
| VOST  | UTC +6:00          | Antarctica     | Vostok Time                              | 
| VUT   | UTC +11:00         | Pacific        | Vanuatu Time                             |
| WAKT  | UTC +12:00         | Pacific        | Wake Time                                | 
| WARST | UTC -3:00          | South America  | Western Argentine Summer Time            | 
| WAST  | UTC +2:00          | Africa         | West Africa Summer Time                  | 
| WAT   | UTC +1:00          | Africa         | West Africa Time                         | 
| WEST  | UTC +1:00          | Europe         | Western European Summer Time             | 
| WET   | UTC +0:00          | Europe         | Western European Time                    | 
| WFT   | UTC +12:00         | Pacific        | Wallis and Futuna Time                   | 
| WGST  | UTC -2:00          | North America  | Western Greenland Summer Time            | 
| WGT   | UTC -3:00          | North America  | West Greenland Time                      | 
| WIB   | UTC +7:00          | Asia           | Western Indonesian Time                  | 
| WIT   | UTC +9:00          | Asia           | Eastern Indonesian Time                  | 
| WITA  | UTC +8:00          | Asia           | Central Indonesian Time                  | 
| WST   | UTC +1:00          | Africa         | Western Sahara Summer Time               | 
| WST   | UTC +13:00         | Pacific        | West Samoa Time                          | 
| WT    | UTC +0:00          | Africa         | Western Sahara Standard Time             |
| YAKST | UTC +10:00         | Asia           | Yakutsk Summer Time                      | 
| YAKT  | UTC +9:00          | Asia           | Yakutsk Time                             | 
| YAPT  | UTC +10:00         | Pacific        | Yap Time                                 | 
| YEKST | UTC +6:00          | Asia           | Yekaterinburg Summer Time                | 
| YEKT  | UTC +5:00          | Asia           | Yekaterinburg Time                       |
------------------------------------------------------------------------------------------

```
