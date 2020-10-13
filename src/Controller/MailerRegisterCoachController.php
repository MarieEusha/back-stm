<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailerRegisterCoachController extends AbstractController
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer){

        $this->mailer = $mailer;
    }

    /**
     * @Route("api/emailCoach", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function sendEmailCoach(Request $request)
    {
        $params = $request->getContent();
        $params = json_decode($params);


        return $this->json([$params], 200);
    }
}