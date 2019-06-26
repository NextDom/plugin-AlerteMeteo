<?php

/* This file is part of NextDom.
 *
 * NextDom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * NextDom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NextDom. If not, see <http://www.gnu.org/licenses/>.
 */


if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}


$plugin = plugin::byId('AlerteMeteo');

sendVarToJS('eqType', $plugin->getId());
$eqLogics = eqLogic::byType($plugin->getId());
?>
<div class="row row-overflow">
    <!-- Sidebar -->
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <!-- Ajout -->
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add">
                    <i class="fa fa-plus-circle"></i> {{Ajouter}}
                </a>
                <!-- Recherche -->
                <li class="filter" style="margin-bottom: 5px;">
                    <input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%" />
                </li>
                <?php
                foreach ($eqLogics as $eqLogic) {
                    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
                    echo '<li class="li_eqLogic cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="' . $opacity . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- Elements -->
    <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
        <legend><i class="fa fa-cog"></i> {{Gestion}}</legend>
        <div class="eqLogicThumbnailContainer">
            <div class="eqLogicAction cursor" data-action="add" style="text-align: center; background-color : #ffffff; height : 120px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
                <i class="fa fa-plus-circle" style="font-size : 6em;color:#33b8cc;"></i>
                <br>
                <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#33b8cc">{{Ajouter}}</span>
            </div>
            <div class="eqLogicAction cursor" data-action="gotoPluginConf" style="text-align: center; background-color : #ffffff; height : 120px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
                <i class="fa fa-wrench" style="font-size : 6em;color:#767676;"></i>
                <br>
                <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676">{{Configuration}}</span>
            </div>
        </div>
        <br>
        <div id="objectList" class="panel-group">
            <!-- Prévisions -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#objectList" href="#forecastObjectList"> {{Prévisions}} </a>
                        <span class="badge">
                            <?php
                            $objectNumber = 0;
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'forecast') {
                                    ++$objectNumber;
                                }
                            }
                            echo $objectNumber;
                            ?>
                        </span>
                    </h4>
                </div>
                <div id="forecastObjectList" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="eqLogicThumbnailContainer">
                            <?php
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'forecast') {
                                    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
                                    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
                                    echo '<img src="plugins/AleterMeteo/resources/images/forecast.png" height="100" width="100" />';
                                    echo "<br>";
                                    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vigilances -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#objectList" href="#alertObjectList"> {{Vigilances}} </a>
                        <span class="badge">
                            <?php
                            $objectNumber = 0;
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'alert') {
                                    ++$objectNumber;
                                }
                            }
                            echo $objectNumber;
                            ?>
                        </span>
                    </h4>
                </div>
                <div id="alertObjectList" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="eqLogicThumbnailContainer">
                            <?php
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'alert') {
                                    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
                                    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
                                    echo '<img src="plugins/AleterMeteo/resources/images/alert.png" height="100" width="100" />';
                                    echo "<br>";
                                    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cyclones -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#objectList" href="#hurricaneObjectList"> {{Alertes cycloniques}} </a>
                        <span class="badge">
                            <?php
                            $objectNumber = 0;
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'hurricane') {
                                    ++$objectNumber;
                                }
                            }
                            echo $objectNumber;
                            ?>
                        </span>
                    </h4>
                </div>
                <div id="hurricaneObjectList" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="eqLogicThumbnailContainer">
                            <?php
                            foreach ($eqLogics as $eqLogic) {
                                if ($eqLogic->getConfiguration('eqType') == 'hurricane') {
                                    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
                                    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
                                    echo '<img src="plugins/AleterMeteo/resources/images/hurricane.png" height="100" width="100" />';
                                    echo "<br>";
                                    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
        <a class="btn btn-success eqLogicAction pull-right" data-action="save">
            <i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
        <a class="btn btn-danger eqLogicAction pull-right" data-action="remove">
            <i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
        <a class="btn btn-default eqLogicAction pull-right" data-action="configure">
            <i class="fa fa-cogs"></i> {{Configuration avancée}}</a>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
                <a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay">
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </li>
            <li role="presentation" class="active">
                <a href="#eqLogicTab" aria-controls="home" role="tab" data-toggle="tab">
                    <i class="fa fa-microchip"></i> {{Alerte}}</a>
            </li>
            <li role="presentation">
                <a href="#settingsTab" aria-controls="profile" role="tab" data-toggle="tab">
                    <i class="fa fa-wrench"></i> {{Paramètres}}</a>
            </li>
            <li role="presentation">
                <a href="#commandTab" aria-controls="avatar" role="tab" data-toggle="tab">
                    <i class="fa fa-list-alt"></i> {{Commandes}}</a>
            </li>
        </ul>
        <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
            <div role="tabpanel" class="tab-pane active" id="eqLogicTab">
                <br />
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{Alerte}}</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="objectName">{{Nom de l'alerte}}</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="eqLogicAttr form-control display-none" data-l1key="id" />
                                            <input id="objectName" type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de la surveillance}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="sel_object">{{Objet parent}}</label>
                                        <div class="col-sm-5">
                                            <select id="sel_object" class="eqLogicAttr form-control cursor" data-l1key="object_id">
                                                <option value="">{{Aucun}}</option>
                                                <?php
                                                foreach (object::all() as $object) {
                                                    echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">{{Catégorie}}</label>
                                        <div class="col-sm-9">
                                            <?php
                                            foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
                                                echo '<label class="checkbox-inline">';
                                                echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">{{Alerte}}</label>
                                        <div class="col-sm-5">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked />{{Activer}}</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked />{{Visible}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="eqType">{{Type d'alerte}}</label>
                                        <div class="col-sm-5">
                                            <select id="eqType" class="eqLogicAttr form-control cursor" data-l1key="configuration" data-l2key="eqType">
                                                <option value="forecast">{{Prévision}}</option>
                                                <option value="alert">{{Vigilance}}</option>
                                                <option value="hurricane">{{Alerte cyclonique}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="comment">{{Commentaire}}</label>
                                        <div class="col-sm-5">
                                            <textarea id="comment" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="commentaire"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settingsTab">
                <br />
                <div id="settingsPanels"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="commandTab">
                <br />
                <div id="commandsPanels"></div>
            </div>
        </div>
    </div>
</div>
<?php
include_file('desktop', 'AlerteMeteo', 'js', 'AlerteMeteo');
include_file('core', 'plugin.template', 'js');
