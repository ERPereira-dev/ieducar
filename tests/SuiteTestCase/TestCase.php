<?php

namespace Tests\SuiteTestCase;

use clsBanco;
use PHPUnit\DbUnit\Database\Connection;
use PHPUnit\DbUnit\DataSet\DefaultDataSet;
use PHPUnit\DbUnit\Operation\Composite;
use PHPUnit\DbUnit\TestCaseTrait;
use \Tests\TestCase as AbstractTestCase;

class TestCase extends AbstractTestCase
{
    use TestCaseTrait;
    /**
     * @var Connection
     */
    private static $connection;

    /**
     * Returns the test database connection.
     *
     * @return Connection
     */
    protected function getConnection($connection = NULL)
    {
        if (!self::$connection) {
            $banco = new clsBanco();
            $banco->FraseConexao();
            $pdo = new \PDO('pgsql:' . $banco->getFraseConexao());
            self::$connection = $this->createDefaultDBConnection($pdo);
        }

        return self::$connection;
    }

    /**
     * Returns the test dataset.
     *
     */
    protected function getDataSet()
    {
        return (new DataSet($this))->getDataSet();
    }

    public function getYamlDataSet()
    {
        return new DefaultDataSet();
    }

    protected function getSetUpOperation()
    {
        return new Composite(
            [
                new ForeignKeysCheckDisable(),
                new InsertTriggerEnable()
            ]
        );
    }

    public function getTearDownOperation()
    {
        return new ForeignKeysCheckDisable();
    }

    public function getHtmlCodeFromFile($fileName)
    {
        return  file_get_contents(__DIR__ . '/../Unit/assets/' . $fileName);
    }

    public function getPdoConection()
    {
        return $this->getConnection()->getConnection();
    }
}
