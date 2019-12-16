<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Image;
use App\Entity\Voiture;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();

        for($i=1 ; $i <=11; $i++){
            $voiture = new Voiture();

            $marque = $faker-> randomElement($array = array ('Volvo','Citroen','Hyundai','BMW','Audi','Ford','KIA','Honda','Mini','Fiat'));
            $modele = $faker->word();
            $slug = $slugify->slugify($modele);
            $coverimg = $faker->randomElement($array = array ('https://gocar.be/fr/voitures/fiat/500/1-3-multijet-lounge-airco-toit-pano-ja-rcd/id/65962', 'https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/384888271/dfeb3684-9147-4d35-811b-934726f1ac72_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/387897953/e2a3ff13-a23d-4680-b706-16512a24a67c_02.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/386984334/a1a48640-b93a-42e1-87c6-adc2b85da6a9_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/387523463/acc9c983-da42-4e59-b9a3-ce93fbdd99ee_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/369228233/22314700-3207-4308-9dec-b21acb450f25_04.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/338980791/49d49365-db52-514e-e053-e350040a9326_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/385431520/0fb6c04f-eeb7-47c3-9cfa-b5ceb242b72e_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/376838148/a5d89242-86fe-41bf-a345-8683b060c8dd_01.jpg','chttps://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/388018331/014ffba3-2970-4dcf-84db-50a6fe1b0820_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/385183140/3fd5bf1e-ad86-4ec3-a0cc-899b42bb76cd_01.jpg','https://gocar.be/fr/voitures/mini/cooper-clubman/automatic-navi-led-sportseats-camara-top/id/14642','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/380814611/2426a853-88dd-4689-a0b2-bc64bf51b81d_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/386363343/0e155895-ea17-870e-e053-e250040a6dc9_01.jpg'));
            $cylindre = $faker-> randomElement($array = array ('4','6','8'));
            $carburant = $faker-> randomElement($array = array ('essence','diesel'));
            $transmission = $faker-> randomElement($array = array ('manuelle','automatique'));
            $description=$faker->paragraph(2);
            $descrip =  "<p>".join("</p><p>",$faker->paragraphs(3))."</p>";
            $voption = $faker->paragraph(2);
            

            $voiture->setMarque($marque)
                    ->setModele($modele)
                    ->setSlug($slug)
                    ->setCoverimg($coverimg)
                    ->setKm(mt_rand(550,20000))
                    ->setPrix(mt_rand(8000,15000))
                    ->setProprio(mt_rand(1,4))
                    ->setCylindre($cylindre)
                    ->setPuissance(mt_rand(67,137))
                    ->setCarburant($carburant)
                    ->setAnnee(mt_rand(2010,2019))
                    ->setTransmission($transmission)
                    ->setDescrip($descrip)
                    ->setDescription($description)
                    ->setVoption($voption);

            for($j=1; $j <= mt_rand(2,5) ; $j++){
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setVoiture($voiture);

                $manager->persist($image);
            }
        $manager->persist($voiture);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}