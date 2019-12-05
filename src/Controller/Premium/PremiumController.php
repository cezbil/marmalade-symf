<?php

namespace App\Controller\Premium;

use App\Entity\AbiCodeRating;
use App\Entity\AgeRating;
use App\Entity\BasePremium;
use App\Entity\PostcodeRating;
use App\Entity\Quote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

class PremiumController extends Controller
{
    public function getPremium(Request $request)
    {
        $basePremium = $this->getBasePremium();
        $client = HttpClient::create();
        if ($request->headers->get('Content-Type') === 'application/json') {
            $data = $this->getData($request->getContent());
            $response = $client->request('GET', 'https://marm-symfony-api.firebaseio.com/' . $data['regNo'] . '.json');
            $abiCode = $response->getContent();
            $ageRating = $this->getAgeRating($data['age']);
            $postcodeRating = $this->getPostcodeRating($data['postcode']);
            $abiCodeRating = $abiCode !== 'null' ? $this->getAbiRating($abiCode) : 1;
            $premium = $this->calculatePremium($basePremium, $ageRating, $postcodeRating, $abiCodeRating);
            $quote = $this->createQuote($premium, $data['age'], $data['full_postcode'], $abiCode, $data['regNo']);
        }
        $responseData = [
            'quote_id' => $quote->getId(),
            'policy_number' => $quote->getPolicyNumber(),
            'premium' => $quote->getPremium()
        ];

        return new JsonResponse($responseData);
    }

    private function getData($content)
    {
        $data = json_decode($content, true);
        $data['age'] = isset($data['age']) && $data['age'] !== '' ? $data['age'] : '';
        $data['full_postcode'] = isset($data['postcode']) && $data['postcode'] !== '' ? $this->trimInputs(
            $data['postcode']
        ) : '';
        $data['postcode'] = isset($data['postcode']) && $data['postcode'] !== '' ? $this->getFirstPart(
            strtoupper($data['postcode'])
        ) : '';
        $data['regNo'] = isset($data['regNo']) && $data['regNo'] !== '' ? strtoupper(
            $this->trimInputs($data['regNo'])
        ) : '';

        return $data;
    }

    private function getBasePremium()
    {
        $basePremiumArr = $this->getDoctrine()->getRepository(BasePremium::class)->findAll();
        $basePremiumObj = $basePremiumArr[0];
        return $basePremiumObj->getBasePremium();
    }

    private function getAgeRating($age)
    {
        $ageObj = $this->getDoctrine()->getRepository(AgeRating::class)->find($age);
        return $ageObj !== null ? $ageObj->getRatingFactor() : 1;
    }

    private function getPostcodeRating($postcode)
    {
        $postcodeObj = $this->getDoctrine()->getRepository(PostcodeRating::class)->find($postcode);
        return $postcodeObj !== null ? $postcodeObj->getRatingFactor() : 1;
    }

    private function getAbiRating($abiCode)
    {
        $abiCodeObj = $this->getDoctrine()->getRepository(AbiCodeRating::class)->find($abiCode);
        return $abiCodeObj->getRatingFactor();
    }

    private function trimInputs($input)
    {
        return preg_replace('/\s+/', '', $input);
    }

    function getFirstPart($postcode)
    {
        if (preg_match('/^[A-Z]([A-Z]?\d(\d|[A-Z])?|\d[A-Z]?)\s*?\d[A-Z][A-Z]$/i', $postcode)) {
            return preg_replace('/^([A-Z]([A-Z]?\d(\d|[A-Z])?|\d[A-Z]?))\s*?(\d[A-Z][A-Z])$/i', '$1', $postcode);
        }
    }

    private function calculatePremium($basePremium, $ageRating, $postcodeRating, $abiRating)
    {
        return $basePremium * $ageRating * $postcodeRating * $abiRating;
    }

    private function createQuote($premium, $age, $postcode, $abiCode, $regNum)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $quote = new Quote();
        $quote->setPolicyNumber(rand(0, 999999999999999999));
        $quote->setAbiCode($abiCode);
        $quote->setRegNo($regNum);
        $quote->setAge($age);
        $quote->setPostcode($postcode);
        $quote->setPremium($premium);
        $entityManager->persist($quote);
        $entityManager->flush();

        return $quote;
    }

}
