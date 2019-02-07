<?php
// error_reporting(E_ALL | E_STRICT);
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', '1');
ini_set('log_errors', 1);

class Database
{
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'Shakey1985';
    private $db = 'mykitchen_db';



    //====================================================================
    // constructor
    //====================================================================
    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password);
        $this->connection->select_db($this->db);
        switch (connection_status()) {
            case CONNECTION_NORMAL:
                $txt = 'Connection is in a normal state';
                break;
            case CONNECTION_ABORTED:
                $txt = 'Connection aborted';
                break;
            case CONNECTION_TIMEOUT:
                $txt = 'Connection timed out';
                break;
            case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
                $txt = 'Connection aborted and timed out';
                break;
            default:
                $txt = 'Unknown';
                break;
        }
        // echo $txt;
    }


    //====================================================================
    // destructor
    //====================================================================
    public function __destruct()
    {
        $this->connection->close();
    }

    public function saveUserData($email,$dk,$vj) {

        $stmt = $this->connection->prepare("INSERT INTO participants(email,deutschkenntnisse,volljaehrig) VALUES (?,?,?)");

        $stmt->bind_param("sii",$email,$dk,$vj);
        if($stmt->execute()) {
            $stmt->close();
            return TRUE;
        } else {
            echo "<p>There was an error in query:</p>";
            echo $this->connection->error;
            $stmt->close();
            return FALSE;
        }


    }

    public function getLastUserId($email) {

        $stmt = $this->connection->prepare('SELECT userid FROM participants WHERE email =? AND completed = 0 ORDER BY userid DESC LIMIT 1');
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($usrd);
        $userid= 0;
        while ($stmt->fetch()) {
            $userid = $usrd;
        }

        $stmt->close();
        return $userid;
    }

    public function getAllImages() {

        $stmt = $this->connection->query('SELECT name, picture, width, height, depth FROM mykitchen2');
        $res = [];
        while ($row = $stmt->fetch_assoc()) {
            $res[]= $row;
        }

        return $res;
    }

    public function getAllImagesWithData() {
        $stmt = $this->connection->query('SELECT * FROM mykitchen2 ORDER BY RAND()');
        $res = [];
        while ($row = $stmt->fetch_assoc()) {
            $res[]= $row;
        }

        return $res;
    }
}