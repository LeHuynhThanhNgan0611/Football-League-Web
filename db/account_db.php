<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    require_once('db.php');

    function login($username, $password){
        $conn = create_connection();
        $sql = "select * from account where username = ?";

        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$username);

        if (!$stm->execute()) return ['Cannot login please contact your admin',False];

        $result = $stm->get_result();
        if($result->num_rows !==1) return ['Cannot login, invalid username or password',False];

        $data = $result->fetch_assoc();
        $hashed = $data['password'];
        
        if(!password_verify($password,$hashed)) return ['Cannot login, invalid username or password',False];

        $activated = $data['activated'];
        if($activated === 0) return ['Cannot login, this account has not been activated',False];
        return [$data,True];
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function register($username, $firstname, $lastname, $email,$password){
        $sql = "select count(*) from account where username = ? or email = ?";
        $conn = create_connection();

        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$username,$email);
        $stm->execute();
        
        $result = $stm->get_result();
        $exists = $result->fetch_array()[0] === 1;

        if($exists){
            return "Cannot register because this username or email is already taken";
        }
        $hashed = password_hash($password,PASSWORD_DEFAULT);
        $token = generateRandomString();
        $sql = "insert into account(username, firstname, lastname, email, password, activated, activate_token) value(?,?,?,?,?,0,'$token')";

        $stm = $conn->prepare($sql);
        $stm->bind_param('sssss',$username,$firstname,$lastname,$email,$hashed);
        if(!$stm->execute()) return false;
        sendActiveEmail($email,$token);
        return true;
    }
    function sendActiveEmail($email,$token){


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'luansuunhi2002@gmail.com';                     //SMTP username
            $mail->Password   = 'xlhtmvkxhohdoovn';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('luansuunhi2002@gmail.com', 'Admin Luannek');
            $mail->addAddress($email, 'Người Nhận');     //Add a recipient
            /*$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');*/

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verify your account';
            $mail->Body    = "Click <a href='http://localhost/Test2/activate.php?email=$email&token=$token'>Here</a> to activate your account";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    function activeAccount($email,$token){
        $sql = 'select username from account where email = ? and activated = 0 and activate_token = ? ';
        $conn = create_connection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$email,$token);

        if(!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute command');
        }
        $result = $stm->get_result();
        if($result->num_rows == 0){
            return array('code' => 2,'error' => 'Email address or token not found');
        }
        $sql = "update account set activate_token = '', activated = 1 where email = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$email);
        if(!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute command');
        }
        return array('code'=> 0,'message' => 'Account activated');      
    }
    function checkAdmin($email){
        $sql = 'select * from admin where email = ?';
        $conn = create_connection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$email);
        $stm->execute();
        $rs = $stm->get_result();
        $data = $rs->fetch_assoc();
        if($rs->num_rows == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
?>
