<?php

namespace App\DataFixtures;

use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{

    const SAUCES = [
        'Algérienne' => [
            'Origine' => 'Algérie',
            'Ingrédients' => ' Huile de colza, sirop de glucose, purée de tomates, vinaigre, jaune d\'œuf, sel, 
            poivron, poudre de chili, farine, piment doux.',
        ],
        'Mayonnaise' => [
            'Origine' => 'France',
            'Ingrédients' => ' Huile de colza, jaune d\'œuf, sel, vinaigre, moutarde.',
        ],
        'Burger' => [
            'Origine' => 'États-Unis',
            'Ingrédients' => ' Huile de colza, jaune d\'œuf, sel, vinaigre, cornichons, purée de tomates.',
        ],
        'Cubanita' => [
            'Origine' => 'Cuba',
            'Ingrédients' => 'Huile de colza, jaune d\'œuf, sel, vinaigre, piment fort, purée de tomate, habaneros.',
        ],
        'Curry' => [
            'Origine' => 'Inde',
            'Ingrédients' => 'Huile de colza, jaune d\'œuf, sel, curry Indien, muscade.',
        ],
        'Blanche' => [
            'Origine' => 'France',
            'Ingrédients' => 'Huile de colza, jaune d\'œuf, sel, cumin, ail, herbes de provence.',
        ],
        'Ketchup' => [
            'Origine' => 'Sample',
            'Ingrédients' => 'sel, sauce tomate, sucre.',
        ],
        'Pili pili' => [
            'Origine' => 'Mexique',
            'Ingrédients' => 'Huile de colza, jaune d\'œuf, sel, piment Pili pili, purée de tomate.',
        ],
        'Poivre' => [
            'Origine' => 'France',
            'Ingrédients' => 'Huile de colza, jaune d\'œuf, sel, moutarde, gingembre, poivre, sucre, girofle ',
        ],
        'Buffalo' => [
            'Origine' => 'Espagne',
            'Ingrédients' => 'Huile de colza, sel, caramel, purée de tomate, piment fort, arôme fumé.',
        ],

    ];
    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::SAUCES as $name => $data) {
            $sauce = new Sauce();
            $sauce->setName($name);
            $sauce->setOrigin($data['Origine']);
            $sauce->setIngredient($data['Ingrédients']);
            $manager->persist($sauce);
            $i++;
        }
        $manager->flush();
    }
}
