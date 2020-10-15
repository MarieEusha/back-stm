<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\ClubRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerRegisterPlayerController extends AbstractController
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
     * @Route("api/emailPlayer", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function sendEmailPlayer(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        $url = $params["url"];
        $clubId = $params["club"];
        $emailPlayer = $params["email"];

        //controle de l'adresse email envoyé
        //le champ email a t il été rempli?
        if (isset($emailPlayer) && !empty($emailPlayer)){
            //est-ce un adresse mail valide?
            if (filter_var($emailPlayer, FILTER_VALIDATE_EMAIL)){
                //verification dans la BDD si l'adresse mail n'existe pas déjà
                //1.requête sql
                $user = $this->userRepository->findOneBy(['email' => $emailPlayer]);
                if(!$user){
                    //ok maintenant on peut traiter la demande !
                    //1. création d'un token !
                    $club = $this->clubRepository->find($clubId);
                    $user = new User();
                    $user->setEmail($emailPlayer)->setClub($club)->setRoles(["ROLE_PLAYER"])->setLastName('')->setFirstName('')->setBirthday('')->setPhone('')->setPassword('coach00');
                    $token = $this->JWTTokenManager->create($user);

                    $email = (new Email())
                        ->from('SoccerTeamManager@dev.fr')
                        ->to("$emailPlayer")
                        ->subject('Devenez notre nouveau joueur !')
                        ->text("$url" . 'tokenDeFou')
                        ->html('<a href="'. "$url" . "$token" . '">'. 'S inscrire' .'</a>');

                    $this->mailer->send($email);

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