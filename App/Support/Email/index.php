<?php
require '../../../vendor/autoload.php';

use App\Support\Email\Email;

$email = new Email();
$email->add("Ocorreu um problema no seu site","<h1>Deu merda</h1>","Pedro Monteiro Yoshimura","ropehapi@gmail.com")->send();

if(!$email->error()){
    var_dump(true);
}else{
    echo $email->error()->getMessage();
}