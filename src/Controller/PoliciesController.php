<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/policies', name: 'app_policies_')]
final class PoliciesController extends AbstractController
{
    #[Route('/terms_of_service', name: 'terms_of_service')]
    public function termsOfService(): Response
    {
        return $this->render('policies/terms_of_service.html.twig');
    }

    #[Route('/event_terms', name: 'event_terms')]
    public function eventTerms(): Response
    {
        return $this->render('policies/event_terms.html.twig');
    }

    #[Route('/privacy_policy', name: 'privacy_policy')]
    public function privacyPolicy(): Response
    {
        return $this->render('policies/privacy_policy.html.twig');
    }

    #[Route('/safety_procedure', name: 'safety_procedure')]
    public function safetyProcedure(): Response
    {
        return $this->render('policies/safety_procedure.html.twig');
    }

    #[Route('/cookies', name: 'cookies')]
    public function cookies(): Response
    {
        return $this->render('policies/cookies.html.twig');
    }
}
