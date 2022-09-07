<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (! function_exists('view')) {
    /**
     * ---------------------------------------------------------------
     * GET A VIEW
     * ---------------------------------------------------------------
     * First parameter will be the page to include. Second parameter,
     * if not null, will be saved in global $_SESSION data
     */
    function view($view, array $data = null) {

        if (isset($data) && is_array($data)) {

            foreach ($data as $k => $v) {

                $_SESSION[$k] = $v;

            }

        }

        $page = VIEWDIR . $view . '.php';

        if (is_file($page)) {

            include $page;

        }

    }

}

if (! function_exists('template')) {
    /**
     * ---------------------------------------------------------------
     * DEFAULT TEMPLATE FOR VIEWS
     * ---------------------------------------------------------------
     * First parameter will be treated as a page view and included
     * widh the header and footer view using global view() function.
     * The second parameter wether is null or not will be passed to
     * the first view() function
     * 
     * @param string $view
     * @param array $data
     */
    function template($view, array $data = null) {

        view('templates/header', $data);

        view($view, $data);

        view('templates/footer');
    
    }

}

if (! function_exists('model')) {
    /**
     * ---------------------------------------------------------------
     * CREATE MODEL OBJECT
     * ---------------------------------------------------------------
     * 
     * Creates a model object with the parameter given.
     * 
     * This method expects you type the classname of the model like:
     * 'ModelName::class', separating the elements in an array by the 
     * char '\' and creating then a string starting with the models
     * namespace followed by the last element of the array.
     * 
     * @param string $model
     * 
     * @return instance
     * 
     * @template object of Models
     */
    function model($model) {

        $class = explode('\\', $model);

        $model = "\\Models" . "\\" . end($class);

        return new $model;

    }

}

if (! function_exists('get')) {
    /**
     * ---------------------------------------------------------------
     * GET GLOBAL PARAMETERS
     * ---------------------------------------------------------------
     * 
     * Returns value of param given from $_GET global or null if it's 
     * not set.
     * 
     * @param string $param
     * 
     * @return null|mixed
     */
    function get($param) {
    
        if (isset($_GET[$param])) {
    
            return $_GET[$param];
    
        }
    
        return null;
    
    }

}

if (! function_exists('esc')) {
    /**
     * ---
     * Get a parameter from session
     * -
     * Returns the value of param given from $_SESSION global. Returns
     * null if the param is not set.
     * 
     * @param string $param
     * 
     * @return null|mixed
     */
    function esc($param) {

        if (isset($_SESSION[$param])) {

            return $_SESSION[$param];

        }

        return null;
        
    }
}

if (! function_exists('loggedIn')) {

    function loggedIn() {

        if (empty($_SESSION[session_id()]['user']['username'])) {

            return false;
        
        }
    
        return true;

    }

}

if (! function_exists('randomChar')) {

    function randomChar() {

        return chr(random_int(65, 90));

    }

}

if (! function_exists('generateCode')) {

    function generateCode() {

        $code = "";

        for ($i = 0; $i < 5; $i++) {

            $code = $code . random_int(1, 9) . randomChar();

        }

        return $code;

    }

}


if (! function_exists('pwdReset')) {

    function pwdReset() {

        $mail = new PHPMailer();

        $from = 'erica.pastor@asesormasmovil.es';

        $pwd = 'Aqws*5656';

        $to = $_POST['email'];

        $user = $_POST['username'];

        $code = generateCode();

        try {

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            
            $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
            
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            
            $mail->Username   = $from;                                    //SMTP username

            $mail->Password = $pwd;
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            
            $mail->Port       = 587;         
            
            $mail->CharSet    = PHPmailer::CHARSET_UTF8;
            
            //Recipients
            $mail->setFrom($from, 'Recuperación de contraseña');
            
            $mail->addAddress($to);                                     // address of destiny
            
            $mail->addReplyTo($from, 'Information');

            $mail->isHTML(true);

            $mail->Subject = 'Recuperación de contraseña';

            $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <head>
                    <meta charset='utf-8'>
                    <title>
                        Estilos correo
                    </title>
                    <meta name='description' content='RowReorder'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui'>
                </head>
            </head>
            <body>
                <h1>Hola, $user</h1>
                <p>Copia y pega <a href='http://localhost/monitoring/?newPassword&code=$code'>aquí</a> el siguiente codigo:</p>
                <h3 class>$code</h3>
            </body>
            </html>
            ";

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            setcookie('temporaryCode', $code, time() + 600);

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }

}