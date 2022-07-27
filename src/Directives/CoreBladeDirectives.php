<?php

namespace DevHau\Modules\Directives;

use Illuminate\Support\Str;
use Livewire\LivewireManager;

class CoreBladeDirectives
{
    public static function menuRender($expression)
    {
        if (class_exists($expression)) {
            $expression = $expression::getName();
        }
        $cachedKey = "'menu-" . Str::random(7) . "'";
        $cachedPosition = "'menu-top'";
        $cachedClass = "''";
        $cachedAttr = "''";
        $cachedActive = "true";
        $pattern = "/,\s*?key\(([\s\S]*)\)/"; //everything between ",key(" and ")"
        $patternActive = "/,\s*?active\(([\s\S]*)\)/"; //everything between ",active(" and ")"
        $patternPosition = "/,\s*?position\(([\s\S]*)\)/"; //everything between ",position(" and ")"
        $patternclass = "/,\s*?class\(([\s\S]*)\)/"; //everything between ",class(" and ")"
        $patternAttr = "/,\s*?attr\(([\s\S]*)\)/"; //everything between ",attr(" and ")"
        $expression = preg_replace_callback($pattern, function ($match) use (&$cachedKey) {
            $cachedKey = "'" . trim($match[1]) . "'" ?: $cachedKey;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternActive, function ($match) use (&$cachedActive) {
            $cachedActive = trim($match[1]) ?: $cachedActive;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternclass, function ($match) use (&$cachedClass) {
            $cachedClass = "'" . trim($match[1]) . "'" ?: $cachedClass;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternAttr, function ($match) use (&$cachedAttr) {
            $cachedAttr = "'" . trim($match[1]) . "'" ?: $cachedAttr;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternPosition, function ($match) use (&$cachedPosition) {
            $cachedPosition = "'" . trim($match[1]) . "'" ?: $cachedPosition;
            return "";
        }, $expression);
        return <<<EOT
        <?php
        echo \DevHau\Modules\Builder\Menu\MenuBuilder::Render($cachedPosition,$cachedKey,$cachedClass,$cachedAttr,$cachedActive);
        ?>
        EOT;
    }
    public static function livewireModal($expression)
    {
        $cachedKey = "'" . Str::random(7) . "'";
        $cachedId = Str::random(20);
        $cachedParams = array();
        if (class_exists($expression)) {
            $expression = $expression::getName();
        }
        // If we are inside a Livewire component, we know we're rendering a child.
        // Therefore, we must create a more deterministic view cache key so that
        // Livewire children are properly tracked across load balancers.
        if (LivewireManager::$currentCompilingViewPath !== null) {
            // $cachedKey = '[hash of Blade view path]-[current @livewire directive count]'
            $cachedKey = "'l" . crc32(LivewireManager::$currentCompilingViewPath) . "-" . LivewireManager::$currentCompilingChildCounter . "'";

            // We'll increment count, so each cache key inside a compiled view is unique.
            LivewireManager::$currentCompilingChildCounter++;
        }

        $pattern = "/,\s*?key\(([\s\S]*)\)/"; //everything between ",key(" and ")"
        $patternModal = "/,\s*?modal\(([\s\S]*)\)/"; //everything between ",modal(" and ")"
        $patternParams = "/,\s*?params\(([\s\S]*)\)/"; //everything between ",params(" and ")"
        $expression = preg_replace_callback($pattern, function ($match) use (&$cachedKey) {
            $cachedKey = trim($match[1]) ?: $cachedKey;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternModal, function ($match) use (&$cachedId) {
            $cachedId = trim($match[1]) ?: $cachedId;
            return "";
        }, $expression);
        $expression = preg_replace_callback($patternParams, function ($match) use (&$cachedParams) {
            $cachedParams = trim($match[1]) ?: $cachedParams;
            return "";
        }, $expression);
        return <<<EOT
<?php
    \$html = \Livewire\LifecycleManager::fromInitialRequest($expression, $cachedId)->boot() 
    ->initialHydrate()
    ->mount($cachedParams)
    ->renderToView()
    ->initialDehydrate()->toInitialResponse()->html();
    echo \$html;
?>
EOT;
    }
}
