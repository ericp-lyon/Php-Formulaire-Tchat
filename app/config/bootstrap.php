// <?php
// // bootstrap.php
// require_once __DIR__ . "/../../vendor/autoload.php";

//  use Doctrine\ORM\EntityManager;
//  use Doctrine\ORM\Tools\Setup;
 
//  return $entityManager = EntityManager::create([
     
//          "driver"   => "pdo_mysql",
//          "user"     => "root",
//          'password' => "",
//          "dbname"   => "formation-php",
//           "enum" => "string"
//      ],
//          Setup::createAnnotationMetadataConfiguration(
//          [__DIR__."/../../src/Entity"], false, null,null,false)
  
//      );
 
 

// $paths = array("/path/to/entity-files");
// $isDevMode = false;

// // the connection configuration
// $dbParams = array(
//     'driver'   => 'pdo_mysql',
//     'user'     => 'root',
//     'password' => '',
//     'dbname'   => 'foo',
// );

// $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
// $entityManager = EntityManager::create($dbParams, $config);