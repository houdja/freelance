<?php 
require_once 'connexiondb.php';

$success = false;
$successMsg = '';
$errorMsg = '';

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        try{
            $query = 'INSERT INTO user (name, email, subject, message) VALUES (:name, :email, :subject, :message)';

            $stmt = $connection->prepare($query);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindValue(':message', $message, PDO::PARAM_STR);
            $stmt->execute();
            $successMsg = 'Le formulaire a bien été envoyé';
            $success = true;
        }catch(PDOException $e){
            $e->getMessage();
        }
    }else{
        $errorMsg = 'Adresse email incorrect';
        $error = true;
    }
}else{
    $errorMsg = 'Veuillez remplir les champs';
}

$data = [
    'successMsg' => $successMsg,
    'errorMsg' => $errorMsg,
];

echo json_encode($data);