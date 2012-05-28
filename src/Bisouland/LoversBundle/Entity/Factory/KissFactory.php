<?php

namespace Bisouland\LoversBundle\Entity\Factory;

use Doctrine\Common\Persistence\ManagerRegistry;

use Bisouland\RolePlayingGameSystemBundle\Entity\Factory\AttackFactory;
use Bisouland\LoversBundle\Entity\Lover;
use Bisouland\LoversBundle\Entity\Kiss;

use Bisouland\LoversBundle\Exception\InvalidKisserException;
use Bisouland\LoversBundle\Exception\InvalidKissedException;
use Bisouland\LoversBundle\Exception\InvalidKisserAsKissedException;
use Bisouland\LoversBundle\Exception\KissOverflowException;

class KissFactory
{
    public static $quotaOfKiss = 3;
    public static $quotaOfSeconds = 43200;

    private $doctrine;
    private $attackFacotry;

    private $kisser;
    private $kissed;

    public function __construct(ManagerRegistry $doctrine, AttackFactory $attackFactory)
    {
        $this->doctrine = $doctrine;
        $this->attackFacotry = $attackFactory;
    }

    public function make($kisserName, $kissedName)
    {
        $this->kisser = $this->doctrine->getRepository('BisoulandLoversBundle:Lover')
                ->findOneByName($kisserName);
        $this->kissed = $this->doctrine->getRepository('BisoulandLoversBundle:Lover')
                ->findOneByName($kissedName);

        $this->checkLovers();
        $this->checkTime();

        $kiss = $this->makeKiss();

        $this->updateLifePoints($this->kisser, $kiss->getAttackerEarning());
        $this->updateLifePoints($this->kissed, -$kiss->getDefenderLoss());

        $this->saveKiss($kiss);

        return $kiss;
    }

    private function checkLovers()
    {
        if (null === $this->kisser) {
            throw new InvalidKisserException();
        }
        if (null === $this->kissed) {
            throw new InvalidKissedException();
        }
        if ($this->kisser->getName() === $this->kissed->getName()) {
            throw new InvalidKisserAsKissedException();
        }
    }

    private function checkTime()
    {
        $numberOfKiss = $this->doctrine->getRepository('BisoulandLoversBundle:Kiss')
                ->countForLastGivenSeconds(
                        $this->kisser->getId(),
                        $this->kissed->getId(),
                        self::$quotaOfSeconds
                );

        if (self::$quotaOfKiss <= $numberOfKiss) {
            throw new KissOverflowException();
        }
    }

    private function makeKiss()
    {
        $numberOfSecondsInOneHour = 60 * 60;
        $attack = $this->attackFacotry->make($this->kisser, $this->kissed);
        $kiss = new Kiss();

        $kiss->setAttackerEarning($attack->getAttackerEarning() * $numberOfSecondsInOneHour);
        $kiss->setDefenderLoss($attack->getDefenderLoss() * $numberOfSecondsInOneHour);
        $kiss->setIsCritical($attack->getIsCritical());
        $kiss->setHasHit($attack->getHasHit());
        $kiss->setAttacker($this->kisser);
        $kiss->setDefender($this->kissed);

        return $kiss;
    }

    private function updateLifePoints(Lover $lover, $pointsToAdd)
    {
        $lifePoints = $lover->getLifePoints() + $pointsToAdd;
        $lover->setLifePoints($lifePoints);

        $entityManager = $this->doctrine->getEntityManager();
        $entityManager->persist($lover);
        $entityManager->flush();
    }

    private function saveKiss(Kiss $kiss)
    {
        $entityManager = $this->doctrine->getEntityManager();
        $entityManager->persist($kiss);
        $entityManager->flush();
    }
}
