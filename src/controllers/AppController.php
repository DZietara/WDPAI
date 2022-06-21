<?php

class AppController
{

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === "GET";
    }

    protected function isPost(): bool
    {
        return $this->request === "POST";
    }

    public function render(string $template = null, array $variables = [])
    {
        session_start();

        if ($_SESSION['loggedin'] && $_SESSION['role'] == 'admin' && $template == 'settings') {
            $templatePath = 'public/views/' . $template . '.php';
            $output = "Page not found";
            if (file_exists($templatePath)) {
                extract($variables);

                ob_start();
                include $templatePath;
                $output = ob_get_clean();
            }
            print $output;
        } else if ($_SESSION['loggedin'] && $_SESSION['role'] == 'user' && $template == 'settings') {
            echo "You are not authorized to view this page";
        } else if ($_SESSION['loggedin'] || $template == 'login' || $template == 'register') {
            $templatePath = 'public/views/' . $template . '.php';
            $output = "Page not found";
            if (file_exists($templatePath)) {
                extract($variables);

                ob_start();
                include $templatePath;
                $output = ob_get_clean();
            }
            print $output;
        } else {
            echo "You are not authorized to view this page";
        }
    }
}
