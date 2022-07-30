<?php

namespace App\Controller;

use App\Entity\History;
use App\Service\WeatherApi;
use App\Service\Manager\HistoryManager;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly WeatherApi $weatherApi,
        private readonly HistoryManager $manager,
        ){
    }

    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/history', name: 'history')]
    public function history(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $limit = $request->query->get('limit') ?? 10; 

        return $this->render('default/history.html.twig', [
            'paginated' => $this->manager->listPaginated($page, $limit),
            'maxPage' => intval(count($this->manager->listPaginated($page, $limit))/$limit),
            'page' => $page,
            'limit' => $limit,
            'averageTemperature' => round($this->manager->averageTemperature(), 2),
            'maxTemperature' => $this->manager->maxTemperature(),
            'minTemperature' => $this->manager->minTemperature(),
            'searchQuantity' => count($this->manager->listPaginated($page, $limit)),
            'frequentlySearchedCity' => $this->manager->frequentlySearchedCity()['city'],
        ]);
    }

    #[Route('/getWeather', name: 'getWeather', methods: ['POST'])]
    public function getCoordinates(Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $latLng =  $parameters['latlng'];
        $latitude = $latLng['lat'];
        $longitude = $latLng['lng'];

        $response = $this->weatherApi->getWeather($latitude, $longitude);
        
        $this->manager->save((new History()), $response);

        return new Response($response, 200);
    }
}
