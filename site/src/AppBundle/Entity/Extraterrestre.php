<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Extraterrestre
 *
 * @ORM\Table(name="extraterrestre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExtraterrestreRepository")
 */
class Extraterrestre extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="famille", type="string", length=255, nullable=true)
     */
    private $famille;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255, nullable=true)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="nourriture", type="string", length=255, nullable=true)
     */
    private $nourriture;

    /**
     * @var string
     *
     */
    protected $password;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Extraterrestre", cascade={"persist"})
     */

    private $friends;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set famille
     *
     * @param string $famille
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set race
     *
     * @param string $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set nourriture
     *
     * @param string $nourriture
     *
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }

    /**
     * Get nourriture
     *
     * @return string
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * Add friend
     *
     * @param Extraterrestre $friend
     */
    public function addFriend(Extraterrestre $friend)
    {
        $this->friends[] = $friend;
    }

    /**
     * Remove friends
     *
     * @param Extraterrestre $friend
     */
    public function removeFriend(Extraterrestre $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friends;
    }
}

