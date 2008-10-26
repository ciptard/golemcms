<?php
class User {
    private $db;
    private $username = '' ;
    private $real_name = '' ;
    private $email = '';
    private $level = 0 ;
    private $activated = 0;
    private $logged_in = false;

  // This function isn't finished
    public function __construct($db) {
        @session_start();
        $this->db = $db;

        /*
        if ($_SESSION['logged_in'] === true) {
          // Do something to make sure the session is valid
        }
        */
    }
    
   
  // Add User to the SQL
    public function add($username, $password, $real_name, $email, $activated=0) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $query = 'INSERT INTO users (username, password, realname, email, activated) VALUES (?,?,?,?,?)';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ssssi', $username, md5($password), $real_name, $email, $activated);
            $stmt->execute();
            $stmt->close();
        }
    }
  // setActivation() ?
    public function activate($username) {
        $query = 'UPDATE users SET activated = ? WHERE username = ? AND activated = ? LIMIT 1';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('isi', 1, $username, 0);
            $stmt->execute();
            $stmt->close();
        }
    }


    // Remove User from the SQL
    // This function isn't finished
    public function remove($user, $pass) { }

    // This function isn't finished
    public function isLoggedIn() {
        return $_SESSION['logged_in'];
    }

    //attempt to login false if invalid true if correct
    public function login($username, $password) {
    $this->logged_in = true;

        $query = 'SELECT username, realname, email, activated, permission_level FROM users WHERE username = ? AND password = ?';

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param('ss', $username, md5($password));
            $stmt->execute();               /* execute statement */
            $stmt->bind_result( $user, $real_name, $email, $activated, $level );

            if($stmt->fetch())
            {
                $this->logged_in = true;
                $this->username = $user;
                $this->real_name = $real_name;
                $this->email = $email;
                $this->activated = $activated;
                $this->level = $level;
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
            $this->setSession();
        }
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

  // Fetch User's Email
    public function getEmail()
    {
        return $this->email;
    }

  // Fetch User's Real/Displayed Name
    public function getRealName()
    {   
        $realname = $this->real_name;
        return $realname;
    }

  // Fetch User's Admin Level
    public function getUserLevel()
    {
        return $this->level;
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