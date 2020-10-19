<?php


namespace App\Controller;


use App\Services\MakeMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MailerController extends AbstractController
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Security
     */
    private $security;

    public function __construct(MailerInterface $mailer, Security $security)
    {
        $this->mailer = $mailer;
        $this->security = $security;
    }

    /**
     * @param Request $request
     * @Route("api/sendEmail", methods={"POST"})
     * @return JsonResponse
     * @throws TransportExceptionInterface
     */
    public function sendMail(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        $receivers = $params['email']["receivers"];
        $message = $params['email']["message"];
        $subject = $params['email']["subject"];
        if(isset($receivers) && !empty($receivers)){
            if(isset($subject) && !empty($subject)){
                if(isset($message) && !empty($message)){
                    ///$receivers = string, chaque adresse email séparé par ';'  ---> on el transforme en array
                    $receivers = explode(';', $receivers);
                    $user = $this->security->getUser();
                    MakeMailer::sendMultiMails('SoccerTeamManager@example.fr',
                        $receivers,
                        $subject,
                        'email/classicMail.html.twig',
                        ['user' => $user, 'message' => $message],
                        $this->mailer
                    );
                    return $this->json([ "success" => true], 200);
                }else{
                    return $this->json(["success" => false, "violations" => "Veuillez saisir un message" ], 400);
                }
            }else{
                return $this->json(["success" => false, "violations" => "Veuillez préciser le sujet de votre email" ], 400);
            }
        }else{
            return $this->json(["success" => false, "violations" => "Veuillez sélectionner au moins un destinataire" ], 400);
        }






    }
}