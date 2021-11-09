<?php
require_once("functions.php");
/** */
/**** Démarrage de la session ****/
/** */
session_start();

/** */
/**** Récuperation des données du formulaire ****/
/** */
if (isset($_POST)){
    
  if(isset($_POST['nom'])){
      $nom = $_POST['nom'];
  }

  if (isset($_POST['prenom'])) {
      $prenom = $_POST['prenom'];
  }

  if(isset($_POST['pseudo'])){
      $pseudo=$_POST['pseudo'];
  }
  if(isset($_POST['password'])){
      $password = $_POST['password'];
  }

  if(isset( $_POST['verif_password'])){
      $verifpassword = $_POST['verif_password'];
  }

  if (isset($_POST['mobile'])) {
    $mobile = $_POST['mobile'];
  }

  if (isset($_POST['naissance'])) {
    $naissance = $_POST['naissance'];
  }

  if (isset($_POST['email'])) $email = nettoyerTexte($_POST['email']);

  /** */
  /**** Vérification des données entrées par l'utilisateur ****/
  /** */
  // if($nom && $prenom)

  $_SESSION['error']='';
  // stan =)
  if (!isset($pseudo) OR !preg_match("/[\w]{8,}/", $pseudo)) {
    $_SESSION['error'] .= "Le pseudo doit contenir minimum 8 caractères alphanumériques uniquement<br/>";
  }

  //Jojo
  if(!isset($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['error'] .= "L'adresse e-mail ne doit pas être vide'<br/>";
  }

  //julien
  if (!isset($naissance) OR !preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $naissance)){
    $_SESSION['error'] .= "veuillez respecter le format jj/mm/aaaa<br/>";
  }


  //mike

  if(!preg_match("/.{8,}/", $password)){
    $_SESSION['error'].="le mot de passe doit contenir minimum 8 caracterères.<br/>";
  }

  if(!preg_match("/[a-z]/", $password)){
    $_SESSION['error'].="le mot de passe doit contenir une lettre minuscule.<br/>";
  }

  if(!preg_match("/[A-Z]/", $password)){
    $_SESSION['error'].="le mot de passe doit contenir une lettre majuscule.<br/>";
  }

  if(!preg_match("/[0-9]/", $password)){
    $_SESSION['error'].="le mot de passe doit contenir un chiffre.<br/>";
  }

  if(!preg_match("/\W/", $password)){
    $_SESSION['error'].="le mot de passe doit contenir un caractères special.<br/>";
  }

  if($password!=$verifpassword){
    $_SESSION['error'].="les mots de passe ne sont pas identiques.<br/>";
  }

  // Romain
  if(!isset($mobile) OR !preg_match("/^(0|\+33)[1-9]([. ]?[0-9]{2}){4}$/", $mobile)) {
      $_SESSION['error'].="Le numéro de mobile n'est pas conforme.<br/>";
  }

  if (!empty($_SESSION['error'])){
    header('location: ./index.php');
    exit;
  }
  else
  {
    /*
    Extrait de la doc PDO disponible à l'adresse : https://www.php.net/manual/fr/pdo.construct.php:
    $dsn = 'mysql:dbname=testdb;host=127.0.0.1;port=3306';
    PDO::__construct ( string $dsn , string $username = ? , string $passwd = ? , array $options = ? )
    */
    $database = new PDO("mysql:host=localhost;port=3306;dbname=users","root","");
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->exec("SET NAMES 'utf8'");
    $requete = "INSERT INTO utilisateurs (nom, prenom, pseudo, email, mobile, mdp, date_naissance)
    VALUES(:nom,:prenom,:pseudo,:email,:mobile,:mdp,:date_naissance)";

    $prepare = $database->prepare($requete);
    $prepare->execute(array(
        ":nom"=>$nom,
        ":prenom"=>$prenom,
        ":pseudo"=>$pseudo,
        ":email"=>$email,
        ":mobile"=>$mobile,
        ":mdp"=>sha1($password),
        ":date_naissance"=>$naissance)
    );
    header("location: ./index.php");
  }
}






