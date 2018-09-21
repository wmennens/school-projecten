<?php
echo "hell";
$file_tmp_name = 'pdfjes/presentatiepdg.pdf';
$file_size = 400000;

$handle = fopen($file_tmp_name, "r");
$content = fread($handle, $file_size);
fclose($handle);
$encoded_content = chunk_split(base64_encode($content));

$from_email = '4plus7@gmail.com';
$reply_to_email = '4plus7@gmail.com';

$boundary = md5("sanwebe");
$message = 'Dit is een test.';

//header
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From:".$from_email."\r\n";
$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

//plain text
$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split(base64_encode($message));

//attachment
$body .= "--$boundary\r\n";
// LET OP FILETYPE
$body .="Content-Type: PDF; name=".$file_tmp_name."\r\n";
$body .="Content-Disposition: attachment; filename=".$file_tmp_name."\r\n";
$body .="Content-Transfer-Encoding: base64\r\n";
$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
$body .= $encoded_content;

$recipient_email = '14511@ma-web.nl';
$subject = 'Testing testing';

$sentMail = mail($recipient_email, $subject, $body, $headers);

if($sentMail) //output success or failure messages
{
    die('Thank you for your email');
}else{
    die('Could not send mail! Please check your PHP mail configuration.');
}

echo 'Doeg!';
