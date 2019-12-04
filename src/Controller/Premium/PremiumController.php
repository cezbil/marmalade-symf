<?php

namespace App\Controller\Premium;

use App\Entity\AbiCodeRating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;
use GuzzleHttp\Client;

class PremiumController extends Controller
{
    public function getPremium(Request $request)
    {
        $client = HttpClient::create();
        if ($request->headers->get('Content-Type') === 'application/json') {
            $data = $this->getData($request->getContent());
            $response = $client->request('GET', 'https://marm-symfony-api.firebaseio.com/' . $data['regNo'] . '.json');
            var_dump($response->getContent());
            die();
            $decodedPayload = $response->toArray();
            print_r($decodedPayload);
        }

        return new JsonResponse($data);
    }

    private function getData($content)
    {
        $data = json_decode($content, true);
        $data['age'] = isset($data['age']) && $data['age'] !== '' ? $data['age'] : '';
        $data['postcode'] = isset($data['postcode']) && $data['postcode'] !== '' ? $data['postcode'] : '';
        $data['regNo'] = isset($data['regNo']) && $data['regNo'] !== '' ? $data['regNo'] : '';

        return $data;
    }
}