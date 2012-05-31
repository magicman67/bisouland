<?php

namespace Bisouland\RolePlayingGameSystemBundle\Tests\Entity\Factory;

use Bisouland\RolePlayingGameSystemBundle\Tests\Entity\Factory\SimpleBeingFactory;
use Bisouland\RolePlayingGameSystemBundle\Entity\Factory\RollFactory;
use Bisouland\RolePlayingGameSystemBundle\Entity\Factory\AttackFactory;

class AttackFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $beingFactory;

    public function __construct()
    {
        $this->beingFactory = new SimpleBeingFactory();
    }

    private function getAttackFactoryWithRollsReturningGivenResult($result)
    {
        $rollFactory = $this->getMock('Bisouland\RolePlayingGameSystemBundle\Entity\Factory\RollFactory');
 
        $rollFactory->expects($this->any())
             ->method('make')
             ->will($this->returnValue($result));

        $attackFactory = new AttackFactory($rollFactory);

        return $attackFactory;
    }

    public function testHasHit()
    {
        $attacker = $this->beingFactory->make();
        $defender = $this->beingFactory->make();

        for ($attribute = 3; $attribute < 18; $attribute += 2) {
            $defender->setDefense($attribute);
            $attacker->setAttack($attribute + 2);

            $attackFactory = $this->getAttackFactoryWithRollsReturningGivenResult(10);
            $attack = $attackFactory->make($attacker, $defender);

            $this->assertTrue($attack->getHasHit());
        }
    }

    public function testHasNotHit()
    {
        $attacker = $this->beingFactory->make();
        $defender = $this->beingFactory->make();

        for ($attribute = 3; $attribute < 18; $attribute += 2) {
            $attacker->setAttack($attribute);
            $defender->setDefense($attribute + 2);

            $attackFactory = $this->getAttackFactoryWithRollsReturningGivenResult(10);
            $attack = $attackFactory->make($attacker, $defender);

            $this->assertFalse($attack->getHasHit());
        }
    }

    public function testIsNotCritical()
    {
        $attacker = $this->beingFactory->make();
        $defender = $this->beingFactory->make();

        for ($diceResult = 2; $diceResult < 20; $diceResult++) {
            $attackFactory = $this->getAttackFactoryWithRollsReturningGivenResult($diceResult);
            $attack = $attackFactory->make($attacker, $defender);

            $this->assertFalse($attack->getIsCritical());
        }
    }

    public function testIsCriticalHit()
    {
        $attacker = $this->beingFactory->make();
        $defender = $this->beingFactory->make();

            $attackFactory = $this->getAttackFactoryWithRollsReturningGivenResult(20);
            $attack = $attackFactory->make($attacker, $defender);

            $this->assertTrue($attack->getIsCritical());
            $this->assertTrue($attack->getHasHit());
    }

    public function testIsCriticalFail()
    {
        $attacker = $this->beingFactory->make();
        $defender = $this->beingFactory->make();

            $attackFactory = $this->getAttackFactoryWithRollsReturningGivenResult(1);
            $attack = $attackFactory->make($attacker, $defender);

            $this->assertTrue($attack->getIsCritical());
            $this->assertFalse($attack->getHasHit());
    }
}
