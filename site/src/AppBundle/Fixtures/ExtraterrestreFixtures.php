<?php
/**
 * Created by PhpStorm.
 * User: nasri
 * Date: 09/05/2018
 * Time: 16:53
 */

namespace AppBundle\Fixtures;


use AppBundle\Entity\Extraterrestre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ExtraterrestreFixtures extends Fixture
{

    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $extra =  new Extraterrestre();
            $extra->setAge(mt_rand(10, 100));
            $extra->setFamille('Les Pléiadiens');
            $extra->setRace('Aliens');
            $extra->setNourriture('filets de poulet');
            $extra->setUsername('Grood N'.$i);
            $extra->setEmail('grood'.$i.'@testapp.com');
            $password = $this->encoder->encodePassword($extra, 'pass'.$i);
            $extra->setPassword($password);
            $extra->setRoles(['ROLE_USER']);
            $extra->setEnabled(true);
            $manager->persist($extra);
        }
        $manager->flush();
    }
}
