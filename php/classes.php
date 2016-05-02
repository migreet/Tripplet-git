<?php

require_once("mother.php");

class dozent extends mother
{
    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param $id
     * @return null
     */

	    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM dozent WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param string $mail
     * @return null
     */

    public function getByMail($mail)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM dozent WHERE mail = :mail');
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $dozentenid
     * @return mixed
     */

    public function getAll($dozentenid)
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM dozent
              WHERE ID != :dozentenid
            ');
            $stmt->bindParam(':dozentenid', $dozentenid);
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param string $name
     * @param string $vorname
     * @param string $passwort
     * @param  string $mail
     * @return mixed
     */

public function signup($name, $vorname, $passwort, $mail)
    {
        try {
            $stmt = $this->pdo->prepare('
				INSERT INTO dozent (name, vorname, passwort, mail)
				VALUES (:name,:vorname,:passwort, :mail)
            ');
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':vorname', $vorname);
			$stmt->bindParam(':passwort', $passwort);
			$stmt->bindParam(':mail', $mail);
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $id
     * @return null
     */

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM dozent WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $userid
     * @param int $rights
     * @return mixed
     */

    public function updateRights($userid, $rights)
    {
        try {
            $stmt = $this->pdo->prepare('
            UPDATE dozent
            SET ID_RECHTE=:rights
            WHERE ID=:userid;
            ');
            $stmt->bindParam(':userid', $userid);
            $stmt->bindParam(':rights', $rights);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }
}


class vorlesung extends mother
{


    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

	    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM vorlesung WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $dozentenid
     * @return null
     */
	
		    public function getByDozentenId($dozentenid)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM vorlesung WHERE ID_DOZENT = :dozentenid');
            $stmt->bindParam(':dozentenid', $dozentenid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @return mixed
     */

    public function getAll()
{
    try {
        $stmt = $this->pdo->prepare('
              SELECT * FROM vorlesung
            ');
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    } catch (PDOException $e) {
        echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
        die();
    }

}

    /***
     * @param string $bezeichnung
     * @param int $dozentenid
     * @return mixed
     */

    public function createVorlesung($bezeichnung, $dozentenid)
    {
        try {
            $stmt = $this->pdo->prepare('
              	INSERT INTO vorlesung (bezeichnung, ID_DOZENT)
				VALUES (:bezeichnung,:dozentenid)
            ');
            $stmt->bindParam(':bezeichnung', $bezeichnung);
            $stmt->bindParam(':dozentenid', $dozentenid);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }


    /***
     * @param int $id
     * @return null
     */

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM vorlesung WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }
}

class voting extends mother
{
    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

	    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM voting WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $vorlesungsid
     * @return null
     */
	
	    public function getByVorlesungsId($vorlesungsid)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM voting WHERE ID_VORLESUNG = :vorlesungsid');
            $stmt->bindParam(':vorlesungsid', $vorlesungsid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param string $schluessel
     * @return null
     */

    public function getByKey($schluessel)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM voting WHERE schluessel = :schluessel');
            $stmt->bindParam(':schluessel', $schluessel);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @return mixed
     */

    public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM voting
            ');
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param string $bezeichnung
     * @param int $vorlesungsid
     * @return mixed
     */


    public function createVoting($bezeichnung, $vorlesungsid)
    {
        try {
            $stmt = $this->pdo->prepare('
              	INSERT INTO voting (bezeichnung, ID_VORLESUNG)
				VALUES (:bezeichnung, :vorlesungsid)
            ');
            $stmt->bindParam(':bezeichnung', $bezeichnung);
            $stmt->bindParam(':vorlesungsid', $vorlesungsid);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $votingid
     * @param string $schluessel
     * @return mixed
     */

    public function update($votingid, $schluessel)
    {
        try {
            $stmt = $this->pdo->prepare('
            UPDATE voting
            SET schluessel=:schluessel
            WHERE ID=:votingid;
            ');
            $stmt->bindParam(':votingid', $votingid);
            $stmt->bindParam(':schluessel', $schluessel);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $id
     * @return null
     */

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM voting WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }
}

class frage extends mother
{


    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

	    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM frage WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $votingid
     * @return null
     */
	
        public function getByVotingId($votingid)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM frage WHERE ID_VOTING = :votingid');
            $stmt->bindParam(':votingid', $votingid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @return mixed
     */

    public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM frage
            ');
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param string $text
     * @param int $votingid
     * @return mixed
     */

    public function createFrage($text, $votingid)
    {
        try {
            $stmt = $this->pdo->prepare('
              	INSERT INTO frage ( text, ID_VOTING)
				VALUES (:text,:votingid)
            ');
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':votingid', $votingid);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            $fragenID=$this->pdo->lastInsertId();
            return $fragenID;
            //return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
    }

    /***
     * @param int $id
     * @return null
     */

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM frage WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }
}

class antwort extends mother
{


    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

		    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM antworten WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $fragenid
     * @return null
     */

		    public function getByFragenId($fragenid)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM antworten WHERE ID_FRAGE = :fragenid');
            $stmt->bindParam(':fragenid', $fragenid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @return mixed
     */

        public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM antworten
            ');
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param string $text
     * @param int $fragenid
     * @return mixed
     */

    public function createAntwort($text, $fragenid)
    {
        try {
            $stmt = $this->pdo->prepare('
              	INSERT INTO antworten (text, ID_FRAGE)
				VALUES (:text, :fragenid)
            ');
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':fragenid', $fragenid);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
    }

    /***
     * @param int $id
     * @return null
     */

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM antworten WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }
}

class auswertung extends mother
{


    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

		    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM auswertung WHERE ID_FRAGE = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @param int $fragenid
     * @return null
     */
			    public function getByFragenId($fragenid)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM auswertung WHERE ID_FRAGE = :fragenid');
            $stmt->bindParam(':fragenid', $fragenid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }


    /***
     * @return mixed
     */

    public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM auswertung
            ');
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $antwortid
     * @return mixed
     */

    public function countAntworten($antwortid)
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT COUNT(*) FROM auswertung WHERE ID_ANTWORT=:antwortid;
            ');
            $stmt->bindParam(':antwortid', $antwortid);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $frageid
     * @return mixed
     */

    public function countTeilnehmer($frageid)
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT COUNT(*) FROM auswertung
              WHERE ID_FRAGE=:frageid
              AND ID_ANTWORT !=0;
            ');
            $stmt->bindParam(':frageid', $frageid);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $fragenid
     * @param string $sessionid
     * @return mixed
     */

    public function createAuswertung($fragenid, $sessionid)
    {
        try {
            $stmt = $this->pdo->prepare('
              INSERT INTO auswertung (ID_FRAGE, SESSIONID_STUDENT) VALUES (:fragenid, :sessionid)
            ');
            $stmt->bindParam(':fragenid', $fragenid);
            $stmt->bindParam(':sessionid', $sessionid);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $status
     * @param int $votingid
     * @param string $sessionid
     * @return mixed
     * nochmal überarbeiten
     */

    public function countFragen($status, $votingid, $sessionid)
    {
        try {
            if ($status==1){
                $stmt = $this->pdo->prepare('
                SELECT COUNT(*)
                FROM frage
                LEFT JOIN auswertung
                ON frage.ID=auswertung.ID_FRAGE
                WHERE frage.ID_VOTING = :votingid
                AND auswertung.SESSIONID_STUDENT = :sessionid
                AND auswertung.ID_ANTWORT != 0;
            ');
            }else{
                $stmt = $this->pdo->prepare('
                SELECT COUNT(*)
                FROM frage
                LEFT JOIN auswertung
                ON frage.ID=auswertung.ID_FRAGE
                WHERE frage.ID_VOTING = :votingid
                AND auswertung.SESSIONID_STUDENT = :sessionid;
            ');
                //Hier muss noch die SESSION_ID rein!!!!
            }
            $stmt->bindParam(':votingid', $votingid);
            $stmt->bindParam(':sessionid', $sessionid);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $votingid
     * @param string $sessionid
     * @return mixed
     */

    public function frageRunde($votingid, $sessionid)
    {
        try {
                $stmt = $this->pdo->prepare('
                SELECT *
                FROM frage
                LEFT JOIN auswertung
                ON frage.ID=auswertung.ID_FRAGE
                WHERE frage.ID_VOTING = :votingid
                AND auswertung.SESSIONID_STUDENT = :sessionid
                AND auswertung.ID_ANTWORT = 0;
            ');

            $stmt->bindParam(':votingid', $votingid);
            $stmt->bindParam(':sessionid', $sessionid);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }

    /***
     * @param int $fragenid
     * @param string $sessionid
     * @param int $antwortid
     * @return mixed
     */

    public function update($fragenid, $sessionid, $antwortid)
    {
        try {
            $stmt = $this->pdo->prepare('
              UPDATE auswertung
              SET ID_ANTWORT=:antwortid
              WHERE ID_FRAGE=:fragenid
              AND SESSIONID_STUDENT=:sessionid;
            ');
            $stmt->bindParam(':fragenid', $fragenid);
            $stmt->bindParam(':sessionid', $sessionid);
            $stmt->bindParam(':antwortid', $antwortid);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }


	
}

class rechte extends mother
{


    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /***
     * @param int $id
     * @return null
     */

		    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM rechte WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $n = $stmt->fetch();
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        if (!$n) $n = null;
        return $n;
    }

    /***
     * @return mixed
     */

        public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare('
              SELECT * FROM rechte
            ');
            $stmt->execute();
			$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

    }
	
	
}


