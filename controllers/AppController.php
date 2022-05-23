<?php

class AppController {

    public function render(string $template = 'index', array $variables = []) {
        $templatePath = 'public/views/'.$template.'.html';
        $output = "Page not found";

       if(file_exists($templatePath)) {

            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
       }

       print $output;
    }
}