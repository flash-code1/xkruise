<?php
include("connect.php");
session_start();
require '../paystack/src/autoload.php';
?>
<?php
$ssint_id = $_SESSION["id"];
$user = $_SESSION["username"];
$email = $_SESSION["email"];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$location = $_POST['location'];
$car_id = $_POST['car_id'];
$ext_ride = $_POST['ext_ride'];
$pm = $_POST['pm'];

$digits = 10;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$reference = $randms;

$amount = 3000 * $ext_ride;
if($pm == "card") {
    $paystack = new Yabacon\Paystack('sk_live_7a99fb53dc3a75d55a2d33fcda3349c8efff7363');
    try
    {
      $tranx = $paystack->transaction->initialize([
        'amount'=>$amount,       // in kobo
        'email'=>$email,         // unique to customers
        'reference'=>$reference, // unique to transactions
      ]);
    } catch(\Yabacon\Paystack\Exception\ApiException $e){
      print_r($e->getResponseObject());
      die($e->getMessage());
    }

    // store transaction reference so we can query in case user never comes back
    // perhaps due to network issue
    'save_last_transaction_reference'.($tranx->data->reference);

    // redirect to page so User can pay
    header('Location: ' . $tranx->data->authorization_url);

      // Retrieve the request's body and parse it as JSON
      $event = Yabacon\Paystack\Event::capture();
      http_response_code(200);
  
      /* It is a important to log all events received. Add code *
       * here to log the signature and body to db or file       */
      openlog('MyPaystackEvents', LOG_CONS | LOG_NDELAY | LOG_PID, LOG_USER | LOG_PERROR);
      syslog(LOG_INFO, $event->raw);
      closelog();
  
      /* Verify that the signature matches one of your keys*/
      $my_keys = [
                  'live'=>'sk_live_7a99fb53dc3a75d55a2d33fcda3349c8efff7363',
                  'test'=>'sk_test_426a49a1de5aa7a50b720622c66151fbb103618d',
                ];
      $owner = $event->discoverOwner($my_keys);
      if(!$owner){
          // None of the keys matched the event's signature
          die();
      }
  
      // Do something with $event->obj
      // Give value to your customer but don't give any output
      // Remember that this is a call from Paystack's servers and
      // Your customer is not seeing the response here at all
      switch($event->obj->event){
          // charge.success
          case 'charge.success':
              if('success' === $event->obj->data->status){
                  // TIP: you may still verify the transaction
                  // via an API call before giving value.
                  $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    if(!$reference){
      die('No reference supplied');
    }

    // initiate the Library's Paystack Object
    $paystack = new Yabacon\Paystack('sk_live_7a99fb53dc3a75d55a2d33fcda3349c8efff7363');
    try
    {
      // verify using the library
      $tranx = $paystack->transaction->verify([
        'reference'=>$reference, // unique to transactions
      ]);
    } catch(\Yabacon\Paystack\Exception\ApiException $e){
      print_r($e->getResponseObject());
      die($e->getMessage());
    }

    if ('success' === $tranx->data->status) {
      // transaction was successful...
      // please check other things like whether you already gave value for this ref
      // if the email matches the customer who owns the product etc
      // Give value
    }
              }
              break;
      }
} else {

}

?>