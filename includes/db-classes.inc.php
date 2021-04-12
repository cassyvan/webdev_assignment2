<?php
class DatabaseHelper
{
    /* Returns a connection object to a database */
    public static function createConnection($values = array())
    {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString, $user, $password);
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
        return $pdo;
    }
    /*
 Runs the specified SQL query using the passed connection and
 the passed array of parameters (null if none)
 */
    public static function runQuery($connection, $sql, $parameters)
    {
        $statement = null;
        // if there are parameters then do a prepared statement
        if (isset($parameters)) {
            // Ensure parameters are in an array
            if (!is_array($parameters)) {
                $parameters = array($parameters);
            }
            // Use a prepared statement if parameters
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (!$executedOk) throw new PDOException;
        } else {
            // Execute a normal query
            $statement = $connection->query($sql);
            if (!$statement) throw new PDOException;
        }
        return $statement;
    }
}
class CompaniesDB
{
    private static $baseSQL = "SELECT * FROM companies";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getSingleCompany($companySymbol)
    {
        $sql = self::$baseSQL . " WHERE symbol=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($companySymbol)
        );
        return $statement->fetchAll();
    }
}

class HistoryDB
{
    private static $baseSQL;

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    public function getAllCompanySymbol($symbol)
    {
        $sql = self::$baseSQL . " SELECT date, open, high, low, close, volume FROM history";
        $sql .= " WHERE history.symbol=?";
        $sql .= " ORDER BY date";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($symbol)
        );
        return $statement->fetchAll();
    }

    public function getSortedCompany($symbol, $sort)
    {
        $sql = self::$baseSQL . " SELECT date, open, high, low, close, volume FROM history";
        $sql .= " WHERE history.symbol=?";
        $sql .= " ORDER BY " . $sort;
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($symbol)
        );
        return $statement->fetchAll();
    }
}

class PortfolioDB
{
    private static $baseSQL;

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

<<<<<<< HEAD
    public function getPortfolio($userId)
    {
        // $sql = self::$baseSQL . "SELECT companies.symbol, companies.name, portfolio.amount, h.close
        // FROM portfolio 
        // JOIN companies ON portfolio.symbol = companies.symbol
        // JOIN (  SELECT symbol, history.close
        //         FROM history 
        //         GROUP BY symbol
        //         HAVING MAX(date)
        //      ) as h
        // WHERE portfolio.symbol = h.symbol
        // ORDER BY portfolio.symbol";
        $sql = self::$baseSQL . "SELECT companies.name, portfolio.amount
                FROM companies
                JOIN portfolio ON portfolio.symbol = companies.symbol";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($userId));
=======
    public function getPortfolio($userId) {
        $sql = self::$baseSQL . "SELECT companies.symbol, companies.name, portfolio.amount, h.close, portfolio.amount*h.close
        FROM portfolio 
        JOIN companies ON portfolio.symbol = companies.symbol
        JOIN (  SELECT symbol, history.close
                FROM history 
                GROUP BY symbol
                HAVING MAX(date)
             ) as h
        WHERE portfolio.symbol = h.symbol
        AND userId =  $userId  
        ORDER BY portfolio.symbol";
        // $sql = self::$baseSQL . "SELECT companies.name, portfolio.amount
        //         FROM companies
        //         JOIN portfolio ON portfolio.symbol = companies.symbol";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,array($userId));
>>>>>>> 9774764886363e5e4b4ed796d4aa060175dbafde
        return $statement->fetchAll();
    }
}

class UsersDB
{
    private static $baseSQL = "SELECT * FROM users";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }


    public function getUser($email, $password)
    {
        $sql = self::$baseSQL;
        $sql .= " WHERE email=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($email)
        );


        $row = $statement->fetch(PDO::FETCH_OBJ);

        if ($row) {

            print_r($row);

            $hashedPassword = $row->password;

            if (password_verify($password, $hashedPassword)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // public function getPortfolio($userId) {
    //     // $sql = self::$baseSQL . "SELECT companies.symbol, companies.name, portfolio.amount, h.close
    //     // FROM portfolio 
    //     // JOIN companies ON portfolio.symbol = companies.symbol
    //     // JOIN (  SELECT symbol, history.close
    //     //         FROM history 
    //     //         GROUP BY symbol
    //     //         HAVING MAX(date)
    //     //      ) as h
    //     // WHERE portfolio.symbol = h.symbol
    //     // ORDER BY portfolio.symbol";
    //     $sql = self::$baseSQL . "SELECT companies.name, portfolio.amount
    //             FROM companies
    //             JOIN portfolio ON portfolio.symbol = companies.symbol";
    //     $statement = DatabaseHelper::runQuery($this->pdo, $sql,array($userId));
    //     return $statement->fetchAll();
    // }
}
