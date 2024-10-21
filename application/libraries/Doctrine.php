<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine {

    public $em = null;

    public function __construct()
    {
        //cargamos la configuración de base de datos de codeigniter
        require APPPATH . "config/database.php";

        //utilizamos el namespace Entities para mapear el directorio models
        $entitiesClassLoader = new ClassLoader('Entities', rtrim(APPPATH . "models" ));
        $entitiesClassLoader->register();

        //utilizamos el namespace Proxies para mapear el directorio models/proxies
        $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/Proxies');
        $proxiesClassLoader->register();

        //utilizamos el namespace Repositories
        $repositoriesClassLoader = new ClassLoader('Repositories', rtrim(APPPATH . "models" ));
        $repositoriesClassLoader->register();

        // Configuración y chaché
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        $config->setQueryCacheImpl($cache);

        // Configuración Proxy
        $config->setProxyDir(APPPATH.'/models/Proxies');
        $config->setProxyNamespace('Proxies');

        // Habilitar el logger para obtener información de cada proceso
        $logger = new EchoSQLLogger;
        //$config->setSQLLogger($logger);

        $config->setAutoGenerateProxyClasses( TRUE );

        //configuramos la conexión con la base de datos utilizando las credenciales de nuestra app
        $connectionOptions = $this->convertDbConfig($db['default']);

        // Creamos el EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
    /**
     * Convert CodeIgniter database config array to Doctrine's
     *
     * See http://www.codeigniter.com/user_guide/database/configuration.html
     * See http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
     *
     * @param array $db
     * @return array
     * @throws Exception
     */
    public function convertDbConfig($db)
    {
        $connectionOptions = [];

        if ($db['dbdriver'] === 'pdo') {
            return $this->convertDbConfigPdo($db);
        } elseif ($db['dbdriver'] === 'mysqli') {
            $connectionOptions = [
                'driver'   => $db['dbdriver'],
                'user'     => $db['username'],
                'password' => $db['password'],
                'host'     => $db['hostname'],
                'dbname'   => $db['database'],
                'charset'  => $db['char_set'],
            ];
        } else {
            throw new Exception('Your Database Configuration is not confirmed by CodeIgniter Doctrine');
        }

        return $connectionOptions;
    }

    protected function convertDbConfigPdo($db)
    {
        $connectionOptions = [];

        if (substr($db['hostname'], 0, 7) === 'sqlite:') {
            $connectionOptions = [
                'driver'   => 'pdo_sqlite',
                'user'     => $db['username'],
                'password' => $db['password'],
                'path'     => preg_replace('/\Asqlite:/', '', $db['hostname']),
            ];
        } elseif (substr($db['dsn'], 0, 7) === 'sqlite:') {
            $connectionOptions = [
                'driver'   => 'pdo_sqlite',
                'user'     => $db['username'],
                'password' => $db['password'],
                'path'     => preg_replace('/\Asqlite:/', '', $db['dsn']),
            ];
        } elseif (substr($db['dsn'], 0, 6) === 'mysql:') {
            $connectionOptions = [
                'driver'   => 'pdo_mysql',
                'user'     => $db['username'],
                'password' => $db['password'],
                'host'     => $db['hostname'],
                'dbname'   => $db['database'],
                'charset'  => $db['char_set'],
            ];
        } else {
            throw new Exception('Your Database Configuration is not confirmed by CodeIgniter Doctrine');
        }

        return $connectionOptions;
    }
}
