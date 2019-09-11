<?php
use PHPMailer\PHPMailer\PHPMailer;
/**
 * The PantryDatabase class
 * Contains all methods relevant to the database
 */
class PantryDatabase {
    const DB_SERVER = "cisdbss.pcc.edu";
    const DB_DATABASE = "234a_PHPeeps";
    const DB_USER = "234a_PHPeeps";
    const DB_PASSWORD = "IfIhad100wishes#";
    /** @var $dbh PDO  */
    private static $db = NULL;

    /**
     * Creates a connection to the database
     */
    private static function connect() {
        if (empty(PantryDatabase::$db)) {
            PantryDatabase::$db = new PDO("sqlsrv:Server=" . self::DB_SERVER . ";Database=" . self::DB_DATABASE, self::DB_USER, self::DB_PASSWORD);
        }
        return PantryDatabase::$db;
    }

    /**
     * Gets data of a user based on a username or email address
     * @param $username String the username passed through
     * @return array The user's data in the database
     */
    public function lookupUser($username) {
        $conn = PantryDatabase::connect();
        $safe_username = $conn->quote($username);

        $query = 'SELECT * FROM [USER] FULL JOIN [USER_ROLE] ON [USER].user_id = [USER_ROLE].user_id FULL JOIN [ROLE] 
                    ON [ROLE].role_id = [USER_ROLE].role_id WHERE username=' . $safe_username . ' OR email=' . $safe_username;

        $statement = $conn->prepare($query);
        $statement->execute(array($safe_username));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function changeEmail($newEmail, $email) {
         $conn = PantryDatabase::connect();
        $safe_newEmail = $conn->quote($newEmail);
        $safe_email = $conn->quote($email);
        $query = 'UPDATE [USER] SET email=' . $safe_newEmail . ' WHERE email=' . $safe_email;
        $statement = $conn->prepare($query);
        $statement->execute(array($safe_email, $safe_newEmail));
    }
    
    public function changeUsername($newUsername, $username) {
        $conn = PantryDatabase::connect();
        $safe_newUsername = $conn->quote($newUsername);
        $safe_username = $conn->quote($username);
        $query = 'UPDATE [USER] SET username=' . $safe_newUsername . ' WHERE username=' . $safe_username;
        $statement = $conn->prepare($query);
        $statement->execute(array($safe_username, $safe_newUsername));
    }

    public function recoveryToken($userToken, $email) {
        $conn = PantryDatabase::connect();

        $query = 'UPDATE [USER]   SET token = :questionString, token_time= DATEADD(MINUTE, 5, 	CURRENT_TIMESTAMP )
					WHERE email = :question_id';
        $stmt = $conn->prepare($query);
        $stmt->execute(array(':questionString' => $userToken,
         ':question_id' => $email));
        print $stmt->rowCount();
    }  
    
    public function confirmToken($userToken, $email) {
        $conn = PantryDatabase:: connect();

        $query = "SELECT * FROM [USER]  [USER] FULL JOIN [USER_ROLE] ON [USER].user_id = [USER_ROLE].user_id FULL JOIN [ROLE] 
                    ON [ROLE].role_id = [USER_ROLE].role_id WHERE  token= :tokenString AND token <> ''  AND token is not null AND email = :emailString AND token_time > CURRENT_TIMESTAMP";
        $statement = $conn->prepare($query);
        $statement->execute(array(
            ':tokenString' => $userToken,
            ':emailString' => $email)
        );
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function reset_password($newPassword, $userId) {
        $conn = PantryDatabase:: connect();
        $query = "UPDATE [USER] SET hash=:passwordString WHERE user_id =:useridString";
        $statement = $conn->prepare($query);
        $statement->bindParam(':passwordString', $newPassword);
        $statement->bindParam(':useridString', $userId);

        $statement->execute();
    }
    
    public function DeleteUser($id) {
        $conn = PantryDatabase::connect();
        $safe_delete = $conn->quote($id);
        $query = ('DELETE FROM [USER_ROLE] WHERE user_id =' . $safe_delete .'
                                        DELETE FROM [USER] WHERE user_id =' . $safe_delete);
        $statement = $conn->prepare($query);
        $statement->execute(array($safe_delete));
    }

    /**
     * Inserts a user into the database
     * @param $username string the username which the user picked
     * @param $name string the name which the user picked
     * @param $role string the role of the user ("subscriber" by default)
     * @param $email string the email address of the user
     * @param $hash string the hashed password
     * @return array The newly created user's data
     */
    public function addUser($username, $name, $role, $email, $hash) {
        $conn = PantryDatabase::connect();
        $safe_username = $conn->quote($username);
        $safe_email = $conn->quote($email);
        $safe_name = $conn->quote($name);

        $query = 'INSERT INTO [USER]   
                                   (username, name, role, email, hash)  
                      VALUES   (' . $safe_username . "," .  $safe_name . ",'" . $role . "'," . $safe_email . ",'" . $hash . "');";

        $statement = $conn->prepare($query);
        $statement->execute(array($safe_username, $safe_name, $role, $safe_email, $hash));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Gets the data on all the templates in the database, using a stored procedure in the database
     * @return array The resulting data array
     */
    public function getAllTemplates() {
        $conn = PantryDatabase::connect();
        $query = 'EXEC get_all_templates;';
        $statement = $conn->prepare($query);
        $statement->execute();

        $data_array = array();
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
           $data_array[] = $result;
        }
        return $data_array;
    }

    /**
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     * @return array The resulting data array
     */
    public function getSpecificTemplate($template_id) {
        $conn = PantryDatabase::connect();

        $query = 'EXEC get_specific_template ' . $template_id . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_id));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_name string The template's name
     * @param $template_body string The template's body
     */
    public function createNewTemplate($template_name, $template_body) {
        $conn = PantryDatabase::connect();
        $template_name = $conn->quote($template_name);
        $template_body = $conn->quote($template_body);

        $query = 'EXEC create_new_template ' . $template_name . ', ' . $template_body . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_name, $template_body));
    }

    /**
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     * @param $template_name string The template's name
     * @param $template_body string The template's body
     */
    public function updateTemplate($template_id, $template_name, $template_body) {
        $conn = PantryDatabase::connect();
        $template_name = $conn->quote($template_name);
        $template_body = $conn->quote($template_body);

        $query = 'EXEC update_template ' . $template_id . ', ' . $template_name . ', ' . $template_body . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_id, $template_name, $template_body));
    }
	
    /**
     * Deletes a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     */
    public function deleteTemplate($template_id) {
        $conn = PantryDatabase::connect();

        $query = 'EXEC delete_template ' . $template_id . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_id));
    }

    /**
     * Function: lookupTemplateName
     * looks up a template based on the name
     * @param $template_name string The template's name
     * @return array The resulting data array
     */
    public function lookupTemplateName($template_name)
    {
        $conn = PantryDatabase::connect();
        $template_name = $conn->quote($template_name);
        $query = 'EXEC lookup_template_name ' . $template_name . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_name));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Gets all the rows in the database LOG table between two dates
     * @param string from_date The date to begin with
     * @param string to_date The date to end with
     * @return array The resulting data array
     */
    public function getLog($from_date, $to_date) {
        $conn = PantryDatabase::connect();
        $safe_from_date = $conn->quote($from_date);
        $safe_to_date = $conn->quote($to_date);

        $query = 'EXEC get_log ' . $safe_from_date . ', ' . $safe_to_date . ";";

        $statement = $conn->prepare($query);
        $statement->execute(array($from_date, $to_date));

        $data_array = array();
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data_array[] = $result;
        }
        return $data_array;
    }

    /**
     * Deletes LOG entry by record_id
     * @param int id
     */
	public function deleteLogRecord($record_id) {
		$conn = PantryDatabase::connect();
        $safe_record_id = $conn->quote($record_id);

        $query = 'EXEC delete_log_record ' . $safe_record_id . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($record_id));
	}

    /**
     * Executes the stored procedure add_log to add a new log entry to the log table.
     * @param $staff_id string ID of the staff member sending the notification
     * @param $message string message being sent to the subscribers
     * @param $date string date the message is being sent
     * @param $sent_count string the number of subscribers it is being sent to
     */
    public static function addLog($staff_id, $message, $date, $sent_count) {
        $conn = PantryDatabase::connect();
        $query = 'EXEC add_log ' .
            $conn->quote($staff_id) . ', ' .
            $conn->quote($message) . ', ' .
            $conn->quote($date) . ', ' .
            $conn->quote($sent_count);
        $statement = $conn->prepare($query);
        $statement->execute(array($staff_id, $message, $date, $sent_count));
    }

    /**
     * Gets the data on all the subscribers in the database, using a stored procedure in the database
     * @return array The resulting data array
     */
    public static function getSubscribers() {
        $conn = self::connect();
        $query = 'EXEC get_subscribers;';
        $statement = $conn->prepare($query);
        $statement->execute();

        $data_array = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data_array[] = $row;
        }
        return $data_array;
    }
}
