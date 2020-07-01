<?php

namespace ImportCsv;

/**
 * Class DataSource
 */
class DataSource
{
    /** @var string HOST */
    const HOST = 'localhost';

    /** @var string USERNAME */
    const USERNAME = 'root';

    /** @var string PASSWORD */
    const PASSWORD = 'password';

    /** @var string DATABASENAME */
    const DATABASENAME = 'smartWorks_test';
    
    /** @var \mysqli $conn */
    private $conn;
   
    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    /**
     * If connection object is needed use this method and get access to it.
     * Otherwise, use the below methods for insert / update / etc.
     *
     * @return \mysqli
     */
    public function getConnection(): \mysqli
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");

        return $conn;
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select(string $query, string $paramType = "", array $paramArray = array()): array
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        return $resultset ?? [];
    }

    /**
     * To insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert(string $query, string $paramType, array $paramArray): int
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();

        return $stmt->insert_id;;
    }

    /**
     * To execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute(string $query, string $paramType = "", array $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
    }

    /**
     * Prepares parameter binding
     * Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams(string $stmt, string $paramType, array $paramArray = array())
    {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function getRecordCount(string $query, string $paramType = "", array $paramArray = array()): int
    {
        $stmt = $this->conn->prepare($query);
        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }
}