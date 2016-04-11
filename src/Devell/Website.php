<?php

namespace Devell;

class Website
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var \Parsedown
     */
    private $parsedown;

    /**
     * @var string
     */
    private $textFilesFolder;

    public function __construct(\Twig_Environment $twig, \Parsedown $parsedown, $textFilesFolder = './')
    {
        $this->twig = $twig;
        $this->parsedown = $parsedown;
        $this->textFilesFolder = $textFilesFolder;
    }

    private function renderTemplate($name, $data = [])
    {
        return $this->twig->render($name.'.html.twig', $data);
    }

    public function render($pageName)
    {
        $data = [];

        if (file_exists($textFile = $this->textFilesFolder.$pageName.'.md')) {
            $data['text'] = $this->parsedown->parse(file_get_contents($textFile));
            echo 'jest';
        }
echo $textFile;

        return $this->renderTemplate(
            'layout',
            [
                'content' => $this->renderTemplate(
                    $pageName,
                    $data
                )
            ]
        );
    }
}