<?php

namespace App\DataFixtures;

use App\Entity\CompanyType;
use App\Entity\Domain;
use App\Entity\Gender;
use App\Entity\JobType;
use App\Entity\JobGrade;
use App\Entity\CompanySize;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jobGrades = [
            "Etudiant",
            "Junior",
            "Senior"
        ];
        $jobTypes = [
            "Temps plein",
            "Temps partiel",
            "CDI",
            "CDD",
            "Alternance",
            "Teletravail/Freelance",
            "Stage",
        ];
        $genders = [
            "Homme",
            "Femme",
            "Autre"
        ];
        $companySizes = [
            "1-10",
            "10-30",
            "30-50",
            "50-100",
            "100+"
        ];
        $domains = [
            "Technologie de l'information",
            "Santé",
            "Finance",
            "Énergie",
            "Transport",
            "Éducation",
            "Immobilier",
            "Automobile",
            "Agriculture",
            "Alimentation et boissons",
            "Mode",
            "Tourisme",
            "Divertissement",
            "Télécommunications",
            "Assurance",
            "Construction",
            "Industrie pharmaceutique",
            "Logistique",
            "Marketing",
            "Médias",
            "Aérospatiale",
            "Hôtellerie",
            "Consulting",
            "Services juridiques",
            "Biotechnologie",
            "Environnement",
            "Sport",
            "Chimie",
            "Ingénierie",
            "Gestion des déchets",
            "Électronique",
            "Agence immobilière",
            "Sécurité",
            "Gestion des ressources humaines",
            "Services financiers",
            "Joaillerie",
            "Agroalimentaire",
            "Audiovisuel",
            "Arts",
            "Audio",
            "Tabac",
            "Équipements médicaux",
            "Édition",
            "Événementiel",
            "Services gouvernementaux",
            "Textile",
            "Architecture",
            "Restauration",
            "Équipements sportifs",
            "Électronique grand public",
            "Jouets",
            "Pétrole et gaz",
            "Équipements industriels",
            "Éducation supérieure",
            "Papeterie",
            "Équipements de bureau",
            "Artisanat",
            "Équipements de loisirs",
            "Photographie",
            "Assistance technique",
            "Matériaux de construction",
            "Santé animale",
            "Vins et spiritueux",
            "Formation en ligne",
            "Fabrication",
            "Services internet",
            "Énergie renouvelable",
            "Équipements agricoles",
            "Énergie solaire",
            "Aménagement paysager",
            "Bijouterie",
            "Horlogerie",
            "Jeux vidéo",
            "Services sociaux",
            "Plomberie",
            "Équipements audiovisuels",
            "Équipements de sécurité",
            "Mobilier",
            "Cinéma",
            "Électronique automobile",
            "Équipements de cuisine",
            "Design",
            "Jardinerie",
            "Restauration rapide",
            "Réparation automobile",
            "Équipements de plongée",
            "Publicité",
            "Informatique",
            "Produits chimiques de nettoyage",
            "Habillement de travail",
            "Équipements de camping",
            "Édition en ligne",
            "Équipements de pêche",
            "Équipements de golf",
            "Équipements de paintball",
            "Équipements de cyclisme",
            "Équipements de natation",
            "Équipements de ski",
        ];

        $companyTypes = [
            "Startup",
            "Entreprise individuelle",
            "Société anonyme (SA)",
            "Société à responsabilité limitée (SARL)",
            "Entreprise familiale",
            "Entreprise publique",
            "Coopérative",
            "Association",
            "Entreprise sociale",
            "Entreprise multinationale",
            "Entreprise artisanale",
            "Entreprise innovante",
            "Entreprise technologique",
            "Entreprise de services",
            "Entreprise manufacturière",
            "Entreprise de vente au détail",
            "Entreprise en ligne",
            "Entreprise de conseil",
            "Entreprise de construction",
            "Entreprise agroalimentaire",
            "Entreprise pharmaceutique",
            "Entreprise de logistique",
            "Entreprise de transport",
            "Entreprise de médias",
            "Entreprise de divertissement",
            "Entreprise de télécommunications",
            "Entreprise d'énergie",
            "Entreprise de gestion des déchets",
            "Entreprise d'ingénierie",
            "Entreprise de sécurité",
            "Entreprise de recyclage",
            "Entreprise d'architecture",
            "Entreprise de design",
            "Entreprise de développement web",
            "Entreprise de marketing numérique",
            "Entreprise de formation en ligne",
            "Entreprise de tourisme",
            "Entreprise de restauration",
            "Entreprise de construction navale",
            "Entreprise de vente en gros",
            "Entreprise de technologie propre",
            "Entreprise de recyclage électronique",
            "Entreprise sociale et solidaire",
            "Entreprise culturelle",
            "Entreprise d'art et de design",
            "Entreprise humanitaire",
            "Entreprise de recherche et développement",
            "Entreprise de sécurité informatique",
            "Entreprise de génie civil",
            "Entreprise de gestion des ressources humaines",
            "Entreprise de conseil en gestion",
            "Entreprise de fabrication de produits chimiques",
            "Entreprise de fabrication d'équipements médicaux",
            "Entreprise de mode éthique",
            "Entreprise d'éducation",
            "Entreprise d'architecture d'intérieur",
            "Entreprise de conception de jeux vidéo",
            "Entreprise de gestion d'événements",
            "Entreprise de conception graphique",
            "Entreprise de développement durable",
            "Entreprise de conception de logiciels",
            "Entreprise de gestion de projet",
            "Entreprise de développement mobile",
            "Entreprise de commerce électronique",
            "Entreprise de sécurité alimentaire",
            "Entreprise de fabrication de meubles",
            "Entreprise de design d'expérience utilisateur",
            "Entreprise de développement durable",
            "Entreprise de téléphonie mobile",
            "Entreprise de services financiers",
            "Entreprise de production audiovisuelle",
            "Entreprise de gestion immobilière",
            "Entreprise de restauration rapide",
            "Entreprise de santé et de bien-être",
            "Entreprise de cosmétiques",
            "Entreprise de gestion de projet",
            "Entreprise de développement de jeux éducatifs",
            "Entreprise de fabrication de matériaux de construction",
            "Entreprise de gestion des ressources naturelles",
            "Entreprise de fabrication de produits électroniques",
            "Entreprise de fabrication de textiles",
            "Entreprise de conception de logiciels",
            "Entreprise de commerce de gros",
            "Entreprise de fabrication de produits alimentaires",
            "Entreprise de développement de logiciels",
            "Entreprise de vente au détail en ligne",
            "Entreprise de transport de marchandises",
            "Entreprise de commerce équitable",
            "Entreprise de gestion de l'eau",
            "Entreprise de fabrication de jouets",
            "Entreprise de fabrication de produits pharmaceutiques",
            "Entreprise de gestion des médias sociaux",
            "Entreprise de gestion des déchets électroniques",
            "Entreprise de fabrication de vêtements de sport",
            "Entreprise de production cinématographique",
            "Entreprise de production de musique",
            "Entreprise de production de jeux vidéo",
            "Entreprise de conception de logiciels de gestion",
            "Entreprise de gestion de la chaîne d'approvisionnement",
        ];


        foreach ($jobGrades as $value) {
            $jobGrade = new JobGrade();
            $jobGrade->setTitle($value);
            $manager->persist($jobGrade);
        }
        foreach ($jobTypes as $value) {
            $jobType = new JobType();
            $jobType->setTitle($value);
            $manager->persist($jobType);
        }
        foreach ($genders as $value) {
            $genders = new Gender();
            $genders->setTitle($value);
            $manager->persist($genders);
        }
        foreach($companySizes as $value){
            $companySize = new CompanySize();
            $companySize->setSize($value);
            $manager->persist($companySize);
        }
        foreach ($domains as $value) {
            $domain= new Domain();
            $domain->setTitle($value);
            $manager->persist($domain); 
        }
        foreach ($companyTypes as $value) {
            $companyType=new CompanyType();
            $companyType->setType($value);
            $manager->persist($companyType);
        }

        $manager->flush();
    }
}
