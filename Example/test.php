<?php
require 'vendor/autoload.php';

use Rere\Wallet\WalletClient;

//new WalletClient
$client = new WalletClient();

//create a wallert
$res = $client->createWallet();
var_dump($res);

