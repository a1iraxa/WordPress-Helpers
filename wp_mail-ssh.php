<?php 

add_action( 'phpmailer_init', 'digitsol_mailer_config', 10, 1);
    
    function digitsol_mailer_config($phpmailer){
        $phpmailer->isSMTP();
        $phpmailer->Host       = 'mail.rainbowflag.com.au';
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = 465;
        $phpmailer->Username   = 'wordpress@rainbowflag.com.au';
        $phpmailer->Password   = 'DigitSol@12';
        $phpmailer->SMTPSecure = 'ssl';
        //CC and BCC
        // $phpmailer->addCC("cc@example.com");
        // $phpmailer->addBCC("bcc@example.com");
        // $phpmailer->From       = 'aligcs';
        // $phpmailer->FromName   = 'RainbowFlag';
        $phpmailer->SMTPDebug = 0; // write 2 for debugging
        $phpmailer->CharSet  = "utf-8";
        $phpmailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
    }
    
    add_action('wp_mail_failed', 'digitsol_log_mailer_errors', 10, 1);
    function digitsol_log_mailer_errors(){
        $fn = ABSPATH . '/digitsol-mail.log'; // say you've got a mail.log file in your server root
        $fp = fopen($fn, 'a');
        fputs($fp, "Mailer Error: " . print_r($mailer) ."\n");
        fclose($fp);
    }