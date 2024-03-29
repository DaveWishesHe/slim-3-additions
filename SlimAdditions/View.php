<?php
//TODO: Reimplement for Slim 3...?
namespace SlimAdditions;

class View extends \Slim\View
{
    private $themes;
    private $inherited_data;

    public function __construct($themes = null)
    {
        parent::__construct();
        if ($themes == null) {
            $themes = array('.');
        }
        $this->themes = $themes;
        $this->layout = "default";
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    protected function render($template, $data = array())
    {
        if ($data == null) {
            $data = array();
        }
        $this->inherited_data = $data;
        $content = parent::render($template, $data);
        $data['content'] = $content;
        return parent::render('layouts/' . $this->layout, $data);
    }

    protected function h($text)
    {
        return htmlspecialchars($text);
    }

    protected function urlFor($url, $params)
    {
        return \Slim\Slim::getInstance()->urlFor($url, $params);
    }

    protected function renderElement($name, $params = array())
    {
        $previous_data = $this->inherited_data;
        $this->inherited_data = array_merge($this->inherited_data, $params);
        print parent::render($this->getElementName($name), $this->inherited_data);
        $this->inherited_data = $previous_data;
        return;
    }

    /**
     * Override the slim implementation of getTemplatePathname($file);
     * to provide a theme specific path if a file in the theme directory exists.
    */
    public function getTemplatePathname($file)
    {
        foreach ($this->themes as $dir) {
            $templateDirectory = $this->getTemplateDirectory($dir, $file . '.php');
            if (is_file($templateDirectory)) {
                return $templateDirectory;
            }
        }
        return $templateDirectory;
    }

    /**
     * Retrive the file name of an element.
     *@param $element_name  Name of the element you want to retrieve.
    */
    protected function getElementName($element_name)
    {
        $template_names = explode('/', $element_name, 2);
        return "{$template_names[0]}/elements/{$template_names[1]}";
    }

    /**
     * Retrive the file path to a template's directory by supplying the theme name and template file name.
     *@param $theme     Name of the theme.
     *@param $file      File path of the file from its theme's root directory.
    */
    protected function getTemplateDirectory($theme, $file)
    {
        return $this->templatesDirectory .
            DIRECTORY_SEPARATOR . $theme .
            DIRECTORY_SEPARATOR . ltrim($file, DIRECTORY_SEPARATOR);
    }
}
