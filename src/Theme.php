<?php

namespace DevHau\Modules;

class Theme
{
    private static $themeValue = array();

    public static function setValue($key, $value)
    {
        self::$themeValue[$key] = $value;
    }
    public static function getValue($key,  $default = '')
    {
        return self::$themeValue[$key] ?? (self::$themeValue[$key] = $default);
    }
    public static function setBodyClass($bodyClass)
    {
        self::setValue('bodyClass', $bodyClass);
    }
    public static function getBodyClass()
    {
        return self::getValue('bodyClass', self::getTheme('.body-class'));
    }
    public static function setImage($image)
    {
        self::setValue('image', $image);
    }
    public static function getImage()
    {
        return self::getValue('image', self::getTheme('.image'));
    }
    public static function setUrl($url)
    {
        self::setValue('url', $url);
    }
    public static function getUrl()
    {
        return self::getValue('url', \URL::current());
    }
    public static function setTitle($title)
    {
        self::setValue('title', $title);
    }
    public static function getTitle()
    {
        return self::getValue('title', self::getTheme('.title'));
    }
    public static function setDescription($description)
    {
        self::setValue('description', $description);
    }
    public static function getDescription()
    {
        return self::getValue('description', self::getTheme('.description'));
    }
    public static function setKeyword($keyword)
    {
        self::setValue('keyword', $keyword);
    }
    public static function getKeyword()
    {
        return self::getValue('keyword', self::getTheme('.keyword'));
    }
    public static function setRobots($robots)
    {
        self::setValue('robots', $robots);
    }
    public static function getRobots()
    {
        return self::getValue('robots', self::getTheme('.robots'));
    }
    public static function setLanguage($language)
    {
        self::setValue('language', $language);
    }
    public static function getLanguage()
    {
        return self::getValue('language', self::getTheme('.language'));
    }
    public static function setContentLanguage($contentLanguage)
    {
        self::setValue('contentLanguage', $contentLanguage);
    }
    public static function getContentLanguage()
    {
        return self::getValue('contentLanguage', self::getTheme('.content-language', 'en'));
    }
    public static function setRevisitAfter($revisitAfter)
    {
        self::setValue('revisitAfter', $revisitAfter);
    }
    public static function getRevisitAfter()
    {
        return self::getValue('revisitAfter', self::getTheme('.revisit-after', '1 days'));
    }
    public static function setAuthor($author)
    {
        self::setValue('author', $author);
    }
    public static function getAuthor()
    {
        return self::getValue('author', self::getTheme('.author', 'nguyen van hau'));
    }
    private static $theme;
    private static $themeDefault;
    public static function SetTheme($theme, $themeDefault = 'devhau-module::layout.none')
    {
        self::$theme = $theme;
        self::$themeDefault = $themeDefault ?? 'devhau-module::layout.none';
    }
    public static function HasTheme()
    {
        return isset(self::$theme) && self::$theme != "";
    }
    public static function Current()
    {
        return self::$theme;
    }
    public static function getTheme($sub = "", $default = '')
    {
        return ModuleLoader::Theme()->getDataByKey(self::$theme, $sub) ?? $default;
    }
    public static function Layout()
    {
        return self::getTheme(".layout", self::$themeDefault);
    }

    public static function js()
    {
        return self::getTheme(".js", []);
    }
    public static function css()
    {
        return self::getTheme(".css", []);
    }
    public static function isTurbo()
    {
        return self::getTheme(".is-turbo", true);
    }
    public static function None()
    {
        return ModuleLoader::Theme()->getDataByKey('none');
    }
    public static function getList($status = 0)
    {
        $theme = ModuleLoader::Theme()->getData();
        $themes = [];
        foreach ($theme as $key => $item) {
            if ($status == 1 && (!isset($item['admin']) || $item['admin'] != true)) continue;
            if ($status == -1 && isset($item['admin']) && $item['admin'] == true) continue;
            $themes[] = [
                'id' => $key,
                'text' => $key
            ];
        }
        return  $themes;
    }
}
