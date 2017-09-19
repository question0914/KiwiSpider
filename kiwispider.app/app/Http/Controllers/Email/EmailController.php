<?php
namespace App\Http\Controllers\Email;
/**
 * Created by
 * User: zijianli
 * Date: 8/7/17
 * Time: 11:52 AM
 */
// Replace path_to_sdk_inclusion with the path to the SDK as described in
// http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html
define('REQUIRED_FILE','../../../../vendor/autoload.php');

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
define('SENDER', 'answer0914@gmail.com');

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
// You can insert multiple address into the $recipient array.
//define('RECIPIENT','recipient@example.com');

$recipient = array('895820518@qq.com', 'zjlee0914@yahoo.com');

// Replace us-west-2 with the AWS Region you're using for Amazon SES except US West (Oregon).
define('REGION','us-west-2');

//Subject of the email
define('SUBJECT','Updates to GitHub Terms of Service');

//Read content from a file as email body
$content = file_get_contents("/Users/zijianli/Desktop/email.txt");
define('BODY',$content);

require REQUIRED_FILE;

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

$client = SesClient::factory(array(
    'version'=> 'latest',
    'region' => REGION
));

$request = array();
$request['Source'] = SENDER;
$request['Destination']['ToAddresses'] = $recipient;
$request['Message']['Subject']['Data'] = SUBJECT;
$request['Message']['Body']['Text']['Data'] = BODY;

try {
    $result = $client->sendEmail($request);
    echo("Email sent! Message ID: ".$result->get('MessageId')."\n");

} catch (SesException $e) {
    echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
}

