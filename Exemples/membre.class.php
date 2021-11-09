<?php
	class membre {
		
		private $login, $mdp, $mdp2, $email, $nom, $prenom, $pays, $d_naissance, $d_inscription, $BDD;
		
		public function __construct($_login, $_mdp, $_mdp2, $_email, $_nom = 'aucun', $_prenom = 'aucun', $_pays, $_d_naissance = '01/01/2000', $_d_inscription, $_BDD)
		{
			$this->login = $_login;
			$this->mdp = $_mdp;
			$this->mdp2 = $_mdp2;
			$this->email = $_email;
			$this->nom = $_nom;
			$this->prenom = $_prenom;
			$this->pays = $_pays;
			$this->d_naissance = $_d_naissance;
			$this->d_inscription = $_d_inscription;
			$this->BDD = $_BDD;

		}
		
		public function recuperer()
		{
			$recuperation = $this->BDD->prepare('SELECT login, courriel FROM membre WHERE UPPER(login) = "'.$this->login.'" OR courriel = "'.$this->email.'"'); 
			$resulte = $recuperation->execute();
			
			return $result;
		}
		
		public function creer()
		{		
			$insertion = $this->BDD->prepare('INSERT INTO membre(login, mot_de_passe, courriel, nom, prenom, pays, d_anniversaire, d_inscription) VALUES("'.$this->login.'", "'.SHA1($this->mdp).'", "'.$this->email.'", "'.$this->nom.'", "'.$this->prenom.'", "'.$this->pays.'", "'.$this->d_naissance.'", "'.$this->d_inscription.'")');
			$insertion->execute();
		}
		
		public function membre_existe()
		{
			if(isset(
		}
		
		public function verifier()
		{
		
			
if(!taille_variable('username',2,25)){
echo'Login invalide, rentrez minimum 2 caractères';
echo'<br>';

}elseif (!taille_variable('password',5,40)){
echo'Mot de passe invalide, rentrez minimum 5 caractères, 40 caractères maximum';
echo'<br>';
}elseif (!taille_variable('email',8,60)){
   echo'email invalide, rentrez minimum 8 caractères';
   echo'<br>';
}
if (!strpos($_POST['email'],'@')){
   echo'Adresse mail non valide';
}
list($user,$dns)=explode("@",$_POST['email']);
If (!checkdnsrr($dns)){
  echo'L\'adresse mail n\'est pas valide';
}
if(!taille_variable('nom',3,25)){
echo'Nom invalide, rentrez votre nom (minimum 3 lettres)';
echo'<br>';
}elseif (!taille_variable('prenom',3,25)){
echo'Prénom invalide, rentrez votre nom';
echo'<br>';
}
}
if (strlen($_POST['codepost'])<>0){
if(!taille_variable('codepost',4,10)){
echo'Code Postal invalide, entre 4 et 10 caractères';
echo'<br>';
}
}
if (!taille_variable('ville',3,25)){
echo'Ville invalide, rentrez minimum 3 caractères';
echo'<br>';
}elseif (!taille_variable('pays',3,20)){
echo'Pays invalide, rentrez minimum 3 caractères';
echo'<br>';
}elseif (strlen($_POST['telephone'])<>0){
if (!taille_variable('telephone',5,20)){
echo'Numéro de téléphone non valide';
echo'<br>';
}
}
if (strlen($_POST['bday'])<>0){
if (!taille_variable('bday',1,2)){
echo'Jour de naissance invalide, rentrez 2 chiffres';
echo'<br>';
}if (($_POST['bday'])<"1"){
echo'Jour inférieur à 1';
echo'<br>';
}elseif (($_POST['bday'])>"31"){
echo'Jour supérieur à 31';
echo'<br>';
}
}
if (strlen($_POST['bmonth'])<>0){
if (!taille_variable('bmonth',2,2)){
echo'Mois de naissance invalide, rentrez 2 chiffres';
echo'<br>';
}
if ($_POST['bmonth']<1){
echo'Mois de naissance >0';
echo'<br>';
}elseif ($_POST['bmonth']>12){
echo'Mois de naissance <12';
echo'<br>';
}

}
if (strlen($_POST['byear'])<>0){
if (!taille_variable('byear',2,2)){
echo'Année de naissance invalide, rentrez 2 chiffres';
echo'<br>';
}
if ($_POST['byear']<1900){
echo'Année de naissance >1900';
echo'<br>';
}elseif ($_POST['byear']>2020){
echo'Année de naissance <2020';
echo'<br>';
}
}
?>
<p>Recommencez, revenez en arrière avec votre navigateur</a></p>
<?php
function taille_variable($variable,$taille_min=0,$taille_max=0){
global $_POST;
if(!isset($_POST[$variable])){
// valeur non définie
return false;
}elseif (strlen($_POST[$variable])<$taille_min){
return False;
}elseif(strlen($_POST[$variable])>$taille_max){
return FALSE;
}
return True;
}

		}
		
		// public function envoyer_mail($_titre, $_message)
		// {
			// mail($this->email, $_titre, $_message);		
		// }
		
		
		
	
	}
?>