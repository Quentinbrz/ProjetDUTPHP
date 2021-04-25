<div class="accordion" id="Semaine">
    <div class="card">
        <div class="card-header " id="headingOne" >

            <?php	$tabSemaines = array();
            $seance = 0;
            $mois = isset($_GET['mois']) && !empty($_GET['mois']) ? $_GET['mois'] : date('m');
            $annee = isset($_GET['annee']) && !empty($_GET['annee']) ? $_GET['annee'] : date('Y');
            $seances = $db->getSeance($mois,$annee);
            foreach($seances as $seance){
                if(!in_array($seance->getNumberWeeks(),$tabSemaines))
                    array_push($tabSemaines,$seance->getNumberWeeks());
            }
            foreach($tabSemaines as $semaine){?>
                <h2 class="mb-0">
                    <button class="btn-semaine" type="button" data-toggle="collapse"
                            data-target="#Semaine<?php echo $semaine;?>" aria-expanded="true" aria-controls="collapse">
                        Semaine <?php echo $semaine; ?>
                    </button>
                </h2>

                <div class="accordion collapse" id="Semaine<?php echo $semaine;?>">
                    <div class="card" style=" margin-top:0.3rem;">
                        <div class="card-header" id="headingTwo">
                            <?php foreach($seances as $seance){
                                    if ($seance->getNumberWeeks() == $semaine) {
                                        $module = $db->getModuleWithId($seance->getId_moduleName());
                                        $user   = $db->getUserWithKey($seance->getKey_User());
                                        $events = $db->getEvents($seance->getId_seance());
                                        $semaphore = $db->getSemaphore($_SESSION['Client']->getKeyUser(),$seance->getId_seance());
                                    ?>
                                    <h2 class="mb-0">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn-seance" style="background-color: <?php echo $module->getCoulModule();?>;" type="button" data-toggle="collapse"
                                                            data-target="#collapseEvent<?php echo$seance->getId_seance();?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="container-fluid">
                                                            <div class="row align-items-center">
                                                                <div class="col-xl-3 col- 2">
                                                                    <?php echo $module->getLibModule() ?>
                                                                </div>
                                                                <div class="col-xl-8 col">
                                                                    <?php echo $seance->getDate(); ?>
                                                                </div>
                                                                <div class="col-xl-1 col-1">
                                                                    <a id="popover" data-trigger="hover" data-html="true" data-toggle="popover" style=":hover {background: yellow}"
                                                                       data-content=   "Type : <?php echo $seance->getType_seance(); ?> <br/>
																			Groupe : <?php echo $seance->getNom_group(); ?> <br/>
																			Crée par : <?php echo $user -> getPrenomUser()." ". $user -> getNomUser() ?>"><img src="../iconic/svg/info.svg"
                                                                                                                                                               alt="" width="20" height="20" style="margin-bottom: 0;"/>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="col-1"><!-- Création du bouton de sémaphore -->
                                                    <button type="button" id="buttonSema<?php echo $seance->getId_seance();?>" class="btn-seance btn-semaphore" title="<?php echo $semaphore->getLib();?>" style="background-color :<?php echo $semaphore->getColor();?>; color :<?php echo $semaphore->getTextColor();?>;" onclick="changeSemaphore(<?php echo $seance->getId_seance();?>)">&nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </h2>
                                    <div id="collapseEvent<?php echo $seance->getId_seance();?>" class="collapse" aria-labelledby="headingOne"
                                         data-parent="#Semaine<?php echo $semaine;?>">
                                        <div class="card-body">
                                            <table class="table table-responsive-sm"
                                                   style="padding:0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Pièces jointes </th>
                                                    <th>Durée</th>
                                                    <th>Pour le</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php
                                                foreach ($events as $event) {
														$pathFiles = 'documents/'.substr($seance->getDateTime(), 0,4 )."/".substr($seance->getDateTime(), 5,2 )."/".$seance->getId_seance().'/'.$event->getIdEvent();
												?>
                                                <tr>
                                                    <td> <?php echo $event->getTypeEvent();?> </td>
                                                    <td> <?php echo $event -> getLibEvent();?> </td>
                                                    <td> <?php if(is_dir($pathFiles)){
                                                            foreach (new DirectoryIterator($pathFiles) as $fileInfo) {
                                                                if($fileInfo->isDot()) continue;
                                                                ?>
                                                                <a target="_blank" title="<?php echo $fileInfo->getBasename(); ?>" href="<?php echo $fileInfo->getPathName();?>"><img class= "mb-4 attachmentIcon" src="../iconic/svg/file.svg" alt="" width="20" height="20"/></a>

                                                            <?php  			}
                                                        }
                                                        ?>
                                                    </td>
                                                    <td> <?php echo substr($event -> getDureeEvent(), 0, 5);?></td>

                                                    <?php
                                                    $dateJour   = date('w', $event -> getDateFinEvent());
                                                    $datePourLe = $event -> getDateFinEvent();

                                                    if (!empty($dateJour))
                                                    {
                                                        $tabJours = array( "lun", "mar", "mer","jeu", "ven","sam","dim");
                                                        for ($i = 0; $i < count($tabJours); $i++) {
                                                            if ($i == $dateJour) {
                                                                $dateJour = $tabJours[$i];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $dateJour = "";
                                                        $datePourLe = "";
                                                    }
                                                    ?>
                                                    <td> <?php echo $dateJour." ".$datePourLe;?> </td>
                                                    <td><?php if($_SESSION['Client']->getKeyUser() == $event->getKeyOwner()){?>	<button type="button" class="btn btn-warning" data-toggle="modal" style="height : 36px" data-target="#modalEditEvent"
                                                                                                                                           data-idevent="<?php echo $event->getIdEvent();?>"
                                                                                                                                           data-idseance="<?php echo $seance->getId_seance();?>"
                                                                                                                                           data-typeevent="<?php echo $event->getTypeEvent();?>"
                                                                                                                                           data-libevent="<?php echo $event->getLibEvent();?>"
                                                                                                                                           data-duree="<?php echo $event->getDureeEvent();?>"
                                                                                                                                           data-datefin="<?php echo $event->getDateFinEventRFC();?>"
                                                                                                                                           data-numsemaine="<?php echo $semaine;?>">

                                                            <img class= "mb-4" src="../iconic/svg/pencil.svg" alt="" width="20" height="20"/>
                                                        </button>
                                                        <?php }?>
                                                    </td>
                                                    <td><?php if($_SESSION['Client']->getKeyUser() == $event->getKeyOwner()){?><button type="button" class="btn btn-danger" style="height : 36px"  data-toggle="modal" data-target="#modalDeleteEvent" data-idevent="<?php echo $event->getIdEvent();?>" data-idseance="<?php echo $seance->getId_seance();?>" data-numsemaine="<?php echo $semaine;?>">
                                                            <img class= "mb-4" src="../iconic/svg/ban.svg" alt="" width="20" height="20"/>
                                                        </button>
                                                        <?php }?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                </tbody>

                                            </table>
                                                <div class="container-fluid">
                                                    <div class="row">
											 <?php if($db->getNbEventWithIdSeance($seance->getId_seance())<$db->getNbEventMax()){ ?>
                                                        	<div class="col">
                                                            	<button class="button btn-lg btn-block btn-warning" data-toggle="modal" data-target="#modalAddEvent" data-idseance="<?php echo $seance->getId_seance();?>" data-numsemaine="<?php echo $semaine;?>">Ajouter des événements à cette séance</button>
                                                        	</div>
											<?php } ?>
                                                        <?php if($_SESSION['Client']->getIdUser() == $user->getIdUser()){ //Si l'utilisateur est le créateur de la séance on lui affiche de quoi la supprimer?>
                                                        <div class="col">
                                                            <button class="button btn-lg btn-block btn-danger" style="color: black;" data-toggle="modal" data-target="#modalDeleteSeance" data-idseance="<?php echo $seance->getId_seance();?>">Supprimer cette séance</button>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <?php }}//Fin du IF et du FOREACH seances ?>
                        </div>

                    </div>
                </div>
                <?php
            }?>
        </div>
    </div>
</div>

<script>

    <?php //Permet de collapse la semaine actuelle automatiquement
    if($mois == date('m') && $annee == date('Y')) echo '$(\'#Semaine'.date('W').'\').collapse({ toggle: true });'
    ?>

</script>
<script type="text/javascript" src="scripts/showSeance.js"></script>
