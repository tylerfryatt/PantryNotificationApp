<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 6/1/2019
 * Time: 3:31 PM
 */


            if ( isset( $_GET[ 'error' ] ) ) {

                if( $_GET[ 'error' ] == "edit-email" ) {
                    echo '    <head><script>alert(\'Error: Email already exists!\')</script></head>';
                }
                if( $_GET[ 'error' ] == "emptyfields" ) {

                    echo '    <head><script>alert(\'Error: All fields must be filled out!\')</script></head>';

                } if ( $_GET[ 'error' ] == "UserDoesNotExist" ) {

                    echo '    <head><script>alert(\'Error: User does not exist!\')</script></head>';

                }if ( $_GET[ 'error' ] == "edit-username" ) {

                    echo '    <head><script>alert(\'Error: Invalid Username\')</script></head>';

                }else if ($_GET['error'] == "PasswordNotStrongEnough") {

                    echo '    <head><script>alert(\'Error: Password is too weak!\')</script></head>';

                }else if ($_GET['error'] == "passwordcheck") {

                    echo '    <head><script>alert(\' Error: Passwords do not match!\')</script></head>';

                }

                
                }else if(isset($_GET['login-error'])){
                    if ( $_GET[ 'login-error' ] == "UserDoesNotExist" ) {

                        echo '    <head><script>alert(\'Error: User does not exist!\')</script></head>';

                    } else if ( $_GET[ 'login-error' ] == "WrongPassword" ) {

                        echo '    <head><script>alert(\'Error: Password is incorrect!\')</script></head>';

                    } if( $_GET[ 'login-error' ] == "emptyfields" ) {

                    echo '    <head><script>alert(\'Error: All fields must be filled out!\')</script></head>';

                }

            } else if (isset( $_GET[ 'signup' ] )) {
                if ($_GET['signup'] == "success") {
                    echo ' <head><script>alert("Account created successfuly!")</script></head>';
                }

            }else if(isset($_GET['reset'])) {
                if ($_GET['reset'] == "successful") {

                    echo '    <head><script>if (window.confirm(\'Your password was successfully reset!\')) 
{
                                        window.location.href=\'../index.php\';
}
                                    </script></head>';
                    }

                   if($_GET['reset'] == "emailchangesuccessful") {
                        echo '    <head><script>alert(\'Your Email was successfully changed\')</script></head>';
                    }  if($_GET['reset'] == "usernamechangesuccessful") {
                        echo '    <head><script>alert(\'Your username was successfully changed\')</script></head>';
                    }

            }else if (isset($_GET['mail-send'])) {
                if($_GET['mail-send'] == 'successful') {

        echo '<head><script>alert(\'An account recovery link has been sent to your email\')</script></head>';

           }else if(isset($_GET['mail-send'])) {
        if ($_GET['mail-send'] == 'failed') {
            echo '<head><script>alert(\'Oops.. something went wrong\')</script></head>';
        }
    }
}
