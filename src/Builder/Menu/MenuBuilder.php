<?php

namespace DevHau\Modules\Builder\Menu;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class MenuBuilder
{
    private $isSub = false;
    private $data = array();
    private $callbackAdd = array();
    private $callbackAttach = array();
    private $isCheckActive = true;
    public function setCheckActive($flg): self
    {
        $this->isCheckActive = $flg;
        return $this;
    }
    private function __construct($isSub = true)
    {
        $this->isSub = $isSub;
        $this->data['id'] = "menu-" . time();
    }
    public function setId($id): self
    {
        return $this->setValue('id', $id);
    }
    public function setClass($class): self
    {
        return $this->setValue('class', $class);
    }
    public function setName($name): self
    {
        return $this->setValue('name', $name);
    }
    public function setIcon($icon): self
    {
        return $this->setValue('icon', $icon);
    }
    public function setLink($link): self
    {
        return $this->setValue('link', $link);
    }
    public function setRouter($router, $params): self
    {
        $this->setPermission($router);
        return $this->setValue('router',  [
            'name' => $router,
            'params' => $params,
        ]);
    }
    public function setModal($modal): self
    {
        return $this->setValue('modal', $modal);
    }

    public function setPermission($permission): self
    {
        return $this->setValue('permission', $permission);
    }
    public function setSort($sort): self
    {
        return $this->setValue('sort', $sort);
    }
    public function getSort()
    {
        return $this->getValue('sort', 0);
    }
    public function AddItem($callback): self
    {
        $this->callbackAdd[] = $callback;
        return $this;
    }

    public function AttachMenu($name, $callback)
    {
        $this->callbackAttach[] = [
            'name' => $name,
            'callback' => $callback
        ];
    }
    public function checkPermission()
    {
        $permission = $this->getValue('permission');
        return $permission == '' || Gate::check($permission, [auth()]);
    }
    private $items;
    public function startBuilder()
    {
        foreach ($this->callbackAdd as $callback) {
            $item = new MenuBuilder();
            if ($callback != null) $callback($item);
            if ($item->checkPermission()) {
                $item->isCheckActive = $this->isCheckActive;
                $item->startBuilder();
                $this->items[] = $item;
            }
        }
        if ($this->items) {
            usort($this->items, function ($a, $b) {
                return strcmp($a->getSort(), $b->getSort());
            });
        }

        foreach ($this->callbackAttach as $item) {
            $name = $item['name'];
            foreach ($this->items as $_item) {
                if ($_item->data['name'] == $name) {
                    $item['callback']($_item);
                    break;
                }
            }
        }
    }
    public function checkChild()
    {
        return isset($this->items) && count($this->items) > 0;
    }
    public function setValue($key, $value = '')
    {
        $this->data[$key] = $value;
        return $this;
    }
    public function getValue($key, $default = '')
    {
        if (isset($this->data[$key]) && $this->data[$key] != "") {
            return $this->data[$key];
        }
        return $default;
    }
    public function getLinkHref()
    {
        if ($this->checkValue('link')) {
            return $this->data['link'];
        }
        if ($this->checkValue('router')) {
            return  route($this->data['router']['name'], $this->data['router']['params']);
        }
        return '';
    }
    public function checkActive()
    {
        if ($this->isCheckActive == false) return false;
        if ($this->getLinkHref() == Request::url())
            return true;
        if ($this->checkChild()) {
            foreach ($this->items as $item) {
                if ($item->checkActive())
                    return true;
            }
        }
        return false;
    }
    public function checkValue($key)
    {
        return isset($this->data[$key]) && $this->data[$key] != "";
    }
    public function RenderToHtml($position = '')
    {
        if (!$this->isSub) {
            $this->startBuilder();
            ob_start();
        }
        echo  "<ul " . $this->getValue('attr', '') . " class='menu " . $this->getValue('class', '') . " " . ($this->isSub ? 'menu-sub' : ($position != '' ? ('menu-' . $position) : '')) . " " . $this->data['id'] . "' id='" . $this->data['id'] . "'>";
        if ($this->items) {
            foreach ($this->items as $item) {
                $attrLink = "";
                if ($item->checkValue('modal')) {
                    $attrLink = "wire:openmodal='" . $item->data['modal'] . "'";
                } else {
                    $link = $item->getLinkHref();
                    if ($link) {
                        $attrLink = 'href="' . $link . '"';
                    }
                }
                if ($attrLink == "" && $item->checkChild() == false) continue;
                echo "<li class='menu-item " . ($item->checkActive() ? 'active' : '') . "'>";
                echo "<a $attrLink title='" . $item->getValue('name', '') . "'>";
                if ($item->checkValue('icon'))
                    echo " <i class='" . $item->data["icon"] . "'></i> ";
                echo " <span>" . $item->getValue('name', '') . "</span> ";

                echo "</a>";
                if ($item->checkChild()) {
                    $item->RenderToHtml();
                }
                echo "</li>";
            }
        }
        echo  "</ul>";
        if (!$this->isSub) {
            return ob_get_clean();
        }
    }
    private static $menuPosition = array();
//top sidebar
    public static function Menu($position = 'top'): self
    {
        return self::$menuPosition[$position] ?? (self::$menuPosition[$position] = new self(false));
    }
    public static function Render($position, $id = '', $class = '', $attr = '', $active = true)
    {
        return self::Menu($position)->setId($id)->setClass($class)->setValue('attr', $attr)->setCheckActive($active)->RenderToHtml($position);
    }
}
