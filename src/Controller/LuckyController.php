<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    public function showJson(): Response
    {
        return $this->json([
            'username' => 'JoseR',
            'age' => '79 😁',
            'email' => 'jose@gmail.es',
        ]);
    }
}
