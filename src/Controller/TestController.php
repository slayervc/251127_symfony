<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Notifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test123', methods: ['GET'])]
    public function test(Request $request, Notifier $notifier): Response
    {
        $text = implode('<BR>', $request->query->all());
        $notifier->notify();

        return new Response($text);
    }

}
