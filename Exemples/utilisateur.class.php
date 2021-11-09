<?php
	class Utilisateur {
	
		private $m_login, $m_mdp, $m_mdp2, $m_email, $m_nom, $m_prenom, $m_date_naissance;
			
		/* constructeur */	
		public function __construct($pseudo, $password, $password_conf, $mail, $nom = 'aucun', $prenom = 'aucun', $date_naissance = 'aucun') 
		{
			$this->m_login = $pseudo;
			$this->m_mdp = $password;
			$this->m_mdp2 = $password_conf;
			$this->m_email = $mail;
			$this->m_nom = $nom;
			$this->m_prenom = $prenom;
			$this->m_date_naissance = $date_naissance;
		}
		
///////////////////////////////////////// PARTIE INSCRIPTION ////////////////////////////////////////
		
		public function creer() /* creation d un membre */
		{			
			$requete = "
				INSERT INTO utilisateur(
				login
				, mot_de_passe
				, email
				, nom
				, prenom
				, date_naissance
				)
				VALUES(
				'" . $this->m_login . "'
				, '" . SHA1($this->m_mdp) . "'
				, '" . $this->m_email . "'
				, '" . $this->m_nom . "'
				, '" . $this->m_prenom . "'
				, '" . $this->m_date_naissance . "'

				)
				";
		
			$result = mysql_query($requete)
				or die ('Erreur de requête de base de données :'.mysql_error() ); 
			
			if($result)return true;
			else return false;
		}
		
		
		public function selectionner() /* selectionne un utilisateur en fonction de son login ou son email */
		{
			/* Vérification de l'unicité du nom d'utilisateur et de l'adresse e-mail */
			$req = "
			SELECT login , email
			FROM utilisateur
			WHERE login = '" . $this->m_login . "'
			OR email = '" . $this->m_email . "'
			";	
			
			$result =  mysql_query($req)
			or die ('Erreur de requête de base de données :'.mysql_error() );
			
			return $result;	
		}
		
		
		public function user_existe() /* verifie si un utilisateur ou un email n'existe pas deja */
		{
			if(mysql_num_rows($this->selectionner()) > 0)
			{
				$result = $this->selectionner();
				while($row = mysql_fetch_array($result))
				{
					if($this->m_login == $row["login"])
					{
						$message = "Le nom d'utilisateur " . $this->m_login;
						$message .= "est déjà utilisé";
					}
					elseif($this->m_email == $row["email"])
					{
						$message = "L'adresse e-mail " . $this->m_email;
						$message .= "est déjà utilisée";
					}
				}					
			}
			if(isset($message)) return $message;
		}
		
		
		public function verif_champs() /* Vérification de la validité des champs */
		{		
			if(!ereg("^[A-Za-z0-9_]{4,15}$", $this->m_login))
			{
				$message = "Votre nom d'utilisateur doit comporter entre 4 et 15 caractères (hors caractères speciaux)<br />\n";
				$message .= "L'utilisation de l'underscore est autorisée";
			}
			elseif(!ereg("^[A-Za-z0-9_]{8,100}$", $this->m_mdp))
			{
				$message = "Votre mot de passe doit comporter au moins 8 caractères (hors caractères speciaux)";
			}
			elseif($this->m_mdp != $this->m_mdp2)
			{
				$message = "Votre mot de passe n'a pas été correctement confirmé";
			}
			elseif(!ereg("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$",$this->m_email))
			{
				$message = "Votre adresse e-mail n'est pas valide";
			}
			
			if(!empty($this->m_nom))
			{
				if(!eregi("^[a-z0-9_áàâäãåçéèêëìíîïñòóôöõöúùûüýÿ-]{4,50}$", $this->m_nom))
				{
					$message = "Votre Nom doit comporter entre 4 et 50 caractères (hors caractères speciaux)<br />\n";
				}
			}
			if(!empty($this->m_prenom))
			{
				if(!eregi("^[a-z0-9_áàâäãåçéèêëìíîïñòóôöõöúùûüýÿ-]{4,50}$",  $this->m_prenom ))
				{
					$message = "Votre Prenom doit comporter entre 4 et 50 caractères (hors caractères speciaux)<br />\n";
				}
			}
			
			if(isset($message)) return $message;
		}
		
		
		public function dossiers()
		{
			/* création du répertoire photo */
			$dossier = './IMG/'.$this->m_login;
			$adresse[0] = $dossier;
			
			if(!mkdir($dossier, 0777, true))
			{
				die('Echec lors de la création des répertoires...');
			}

			/* Création du repetoire miniature */

			$dossier_min = './IMG/'.$this->m_login .'/MIN/';
			$adresse[1] = $dossier_min;
			
			if(!mkdir($dossier_min, 0777, true))
			{
				die('Echec lors de la création des répertoires...');
			}
			
			/* Création du repetoire protection */

			$dossier_protect = './IMG/'.$this->m_login .'/protect/';
			$adresse[2] = $dossier_protect;
			
			if(!mkdir($dossier_protect, 0777, true))
			{
				die('Echec lors de la création des répertoires...');
			}
			
			/* Création d index de protection dans les dossiers */
			
			$index = '<html><head><title>Restricted Access</title></head><body>Restricted Access</body></html>';
			
			for($i = 0; $i !=3; $i++)
			{
				$fp = fopen($adresse[$i].'/index.html',"w");
				fputs($fp, $index);
				fclose($fp);
			}
			
			
		}
		
///////////////////////////////////////// PARTIE CONNEXION ////////////////////////////////////////
		
		public function champs_verif()
		{
			/* Vérification de la validité des champs */
			if(!ereg("^[A-Za-z0-9_]{4,15}$", $this->m_login))
			{
				$message = "Votre nom d'utilisateur doit comporter entre 4 et 15 caractères<br />\n";
				$message .= "L'utilisation de l'underscore est autorisée";
			}
			elseif(!ereg("^[A-Za-z0-9]{8,}$", $this->m_mdp))
			{
				$message = "Votre mot de passe doit comporter au moins 8 caractères";
			}
			
			if(isset($message)) return $message;
		}
		
		
		public function select_user() /* selectionne le login et le mdp, pour un nom d utilisateur donnée */
		{
			/* Sélection de l'utilisateur concerné */
		   $result = mysql_query("
				SELECT login, mot_de_passe
				FROM utilisateur
				WHERE login = '" . $this->m_login . "'
		   ");
			return $result;
		}
		
		
		public function existe() /* return faux si aucun utilisateur n est trouvé */
		{
			if(mysql_num_rows($this->select_user()) == 0) return false;
			else return true;
		}
		
		
		public function infos() /* recupere dans un tableau le login et mdp, et retourne faux si le mdp donnée est différent de celui de la bdd */
		{
			$row = mysql_fetch_array($this->select_user());
			
			if(SHA1($this->m_mdp) != $row["mot_de_passe"]) return false;
			else return true;	
		}
		
		
		public function connexion() /* creer une session */
		{
			session_start();
			$_SESSION['login'] = strtolower($this->m_login);
		}
		
///////////////////////////////////////// PARTIE EDITION PROFIL ////////////////////////////////////////

		public function champ_verif_edit()
		{
			/* Vérification de la validité des champs */
			if(!eregi("^[a-z0-9_áàâäãåçéèêëìíîïñòóôöõöúùûüýÿ-]{4,50}$", $this->m_nom))
			{
				$message = "Votre Nom doit comporter entre 4 et 50 caractères (hors caractères speciaux)<br />\n";
			}
			elseif(!eregi("^[a-z0-9_áàâäãåçéèêëìíîïñòóôöõöúùûüýÿ-]{4,50}$",  $this->m_prenom ))
			{
				$message = "Votre Prenom doit comporter entre 4 et 50 caractères (hors caractères speciaux)<br />\n";
			}
			
			if(isset($message)) return $message;
		}
		
		public function update() /* creation d un membre */
		{	
			$requete = "
				UPDATE utilisateur SET
				nom = '" . $this->m_nom . "'
				, prenom = '" . $this->m_prenom . "'
				, date_naissance ='" . $this->m_date_naissance . "'
				WHERE login = '". $this->m_login ."'";
		
			$result = mysql_query($requete)
				or die ('Erreur de requête de base de données :'.mysql_error() ); 
			
			if($result)return true;
			else return false;
		}
		
		public function champ_verif_edit2()
		{
			if(!ereg("^[A-Za-z0-9_]{4,15}$", $this->m_login))
			{
				$message = "Votre nom d'utilisateur doit comporter entre 4 et 15 caractères (hors caractères speciaux)<br />\n";
				$message .= "L'utilisation de l'underscore est autorisée";
			}
			elseif(!ereg("^[A-Za-z0-9_]{8,100}$", $this->m_mdp))
			{
				$message = "Votre mot de passe doit comporter au moins 8 caractères (hors caractères speciaux)";
			}
			elseif($this->m_mdp != $this->m_mdp2)
			{
				$message = "Votre mot de passe n'a pas été correctement confirmé";
			}
			elseif(!ereg("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$",$this->m_email))
			{
				$message = "Votre adresse e-mail n'est pas valide";
			}
			
			if(isset($message)) return $message;
		}
		
		public function update2() /* creation d un membre */
		{	
			$requete = "
				UPDATE utilisateur SET
				login = '" . $this->m_login . "'
				, mot_de_passe = '" . SHA1($this->m_mdp) . "'
				, email ='" . $this->m_email . "'
				WHERE login = '". $_SESSION['login'] ."'";
		
			$result = mysql_query($requete)
				or die ('Erreur de requête de base de données :'.mysql_error() ); 
			
			if($result)return true;
			else return false;
		}
		
		public function update3() /* creation d un membre */
		{	
			$requete = "
				UPDATE utilisateur SET
				login = '" . $this->m_login . "'
				, email ='" . $this->m_email . "'
				WHERE login = '". $_SESSION['login'] ."'";
		
			$result = mysql_query($requete)
				or die ('Erreur de requête de base de données :'.mysql_error() ); 
			
			if($result)return true;
			else return false;
		}
		
		
		public function champ_verif_edit3()
		{
			if(!ereg("^[A-Za-z0-9_]{4,15}$", $this->m_login))
			{
				$message = "Votre nom d'utilisateur doit comporter entre 4 et 15 caractères (hors caractères speciaux)<br />\n";
				$message .= "L'utilisation de l'underscore est autorisée";
			}
			elseif(!ereg("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$",$this->m_email))
			{
				$message = "Votre adresse e-mail n'est pas valide";
			}
			
			if(isset($message)) return $message;
		}
	}
?>