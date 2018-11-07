<?php

namespace Badtrends\Containers;

use Plenty\Plugin\Templates\Twig;

class BadtrendsNewsletterInputContainer
{
    public function call(Twig $twig)
    {
        return $twig->render('Badtrends::Containers.Newsletter.ContainerNewsletterInput');
    }
}