<?php
/**
 * Golem CMS - The Rock Solid CMS. <http://darrin.roenfanz.info/golemcms>
 * Copyright (C) 2008 Darrin Roenfanz <darrin@roenfanz.info>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 */
 
class GC_User 
{
    private $db;
    private $username;
    private $real_name;
    private $email;
    private $permission_level;
    private $active;
    private $logged_in;

    public function __construct($db) {
        @session_start();
        $this->db = $db;

        if ($this->isLoggedIn() === true) {
            $username = $_SESSION['username'];
            $query = 'SELECT username, realname, email, active, permission_level FROM users WHERE username = ?';

            if ($stmt = $this->db->prepare($query)) {
                $stmt->bind_param('s', $username);
                $stmt->execute();               /* execute statement */
                $stmt->bind_result( $user, $real_name, $email, $active, $permission_level );

                if($stmt->fetch()) {
                    $this->logged_in = true;
                    $this->username = $user;
                    $this->real_name = $real_name;
                    $this->email = $email;
                    $this->active = $active;
                    $this->permission_level = $permission_level;
                    $this->setSession();
                }
            $stmt->close();
            }
        }
    }
    
    // Add User to the SQL
    public function add($username, $password, $real_name, $email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $query = 'INSERT INTO users (username, password, realname, email, active, permission_level) VALUES (?,?,?,?);';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ssss', $username, md5($password), $real_name, $email );
            $stmt->execute();
            $stmt->close();
        }
    }
  // setActivation() ?
    public function activate($username) {
        $query = 'UPDATE users SET active = 1 WHERE username = ?;';
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->close();
        }
    }


    // Remove User from the SQL
    // This function isn't finished
    public function delete($username, $password) { 
        $query = 'DELETE FROM users WHERE username = ? and password = ?;';
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('si', $username, $password);
            $stmt->execute();
            $stmt->close();
        }
    }
    // This function isn't finished
    public function isLoggedIn() {
        return $_SESSION['logged_in'];
    }
    
    public function isRemembered() {
    }
    
    //attempt to login false if invalid true if correct
    public function login($username, $password) {
    $this->logged_in = false;

        $query = 'SELECT username, realname, email, active, permission_level FROM users WHERE username = ? AND password = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', $username, md5($password));
            $stmt->execute();               /* execute statement */
            $stmt->bind_result( $user, $real_name, $email, $active, $permission_level );

            if($stmt->fetch())
            {
                $this->logged_in = true;
                $this->username = $user;
                $this->real_name = $real_name;
                $this->email = $email;
                $this->active = $active;
                $this->permission_level = $permission_level;
                $this->setSession();
            }
            $stmt->close();
        }
    return $this->logged_in;
    }

  // This function isn't finished
    public function logout() {

        if($this->isLoggedIn()) {
            $this->logged_in = false;
            $this->username = '';
        }
        $this->setSession();

    }


  // Allow User to Reset/Change Password.
    public function setPassword($oldPass, $newPass) {
        $username = $_SESSION['username'];
        $query = 'UPDATE users SET password = ? WHERE username = ? AND password = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('sss', md5($newPass), $username, md5($oldPass));
            $stmt->execute();
            $stmt->close();
        }
    }

  // Allow User to change Email
    public function setEmail($newEmail) {
        $newEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);
        $username = $_SESSION['username'];
        $query = 'UPDATE users SET email = ? WHERE username = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', $newEmail, $username);
            $stmt->execute();
            $stmt->close();
        }
    }

  // Allow User to change his real/displayed name
    public function setRealName($newName) {
        $username = $_SESSION['username'];
        $query = 'UPDATE users SET realname = ? WHERE username = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', $newName, $username);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function setUserLevel($userlevel, $password) {
        $username = $_SESSION['username'];
        $query = 'UPDATE users SET userlevel = ? WHERE username = ? AND password = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('iss', $userlevel, $username, md5($password));
            $stmt->execute();
            $stmt->close();
        }
    }
  // Fetch Username
    public function getUsername() {
        return $this->username;
    }
  // Fetch User's Email
    public function getEmail() {
        return $this->email;
    }

  // Fetch User's Real/Displayed Name
    public function getRealName() {   
       return $this->real_name;
    }

  // Fetch User's Admin Level
    public function getUserLevel() {
        return $this->permission_level;
    }

  // Generate a new password
    public function generatePassword() {
        $salt = "abchefghjkmnpqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;

        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        $username = $_SESSION['username'];
        $query = 'UPDATE users SET password = ? WHERE username = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', md5($pass), $username);
            $stmt->execute();
            $stmt->close();
        }
        return $pass;
    }

  /* Non-public functions follow */
    private function setSession()  {
        $_SESSION['username'] = $this->username;
        $_SESSION['logged_in'] = $this->logged_in;
        $_SESSION['uid'] = session_id();
    }
    private function getSession() { }

    private function generateCookie($username) {
        $cookie = md5(uniqid(mt_rand(1, mt_getrandmax())));
        return $cookie;
    }

    public function updateCookie($cookie, $save) {
        $_SESSION['cookie'] = $cookie;

        if ($save) {
            $query = 'UPDATE users SET cookie = ? WHERE username = ?';
            if ($stmt = $this->db->prepare($query)) {
                $stmt->bind_param('ss', $cookie, $this->username);
                $stmt->execute();
                $stmt->close();
            }

            $cookie = serialize(array($_SESSION['username'], $cookie));
            setcookie('WebLogin', $cookie, time() + 2592000, '/'); // 30 days

            $_COOKIE['WebLogin'] = addslashes($cookie);
        }
    }

    // This method is used to check that the cookie is valid
    /*
    private function checkRemembered($cookie) {
        list($username, $cookie) = @unserialize(stripslashes($cookie));

        if (!$username || !$cookie) {
            return;
        }

        $query = 'SELECT * FROM users WHERE username = ? AND cookie = ?';
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', $this->username, $cookie);
            $stmt->execute();
            $stmt->close();

            if $stmt->fetch() {
                $this->setSession($row, true);
            }
        }
    }
    */
}
?>