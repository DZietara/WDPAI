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

        if ($_SESSION['loggedin'] || $template == 'login' || $template == 'register') {
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
            echo "Log in to view this page";
        }
    }
}
