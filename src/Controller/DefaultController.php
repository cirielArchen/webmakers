<?php

namespace App\Controller;

use App\Entity\History;
use App\Service\WeatherApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly WeatherApi $weatherApi,
        ){
    }

    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/history', name: 'history')]
    public function history(): Response
    {
        return $this->render('default/history.html.twig');
    }

    #[Route('/getWeather', name: 'getWeather', methods: ['POST'])]
    public function getCoordinates(Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $latLng =  $parameters['latlng'];
        $latitude = $latLng['lat'];
        $longitude = $latLng['lng'];

        $response = $this->weatherApi->getWeather($latitude, $longitude);

        $entity = new History();

        return new Response($response, 200);
    }
}
