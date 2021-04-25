<div class="modal fade" id="researchModalSeance" tabindex="-1" role="dialog" aria-labelledby="modalAddSeanceLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title darkModeText" id="researchModalSeance">Etats des séances</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="hidden">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="indexFiltrer.php" method="post">
                <button class="btn-prominfo darkModeText" type="button" data-toggle="collapse"
                    data-target="#collapseSeances" aria-expanded="true" aria-controls="collapseSeances">Critères de
                    séance</button>
                <div class="container">
                    <div id="collapseSeances" class="collapse show multi-collapse">
                        <div class="card card-body">
                            <div class="form-group row ">
                                <label class="col-xl-4 col-form-label darkModeText"
                                    for="addIdModuleSeance">Module</label><br />
                                <div class="col-xl-8">
                                    <select class="form-control darkModeInput" name="addModule" id="addIdModuleSeance">
                                        <option value="" selected="selected"></option>
                                        <?php foreach($db->getModules() as $module) echo "<option>".$module->getLibModule()."</option>\n";?>
                                    </select>
                                </div>
                            </div>
                            <?php
                                $dateMin = '0-0-0';
                                $dateMax = '10000-0-0';
                                if(in_array(3,$db->getRoles($_SESSION['Client']->getKeyUser())) AND count($db->getRoles($_SESSION['Client']->getKeyUser())) == 1) {
									$dateMin = (date('m') > 8) ? date('Y') . '-09-01' : (date('Y') - 1) . '-09-01';
									$dateMax = (date('m') > 8) ? (date('Y') + 1) . '-06-30' : date('Y') . '-06-30';
								}
                            ?>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText" for="addDateEvent">Date entre
                                </label>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control darkModeInput" name="addDateDebSeance"
                                        id="addDateDebSeance" min="<?php echo $dateMin?>" max="<?php echo $dateMax?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText" for="addDateEvent">et </label>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control darkModeInput" name="addDateFinSeance"
                                        id="addDateFinSeance" min="<?php echo $dateMin?>" max="<?php echo $dateMax?>">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="col-xl-4 col-form-label darkModeText" for="addIdTypeSeance">Type</label>
                                <div class="col-xl-8">
                                    <select class="form-control darkModeInput" name="addTypeSeance" id="addTypeSeance">
                                        <option value="" selected="selected"></option>
                                        <?php foreach($db->getTypesSeance() as $seance) echo "<option>".$seance->getLib()."</option>\n";?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText"
                                    for="addIdGroupSeance">Groupe</label>
                                <div class="col-xl-8">
                                    <select class="form-control darkModeInput" name="addGroup" id="addGroup">
                                        <option value="" selected="selected"></option>
                                        <?php foreach($db->getGroups() as $groups) echo "<option>".$groups->getNom()."</option>\n";?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText"
                                    for="addIdUserSeance">Propriétaire</label>
                                <div class="col-xl-8">
                                    <select class="form-control darkModeInput" name="addUser" id="addUser">
                                        <option value="" selected="selected"></option>
                                        <?php foreach($db->getUsers() as $users) echo "<option>".$users->getPrenomUser()." ".$users->getNomUser()."</option>\n";?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn-prominfo darkModeText" type="button" data-toggle="collapse"
                    data-target="#collapseEvents" aria-expanded="false" aria-controls="collapseEvents">Critères
                    d'événement</button>
                <div class="container">
                    <div id="collapseEvents" class="collapse multi-collapse">
                        <div class="card card-body">
                            <div class="form-group row ">
                                <label class="col-xl-4 col-form-label darkModeText" for="addIdTypeEvent">Type</label>
                                <div class="col-xl-8">
                                    <select class="form-control darkModeInput" name="addTypeEvent" id="addTypeEvent">
                                        <option value="" selected="selected"></option>
                                        <?php foreach($db->getTypeEvent() as $event) echo "<option>".$event->getLibTypeEvent()."</option>\n";?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText" for="addDateEvent">Échéance entre
                                </label>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control darkModeInput" name="addDateDebEvent"
                                        id="addDateDebEvent">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-form-label darkModeText" for="addDateEvent">et </label>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control darkModeInput" name="addDateFinEvent"
                                        id="addDateFinEvent">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary darkModeText">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary darkModeText">Filtrer</button>

                </div>
            </form>
        </div>
    </div>
</div>