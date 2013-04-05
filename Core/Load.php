<?php

namespace Framework;

class Load {

    public function view($name, array $vars = null) {
        if (strpbrk($name, '/')) {
            $name = str_replace('/', DIRECTORY_SEPARATOR, $name);
        }
        if (strpbrk($name, '\\')) {
            $name = str_replace('\\', DIRECTORY_SEPARATOR, $name);
        }
        $file = 'Views' . DIRECTORY_SEPARATOR . $name . '.php';

        if (is_readable($file)) {

            if (isset($vars)) {
                extract($vars);
            }
            require($file);
            return true;
        }
        throw new Exception('View issues');
    }

    public function model($name) {
        $model = $name . '_Model';
        $modelPath = 'Models' . DIRECTORY_SEPARATOR . $model . '.php';

        if (is_readable($modelPath)) {
            require_once($modelPath);

            if (class_exists($model)) {
                $registry = Registry::getInstance();
                $registry->$name = new $model;
                return true;
            }
        }
        throw new Exception('Model issues.');
    }

}

