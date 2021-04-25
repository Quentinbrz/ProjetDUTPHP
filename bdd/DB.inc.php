<?php

require 'user.inc.php';
require 'module.inc.php';
require 'group.inc.php';
require 'seances.inc.php';
require 'event.inc.php';
require 'type_event.inc.php';
require 'typesSeances.inc.php';
require 'typesSemaphore.inc.php';


class DB {
	private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
	private $connect=null; //connexion PDO à la base

	/************************************************************************/
	//	Constructeur gerant  la connexion à la base via PDO
	//	NB : il est non utilisable a l'exterieur de la classe DB
	/************************************************************************/
	private function __construct() {
		// Connexion à la base de données
		try {
			// Connexion à la base
			$this->connect = new PDO('mysql:host=localhost;dbname=prominfo','identifiant','password',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			// Configuration facultative de la connexion
			$this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			echo "probleme de connexion :".$e->getMessage();
			return null;
		}
	}

	/************************************************************************/
	//	Methode permettant d'obtenir un objet instance de DB
	//	NB : cet objet est unique pour l'exécution d'un même script PHP
	//	NB2: c'est une methode de classe.
	/************************************************************************/
	public static function getInstance() {
		if (is_null(self::$instance)) {
			try { self::$instance = new DB(); }
			catch (PDOException $e) { echo $e; }
		} //fin IF

		$obj = self::$instance;
		if (($obj->connect) == null) { self::$instance=null;}
		return self::$instance;
	} //fin getInstance

	/************************************************************************/
	//	Methode permettant de fermer la connexion a la base de données
	/************************************************************************/
	public function close() { $this->connect = null;}

	/************************************************************************/
	//	Methode uniquement utilisable dans les méthodes de la class DB
	//	permettant d'exécuter n'importe quelle requête SQL
	//	et renvoyant en résultat les tuples renvoyés par la requête
	//	sous forme d'un tableau d'objets
	//	param1 : texte de la requête à exécuter (éventuellement paramétrée)
	//	param2 : tableau des valeurs permettant d'instancier les paramètres de la requête
	//	NB : si la requête n'est pas paramétrée alors ce paramètre doit valoir null.
	//	param3 : nom de la classe devant être utilisée pour créer les objets qui vont
	//	représenter les différents tuples.
	//	NB : cette classe doit avoir des attributs qui portent le même que les attributs
	//	de la requête exécutée.
	//	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
	//	que d'éléments dans le tableau passé en second paramètre.
	//	NB : si la requête ne renvoie aucun tuple alors la fonction renvoie un tableau vide
	/************************************************************************/
	private function execQuery($requete,$tparam,$nomClasse) {
		//on prépare la requête
		$stmt = $this->connect->prepare($requete);
		//on indique que l'on va récupére les tuples sous forme d'objets instance
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse);
		//on exécute la requête
		if ($tparam != null) { $stmt->execute($tparam);}
		else { $stmt->execute();}
		$tab = array(); //récupération du résultat de la requête sous forme d'un tableau d'objets
		$tuple = $stmt->fetch(); //on récupère le premier tuple sous forme d'objet
		if ($tuple) { //au moins un tuple a été renvoyé
			while ($tuple != false) {
				$tab[]=$tuple; //on ajoute l'objet en fin de tableau
				$tuple = $stmt->fetch(); //on récupère un tuple sous la forme d'un objet instance de la classe $nomClasse
			} //fin du while
		}
		return $tab;
	}

	/************************************************************************/
	//	Methode utilisable uniquement dans les méthodes de la classe DB
	//	permettant d'exécuter n'importe quel ordre SQL (update, delete ou insert)
	//	autre qu'une requête.
	//	Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL
	//	param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré)
	//	param2 : tableau des valeurs permettant d'instancier les paramètres de l'ordre SQL
	//	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
	//	que d'éléments dans le tableau passé en second paramètre.
	/************************************************************************/
	private function execMaj($ordreSQL,$tparam) {
		$stmt = $this->connect->prepare($ordreSQL);
		$res = $stmt->execute($tparam); //execution de l'ordre SQL
		return $stmt->rowCount();
	}


	/*************************************************************************
	* Fonctions qui peuvent être utilisées dans les scripts PHP
	*************************************************************************/


	/*************************************************************************
	* Fonctions général
	*************************************************************************/
	public function getLastInsertedId(){
		return $this->connect->lastInsertId();
	}

	/*************************************************************************
	* Fonctions sur les users
	*************************************************************************/
	public function getUsers() {
		$requete = 'SELECT * FROM users';
		return $this->execQuery($requete,null,'User');
	}

	public function insertUser($idUser,$nom,$prenom,$password_hash) {
		$requete = 'insert into users(id_user,nom_user,prenom_user,password_user) values(?,?,?,?)';
		$tparam = array($idUser,$nom,$prenom,$password_hash);
		return $this->execMaj($requete,$tparam);
	}

	public function checkUserPass($idUser,$password){
		$requete = 'SELECT * FROM users WHERE id_user = ?';
		$tparam = array($idUser);
		$result = $this->execQuery($requete,$tparam,'User');
		if(empty($result)) return false;
		return password_verify($password,array_shift($result)->getPasswordHash());
	}

	public function changePassHash($keyUser,$passwordHash,$needPassChange){
		$requete = 'update users set password_user = ?, need_pass_change = ? WHERE key_user = ?';
		$tparam = array($passwordHash,$needPassChange,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function checkNeedPassChange($keyUser){
		$requete = 'SELECT need_pass_change FROM users WHERE key_user = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($keyUser));
		return array_shift($stmt->fetch());
	}

	public function addRoleToUser($role,$keyUser){
		$requete = 'insert into roles_user(id_role,key_user) values(?,?)';
		$tparam = array($role,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function removeRoleToUser($role,$keyUser){
		$requete = 'delete FROM roles_user WHERE id_role = ? and key_user = ?';
		$tparam = array($role,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function getUser($id) {
		$requete = 'SELECT * FROM users WHERE id_user = ?';
		$user = array_shift($this->execQuery($requete,array($id),'User'));
		return $user;
	}

	public function getUserWithKey($key) {
		$requete = 'SELECT * FROM users WHERE key_user = ?';
		$user = array_shift($this->execQuery($requete,array($key),'User'));
		return $user;
	}

	public function editUser($key,$id,$nom,$prenom){
		$requete = 'update users set id_user = ?, nom_user = ?, prenom_user = ? WHERE key_user = ?';
		$tparam = array($id, $nom, $prenom, $key);
		return $this->execMaj($requete,$tparam);
	}

	public function deleteUser($key){
		$requete = 'delete FROM users WHERE key_user = ?';
		$tparam = array($key);
		return $this->execMaj($requete,$tparam);
	}

	/*************************************************************************
	* Fonctions sur les roles
	*************************************************************************/

	public function getRoles($keyUser){
		$requete = 'SELECT id_role FROM roles_user WHERE key_user = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($keyUser));
		$roles = array();
		$tuple = $stmt->fetch();
		while ($tuple != false) {
			array_push($roles,array_shift($tuple));
			$tuple = $stmt->fetch();
		}
		return $roles;
	}

	public function getIdRoleWithLib($lib){
		$requete = "select id_role FROM roles where lib_role= ?";
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($lib));
		return array_shift($stmt->fetch());
	}
	public function getLibWithIdRole($id){
		$requete = "select lib_role FROM roles where id_role= ?";
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id));
		return array_shift($stmt->fetch());
	}

	public function getAllRoles(){
		$requete = 'select lib_role from roles';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute();
		$roles = array();
		$tuple = $stmt->fetch();
		while ($tuple != false) {
			array_push($roles,array_shift($tuple));
			$tuple = $stmt->fetch();
		}
		return $roles;
	}


	public function getIdUser($keyUser){
		$requete = 'SELECT id_user FROM users WHERE key_user = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($keyUser));
		return array_shift($stmt->fetch());
	}

	/*************************************************************************
	* Fonctions sur les modules
	*************************************************************************/

	public function getLibModules(){
		$requete = 'SELECT lib_module FROM modules';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute();
		$modules = array();
		$tuple = $stmt->fetch();
		while ($tuple != false) {
			array_push($modules,array_shift($tuple));
			$tuple = $stmt->fetch();
		}
		return $modules;
	}
	public function getLibModule($id){
		$requete = 'SELECT lib_module FROM modules WHERE id_module = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id));
		$modules = array();
		$tuple = $stmt->fetch();
		while ($tuple != false) {
			array_push($modules,array_shift($tuple));
			$tuple = $stmt->fetch();
		}
		return array_shift($modules);
	}

	public function getModules() {
		$requete = 'SELECT * FROM modules';
		return $this->execQuery($requete,null,'Module');
	}

	public function getModulesOfUser($keyUser) {
		$requete = 'SELECT * FROM modules WHERE id_module IN (SELECT id_module FROM module_user WHERE key_user = ?)';
		return $this->execQuery($requete,array($keyUser),'Module');
	}

	public function getModule($key) {
		$requete = 'SELECT * FROM modules WHERE id_module  = ?';
		return $this->execQuery($requete,array($key),'Module');
	}
	public function getModuleWithLib($lib) {
		$requete = 'SELECT * FROM modules WHERE lib_module = ?';
		return array_shift($this->execQuery($requete,array($lib),'Module'));
	}


	public function addModuleToUser($keyUser,$libMod){
		$requete = 'insert into module_user(key_user,id_module) values(?,(SELECT id_module FROM modules WHERE lib_module = ?))';
		$tparam = array($keyUser,$libMod);
		return $this->execMaj($requete,$tparam);
	}

	public function delModuleToUser($keyUser,$idMod){
		$requete = 'delete FROM module_user WHERE id_module = ? and key_user = ?';
		$tparam = array($idMod,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function changeModule($codeModule,$module,$coulmodule,$id){
		$requete = 'update modules set code_module = ?,lib_module = ?,coul_module = ? WHERE id_module = ?';
		$tparam = array($codeModule, $module, $coulmodule, $id);
		return $this->execMaj($requete,$tparam);
	}

	public function insertModule($code_Module,$lib_module,$coulModule,$idRole) {
		$requete = 'insert into modules(code_module,lib_module,coul_module,id_role) values(?,?,?,?)';
		$tparam = array($code_Module,$lib_module,$coulModule,$idRole);
		return $this->execMaj($requete,$tparam);
	}

	public function getModuleWithId($idModule){
		$requete = 'SELECT * FROM modules WHERE id_module = ?';
		$module = array_shift($this->execQuery($requete,array($idModule),'Module'));
		return $module;
	}

	public function deleteModule($id){
		$requete = 'delete FROM modules WHERE id_module = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	/*************************************************************************
	* Fonctions sur les type des séances
	*************************************************************************/

	public function getTypesSeance(){
		$requete = 'SELECT * FROM type_seance';
		return $this->execQuery($requete,null,'TypesSeances');
	}

	public function deleteTypeSeance($id){
		$requete = 'delete FROM type_seance WHERE id_type_seance = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	public function addTypeSeance($lib,$idRole){
		$requete = 'insert into type_seance(lib_type_seance,id_role) values (?,?)';
		$tparam = array($lib,$idRole);
		return $this->execMaj($requete,$tparam);
	}
	/*************************************************************************
	* Fonctions sur les séances
	*************************************************************************/
	public function getAllSeances() {
		$requete = "SELECT * FROM   seances s";
		return $this->execQuery($requete,null,'Seances');
	}

	public function getSeanceById($idSeance) {
		$requete = 'SELECT * FROM seances WHERE id_seance = ?';
		return array_shift($this->execQuery($requete,array($idSeance),'Seances'));
	}
	public function getSeanceFiltre(	$libSeance=null,$dateDebSeance=null, $dateFinSeance = null, $libTypeSeance=null, $libGroup=null,
									$personne=null, $libTypeEvent=null,$dateDebEvent=null, $dateFinEvent=null ) {

		if ( (isset($libTypeEvent) &&  !empty($libTypeEvent) )|| ( isset($dateDebEvent) && empty($dateDebEvent) ) || ( isset($dateFinEvent) && empty($dateFinEvent)))
			$requete = 'SELECT s.* FROM seances s WHERE ';
		else
			$requete = 'SELECT s.* FROM seances s JOIN events e ON s.id_seance = e.id_seance_event WHERE ';


		$param = array();
		$haveFirstWhereClause = false;

        if (isset($libSeance) && !empty($libSeance)) {
            if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'id_module_seance = (SELECT id_module FROM modules WHERE lib_module = ?) ';

			array_push($param, $libSeance);
		}
		if (isset($dateDebSeance) && !empty($dateDebSeance) && isset($dateFinSeance) && !empty($dateFinSeance) ) {
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'date_creation_seance BETWEEN  ? AND ? ';
			array_push($param, $dateDebSeance, $dateFinSeance);
		}
		if (isset($libTypeSeance) && !empty($libTypeSeance)) {
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'type_seance = ?';
			array_push($param, $libTypeSeance);

		}
		if (isset($libGroup) && !empty($libGroup)) {
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;

			$requete = $requete .'group_seance = ? ';
			array_push($param, $libGroup);
		}

		if (isset($personne) && !empty($personne)) {

			$personne = explode(" ",$personne);
			$prenom = $personne[0];
			$nom  = "";
			for ( $i = 1 ; $i < sizeof($personne); $i++)
				$nom    = $nom . $personne[$i]." ";
			$nom = trim($nom);

			array_push($param, $prenom,$nom);
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'key_user_seance = (SELECT key_user FROM users WHERE nom_user = ? and prenom_user = ? )';
		}

		if (isset($libTypeEvent) && !empty($libTypeEvent)) {
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'type_event = ?';
			array_push($param, $libTypeEvent);
		}

		if (isset($dateDebEvent) && !empty($dateDebEvent) && isset($dateFinEvent) && !empty($dateFinEvent)) {
			if ($haveFirstWhereClause == true) {
            	$requete = $requete." AND ";
			}
			else
				$haveFirstWhereClause = true;
			$requete = $requete .'date_fin_event BETWEEN ? AND ?';
			array_push($param, $dateDebEvent,$dateFinEvent );
		}

		return $this->execQuery($requete,$param,'Seances');
	}

	public function getSeance($mois, $annee) {
		$requete = 'SELECT * FROM   seances s
					WHERE  MONTH(date_creation_seance) = ?
					AND YEAR(date_creation_seance) = ?
					ORDER BY date_creation_seance';
		if(empty($annee)) $annee = date('Y');
		return $this->execQuery($requete,array($mois,$annee),'Seances');
	}

	public function getSeances($numberWeek,$mois) {
		$requete = 'SELECT *
					FROM   seances s	JOIN modules m      ON s.id_module  = m.id_module
					WHERE  WEEK (date_creation_seance) = ? AND  MONTH(date_creation_seance) =?
					ORDER BY date_creation_seance';
		return $this->execQuery($requete,array($numberWeek,$mois),'Seances');
	}

	public function insertSeance($module,$date_seance,$type_seance,$id_group,$keyUser) {
		$requete = 'insert into seances (id_module_seance,date_creation_seance,type_seance,group_seance,key_user_seance) values (?,?,?,?,?)';
		$tparam = array($module,$date_seance,$type_seance,$id_group,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function deleteSeance($id){
		$requete = 'delete FROM seances WHERE id_seance = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	public function changeTS($idTS,$idRole){
		$requete = 'update type_seance set id_role= ? where id_type_seance= ?';
		$tparam = array($idRole,$idTS);
		return $this->execMaj($requete,$tparam);
	}

	/*************************************************************************
	* Fonctions sur les groupes
	*************************************************************************/
	public function getGroups() {
		$requete = 'SELECT * FROM groups';
		return $this->execQuery($requete,null,'Group');
	}

	public function getGroup($id) {
		$requete = 'SELECT * FROM groups WHERE id_group = ?';
		$tparam = array($id);
		return $this->execQuery($requete,$tparam,'Group');
	}

	public function getGroupWithNom($nom_group) {
		$requete = 'SELECT * FROM groups WHERE nom_group = ?';
		$tparam = array($nom_group);
		return array_shift($this->execQuery($requete,$tparam,'Group'));
	}

	public function getGroupsOfUser($keyUser) {
		$requete = 'SELECT * FROM groups WHERE id_group IN (SELECT id_group FROM groups_user WHERE key_user = ?)';
		return $this->execQuery($requete,array($keyUser),'Group');
	}

	public function addGroupToUser($keyUser,$libGrp){
		$requete = 'insert into groups_user(key_user,id_group) values(?,(SELECT id_group FROM groups WHERE nom_group = ?))';
		$tparam = array($keyUser,$libGrp);
		return $this->execMaj($requete,$tparam);
	}

	public function deleteGroupOfUser($keyUser,$idGrp){
		$requete = 'delete FROM groups_user WHERE id_group = ? and key_user = ?';
		$tparam = array($idGrp,$keyUser);
		return $this->execMaj($requete,$tparam);
	}

	public function getNomGroups(){
		$requete = 'SELECT nom_group FROM groups';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute();
		$groups = array();
		$tuple = $stmt->fetch();
		while ($tuple != false) {
			array_push($groups,array_shift($tuple));
			$tuple = $stmt->fetch();
		}
		return $groups;
	}
	public function changeGroup($nom,$idPere,$id){
		$requete = 'update groups set nom_group = ?,id_group_pere = ? WHERE id_group = ?';
		$tparam = array($nom, $idPere,$id);
		return $this->execMaj($requete,$tparam);
	}

	public function deleteGroup($id){
		$requete = 'delete FROM groups WHERE id_group = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	public function insertGroup($nom_group,$id_pere) {
		$requete = 'insert into groups (nom_group,id_group_pere) values (?,?)';
		$tparam = array($nom_group,$id_pere);
		if($id_pere == NULL){ $requete = 'insert into groups (nom_group) values (?)'; $tparam = array($nom_group); }
		return $this->execMaj($requete,$tparam);
	}

	/*************************************************************************
	* Fonctions sur les évenement
	*************************************************************************/

	public function getEvent(){
		$requete = 'SELECT * FROM events';
		return $this->execQuery($requete,null,'Event');
	}

	public function getEvents($id_seance){
		$requete = 'SELECT * FROM events WHERE id_seance_event = ?';
		return $this->execQuery($requete,array($id_seance),'Event');
	}

	public function getLibTypeEvent($id){
		$requete = 'SELECT lib_type_event FROM type_event WHERE id_type_event = (SELECT id_type_event FROM events WHERE id_event = ? ) ';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id));
		return array_shift($stmt->fetch());
	}

	public function getLibSeance($id){
		$requete = 'SELECT lib_type_seance FROM type_event WHERE id_type_event = (SELECT id_type_event FROM events WHERE id_event = ? ) ';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id));
		return array_shift($stmt->fetch());
	}

	public function getDuree($id_seance) {
		$requete = 'SELECT duree_event FROM events WHERE id_seance = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id_seance));
		return array_shift($stmt->fetch());
	}

	public function insertEvent($idSeance,$typeEvent,$libEvent,$dureeEvent,$dateFinEvent,$keyOwner){
		if(empty($dureeEvent)) $dureeEvent = null;
		if(empty($dateFinEvent)) $dateFinEvent = null;
		$requete = 'insert into events (id_seance_event,type_event,lib_event,duree_event,date_fin_event,key_user) values (?,?,?,?,?,?)';
		$tparam = array($idSeance,$typeEvent,$libEvent,$dureeEvent,$dateFinEvent,$keyOwner);
		return $this->execMaj($requete,$tparam);
	}

	public function changeEvent($idEvent,$idSeance,$typeEvent,$libEvent,$dureeEvent,$dateFinEvent){
		if(empty($dureeEvent)) $dureeEvent = null;
		if(empty($dateFinEvent)) $dateFinEvent = null;
		$requete = 'update events set id_seance_event = ? , type_event = ? ,lib_event = ? , duree_event = ? , date_fin_event = ? where id_event = ?';
		$tparam = array($idSeance,$typeEvent,$libEvent,$dureeEvent,$dateFinEvent,$idEvent);
		return $this->execMaj($requete,$tparam);
	}

	public function deleteEvent($id){
		$requete = 'delete FROM events WHERE id_event = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}


	public function getPourLe($id_seance) {
		$requete = 'SELECT date_fin_event FROM events WHERE id_seance = ?';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($id_seance));
		return array_shift($stmt->fetch());
	}

	/*************************************************************************
	* Fonctions sur les  types d'évenement
	*************************************************************************/


	public function getTypeEvent(){
		$requete ='SELECT * FROM type_event';
		return $this->execQuery($requete,null,'Type_Event');
	}

	public function deleteTypeEvent($id){
		$requete = 'delete FROM type_event WHERE id_type_event = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	public function insertTypeEvent($lib,$idRole) {
		$requete = 'insert into type_event(lib_type_event, id_role) values (?,?)';
		$tparam = array($lib,$idRole);
		return $this->execMaj($requete,$tparam);
	}

	public function changeTE($idTE,$idRole){
		$requete = 'update type_event set id_role= ? where id_type_event= ?';
		$tparam = array($idRole,$idTE);
		return $this->execMaj($requete,$tparam);
	}

	/*************************************************************************
	* Fonctions sur les sémaphore
	*************************************************************************/

	public function getTypesSemaphores(){
		$requete = 'SELECT * FROM type_semaphore';
		return $this->execQuery($requete,null,'TypesSemaphore');
	}

	public function deleteTypeSemaphore($id){
		$requete = 'delete FROM type_semaphore WHERE id_type_semaphore = ?';
		$tparam = array($id);
		return $this->execMaj($requete,$tparam);
	}

	public function addTypeSemaphore($lib,$color,$text_color){
		$requete = 'insert into type_semaphore(lib_type_semaphore,color_semaphore,text_color_semaphore) values (?,?,?)';
		$tparam = array($lib,$color,$text_color);
		return $this->execMaj($requete,$tparam);
	}

	public function changeSemaphore($id,$lib,$color,$text_color){
		$requete = 'update type_semaphore set lib_type_semaphore = ?,color_semaphore = ?,text_color_semaphore = ? WHERE id_type_semaphore = ?';
		$tparam = array($lib,$color,$text_color, $id);
		return $this->execMaj($requete,$tparam);
	}

	public function getSemaphore($keyUser,$idSeance){
		$requete = 'SELECT * FROM type_semaphore WHERE type_semaphore.id_type_semaphore = (SELECT id_semaphore FROM semaphore_user WHERE key_user = ? AND id_seance = ?) ';
		$tparam = array($keyUser,$idSeance);
		$result = $this->execQuery($requete,$tparam,'TypesSemaphore');
		if(count($result) == 0){ //Si l'utilisateur n'as pas encore de sémaphore alors on renvoi le premier
			$requete = 'SELECT * FROM type_semaphore LIMIT 1';
			return array_shift($this->execQuery($requete,null,'TypesSemaphore'));
		}
		return array_shift($result);
	}

	public function getIdNextSemaphore($idSemaphore){
		$requete = 'SELECT IF((SELECT MAX(id_type_semaphore) FROM type_semaphore) = ?, (SELECT id_type_semaphore FROM type_semaphore LIMIT 1), (SELECT id_type_semaphore FROM type_semaphore WHERE id_type_semaphore > ? LIMIT 1))';
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($idSemaphore,$idSemaphore));
		return array_shift($stmt->fetch());
	}

	public function setNextSemaphore($keyUser,$idSeance){
		$idNextSema = $this->getIdNextSemaphore($this->getSemaphore($keyUser,$idSeance)->getId());
		$requete = 'INSERT INTO semaphore_user(key_user, id_seance, id_semaphore) VALUES (?,?,?) ON DUPLICATE KEY UPDATE key_user = VALUES(key_user),id_seance = VALUES(id_seance),id_semaphore = VALUES(id_semaphore)';
		$tparam = array($keyUser,$idSeance,$idNextSema);
		return $this->execMaj($requete,$tparam);
	}
	/*************************************************************************
	* Fonctions sur les pièces jointes
	*************************************************************************/
	public function getNbPieceJointeMax(){
		$requete = "SELECT nb_pieces_jointes FROM general_settings";
		$stmt = $this->connect->prepare($requete);
		$stmt->execute();
		return array_shift($stmt->fetch());
	}

	public function editNbPieceJointeMax($nbPieceJointe){
		$requete = 'update general_settings set nb_pieces_jointes = ?';
		$tparam = array($nbPieceJointe);
		return $this->execMaj($requete,$tparam);
	}

	public function getNbEventMax(){
		$requete = "SELECT nb_events FROM general_settings";
		$stmt = $this->connect->prepare($requete);
		$stmt->execute();
		return array_shift($stmt->fetch());
	}

	public function editNbEventMax($nbEvent){
			$requete = 'update general_settings set nb_events = ?';
			$tparam = array($nbEvent);
			return $this->execMaj($requete,$tparam);
	}

	public function getNbEventWithIdSeance($idSeance){
		$requete = "SELECT count(id_event) FROM events where id_seance_event = ?";
		$stmt = $this->connect->prepare($requete);
		$stmt->execute(array($idSeance));
		return array_shift($stmt->fetch());
	}

} //fin classe DB

?>
