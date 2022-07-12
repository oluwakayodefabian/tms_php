<?php
function validateRegistration($post_data)
{
    $errors = array();
    // Error Handling
    if (empty($post_data['first_name'])) {
        array_push($errors, "First name is required");
    }
    if (empty($post_data['last_name'])) {
        array_push($errors, "Last name is required");
    }
    if (empty($post_data['admin_username'])) {
        array_push($errors, "Username is required");
    }
    if (empty($post_data['admin_email'])) {
        array_push($errors, "Email is required");
    }
    if (empty($post_data['admin_password'])) {
        array_push($errors, "Password is required");
    }
    if (empty($post_data['role'])) {
        array_push($errors, "You have to choose a role");
    }
    // Validate email
    if (!filter_var($post_data['admin_email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid Email");
    }
    // Create a search pattern to check for a valid username
    if (!preg_match("/^[a-zA-Z0-9]*$/", $post_data['admin_username'])) {
        array_push($errors, "Invalid username");
    }

    return $errors;
}

function validateProperties($post_data)
{
    $errors = array();
    // Error Handling
    if (empty($post_data['country'])) {
        array_push($errors, "Country where the property is located is required");
    }
    if (empty($post_data['state'])) {
        array_push($errors, "State where the property is located is required");
    }
    if (empty($post_data['city'])) {
        array_push($errors, "City where the property is located is required");
    }
    if (empty($post_data['rent_amount'])) {
        array_push($errors, "The rent amount for the property is required");
    }
    if (empty($post_data['description'])) {
        array_push($errors, "A brief description for the property is required");
    }
    if (empty($post_data['address'])) {
        array_push($errors, "The address for the property is required");
    }
    if (empty($post_data['property_status'])) {
        array_push($errors, "The current status for the property is required");
    }

    return $errors;
}
