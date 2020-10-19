<?php


namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Coach;
use App\Entity\Player;
use App\Entity\Team;
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
     * CurrentClubExtension constructor.
     * @param Security $security
     * @param AuthorizationCheckerInterface $checker
     */
    public function __construct(Security $security, AuthorizationCheckerInterface $checker)
    {
        $this->security = $security;
        $this->auth = $checker;
    }


    private function addWhere(QueryBuilder $queryBuilder, $resourceClass)
    {


        //3. Si on demande des coachs ou des players alors, agir sur la requête pour qu'elle tienne compte du club de l'admin connecté
        if ($resourceClass === Coach::class || $resourceClass === Player::class) {
            // 1. Obtenir l'utilisateur connecté
            $user = $this->security->getUser();
            //2. obtenir le club de l'user connecté
            $club = $user->getClub();

            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            //la modification de la requête  sera pas la même si on veut des coachs ou des players !
            $queryBuilder->join("$rootAlias.user", "u")
                ->andWhere("u.club = :club");

            $queryBuilder->setParameter("club", $club);
        }else if ($resourceClass === Team::class && $this->auth->isGranted("ROLE_ADMIN")){
            $user = $this->security->getUser();
            //2. obtenir le club de l'user connecté
            $club = $user->getClub();

            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            $queryBuilder->andWhere("$rootAlias.club = :club");

            $queryBuilder->setParameter("club", $club);
        }else if ($resourceClass === Team::class && $this->auth->isGranted("ROLE_COACH")){
            $user = $this->security->getUser();
            //2. obtenir le club de l'user connecté
            $club = $user->getClub();

            $rootAlias = $queryBuilder->getRootAliases()[0];
            // SELECT o from \App\Entity\Coach AS o     (on connait l'alias 'o' grâce à $rooAlias !)
            // WHERE o. .......

            $queryBuilder->join("$rootAlias.coach", "c")
                        ->andWhere("c.user = :user");

            $queryBuilder->setParameter("user", $user);
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
