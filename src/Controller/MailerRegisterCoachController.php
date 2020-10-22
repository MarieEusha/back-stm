<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\ClubRepository;
use App\Repository\UserRepository;
use App\Services\MakeMailer;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailerRegisterCoachController extends AbstractController
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTTokenManager;
    /**
     * @var ClubRepository
     */
    private $clubRepository;


    public function __construct(MailerInterface $mailer, UserRepository $userRepository, ClubRepository $clubRepository,JWTTokenManagerInterface $JWTTokenManager){
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
        $this->JWTTokenManager = $JWTTokenManager;
        $this->clubRepository = $clubRepository;
    }

    /**
     * @Route("api/emailCoach", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws TransportExceptionInterface
     */
    public function sendEmailCoach(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        $url = $params["url"];
        $clubId = $params["club"];
        $emailCoach = $params["email"];

        //contrôle de l'adresse email envoyé
        //le champ email a t il été rempli?
        if (isset($emailCoach) && !empty($emailCoach)){
            //est-ce un adresse mail valide?
            if (filter_var($emailCoach, FILTER_VALIDATE_EMAIL)){
                //verification dans la BDD si l'adresse mail n'existe pas déjà
                //1.requête sql
                $user = $this->userRepository->findOneBy(['email' => $emailCoach]);
                if(!$user){
                    //ok maintenant on peut traiter la demande !
                    //1. création d'un token !
                    $club = $this->clubRepository->find($clubId);
                    $user = new User();
                    $user->setEmail($emailCoach)->setClub($club)->setRoles(["ROLE_COACH"])->setLastName('')->setFirstName('')->setBirthday('')->setPhone('')->setPassword('coach00');
                    $token = $this->JWTTokenManager->create($user);

                    MakeMailer::sendMail('soccerteammanager@laposte.net',
                        $emailCoach,
                        'Invitation SoccerTeamManager',
                        'email/register.html.twig',
                        ['user' => $user, 'token' => $token, 'club' => $club, 'url' => $url],
                        $this->mailer
                    );

                    return $this->json([ "success" => true], 200);
                }else{
                    return $this->json(["success" => false, "violations" => "Un utilisateur existe déjà pour cette adresse email" ], 400);
                }
            }else{
                return $this->json(["success" => false, "violations" => "L'adresse email n'est pas valide" ], 400);
            }
        }else{
            return $this->json(["success" => false, "violations" => "L'adresse email est obligatoire" ], 400);
        }

    }
}