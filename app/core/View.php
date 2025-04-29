<?php

class View
{
    public function render($view, $params = [], $isAdmin = false)
    {
        $viewContent = $this->renderView($view, $params);
        return $this->renderLayout($viewContent, $isAdmin);
    }

    public function renderOnlyView($view, $params = [])
    {
        return $this->renderView($view, $params);
    }

    protected function renderView($view, $params = [])
    {
        $viewPath = App::$ROOT_DIRECTORY . "/app/views/" . THEME . "/{$view}.php";

        if (!file_exists($viewPath)) {
            throw new Exception("View {$view} not found at path: {$viewPath}");
        }

        extract($params);
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }

    protected function renderLayout($content, $isAdmin)
    {
        $layout = $isAdmin ? 'adminLayout' : 'layout';
        $layoutPath = App::$ROOT_DIRECTORY . "/app/views/" . THEME . "/@layout/{$layout}.php";

        if (!file_exists($layoutPath)) {
            throw new Exception("Layout not found at path: {$layoutPath}");
        }

        ob_start();
        include $layoutPath;
        $layout = ob_get_clean();

        return str_replace('{{content}}', $content, $layout);
    }

    public function renderAdmin($view, $params = [])
    {
        return $this->render($view, $params, true);
    }
}
