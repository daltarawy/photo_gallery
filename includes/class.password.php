<?php

// This class will not be used in this application since there is no create user form.

Class Password{
    public $password;
    Public $hashed_password;
    
    function __construct(){
        echo "string";
    } 
    
    public function password_encrypt($password) {
    $hash_format = '$y2$10$';
    $salt_length = 22;
    $salt = generate_salt($salt_length);
    $foramt_and_salt = $hash_format . $salt;
    $this->hashed_password = crypt($password, $foramt_and_salt);

}
}
?>