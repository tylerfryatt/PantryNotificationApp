<?php
/**
 * Course: CIS234a
 * Author: Tyler Fryatt <tyler.fryatt@pcc.edu>
 * Date: 5/8/2019
 * Details:
 * signup button event that checks
 * form data format and queries the
 * database to check if user already exists
 * and if not inserts new user data into the database.
 */




if ( isset( $_POST[ 'signup-submit' ] ) ) {

    require 'PantryDatabase.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];
    $name = $_POST['name'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    /**
     * Requires email to meet email format requirements
     * Requires password to contain 1 upper case,
     * 1 lower case, 1 number, passwords match
     * and a minimum length of 8 characters
     */

    if (empty($username) || empty($email) || empty($password) || empty($password_repeat) || empty($name)) {
        header("Location: ../signup.php?signup-error=emptyfields&uid=" . $username . "&mail=" . $email);
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?signup-error=invalidmail&uid=" . $username);
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup-error=invalidmail&uid=" . $email);
            exit();
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?signup-error=invaliduid&mail=" . $email);
            exit();
        } else if ($password !== $password_repeat) {
        header("Location: ../signup.php?signup-error=passwordcheck&uid=" . $username . "&mail=" . $email);
            exit(); }
    else if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            header("Location: ../signup.php?signup-error=PasswordNotStrongEnough" );
            exit();

        /**
         * Query function checking email &
         * username for unique values
         */

    } else {
        $db = new PantryDatabase();
        /**
         * Gets array of user data in database based on username (will be false if there is an empty dataset returned
         * @param string $username The username entered
         * @return array The user data
         */
        $username_check = $db->lookupUser($username);
        /**
         * Gets array of user data in database based on email address (will be false if there is an empty dataset returned)
         * @param string $email the email address entered
         * @return array The user data
         */
        $email_check = $db->lookupUser($email);

        /**
         * If the dataset from $username_check or $email_check are not empty, then an error is shown
         */
        if(($username_check) && ($email_check)) {
            header("Location: ../signup.php?signup-error=usertaken");
            exit();
        } else {
            /**
             * password_hash function using
             * bcrypt algorithm and provides
             * automatic password salt.
             * @param $password 'value in
             * the signup password field'
             * @return string 'hash'
             *
             */
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $username = $_POST['uid'];
            $email = $_POST['mail'];
            $password = $_POST['pwd'];
            $password_repeat = $_POST['pwd-repeat'];
            $name = $_POST['name'];
            $role = 'subscriber';





            $db = new PantryDatabase();
            /**
             * Calls PantryDatabase class method addUser, which inserts a new row in database
             */
            $new_user = $db->addUser($username, $name, $role, $email, $hashed_password);

            /**
             * Prepared statement to help prevent sql injection attacks
             *
             */
            if (in_array(null, $new_user, true) || in_array('', $new_user, true)) {
                echo "Row insertion failed.\n";
                die(print_r(sqlsrv_errors(), true));}


            else {
                header("Location:../index.php?signup=success");
            }
        }
    }
}




