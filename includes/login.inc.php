<?php
/**
 * Created by PhpStorm.
 * Course: CIS234a
 * Author: Tyler Fryatt <tyler.fryatt@pcc.edu>
 * Date: 5/8/2019
 * Details:
 * Login button event file executed
 * when user clicks on the login
 * submit button.
 */

if ( isset( $_POST[ 'login-submit' ] ) ) {

    require 'PantryDatabase.php';

    $mail_username_id = $_POST['mailuid'];
    $password = $_POST['pwd'];

    /**
     * Makes sure none of the input
     * values of the login form are empty.
     * @param $password 'value in the login password field'
     * @param $mail_username_id 'value in the username field'
     * @return true/false
     *
     */
    if (empty($mail_username_id) || empty($password)) {
        header("Location: ../index.php?login-error=emptyfields");
        exit();

        }
        else {
        $db = new PantryDatabase();
        /** gets array of user data in database based on username (will be false if an empty database is returned)
         * @param $mail_username_id
         * @return $user array The array of user data
         */
        $user = $db->lookupUser($mail_username_id);
        /**
         * If $user is false (which would mean that the user doesn't exist), it shows an error         *
         */
        if(!$user) {
            header( "Location: ../index.php?login-error=UserDoesNotExist" );
            exit();
        }

        /**
         * password_verify function hashing the
         * '$password' value passed in as the first
         * argument and checking it against the hash
         * value of in the row array. If they are the same
         * a new session is started using the data in the row.
         * If they aren't the same no session is started.
         *
         * @param $password 'value in the login password field'
         * @param $row['hash'] 'specifies the hash column in the row'
         */

        if ( password_verify( $password, $user[ 'hash' ] )){
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_uid'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role_title'];
            $_SESSION['user_role'] = $user['role_id'];
            $_SESSION['name'] = $user['name'];

            if($_SESSION['user_role'] === '1'){
                header("Location: student_dashboard_content.php?=success");
                exit();
            } if($_SESSION['user_role'] === '2') {
                header('Location: manager_dashboard_content.php?=success');
                exit();
            }




        } else {
            header( "Location: ../index.php?login-error=WrongPassword" );
            exit();
        }
    }
}
else {
header( "Location: ../index.php" );
exit();
}


