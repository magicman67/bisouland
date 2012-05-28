<?php

namespace Bisouland\RolePlayingGameSystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

use Bisouland\RolePlayingGameSystemBundle\Entity\Attack;

/**
 * @ORM\MappedSuperclass
 */
class Being
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", unique=true, type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="life_points", type="integer")
     */
    protected $life_points;

    /**
     * @ORM\Column(name="attack", type="integer")
     */
    protected $attack;

    /**
     * @ORM\Column(name="defense", type="integer")
     */
    protected $defense;

    /**
     * @ORM\Column(name="constitution", type="integer")
     */
    protected $constitution;

    protected $attacksDone;
    protected $defensesDone;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;

    public static function getBonusFromGivenAttribute($attributePoints)
    {
        return intval(($attributePoints - 10) / 2);
    }

    public function __construct()
    {
        $this->attacksDone = new ArrayCollection();
        $this->defensesDone = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLifePoints($life_points)
    {
        $this->life_points = $life_points;
        return $this;
    }

    public function getLifePoints()
    {
        return $this->life_points;
    }

    public function setAttack($attack)
    {
        $this->attack = $attack;
        return $this;
    }

    public function getAttack()
    {
        return $this->attack;
    }

    public function getBonusAttack()
    {
        return self::getBonusFromGivenAttribute($this->attack);
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
        return $this;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function getBonusDefense()
    {
        return self::getBonusFromGivenAttribute($this->defense);
    }

    public function setConstitution($constitution)
    {
        $this->constitution = $constitution;
        return $this;
    }

    public function getConstitution()
    {
        return $this->constitution;
    }

    public function getBonusConstitution()
    {
        return self::getBonusFromGivenAttribute($this->constitution);
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function addAttackDone(Attack $attackDone)
    {
        $this->attacksDone[] = $attackDone;
    }

    public function getAttacksDone()
    {
        return $this->attacksDone;
    }

    public function addDefenseDone(Attack $defenseDone)
    {
        $this->defensesDone[] = $defenseDone;
    }

    public function getDefensesDone()
    {
        return $this->defensesDone;
    }
}
