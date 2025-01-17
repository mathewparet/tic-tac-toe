<?php

namespace App\Core\Database;

use App\Core\Config;
use PDO;

class MariaDatabase implements DatabaseInterface
{
    private PDO $connection;

    public function __construct(Config $config)
    {
        $dsnParameters = [
            'host=' . $config->getDatabaseHost(),
            'port=' . $config->getDatabasePort(),
            'dbname=' . $config->getDatabaseName(),
            'user=' . $config->getDatabaseUsername(),
            'password=' . $config->getDatabasePassword(),
            'charset=' . $config->getDatabaseCharset(),
        ];
        $dsnString = 'mysql:' . implode(';', $dsnParameters);

        $this->connection = new PDO($dsnString);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeSQL(string $sql, array $bindParameters = []): array
    {
        $statement = $this->connection->prepare($sql);
        foreach ($bindParameters as $parameterName => &$parameterValue) {
            $statement->bindParam($parameterName, $parameterValue, $this->getParamType($parameterValue));
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getParamType($value)
    {
        switch (gettype($value)) {
            case 'integer':
                return PDO::PARAM_INT;
            case 'boolean':
                return PDO::PARAM_BOOL;
            case 'NULL':
                return PDO::PARAM_NULL;
            default:
                return PDO::PARAM_STR;
        }
    }
}
