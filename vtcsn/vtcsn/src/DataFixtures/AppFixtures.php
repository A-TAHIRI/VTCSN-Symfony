<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Driver;
use App\Entity\Location;
use App\Entity\Rating;
use App\Entity\Ride;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;
class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
        ){}
        
            
    
    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@vtcsn.com');
        $admin->setname('vtcsn');
        $admin->setsurname('admin');
        $admin->setGenre('Homme','Femme');
        $admin->setAddress('30 rue du nord');
        $admin->setphoneNumber('0755555555');
        $admin->setZipcode('75000');
        $admin->setCity('Paris');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin,'vtcsn'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);


        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setname($faker->lastName);
            $user->setsurname($faker->firstName);
            $user->setGenre('Homme','Femme');
            $user->setAddress($faker->streetAddress);
            $user->setphoneNumber($faker->phoneNumber);
            $user->setZipcode(str_replace( ' ','',$faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword($this->passwordEncoder->hashPassword($user,'secret'));
           
             
           
            $vehicule= new Vehicule();
            $vehicule->setTypeVehicule('Type'.$i);
            $vehicule->setNumberPlace($faker->numberBetween(3,7));
            $vehicule->setNumberDoor($faker->numberBetween(3,4));
            $vehicule->setBrand('Mercedes');
            $vehicule->setColor('Gris');
            $vehicule->setModel($faker->numberBetween(2015,2023));
            $vehicule->setEnergie('Gazoil');
            $vehicule->setImage($faker->imageUrl(400,300,'cats'));
            $vehicule->setLicensePlate('LicensePlate'.$i);
            
                  
            $driver = new Driver();
            $driver->setLicense('License'.$i);
            $driver->setDisponibility(true);
            $driver->setTotalRide($faker->numberBetween(0,100));
            $driver->setUser($user);
            $driver->setVehicule($vehicule);

            $manager->persist($user);
            $manager->persist($vehicule);
            $manager->persist($driver);

       
         for($k = 1; $k <= 2;$k++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setname($faker->lastName);
            $user->setsurname($faker->firstName);
            $user->setGenre('Homme','Femme');
            $user->setAddress($faker->streetAddress);
            $user->setphoneNumber($faker->phoneNumber);
            $user->setZipcode(str_replace( ' ','',$faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword($this->passwordEncoder->hashPassword($user,'secret'));
       

            $location =new Location();
            $location->setCity($faker->city);
            $location->setCountry($faker->country);
            $location->setRegion('Region'.$k);
            $location->setZipcode(str_replace( ' ','',$faker->postcode));
            

            $ride =  new Ride();
            $ride->setStatus(true);
            $ride->setRendezVous($faker->address);
            $ride->setRendezVousTime($faker->dateTime);
            $ride->setCanceled(false);
            $ride->setDestination($faker->address);
            $ride->setStartTime($faker->dateTime);
            $ride->setStopTime($faker->dateTime);
            $ride->setTimeDestination($faker->dateTime);
            $ride->setLocation($location);
            $ride->addUser($user);
            $ride->addDriver($driver);
           
            $rating = new Rating();
            $rating->setNote($faker->numberBetween(0 ,5));
            $rating->setCommentary($faker->text(50));
            $rating->setRaide($ride);
          
            
            
            
         }

        
            

         $manager->persist($user);
         $manager->persist($rating);
         $manager->persist($location);
         $manager->persist($ride);
    
        }



          $manager->flush();
    }
}