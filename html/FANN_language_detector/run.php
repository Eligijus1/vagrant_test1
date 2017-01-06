<?php

include_once 'helpers.php';

/**
 * Testing ANN
 */

// Define application start:
$milliseconds = round(microtime(true) * 1000);

// Interrupt application if train file not exist:
if (!is_file('classify.txt')) {
    die("The file xor_float.net has not been created! Please run simple_train.php to generate it");
}

// Load ANN model from file:
$ann = fann_create_from_file('classify.txt');


// Check if neural network created:
if (!$ann) {
    die("ANN could not be created");
}


// Text in english language:
$output = fann_run($ann, generate_frequencies('ANN are slowly adjusted so as to produce the same output as in
            the examples. The hope is that when the ANN is shown a new
            X-ray images containing healthy tissues.'));


var_dump($output);
echo '<br>';

// Text in french language:
$output = fann_run($ann, generate_frequencies('Voyons, Monsieur, absolument pas, les camions d’aujourd’hui ne se traînent pas, bien au contraire. Il leur arrive même de pousser les voitures. Non, croyez moi, ce qu’il vous faut, c’est un camion !
     - Vous croyez ? Si vous le dites. Est-ce que je pourrais l’avoir en rouge ?
     - Bien entendu cher Monsieur,vos désirs sont des ordres, vous l’aurez dans quinze jours clé en main. Et la maison sera heureuse de vous offrir le porte-clé. Si vous payez comptant. Cela va sans dire, ajouta Monsieur Filou.
     - Ah, si ce '));

var_dump($output);
echo '<br>';

// Text in pl language:
$output = fann_run($ann, generate_frequencies('tworząc dzieło literackie, pracuje na języku. To właśnie język stanowi tworzywo, dzięki któremu powstaje tekst. Język literacki ( lub inaczej artystyczny) powstaje poprzez wybór odpowiednich środków i przy wykorzystaniu odpowiednich zabiegów technicznych.
            Kompozycja - jest to układ elementów treściowych i formalnych dzieła dokonanych według określonych zasad konstrukcyjnych.
            Kształtowanie tworzywa dzieła literackiego jest procesem skomplikowanym i przebiegającym na wielu poziomach.
            Składa się na nie:'));

var_dump($output);
echo '<br>';

// Destroys the entire network and properly freeing all the associated memory:
fann_destroy($ann);

// Inform about application finish and print time used:
echo 'INFO: Done simple_test.php in ' . (round(microtime(true) * 1000) - $milliseconds) . ' milliseconds<br>';
