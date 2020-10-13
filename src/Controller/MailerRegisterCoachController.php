<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
        $params = json_decode($request->getContent(), true);
        $url = $params["url"];
        $emailCoach = $params["email"];

        //controle de l'adresse email envoyé
        if (isset($emailCoach) && !empty($emailCoach)){
            if (filter_var($emailCoach, FILTER_VALIDATE_EMAIL)){

                $email = (new Email())
                    ->from('SoccerTeamManager@dev.fr')
                    ->to("$emailCoach")
                    ->subject('Devenez notre nouveau coach !')
                    ->text("$url" . 'tokenDeFou')
                    ->html('<h1>'. "$url" . 'tokenDeFou' .'</h1>');

                $this->mailer->send($email);


                return $this->json([ "success" => true], 200);
            }else{
                return $this->json(["success" => false, "violations" => "L'adresse email n'est pas valide" ], 400);
            }
        }else{
            return $this->json(["success" => false, "violations" => "L'adresse email est obligatoire" ], 400);
        }

    }
}