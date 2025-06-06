<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
  public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse
  {
    $session = $request->getSession();
    $session->getFlashBag()->add('warning', 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.');
    return new RedirectResponse('/');
  }
}
