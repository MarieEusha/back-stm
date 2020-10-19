<?php


namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Admin;
use App\Entity\Coach;
use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class CurrentClubExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     * @var Security
     */
    private $security;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $auth;
    /**
     * @var PlayerRepository
     */
    private $playerRepository;


    /**
     * CurrentClubExtension constructor.
     * @param Security $security
     * @param AuthorizationCheckerInterface $checker
     * @param PlayerRepository $playerRepository
     */
    public function __construct(Security $security, AuthorizationCheckerInterface $checker, PlayerRepository $playerRepository)
    {
        $this->security = $security;
        $this->auth = $checker;
        $this->playerRepository = $playerRepository;
    }


    private function addWhere(QueryBuilder $queryBuilder, $resourceClass)
    {
        // 1. Obtenir l'utilisateur connecté
        $user = $this->security->getUser();
        //2. obtenir le club de l'user connecté
        $club = $user->getClub();

        //3. Si on demande des coachs ou des players alors, agir sur la requête pour qu'elle tienne compte du club de l'admin connecté
        if (($resourceClass === Coach::class || $resourceClass === Player::class) && ($this->auth->isGranted("ROLE_ADMIN") || $this->auth->isGranted("ROLE_COACH"))) {


            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            //la modification de la requête  sera pas la même si on veut des coachs ou des players !
            $queryBuilder->join("$rootAlias.user", "u")
                ->andWhere("u.club = :club");

            $queryBuilder->setParameter("club", $club);
        }else if (($resourceClass === Coach::class) && ($this->auth->isGranted("ROLE_PLAYER"))){

            //On sait que c'est un joueur, faut récupérer l'id de sa team...
            $player = $this->playerRepository->findBy(['user' => $user->getId()]);
            $player = $player[0];
            $team = $player->getTeam();

            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......
            $queryBuilder->join("$rootAlias.user", "u")
                        ->innerJoin(Team::class, 't', Join::WITH, "t.coach = $rootAlias.id")
                         ->andWhere("u.club = :club")
                        ->andWhere("t.id = :team");

            $queryBuilder->setParameter("club", $club);
            $queryBuilder->setParameter("team", $team);
        }else if ($resourceClass === Team::class && $this->auth->isGranted("ROLE_ADMIN")){


            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            $queryBuilder->andWhere("$rootAlias.club = :club");

            $queryBuilder->setParameter("club", $club);
        }else if ($resourceClass === Team::class && $this->auth->isGranted("ROLE_COACH")){


            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            $queryBuilder->join("$rootAlias.coach", "c")
                        ->andWhere("c.user = :user");

            $queryBuilder->setParameter("user", $user);
        }else if ($resourceClass === Admin::class){


            $rootAlias = $queryBuilder->getRootAliases()[0];

            $queryBuilder->join("$rootAlias.user", "u")
                        ->andWhere("u.club = :club");

            $queryBuilder->setParameter("club", $club);


        }
    }
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }
}
