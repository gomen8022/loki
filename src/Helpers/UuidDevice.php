<?php

namespace Loki\Helpers;

use Detection\MobileDetect;

class UuidDevice
{
    public $BOTS = [
        '\\+https:\\/\\/developers.google.com\\/\\+\\/web\\/snippet\\/',
        'googlebot',
        'baiduspider',
        'gurujibot',
        'yandexbot',
        'slurp',
        'msnbot',
        'bingbot',
        'facebookexternalhit',
        'linkedinbot',
        'twitterbot',
        'slackbot',
        'telegrambot',
        'applebot',
        'pingdom',
        'tumblr ',
        'Embedly',
        'spbot'
    ];

    public $defOptions = array(
        'version' => false,
        'language' => false,
        'platform' => true,
        'os' => true,
        'pixelDepth' => true,
        'colorDepth' => true,
        'resolution' => false,
        'isAuthoritative' => true,
        'silkAccelerated' => true,
        'isKindleFire' => true,
        'isDesktop' => true,
        'isMobile' => true,
        'isTablet' => true,
        'isWindows' => true,
        'isLinux' => true,
        'isLinux64' => true,
        'isChromeOS' => true,
        'isMac' => true,
        'isiPad' => true,
        'isiPhone' => true,
        'isiPod' => true,
        'isAndroid' => true,
        'isSamsung' => true,
        'isSmartTV' => true,
        'isRaspberry' => true,
        'isBlackberry' => true,
        'isTouchScreen' => true,
        'isOpera' => false,
        'isIE' => false,
        'isEdge' => false,
        'isIECompatibilityMode' => false,
        'isSafari' => false,
        'isFirefox' => false,
        'isWebkit' => false,
        'isChrome' => false,
        'isKonqueror' => false,
        'isOmniWeb' => false,
        'isSeaMonkey' => false,
        'isFlock' => false,
        'isAmaya' => false,
        'isPhantomJS' => false,
        'isEpiphany' => false,
        'source' => false,
        'cpuCores' => false
    );

    public $_Versions = array(
        'Edge' => '/Edge\/([\d\w\.\-]+)/i',
        'Firefox' => '/firefox\/([\d\w\.\-]+)/i',
        'IE' => '/msie\s([\d\.]+[\d])|trident\/\d+\.\d+;.*[rv:]+(\d+\.\d)/i',
        'Chrome' => '/chrome\/([\d\w\.\-]+)/i',
        'Chromium' => '/(?:chromium|crios)\/([\d\w\.\-]+)/i',
        'Safari' => '/version\/([\d\w\.\-]+)/i',
        'Opera' => '/version\/([\d\w\.\-]+)|OPR\/([\d\w\.\-]+)/i',
        'Ps3' => '/([\d\w\.\-]+)\)\s*$/i',
        'Psp' => '/([\d\w\.\-]+)\)?\s*$/i',
        'Amaya' => '/amaya\/([\d\w\.\-]+)/i',
        'SeaMonkey' => '/seamonkey\/([\d\w\.\-]+)/i',
        'OmniWeb' => '/omniweb\/v([\d\w\.\-]+)/i',
        'Flock' => '/flock\/([\d\w\.\-]+)/i',
        'Epiphany' => '/epiphany\/([\d\w\.\-]+)/i',
        'WinJs' => '/msapphost\/([\d\w\.\-]+)/i',
        'PhantomJS' => '/phantomjs\/([\d\w\.\-]+)/i',
        'UC' => '/UCBrowser\/([\d\w\.]+)/i'
    );

    public $_Browsers = array(
        'Edge' => '/edge/i',
        'Amaya' => '/amaya/i',
        'Konqueror' => '/konqueror/i',
        'Epiphany' => '/epiphany/i',
        'SeaMonkey' => '/seamonkey/i',
        'Flock' => '/flock/i',
        'OmniWeb' => '/omniweb/i',
        'Chromium' => '/chromium|crios/i',
        'Chrome' => '/chrome/i',
        'Safari' => '/safari/i',
        'IE' => '/msie|trident/i',
        'Opera' => '/opera|OPR/i',
        'PS3' => '/playstation 3/i',
        'PSP' => '/playstation portable/i',
        'Firefox' => '/firefox/i',
        'WinJs' => '/msapphost/i',
        'PhantomJS' => '/phantomjs/i',
        'UC' => '/UCBrowser/i'
    );

    public $_OS = array(
        'Windows10' => '/windows nt 10\.0/i',
        'Windows81' => '/windows nt 6\.3/i',
        'Windows8' => '/windows nt 6\.2/i',
        'Windows7' => '/windows nt 6\.1/i',
        'UnknownWindows' => '/windows nt 6\.\d+/i',
        'WindowsVista' => '/windows nt 6\.0/i',
        'Windows2003' => '/windows nt 5\.2/i',
        'WindowsXP' => '/windows nt 5\.1/i',
        'Windows2000' => '/windows nt 5\.0/i',
        'WindowsPhone8' => '/windows phone 8\./',
        'OSXCheetah' => '/os x 10[._]0/i',
        'OSXPuma' => '/os x 10[._]1(\D|$)/i',
        'OSXJaguar' => '/os x 10[._]2/i',
        'OSXPanther' => '/os x 10[._]3/i',
        'OSXTiger' => '/os x 10[._]4/i',
        'OSXLeopard' => '/os x 10[._]5/i',
        'OSXSnowLeopard' => '/os x 10[._]6/i',
        'OSXLion' => '/os x 10[._]7/i',
        'OSXMountainLion' => '/os x 10[._]8/i',
        'OSXMavericks' => '/os x 10[._]9/i',
        'OSXYosemite' => '/os x 10[._]10/i',
        'OSXElCapitan' => '/os x 10[._]11/i',
        'OSXSierra' => '/os x 10[._]12/i',
        'Mac' => '/os x/i',
        'Linux' => '/linux/i',
        'Linux64' => '/linux x86_64/i',
        'ChromeOS' => '/cros/i',
        'Wii' => '/wii/i',
        'PS3' => '/playstation 3/i',
        'PSP' => '/playstation portable/i',
        'iPad' => '/\(iPad.*os (\d+)[._](\d+)/i',
        'iPhone' => '/\(iPhone.*os (\d+)[._](\d+)/i',
        'Bada' => '/Bada\/(\d+)\.(\d+)/i',
        'Curl' => '/curl\/(\d+)\.(\d+)\.(\d+)/i'
    );

    public $_Platform = array(
        'Windows' => '/windows nt/i',
        'WindowsPhone' => '/windows phone/i',
        'Mac' => '/macintosh/i',
        'Linux' => '/linux/i',
        'Wii' => '/wii/i',
        'Playstation' => '/playstation/i',
        'iPad' => '/ipad/i',
        'iPod' => '/ipod/i',
        'iPhone' => '/iphone/i',
        'Android' => '/android/i',
        'Blackberry' => '/blackberry/i',
        'Samsung' => '/samsung/i',
        'Curl' => '/curl/i'
    );

    public array $Agent = [];
    public array $options = [];
    public string $_IS_BOT_REGEXP = '';
    private MobileDetect $detect;

    public function __construct($options = [])
    {
        $this->_IS_BOT_REGEXP = '/^.*(' . implode('|', $this->BOTS) . ').*$/';

        $this->checkUserAgent($options);
        $this->options = $this->defOptions;
        $this->Agent = $this->defOptions;
        $this->Agent['isSilk'] = false;

        $this->detect = new MobileDetect();
//        $this->Agent['isTouchScreen'] = $detect->isMobile();
//        $this->agent['isTablet'] = $detect->isTablet();
//        $this->agent['isiOS'] = $detect->isiOS();
//        $this->agent['isAndroidOS'] = $detect->isAndroidOS();

    }

    public function checkUserAgent($options = []) {
        $this->options = $this->options ? $options : [];

        foreach ($this->options as $key => $value) {
            if (array_key_exists($key, $this->defOptions)) {
                $this->defOptions[$key] = $value;
            }
        }
    }

    public function hashInt($string) {
        $hash = 0;
        $len = strlen($string);
        if ($len === 0) { return $hash; }
        for ($i = 0; $i < $len; $i++) {
            $chr = ord($string[$i]);
            $hash = (($hash << 5) - $hash) + $chr;
            $hash |= 0;
        }
        return $hash;
    }

    public function getBrowser($string)
    {
        switch (true) {
            case preg_match($this->_Browsers['Edge'], $string):
                $this->Agent['isEdge'] = true;
                return 'Edge';
            case preg_match($this->_Browsers['PhantomJS'], $string):
                $this->Agent['isPhantomJS'] = true;
                return 'PhantomJS';
            case preg_match($this->_Browsers['Konqueror'], $string):
                $this->Agent['isKonqueror'] = true;
                return 'Konqueror';
            case preg_match($this->_Browsers['Amaya'], $string):
                $this->Agent['isAmaya'] = true;
                return 'Amaya';
            case preg_match($this->_Browsers['Epiphany'], $string):
                $this->Agent['isEpiphany'] = true;
                return 'Epiphany';
            case preg_match($this->_Browsers['SeaMonkey'], $string):
                $this->Agent['isSeaMonkey'] = true;
                return 'SeaMonkey';
            case preg_match($this->_Browsers['Flock'], $string):
                $this->Agent['isFlock'] = true;
                return 'Flock';
            case preg_match($this->_Browsers['OmniWeb'], $string):
                $this->Agent['isOmniWeb'] = true;
                return 'OmniWeb';
            case preg_match($this->_Browsers['Opera'], $string):
                $this->Agent['isOpera'] = true;
                return 'Opera';
            case preg_match($this->_Browsers['Chromium'], $string):
                $this->Agent['isChrome'] = true;
                return 'Chromium';
            case preg_match($this->_Browsers['Chrome'], $string):
                $this->Agent['isChrome'] = true;
                return 'Chrome';
            case preg_match($this->_Browsers['Safari'], $string):
                $this->Agent['isSafari'] = true;
                return 'Safari';
            case preg_match($this->_Browsers['WinJs'], $string):
                $this->Agent['isWinJs'] = true;
                return 'WinJs';
            case preg_match($this->_Browsers['IE'], $string):
                $this->Agent['isIE'] = true;
                return 'IE';
            case preg_match($this->_Browsers['PS3'], $string):
                return 'ps3';
            case preg_match($this->_Browsers['PSP'], $string):
                return 'psp';
            case preg_match($this->_Browsers['Firefox'], $string):
                $this->Agent['isFirefox'] = true;
                return 'Firefox';
            case preg_match($this->_Browsers['UC'], $string):
                $this->Agent['isUC'] = true;
                return 'UCBrowser';
            default:
                // If the UA does not start with Mozilla guess the user agent.
                if (strpos($string, 'Mozilla') !== 0 && preg_match('/^([\d\w\-\.]+)\/[\d\w\.\-]+/i', $string, $matches)) {
                    $this->Agent['isAuthoritative'] = false;
                    return $matches[1];
                }
                return 'unknown';
        }
    }

    public function getBrowserVersion($string)
    {
        $regex = '';
        switch ($this->Agent['browser']) {
            case 'Edge':
                if (preg_match($this->_Versions['Edge'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'PhantomJS':
                if (preg_match($this->_Versions['PhantomJS'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Chrome':
                if (preg_match($this->_Versions['Chrome'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Chromium':
                if (preg_match($this->_Versions['Chromium'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Safari':
                if (preg_match($this->_Versions['Safari'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Opera':
                if (preg_match($this->_Versions['Opera'], $string, $matches)) {
                    return $matches[1] ? $matches[1] : $matches[2];
                }
                break;
            case 'Firefox':
                if (preg_match($this->_Versions['Firefox'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'WinJs':
                if (preg_match($this->_Versions['WinJs'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'IE':
                if (preg_match($this->_Versions['IE'], $string, $matches)) {
                    return $matches[2] ? $matches[2] : $matches[1];
                }
                break;
            case 'ps3':
                if (preg_match($this->_Versions['Ps3'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'psp':
                if (preg_match($this->_Versions['Psp'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Amaya':
                if (preg_match($this->_Versions['Amaya'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Epiphany':
                if (preg_match($this->_Versions['Epiphany'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'SeaMonkey':
                if (preg_match($this->_Versions['SeaMonkey'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'Flock':
                if (preg_match($this->_Versions['Flock'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'OmniWeb':
                if (preg_match($this->_Versions['OmniWeb'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            case 'UCBrowser':
                if (preg_match($this->_Versions['UC'], $string, $matches)) {
                    return $matches[1];
                }
                break;
            default:
                if ($this->Agent['browser'] !== 'unknown') {
                    $regex = '/' . $this->Agent['browser'] . '[\\/ ]([\\d\\w\\.\\-]+)/i';
                    if (preg_match($regex, $string, $matches)) {
                        return $matches[1];
                    }
                }
        }
    }

    public function getOS($string) {
        switch (true) {
            case preg_match($this->_OS['WindowsVista'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows Vista';
            case preg_match($this->_OS['Windows7'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 7';
            case preg_match($this->_OS['Windows8'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 8';
            case preg_match($this->_OS['Windows81'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 8.1';
            case preg_match($this->_OS['Windows10'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 10.0';
            case preg_match($this->_OS['Windows2003'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 2003';
            case preg_match($this->_OS['WindowsXP'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows XP';
            case preg_match($this->_OS['Windows2000'], $string):
                $this->Agent['isWindows'] = true;
                return 'Windows 2000';
            case preg_match($this->_OS['WindowsPhone8'], $string):
                return 'Windows Phone 8';
            case preg_match($this->_OS['Linux64'], $string):
                $this->Agent['isLinux'] = true;
                $this->Agent['isLinux64'] = true;
                return 'Linux 64';
            case preg_match($this->_OS['Linux'], $string):
                $this->Agent['isLinux'] = true;
                return 'Linux';
            case preg_match($this->_OS['ChromeOS'], $string):
                $this->Agent['isChromeOS'] = true;
                return 'Chrome OS';
            case preg_match($this->_OS['Wii'], $string):
                return 'Wii';
            case preg_match($this->_OS['PSP'], $string):
            case preg_match($this->_OS['PS3'], $string):
                return 'Playstation';
            case preg_match($this->_OS['OSXCheetah'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Cheetah';
            case preg_match($this->_OS['OSXPuma'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Puma';
            case preg_match($this->_OS['OSXJaguar'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Jaguar';
            case preg_match($this->_OS['OSXPanther'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Panther';
            case preg_match($this->_OS['OSXTiger'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Tiger';
            case preg_match($this->_OS['OSXLeopard'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Leopard';
            case preg_match($this->_OS['OSXSnowLeopard'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Snow Leopard';
            case preg_match($this->_OS['OSXLion'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Lion';
            case preg_match($this->_OS['OSXMountainLion'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Mountain Lion';
            case preg_match($this->_OS['OSXMavericks'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Mavericks';
            case preg_match($this->_OS['OSXYosemite'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X Yosemite';
            case preg_match($this->_OS['OSXElCapitan'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X El Capitan';
            case preg_match($this->_OS['OSXSierra'], $string):
                $this->Agent['isMac'] = true;
                return 'macOS Sierra';
            case preg_match($this->_OS['Mac'], $string):
                $this->Agent['isMac'] = true;
                return 'OS X';
            case preg_match($this->_OS['iPad'], $string, $matches):
                $this->Agent['isiPad'] = true;
                return str_replace('_', '.', $matches[0]);
            case preg_match($this->_OS['iPhone'], $string, $matches):
                $this->Agent['isiPhone'] = true;
                return str_replace('_', '.', $matches[0]);
            case preg_match($this->_OS['Bada'], $string):
                $this->Agent['isBada'] = true;
                return 'Bada';
            case preg_match($this->_OS['Curl'], $string):
                $this->Agent['isCurl'] = true;
                return 'Curl';
            default:
                return 'unknown';
        }
    }

    public function getPlatform($string)
    {
        switch (true) {
            case preg_match($this->_Platform['Windows'], $string):
                return 'Microsoft Windows';
            case preg_match($this->_Platform['WindowsPhone'], $string):
                $this->Agent['isWindowsPhone'] = true;
                return 'Microsoft Windows Phone';
            case preg_match($this->_Platform['Mac'], $string):
                return 'Apple Mac';
            case preg_match($this->_Platform['Curl'], $string):
                return 'Curl';
            case preg_match($this->_Platform['Android'], $string):
                $this->Agent['isAndroid'] = true;
                return 'Android';
            case preg_match($this->_Platform['Blackberry'], $string):
                $this->Agent['isBlackberry'] = true;
                return 'Blackberry';
            case preg_match($this->_Platform['Linux'], $string):
                return 'Linux';
            case preg_match($this->_Platform['Wii'], $string):
                return 'Wii';
            case preg_match($this->_Platform['Playstation'], $string):
                return 'Playstation';
            case preg_match($this->_Platform['iPad'], $string):
                $this->Agent['isiPad'] = true;
                return 'iPad';
            case preg_match($this->_Platform['iPod'], $string):
                $this->Agent['isiPod'] = true;
                return 'iPod';
            case preg_match($this->_Platform['iPhone'], $string):
                $this->Agent['isiPhone'] = true;
                return 'iPhone';
            case preg_match($this->_Platform['Samsung'], $string):
                $this->Agent['isiSamsung'] = true;
                return 'Samsung';
            default:
                return 'unknown';
        }
    }

    public function testCompatibilityMode() {
        if ($this->Agent['isIE']) {
            if (preg_match('/Trident\/(\d)\.0/i', $this->Agent['source'], $matches)) {
                $tridentVersion = intval($matches[1]);
                $version = intval($this->Agent['version']);
                if ($version === 7 && $tridentVersion === 7) {
                    $this->Agent['isIECompatibilityMode'] = true;
                    $this->Agent['version'] = 11.0;
                }

                if ($version === 7 && $tridentVersion === 6) {
                    $this->Agent['isIECompatibilityMode'] = true;
                    $this->Agent['version'] = 10.0;
                }

                if ($version === 7 && $tridentVersion === 5) {
                    $this->Agent['isIECompatibilityMode'] = true;
                    $this->Agent['version'] = 9.0;
                }

                if ($version === 7 && $tridentVersion === 4) {
                    $this->Agent['isIECompatibilityMode'] = true;
                    $this->Agent['version'] = 8.0;
                }
            }
        }
    }

    public function testSilk() {
        switch (true) {
            case preg_match('/silk/i', $this->Agent['source']):
                $this->Agent['isSilk'] = true;
                break;
            default:
        }

        if (preg_match('/Silk-Accelerated=true/i', $this->Agent['source'])) {
            $this->Agent['isSilkAccelerated'] = true;
        }
        return $this->Agent['isSilk'] ? 'Silk' : false;
    }

    public function testKindleFire() {
        switch (true) {
            case preg_match('/KFOT/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire';
            case preg_match('/KFTT/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HD';
            case preg_match('/KFJWI/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HD 8.9';
            case preg_match('/KFJWA/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HD 8.9 4G';
            case preg_match('/KFSOWI/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HD 7';
            case preg_match('/KFTHWI/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HDX 7';
            case preg_match('/KFTHWA/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HDX 7 4G';
            case preg_match('/KFAPWI/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HDX 8.9';
            case preg_match('/KFAPWA/i', $this->Agent['source']):
                $this->Agent['isKindleFire'] = true;
                return 'Kindle Fire HDX 8.9 4G';
            default:
                return false;
        }
    }
    function testCaptiveNetwork() {
        switch (true) {
            case preg_match('/CaptiveNetwork/i', $this->Agent['source']):
                $this->Agent['isCaptive'] = true;
                $this->Agent['isMac'] = true;
                $this->Agent['platform'] = 'Apple Mac';
                return 'CaptiveNetwork';
            default:
                return false;
        }
    }

    function testMobile() {
        switch (true) {
            case $this->Agent['isWindows']:
            case $this->Agent['isLinux']:
            case $this->Agent['isMac']:
            case $this->Agent['isChromeOS']:
                $this->Agent['isDesktop'] = true;
                break;
            case $this->Agent['isAndroid']:
            case $this->Agent['isSamsung']:
                $this->Agent['isMobile'] = true;
                $this->Agent['isDesktop'] = false;
                break;
            default:
        }
        switch (true) {
            case $this->Agent['isiPad']:
            case $this->Agent['isiPod']:
            case $this->Agent['isiPhone']:
            case $this->Agent['isBada']:
            case $this->Agent['isBlackberry']:
            case $this->Agent['isAndroid']:
            case $this->Agent['isWindowsPhone']:
                $this->Agent['isMobile'] = true;
                $this->Agent['isDesktop'] = false;
                break;
            default:
        }
        if (preg_match('/mobile/i', $this->Agent['source'])) {
            $this->Agent['isMobile'] = true;
            $this->Agent['isDesktop'] = false;
        }
    }

    public function testTablet() {
        switch (true) {
            case $this->Agent['isiPad']:
            case $this->Agent['isAndroidTablet']:
            case $this->Agent['isKindleFire']:
                $this->Agent['isTablet'] = true;
                break;
        }
        if (preg_match('/tablet/i', $this->Agent['source'])) {
            $this->Agent['isTablet'] = true;
        }
    }


    public function testNginxGeoIP($headers) {
        foreach ($headers as $key => $value) {
            if (preg_match('/^GEOIP/i', $key)) {
                $this->Agent['geoIp'][$key] = $value;
            }
        }
    }

    public function testBot() {
        $isBot = preg_match($this->_IS_BOT_REGEXP, strtolower($this->Agent['source']), $matches);
        if ($isBot) {
            $this->Agent['isBot'] = $matches[1];
        }
        elseif (!$this->Agent['isAuthoritative']) {
            // Test unauthoritative parse for `bot` in UA to flag for bot
            $this->Agent['isBot'] = preg_match('/bot/i', $this->Agent['source']);
        }
    }

    public function testSmartTV() {
        $isSmartTV = preg_match('/smart-tv|smarttv|googletv|appletv|hbbtv|pov_tv|netcast.tv/i', strtolower($this->Agent['source']), $matches);
        if ($isSmartTV) {
            $this->Agent['isSmartTV'] = $matches[1];
        }
    }

    public function testAndroidTablet() {
        if ($this->Agent['isAndroid'] && !preg_match('/mobile/i', $this->Agent['source'])) {
            $this->Agent['isAndroidTablet'] = true;
        }
    }

    public function testTouchSupport() {
        $isTouchScreen = isset($_SERVER['HTTP_USER_AGENT']) &&
            (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'Silk') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ||
                strpos($_SERVER['HTTP_USER_AGENT'], 'IEMobile') !== false);
        $this->Agent['isTouchScreen'] = $isTouchScreen;
    }

    public function getLanguage() {
        $this->Agent['language'] = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '');
    }

    public function getColorDepth() {
        $this->Agent['colorDepth'] = (isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : -1);
    }

    public function getScreenResolution() {

        $deviceType = ($this->detect->isMobile() ? ($this->detect->isTablet() ? 'Tablet' : 'Mobile') : 'Desktop');

        // Typical screen sizes for popular brands
        $screenSizes = [
            'Apple' => ['Mobile' => ['width' => 375, 'height' => 812], 'Tablet' => ['width' => 768, 'height' => 1024], 'Desktop' => ['width' => 1440, 'height' => 900]],
            'Samsung' => ['Mobile' => ['width' => 360, 'height' => 740], 'Tablet' => ['width' => 800, 'height' => 1280], 'Desktop' => ['width' => 1366, 'height' => 768]],
            'default' => ['Mobile' => ['width' => 360, 'height' => 640], 'Tablet' => ['width' => 768, 'height' => 1024], 'Desktop' => ['width' => 1366, 'height' => 768]]
        ];

        if ($this->detect->is('iOS') || $this->detect->is('Macintosh')) {
            $screenSize = $screenSizes['Apple'][$deviceType];
        } else if ($this->detect->is('AndroidOS')) {
            // Android devices could be from various brands, Samsung is just used for the example
            $screenSize = $screenSizes['Samsung'][$deviceType];
        } else {
            $screenSize = $screenSizes['default'][$deviceType];
        }

        $this->Agent['resolution'] = [$screenSize['width'], $screenSize['height']];
    }

    public function getPixelDepth () {
        $this->Agent['pixelDepth'] = (isset($_SERVER['HTTP_PIXEL_DEPTH']) ? $_SERVER['HTTP_PIXEL_DEPTH'] : -1);
    }

    public function getCPU() {
        $this->Agent['cpuCores'] = (isset($_SERVER['HTTP_CPU_CORES']) ? $_SERVER['HTTP_CPU_CORES'] : -1);
    }

    public function reset() {
        foreach ($this->defOptions as $key => $value) {
            $this->Agent[$key] = $value;
        }
        return $this;
    }

    public function parse($source = null) {
        $source = isset($source) ? $source : $_SERVER['HTTP_USER_AGENT'];
        $this->Agent['source'] = preg_replace('/^\s*/', '', $source);
        $this->Agent['os'] = $this->getOS($this->Agent['source']);
        $this->Agent['platform'] = $this->getPlatform($this->Agent['source']);
        $this->Agent['browser'] = $this->getBrowser($this->Agent['source']);
        $this->Agent['version'] = $this->getBrowserVersion($this->Agent['source']);
        $this->Agent['isAuthoritative'] = true;
        $this->testBot();
        $this->testSmartTV();
        $this->testMobile();
        $this->testAndroidTablet();
        $this->testTablet();
        $this->testCompatibilityMode();
        $this->testSilk();
        $this->testKindleFire();
        $this->testCaptiveNetwork();
        $this->testTouchSupport();
        $this->getLanguage();
        $this->getColorDepth();
        $this->getPixelDepth();
        $this->getScreenResolution();
        $this->getCPU();
        return $this->Agent;
    }

    public function get($customData = null) {
        $pref = 'a';
        $du = $this->parse();
        $dua = [];
        foreach ($this->options as $key => $value) {
            if ($value === true) {
                $dua[] = $du[$key];
            }
        }
        if ($customData) {
            $dua[] = $customData;
        }
        if (!$this->options['resolution'] && $du['isMobile']) {
            $dua[] = $du['resolution'][0];
            $dua[] = $du['resolution'][1];
        }
        $pref = 'b';
        $tmpUuid = $this->md5Hash(implode(':', $dua));
        $uuid = [
            substr($tmpUuid, 0, 8),
            substr($tmpUuid, 8, 4),
            '4' . substr($tmpUuid, 12, 3),
            $pref . substr($tmpUuid, 15, 3),
            substr($tmpUuid, 20)
        ];
        return implode('-', $uuid);
    }

    public function md5Hash($string) {
        function rotateLeft($lValue, $iShiftBits) {
            return ($lValue << $iShiftBits) | ($lValue >> (32 - $iShiftBits));
        }

        function addUnsigned($lX, $lY) {
            $lX4 = ($lX & 0x80000000);
            $lY4 = ($lY & 0x80000000);
            $lX8 = ($lX & 0x40000000);
            $lY8 = ($lY & 0x40000000);
            $lResult = ($lX & 0x3FFFFFFF) + ($lY & 0x3FFFFFFF);

            if ($lX8 & $lY8) {
                return ($lResult ^ 0x80000000 ^ $lX4 ^ $lY4);
            }
            if ($lX8 | $lY8) {
                if ($lResult & 0x40000000) {
                    return ($lResult ^ 0xC0000000 ^ $lX4 ^ $lY4);
                } else {
                    return ($lResult ^ 0x40000000 ^ $lX4 ^ $lY4);
                }
            } else {
                return ($lResult ^ $lX4 ^ $lY4);
            }
        }

        function gF($x, $y, $z) {
            return ($x & $y) | ((~$x) & $z);
        }

        function gG($x, $y, $z) {
            return ($x & $z) | ($y & (~$z));
        }

        function gH($x, $y, $z) {
            return ($x ^ $y ^ $z);
        }

        function gI($x, $y, $z) {
            return ($y ^ ($x | (~$z)));
        }

        function gFF($a, $b, $c, $d, $x, $s, $ac) {
            $a = addUnsigned($a, addUnsigned(addUnsigned(gF($b, $c, $d), $x), $ac));
            return addUnsigned(rotateLeft($a, $s), $b);
        }

        function gGG($a, $b, $c, $d, $x, $s, $ac) {
            $a = addUnsigned($a, addUnsigned(addUnsigned(gG($b, $c, $d), $x), $ac));
            return addUnsigned(rotateLeft($a, $s), $b);
        }

        function gHH($a, $b, $c, $d, $x, $s, $ac) {
            $a = addUnsigned($a, addUnsigned(addUnsigned(gH($b, $c, $d), $x), $ac));
            return addUnsigned(rotateLeft($a, $s), $b);
        }

        function gII($a, $b, $c, $d, $x, $s, $ac) {
            $a = addUnsigned($a, addUnsigned(addUnsigned(gI($b, $c, $d), $x), $ac));
            return addUnsigned(rotateLeft($a, $s), $b);
        }

        function convertToWordArray($string) {
            $lWordCount = 0;
            $lMessageLength = strlen($string);
            $lNumberOfWordsTemp1 = $lMessageLength + 8;
            $lNumberOfWordsTemp2 = ($lNumberOfWordsTemp1 - ($lNumberOfWordsTemp1 % 64)) / 64;
            $lNumberOfWords = ($lNumberOfWordsTemp2 + 1) * 16;
            $lWordArray = array_fill(0, $lNumberOfWords - 1, 0);
            $lBytePosition = 0;
            $lByteCount = 0;

            while ($lByteCount < $lMessageLength) {
                $lWordCount = ($lByteCount - ($lByteCount % 4)) / 4;
                $lBytePosition = ($lByteCount % 4) * 8;
                $lWordArray[$lWordCount] = ($lWordArray[$lWordCount] | (ord($string[$lByteCount]) << $lBytePosition));
                $lByteCount++;
            }

            $lWordCount = ($lByteCount - ($lByteCount % 4)) / 4;
            $lBytePosition = ($lByteCount % 4) * 8;
            $lWordArray[$lWordCount] = $lWordArray[$lWordCount] | (0x80 << $lBytePosition);
            $lWordArray[$lNumberOfWords - 2] = $lMessageLength << 3;
            $lWordArray[$lNumberOfWords - 1] = $lMessageLength >> 29;
            return $lWordArray;
        }

        function wordToHex($lValue) {
            $wordToHexValue = '';
            $wordToHexValueTemp = '';
            $lByte = '';
            $lCount = '';
            for ($lCount = 0; $lCount <= 3; $lCount++) {
                $lByte = ($lValue >> ($lCount * 8)) & 255;
                $wordToHexValueTemp = '0' . dechex($lByte);
                $wordToHexValue .= substr($wordToHexValueTemp, -2);
            }
            return $wordToHexValue;
        }

        function utf8Encode($string) {
            $string = str_replace("\r\n", "\n", $string);
            $utftext = '';

            for ($n = 0; $n < strlen($string); $n++) {
                $c = ord($string[$n]);
                if ($c < 128) {
                    $utftext .= chr($c);
                } else if (($c > 127) && ($c < 2048)) {
                    $utftext .= chr(($c >> 6) | 192);
                    $utftext .= chr(($c & 63) | 128);
                } else {
                    $utftext .= chr(($c >> 12) | 224);
                    $utftext .= chr((($c >> 6) & 63) | 128);
                    $utftext .= chr(($c & 63) | 128);
                }
            }
            return $utftext;
        }

        $x = [];
        $k = '';
        $AA = '';
        $BB = '';
        $CC = '';
        $DD = '';
        $a = '';
        $b = '';
        $c = '';
        $d = '';
        $S11 = 7;
        $S12 = 12;
        $S13 = 17;
        $S14 = 22;
        $S21 = 5;
        $S22 = 9;
        $S23 = 14;
        $S24 = 20;
        $S31 = 4;
        $S32 = 11;
        $S33 = 16;
        $S34 = 23;
        $S41 = 6;
        $S42 = 10;
        $S43 = 15;
        $S44 = 21;
        $string = utf8Encode($string);
        $x = convertToWordArray($string);
        $a = 0x67452301;
        $b = 0xEFCDAB89;
        $c = 0x98BADCFE;
        $d = 0x10325476;

        for ($k = 0; $k < count($x); $k += 16) {
            $AA = $a;
            $BB = $b;
            $CC = $c;
            $DD = $d;
            $a = gFF($a, $b, $c, $d, $x[$k + 0], $S11, 0xD76AA478);
            $d = gFF($d, $a, $b, $c, $x[$k + 1], $S12, 0xE8C7B756);
            $c = gFF($c, $d, $a, $b, $x[$k + 2], $S13, 0x242070DB);
            $b = gFF($b, $c, $d, $a, $x[$k + 3], $S14, 0xC1BDCEEE);
            $a = gFF($a, $b, $c, $d, $x[$k + 4], $S11, 0xF57C0FAF);
            $d = gFF($d, $a, $b, $c, $x[$k + 5], $S12, 0x4787C62A);
            $c = gFF($c, $d, $a, $b, $x[$k + 6], $S13, 0xA8304613);
            $b = gFF($b, $c, $d, $a, $x[$k + 7], $S14, 0xFD469501);
            $a = gFF($a, $b, $c, $d, $x[$k + 8], $S11, 0x698098D8);
            $d = gFF($d, $a, $b, $c, $x[$k + 9], $S12, 0x8B44F7AF);
            $c = gFF($c, $d, $a, $b, $x[$k + 10], $S13, 0xFFFF5BB1);
            $b = gFF($b, $c, $d, $a, $x[$k + 11], $S14, 0x895CD7BE);
            $a = gFF($a, $b, $c, $d, $x[$k + 12], $S11, 0x6B901122);
            $d = gFF($d, $a, $b, $c, $x[$k + 13], $S12, 0xFD987193);
            $c = gFF($c, $d, $a, $b, $x[$k + 14], $S13, 0xA679438E);
            $b = gFF($b, $c, $d, $a, $x[$k + 15], $S14, 0x49B40821);
            $a = gGG($a, $b, $c, $d, $x[$k + 1], $S21, 0xF61E2562);
            $d = gGG($d, $a, $b, $c, $x[$k + 6], $S22, 0xC040B340);
            $c = gGG($c, $d, $a, $b, $x[$k + 11], $S23, 0x265E5A51);
            $b = gGG($b, $c, $d, $a, $x[$k + 0], $S24, 0xE9B6C7AA);
            $a = gGG($a, $b, $c, $d, $x[$k + 5], $S21, 0xD62F105D);
            $d = gGG($d, $a, $b, $c, $x[$k + 10], $S22, 0x2441453);
            $c = gGG($c, $d, $a, $b, $x[$k + 15], $S23, 0xD8A1E681);
            $b = gGG($b, $c, $d, $a, $x[$k + 4], $S24, 0xE7D3FBC8);
            $a = gGG($a, $b, $c, $d, $x[$k + 9], $S21, 0x21E1CDE6);
            $d = gGG($d, $a, $b, $c, $x[$k + 14], $S22, 0xC33707D6);
            $c = gGG($c, $d, $a, $b, $x[$k + 3], $S23, 0xF4D50D87);
            $b = gGG($b, $c, $d, $a, $x[$k + 8], $S24, 0x455A14ED);
            $a = gGG($a, $b, $c, $d, $x[$k + 13], $S21, 0xA9E3E905);
            $d = gGG($d, $a, $b, $c, $x[$k + 2], $S22, 0xFCEFA3F8);
            $c = gGG($c, $d, $a, $b, $x[$k + 7], $S23, 0x676F02D9);
            $b = gGG($b, $c, $d, $a, $x[$k + 12], $S24, 0x8D2A4C8A);
            $a = gHH($a, $b, $c, $d, $x[$k + 5], $S31, 0xFFFA3942);
            $d = gHH($d, $a, $b, $c, $x[$k + 8], $S32, 0x8771F681);
            $c = gHH($c, $d, $a, $b, $x[$k + 11], $S33, 0x6D9D6122);
            $b = gHH($b, $c, $d, $a, $x[$k + 14], $S34, 0xFDE5380C);
            $a = gHH($a, $b, $c, $d, $x[$k + 1], $S31, 0xA4BEEA44);
            $d = gHH($d, $a, $b, $c, $x[$k + 4], $S32, 0x4BDECFA9);
            $c = gHH($c, $d, $a, $b, $x[$k + 7], $S33, 0xF6BB4B60);
            $b = gHH($b, $c, $d, $a, $x[$k + 10], $S34, 0xBEBFBC70);
            $a = gHH($a, $b, $c, $d, $x[$k + 13], $S31, 0x289B7EC6);
            $d = gHH($d, $a, $b, $c, $x[$k + 0], $S32, 0xEAA127FA);
            $c = gHH($c, $d, $a, $b, $x[$k + 3], $S33, 0xD4EF3085);
            $b = gHH($b, $c, $d, $a, $x[$k + 6], $S34, 0x4881D05);
            $a = gHH($a, $b, $c, $d, $x[$k + 9], $S31, 0xD9D4D039);
            $d = gHH($d, $a, $b, $c, $x[$k + 12], $S32, 0xE6DB99E5);
            $c = gHH($c, $d, $a, $b, $x[$k + 15], $S33, 0x1FA27CF8);
            $b = gHH($b, $c, $d, $a, $x[$k + 2], $S34, 0xC4AC5665);
            $a = gII($a, $b, $c, $d, $x[$k + 0], $S41, 0xF4292244);
            $d = gII($d, $a, $b, $c, $x[$k + 7], $S42, 0x432AFF97);
            $c = gII($c, $d, $a, $b, $x[$k + 14], $S43, 0xAB9423A7);
            $b = gII($b, $c, $d, $a, $x[$k + 5], $S44, 0xFC93A039);
            $a = gII($a, $b, $c, $d, $x[$k + 12], $S41, 0x655B59C3);
            $d = gII($d, $a, $b, $c, $x[$k + 3], $S42, 0x8F0CCC92);
            $c = gII($c, $d, $a, $b, $x[$k + 10], $S43, 0xFFEFF47D);
            $b = gII($b, $c, $d, $a, $x[$k + 1], $S44, 0x85845DD1);
            $a = gII($a, $b, $c, $d, $x[$k + 8], $S41, 0x6FA87E4F);
            $d = gII($d, $a, $b, $c, $x[$k + 15], $S42, 0xFE2CE6E0);
            $c = gII($c, $d, $a, $b, $x[$k + 6], $S43, 0xA3014314);
            $b = gII($b, $c, $d, $a, $x[$k + 13], $S44, 0x4E0811A1);
            $a = gII($a, $b, $c, $d, $x[$k + 4], $S41, 0xF7537E82);
            $d = gII($d, $a, $b, $c, $x[$k + 11], $S42, 0xBD3AF235);
            $c = gII($c, $d, $a, $b, $x[$k + 2], $S43, 0x2AD7D2BB);
            $b = gII($b, $c, $d, $a, $x[$k + 9], $S44, 0xEB86D391);
            $a = addUnsigned($a, $AA);
            $b = addUnsigned($b, $BB);
            $c = addUnsigned($c, $CC);
            $d = addUnsigned($d, $DD);
        }
        $temp = wordToHex($a) . wordToHex($b) . wordToHex($c) . wordToHex($d);
        return strtolower($temp);
    }
}

