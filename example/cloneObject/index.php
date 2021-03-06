<?php
/**
 * @author      Horacio Romero Méndez <horacio@consoluciones.com.mx>
 * @copyright   Copyleft 2016, Angelos Rosemary
 * @version     1.0 25/11/2016 11:26
 * @Project     persistenceInPHP
 * @File        index.php
 * @Internal    Host: MintOS
 *              Kernel: 3.16.0-38-generic x86_64 (64 bit)
 *              Desktop: MATE 1.10.0
 *              Distro: Linux Mint 17.2 Rafaela
 *              IDE: phpStorm
 */
?>
<p>This is an example for cloning objects with persistence in PHP</p>
<?php
require_once("../person.php"); //include class with persistence support

//in this moment, person class properties have empty value

//we can clone class person to assign 5 different class
for ($i = 1; $i <= 5; $i++) {
    $person = init::clonar('../person.php', "person$i");

    //we can assign values for properties
    $person->setValue('name', "Angelos $i");
    $person->setValue('email', "horacio{$i}@consoluciones.com.mx");

    //we can assign arrays too
    $tels = array("+52 $i$i$i $i$i$i $i$i $i$i", "+1 $i$i$i $i$i$i $i$i $i$i");
    $person->setValue('tels', $tels);
}


//now, we can print current values
for ($i = 1; $i <= 5; $i++) {
    $person = init::clonar('../person.php', "person$i");
    ?>
    <p>Person number <?= $i ?></p>
    Name: <?php echo $person->getValue('name'); ?><br/>
    email: <?php echo $person->getValue('email'); ?> <br/>
    Telephones:
    <?php
    foreach ($person->getValue('tels') as $phone) {
        echo $phone . "<br/>";
    }
}
?>

<p><a href='index2.php'>Click here</a> to load another page and recover all values assigned</p>
