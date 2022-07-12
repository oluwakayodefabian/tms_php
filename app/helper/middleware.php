<?php

/**
 *  What this method does is when you execute it before
 * a certain functionality it is going to restrict that
 * functionalty to logged in users 
 */
function usersOnly()
{
    // check if the admin user is not logged in
    if (empty($_SESSION['admin_id'])) {
        // $_SESSION['message']    = 'You need to log in first';
        // $_SESSION['type']       = 'error';
        header("Location: ../../auth/login.php?errMsg=You need to log in first");
        exit();
    }
}
function super_adminOnly()
{
    // check if a user is not logged in
    // or if the user is not an admin user
    if (!isset($_SESSION['role']) && $_SESSION['role'] != 'super_admin') {
        // $_SESSION['message']    = 'You are not Authorized';
        // $_SESSION['type']       = 'error';
        header("Location:../auth/dashboard.php?errMsg=You are not Authorized");
        exit();
    }
}
function adminOnly()
{
    // check if a user is not logged in
    // or if the user is not an admin user
    if ($_SESSION['role'] !== 'super_admin' || $_SESSION['role'] !== 'sub_admin') {
        // $_SESSION['message']    = 'You are not Authorized';
        // $_SESSION['type']       = 'error';
        header("Location: ../../index.php?errMsg=You are no Authorized");
        exit();
    }
}
/**
 * This method is used to restrict access to pages like 
 * the login page and register page for users that are 
 * already logged in
 */
function guestOnly()
{
    //Checking if the user is logged, if they are
    // They should not be allowed to visit the
    // login page and the register page
    if (isset($_SESSION['admin_id'])) {
        // $_SESSION['message']    = 'Logout to view the specified page';
        // $_SESSION['type']       = 'error';
        header("Location: ../auth/dashboard.php?errMsg=Logout to view the specified page");
        exit();
    }
}
