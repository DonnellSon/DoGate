<?php

namespace App\DataFixtures;

use App\Entity\Flag;
use App\Entity\Pays;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AppFixtures extends Fixture
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
{
    $imgDir = $this->kernel->getProjectDir() . '/public/img/flags';
    $newDir = $this->kernel->getProjectDir() . '/public/upload/img/flags';

    $countries = [
        'Algérie' => 'algeria.svg',
        'Angola' => 'angola.svg',
        'Bénin' => 'benin.svg',
        'Botswana' => 'botswana.svg',
        'Burkina Faso' => 'burkina_faso.svg',
        'Burundi' => 'burundi.svg',
        'Cameroun' => 'cameroon.svg',
        'Cap-Vert' => 'cape_verde.svg',
        'Chad' => 'chad.svg',
        'Cueta' => 'cueta.svg',
        'Comores' => 'comoros.svg',
        'République du Congo' => 'republic_of_the_congo.svg',
        'République démocratique du Congo' => 'democratic_Republic_of_the_congo.svg',
        'Côte d\'Ivoire' => 'cote_d\'ivoire.svg',
        'Djibouti' => 'djibouti.svg',
        'Égypte' => 'egypt.svg',
        'Gabon' => 'gabon.svg',
        'Ghana' => 'ghana.svg',
        'Guinée' => 'guinea.svg',
        'Guinée-Bissau' => 'guinea-bissau.svg',
        'Guinée équatoriale' => 'equatorial_guinea.svg',
        'Kenya' => 'kenya.svg',
        'Lesotho' => 'lesotho.svg',
        'Liberia' => 'liberia.svg',
        'Libye' => 'libya.svg',
        'Madagascar' => 'madagascar.svg',
        'Malawi' => 'malawi.svg',
        'Mali' => 'mali.svg',
        'Mauritanie' => 'mauritania.svg',
        'Maurice' => 'mauritius.svg',
        'Maroc' => 'morocco.svg',
        'Mozambique' => 'mozambique.svg',
        'Namibie' => 'namibia.svg',
        'Niger' => 'niger.svg',
        'Nigeria' => 'nigeria.svg',
        'Ouganda' => 'uganda.svg',
        'Rwanda' => 'rwanda.svg',
        'Sao Tomé-et-Principe' => 'sao_tome_and_principe.svg',
        'Sénégal' => 'senegal.svg',
        'Seychelles' => 'seychelles.svg',
        'Sierra Leone' => 'sierra_leone.svg',
        'Somalie' => 'somalia.svg',
        'Afrique du Sud' => 'south_africa.svg',
        'Soudan' => 'sudan.svg',
        'Soudan du Sud' => 'south_sudan.svg',
        'Eswatini' => 'eswatini.svg',
        'Tanzanie' => 'tanzania.svg',
        'Togo' => 'togo.svg',
        'Tunisie' => 'tunisia.svg',
        'Zambie' => 'zambia.svg',
        'Zimbabwe' => 'zimbabwe.svg',
        
    ];

    foreach ($countries as $name => $flagFilename) {
        $pays = new Pays();
        $pays->setName($name);

        $flag = new Flag();
        $newPath = $newDir . '/' . $flagFilename;
        copy($imgDir . '/' . $flagFilename, $newPath);
        $flagFile = new UploadedFile($newPath, $flagFilename, null, null, true);
        $flag->setFile($flagFile);
        $pays->setFlag($flag);

        $manager->persist($pays);
    }

    $manager->flush();
}

}

