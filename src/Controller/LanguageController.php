<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    #[Route('/change-language/{locale}', name: 'change_language')]
    public function changeLanguage(string $locale, Request $request, SessionInterface $session): RedirectResponse
    {
        $referer = $request->headers->get('referer', '/');

        $response = new RedirectResponse($referer);

        if ($this->getUser()) {
            if (!$session->isStarted()) {
                $session->start();
            }
            $session->set('_locale', $locale);
        } else {
            $response->headers->setCookie(new Cookie('_locale', $locale, strtotime('+1 year')));
        }

        return $response;
    }
}
