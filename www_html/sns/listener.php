<?php
 
require __DIR__ . '/awsphp/aws-autoloader.php';
 
use Aws\Sns\MessageValidator\Message;
use Aws\Sns\MessageValidator\MessageValidator;
use Guzzle\Http\Client;

// Make sure the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die;
}

 try {
    // Create a message from the post data and validate its signature
    $message = Message::fromRawPostData();
    $validator = new MessageValidator();
    $validator->validate($message);
} catch (Exception $e) {
    // Pretend we're not here if the message is invalid
    http_response_code(404);
    die;
}


if ($message->get('Type') === 'SubscriptionConfirmation') {
    // Send a request to the SubscribeURL to complete subscription
    (new Client)->get($message->get('SubscribeURL'))->send();
    // Log the message
    $cur_date = date("Y-m-d-H:i:s");
    $file = new SplFileObject('/var/log/sns2sms/SubscribeMessages-$cur_date.info', 'a');
    $file->fwrite($message->get('Type') . ': ' . $message->get('Message') . "\n");
    $file->fwrite($message->get('Topic: ') . $message->get('TopicArn') . "\n");
}

//Log the message
$cur_date = date("Y-m-d-H-i-s");
$file = new SplFileObject("/var/log/sns2sms/messages-$cur_date.log", 'a');
$file->fwrite($message->get('Type') . ': ' . $message->get('Subject') . "\n" . 
              'Topic: ' . $message->get('TopicArn') . "\n");
$file->fwrite("\n  Message: \n\n".$HTTP_RAW_POST_DATA."\n\n");

//$current = file_get_contents($file);
// echo "$current";
//unlink($file);
//$dt = new DateTime();
//echo $dt->format('Y-m-d H:i:s') . "\n\n";

//$topic = $message->get('TopicArn');
//$msgType = $message->get('Type');
//$msgSubjct = $message->get('Subject');
//$msgCont =  $message->get('Message');
//$postBody = file_get_contents('php://input');
// JSON decode the body to an array of message data
//$message = json_decode($postBody, true);

$sms_file = "/var/log/sns2sms/messages-$cur_date.log"; 
$message = json_decode($HTTP_RAW_POST_DATA, true);
if ($message) {
    $topic = $message['TopicArn']; 
    $msgType = $message['Type'];
    $msgSubjct = $message['Subject'];
    $msgCont = $message['Message'];
    $log2file = "$topic"."\n".$msgType."\n".$msgSubjct."\n".$msgCont."\n";
    //file_put_contents($sms_file, $log2file, FILE_APPEND | LOCK_EX); 
}

include 'dbconnect.php';
$sql = "select table_name from topic_2_recipients where topic = '$topic'";
//$retval = mysql_query($sql);
$row = mysql_fetch_row(mysql_query($sql));
$tab_name = $row[0];
$sql = "select sms, email  from $tab_name";
$retval = mysql_query( $sql );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$MailRecs = " ";
while($row = mysql_fetch_array($retval))
{
    $MailRecs .= ", " . $row['email'] . ", " . $row['sms'];
}

   $from = "sns2sms@perion.com";
   $to = "$MailRecs";
   $header = "To: $MailRecs \r\n";
   $header .= "From: <sns2sms@perion.com>\r\n";
   $header .= "Subject: $msgSubjct\r\n";
   $txt = "\r\n-== Critical Error! ==-\r\n";
   $txt .= "\n$msgCont\n";
// In case any of our lines are larger than 70 characters, we should use wordwrap() 
   $message = wordwrap($txt, 70, "\n");
   $message = $header . "\n" . $message ;
   $mail2sms_file = "/tmp/sns2sms_mail_temp.txt";
   if (file_exists($mail2sms_file)) 
{ 
    unlink ($mail2sms_file);
} 
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
   $st = "\n\n ==================== Mail to SMS =====================\n";
   file_put_contents($sms_file, $st, FILE_APPEND | LOCK_EX);
   file_put_contents($sms_file, $message, FILE_APPEND | LOCK_EX);
   file_put_contents($mail2sms_file, $message, FILE_APPEND | LOCK_EX);
//   $current = file_get_contents($myfile);
//   echo "$current";
   shell_exec("/usr/sbin/sendmail -f$from $to < $mail2sms_file ");
if (file_exists($mail2sms_file)) 
{ 
    unlink ($mail2sms_file);
}


?>



