<?php
require_once('Database.php');
class User {
    private $conn;

    public function __construct(){
        $database = new Database();
        $dbConn = $database->getConnection();
        $this->conn = $dbConn;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function last_id() {
        return $this->conn->lastInsertId();
    }

    public function register($email, $first, $last, $phone , $password, $code) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users(email, first, last, phone , password, tokenCode) VALUES(:email, :first, :last, :phone , :password, :tokenCode)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":first", $first);
            $stmt->bindParam(":last", $last);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":password", md5($password));
            $stmt->bindParam(":tokenCode", $code);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $err) {
            echo "Connection error: {$err->getMessage()}";
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", md5($password));
            $stmt->execute();
            $user_record = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0) {
                if($user_record['userStatus'] == 'Y') {
                    $_SESSION['userSession'] = $user_record['id'];
                    $this->redirect('dashboard.php');
                } else {
                    header("Location: index.php?inactive");
                }
            } else {
                header("Location: index.php?error");
                exit();
            }

        } catch(PDOException $err) {
            echo "Connection error: {$err->getMessage()}";
        }
    }

    public function redirect($url) {
        header("Location: {$url}");
    }

    public function is_logged_in() {
        if(isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function log_out() {
        session_destroy();
        $_SESSION['userSession'] = false;
    }

    public function send_mail($email, $message, $subject) {
        require_once("../mailer/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username="bun.fong2009@gmail.com";
        $mail->Password="77889900";
        $mail->SetFrom('bun.fong2009@gmail.com','Web Developer');
        $mail->AddReplyTo("bun.fong2009@gmail.com","Web Developer");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}