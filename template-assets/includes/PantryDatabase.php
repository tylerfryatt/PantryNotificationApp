<?php

/**
 * Filename: PantryDatabase.php
 *
 * The PantryDatabase class
 * Contains all methods relevant to the 234a_PHPeeps database
 */
class PantryDatabase
{
    const DB_SERVER = "cisdbss.pcc.edu";
    const DB_DATABASE = "234a_PHPeeps";
    const DB_USER = "234a_PHPeeps";
    const DB_PASSWORD = "IfIhad100wishes#";

    private static $db = NULL;

    /**
     * Function: connect
     * Creates a connection to the database
     */
    private static function connect()
    {
        if (empty(PantryDatabase::$db)) {
            PantryDatabase::$db = new PDO("sqlsrv:Server=" . self::DB_SERVER . ";Database=" . self::DB_DATABASE, self::DB_USER, self::DB_PASSWORD);
        }
        return PantryDatabase::$db;
    }

    /**
     * ***********************************
     * DATABASE CODE FOR STORY 1
     * ***********************************
     */
    /**
     * Function: lookupUser
     * Gets data of a user based on a username or email address
     * @param $username String the username passed through
     * @return array The user's data in the database
     */
    public function lookupUser($username)
    {
        $conn = PantryDatabase::connect();
        $safe_username = $conn->quote($username);

        $query = 'SELECT * FROM [USER] FULL JOIN [USER_ROLE] ON [USER].user_id = [USER_ROLE].user_id FULL JOIN [ROLE] 
                    ON [ROLE].role_id = [USER_ROLE].role_id WHERE username=' . $safe_username . ' OR email=' . $safe_username;

        $statement = $conn->prepare($query);
        $statement->execute(array($safe_username));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Function: addUser
     * Inserts a user into the database
     * @param $username string the username which the user picked
     * @param $name string the name which the user picked
     * @param $role string the role of the user ("subscriber" by default)
     * @param $email string the email address of the user
     * @param $hash string the hashed password
     * @return array The newly created user's data
     */
    public function addUser($username, $name, $role, $email, $hash)
    {
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
     * ***********************************
     * DATABASE CODE FOR STORY 2
     * ***********************************
     */
    /**
     * Function getSubscribers()
     * Gets the data on all the subscribers in the database, using a stored procedure in the database
     * @return array The resulting data array
     */
    public static function getSubscribers() {
        $conn = self::connect();
        $query = 'CALL get_subscribers();';
        $statement = $conn->prepare($query);
        $statement->execute();

        $data_array = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data_array[] = $row;
        }
        return $data_array;
    }
    /**
     * ***********************************
     * DATABASE CODE FOR STORY 3
     * ***********************************
     */
    /**
     * Function getAllTemplates()
     * Gets the data on all the templates in the database, using a stored procedure in the database
     * @return array The resulting data array
     */
    public function getAllTemplates()
    {
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
     * Function: getSpecificTemplate
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     * @return array The resulting data array
     */
    public function getSpecificTemplate($template_id)
    {
        $conn = PantryDatabase::connect();

        $query = 'EXEC get_specific_template ' . $template_id . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_id));

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Function: getSpecificTemplate
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_name string The template's name
     *        $template_body string The template's body
     */
    public function createNewTemplate($template_name, $template_body)
    {
        $conn = PantryDatabase::connect();
        $template_name = $conn->quote($template_name);
        $template_body = $conn->quote($template_body);

        $query = 'EXEC create_new_template ' . $template_name . ', ' . $template_body . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_name, $template_body));
    }

    /**
     * Function: updateTemplate
     * Gets data on a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     *        $template_name string The template's name
     *        $template_body string The template's body
     */
    public function updateTemplate($template_id, $template_name, $template_body)
    {
        $conn = PantryDatabase::connect();
        $template_name = $conn->quote($template_name);
        $template_body = $conn->quote($template_body);

        $query = 'EXEC update_template ' . $template_id . ', ' . $template_name . ', ' . $template_body . ';';

        $statement = $conn->prepare($query);
        $statement->execute(array($template_id, $template_name, $template_body));
    }

    /**
     * Function: deleteTemplate
     * Deletes a specific template using a stored procedure in the database
     * @param $template_id int The template ID by which the appropriate template may be found
     */
    public function deleteTemplate($template_id)
    {
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
     * ***********************************
     * DATABASE CODE FOR STORY 4
     * ***********************************
     */
    /**
     * Function getLog()
     * Gets all the rows in the database LOG table between two dates
     * @param string from_date The date to begin with
     * @param string to_date The date to end with
     * @return array The resulting data array
     */
    public function getLog($from_date, $to_date)
    {
        $conn = PantryDatabase::connect();
        $safe_from_date = $conn->quote($from_date);
        $safe_to_date = $conn->quote($to_date);

        $query = "SELECT * FROM LOG L INNER JOIN \"USER\" U ON L.user_id = U.user_id WHERE CONVERT (date,L.date) BETWEEN " . $safe_from_date . " AND " . $safe_to_date . ";";

        $statement = $conn->prepare($query);
        $statement->execute(array($from_date, $to_date));

        $data_array = array();
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data_array[] = $result;
        }
        return $data_array;
    }

}
