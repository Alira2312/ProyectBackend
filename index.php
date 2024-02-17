<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tabla con Bootstrap y AngularJS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="http://binmanager.mitechnologiesinc.com/assets/js/Plugins/angucomplete-alt/angucomplete-alt.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .angucomplete-dropdown {
            overflow-y: auto;
            max-height: 200px; /*your preference*/
            width: 100%;
        }

        .zoom-effect {
            transition: transform 0.5s;
        }

        .zoom-effect:hover {
            transform: scale(1.2);
        }
</style>

<body ng-app="myApp" id="V_MovementApp2" ng-controller="myCtrl" style="background-image: url(&quot;https://i.pinimg.com/564x/3d/bb/0a/3dbb0a1c726f41cddeefb3a28272cd4b.jpg&quot;);">
    <div class="ml-2 mr-2">
        <h1 style="color:white">Personajes de Dragonball</h1>
        <div class="col-4" style="position: absolute;left:79%;top:1px;">
            <div id="cont_e937dbe45975ecd21c3e42c4aa7c9384">
                <script type="text/javascript" async src="https://www.meteored.mx/wid_loader/e937dbe45975ecd21c3e42c4aa7c9384"></script>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <input type="text" class="form-control" ng-model="searchMaster">

            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" ng-click="openModal()">Agregar nuevo</button>
            </div>
            <div class="col-4">
                <h4>Tipo de cambio hoy : {{ tipoCambio|currency }}</h4>
            </div>

        </div>
        <div class=" ">
            <div class="row">
                <div class="col-md-3 mt-2" ng-repeat="dragon in dragonball_characters | filter:searchMaster ">
                    <div class="card" style="color: white;background-color: #191919db!important;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                <h5 class="card-title">{{dragon.id}}-{{ dragon.name }}</h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-trash text-danger" ng-click="Delete_DragonBallCharacter(dragon)"></i>
                                    <i class="fa fa-edit text-warning" ng-click="openModal(dragon,true)"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            
                            <img width="200" class="zoom-effect" height="330" src="{{dragon.image}}" alt="">
                            
                        </div>
                        <div class="card-footer">
                            
                            <p class="card-text">Rasa: {{ dragon.race }}</p>
                            <p class="card-text">Genero: {{ dragon.gender }}</p>
                            <p class="card-text">KI: {{ dragon.ki }}</p>
                            <p class="card-text">Max KI: {{ dragon.maxKi }}</p>
                            <div class="row">
                                <div class="col-9">
                                    <p class="card-text">Afiliacion: {{ dragon.affiliation }}</p>
                                </div>
                                <div class="col-3">
                                    <p class="card-text text-info" ng-click=openmodal_info(dragon)>More info</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Agregar/Editar personaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ng-submit="addDragonBallCharacter()">
                        <div class="form-group" ng-show="!edit">
                            <div class="">
                                <div class="input-search ">
                                    
                                    <div angucomplete-alt id="MovementSearchId"
                                            placeholder="Example: Goku, Vegueta"
                                            pause="100"
                                            selected-object="SearchSelected"
                                            local-data="list_Dragonball"
                                            search-fields="name"
                                            title-field="name"
                                            description-field="description"
                                            image-field="image"
                                            minlength="2"
                                            input-class="form-control"
                                            match-class="highlight"
                                            focus-in="focusIn()"
                                            override-suggestions="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <img src="{{newDragonBallCharacter.image}}" width="80" alt="">
                        </div>
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input disabled type="text" class="form-control" id="id" ng-model="newDragonBallCharacter.id" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" ng-model="newDragonBallCharacter.name" required>
                        </div>
                        <div class="form-group">
                            <label for="especie">ki</label>
                            <input type="text" class="form-control" id="ki" ng-model="newDragonBallCharacter.ki" required>
                        </div>
                        <div class="form-group">
                            <label for="especie">maxKi</label>
                            <input type="text" class="form-control" id="maxKi" ng-model="newDragonBallCharacter.maxKi" required>
                        </div>
                        <div class="form-group">
                            <label for="especie">gender</label>
                            <input type="text" class="form-control" id="gender" ng-model="newDragonBallCharacter.gender" required>
                        </div>
                        <div class="form-group">
                            <label for="especie">description</label>
                            <textarea name="" id="" ng-model="newDragonBallCharacter.description" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edad">affiliation</label>
                            <input type="text" class="form-control" id="affiliation" ng-model="newDragonBallCharacter.affiliation">
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModalinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Info personaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>{{Data.name}}</h3>
                    <span>
                        {{Data.description}}
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="http://binmanager.mitechnologiesinc.com/assets/js/Plugins/angucomplete-alt/angucomplete-alt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script src="app.js"></script>
</body>

</html>