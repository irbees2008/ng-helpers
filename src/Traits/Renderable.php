<?php

namespace Plugins\Traits;

// Используем функции из пространства `Plugins`.
use function Plugins\view;

trait Renderable
{
    /**
     * Расположение шаблонов плагина.
     *  - `0` - шаблон сайта;
     *  - `1` - директория плагина.
     * @var int
     */
    protected $localsource;

    /**
     * Список файлов шаблонов с полными путями, исключая имя шаблона.
     * @var array
     */
    protected $templatePath = [];

    /**
     * Определить все пути к файлам шаблонов.
     * @return array
     */
    protected function findTemplates(string $localsource, string $skin = null)
    {
        if (is_null($skin)) {
            return locatePluginTemplates($this->templates, $this->plugin, $localsource);
        }

        return locatePluginTemplates($this->templates, $this->plugin, $localsource, $skin);
    }

    /**
     * Получить путь к файлу шаблона.
     * @param  string  $tpl
     * @return string
     */
    protected function templatePath(string $tpl)
    {
        if (empty($path = $this->templatePath[$tpl])) {
            throw new RuntimeException("Template [{$tpl}] is not define.");
        }

        return $path;
    }

    /**
     * Получить полный путь к файлу шаблона, включая имя шаблона.
     * @param  string  $filename
     * @return string
     */
    protected function template(string $filename)
    {
        $path = $this->templatePath($filename);
        $file = $filename.'.tpl';

        return $path.$file;
    }

    /**
     * Получить полный путь к файлу шаблона, включая имя шаблона.
     * @param  string  $filename
     * @return string
     */
    protected function asset(string $filename)
    {
        $path = $this->templatePath('url:'.$filename);
        $file = '/'.substr($filename, 1);

        return $path.$file;
    }
}
