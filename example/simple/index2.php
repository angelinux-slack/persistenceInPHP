<?php
/**
 * @author      Horacio Romero Méndez <horacio@consoluciones.com.mx>
 * @copyright   Copyleft 2016, Angelos Rosemary
 * @version     1.0 25/11/2016 11:40
 * @Project     persistenceInPHP
 * @File        index2.php
 * @Internal    Host: MintOS
 *              Kernel: 3.16.0-38-generic x86_64 (64 bit)
 *              Desktop: MATE 1.10.0
 *              Distro: Linux Mint 17.2 Rafaela
 *              IDE: phpStorm
 */
?>
<p>This is an example for recover data with object persistence in PHP</p>

<?php
require_once("../person.php"); //include class with persistence support
person::start();
?>

Printing values with persistence <br/>
Name: <?php echo person::getValue('name'); ?><br/>
email: <?php echo person::getValue('email'); ?> <br/>
Telephones:
<?php
foreach (person::getValue('tels') as $phone) {
    echo $phone . "<br/>";
}
?>

<hr/>
<p>Cleaning data</p>
<?php
person::reset();
?>

Printing values with persistence cleaned <br/>
Name: <?php echo person::getValue('name'); ?><br/>
email: <?php echo person::getValue('email'); ?> <br/>
Telephones:
<?php
foreach (person::getValue('tels') as $phone) {
    echo $phone . "<br/>";
}
?>

<p>If you reload this page, the properties values will be empty because they were deleted. You need to <a
        href='index.php'>reassign them</a>.</p>
