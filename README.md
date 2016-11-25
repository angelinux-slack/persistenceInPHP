# persistenceInPHP
Persistence of objects for PHP

With persistence of objects for PHP you can set values for class properties and retrieve all them in any PHP file.

#Example for class 'person'
  
Set String 'Angelos' for property 'name' in class 'person':    
    
    include_once('init.php'); //core
    include_once('person.php'); //see example class 
    person::setValue('name', 'Angelos');
    

 
Retrieve values for property 'name' in class 'person' in any file in your project:

    include_once('init.php'); //core
    include_once('person.php'); //see example class
    person::start(); //retrieve all values for class
    echo person::getValue('name'); //Angelos
    
You can set values
    
    person::setValue('property', 'value');
    
Retrieve all values in your file

    person::start();
    
Get some property value

    $var = person::getValue('property'); //value
    
Clean all properties values

    person::reset();
    
- Also, you can set arrays and retrieve them
 
- Support for cloning objects, you can set persistence any times for same class in your file at once 

See example folder for simple use or cloning use

Class person as example