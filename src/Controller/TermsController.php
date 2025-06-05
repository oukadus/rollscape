<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TermsController extends AbstractController
{
    #[Route('/terms-of-use', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('terms/terms.html.twig');
    }

    #[Route('/legal-notice', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('terms/legal.html.twig');
    }
}
