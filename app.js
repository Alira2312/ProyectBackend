var app = angular.module('myApp', ['angucomplete-alt']);
app.controller('myCtrl', function($scope, $http) {
    $scope.dragonball_characters = [];
    $scope.searchMaster = '';
    Get_All_Dragonball()

    function Get_All_Dragonball() {
        $http({
            method: 'GET',
            url: 'https://dragonball-api.com/api/characters?page=1&limit=30',
            headers: { "Content-Type": "application/json" }
        }).then(function(response) {
            $scope.list_Dragonball = response.data.items;

            console.log(response.data);
        }).catch(function(error) {
            console.log('error', error);
        });
    };

    Get_DragonBallCharacters()

    function Get_DragonBallCharacters() {
        $http({
            method: 'GET',
            url: 'http://localhost/apiDragon/controller/apis.php/dragonball_characters',
            headers: { "Content-Type": "application/json" }
        }).then(function(response) {
            $scope.dragonball_characters = response.data;
            $scope.edit = false;
            console.log(response.data);
        }).catch(function(error) {
            console.log('error', error);
        });
    };



    function fn_AddDragonBallCharacter() {


        $http({
            method: 'POST',
            url: 'http://localhost/apiDragon/controller/apis.php/dragonball_characters',
            data: $scope.newDragonBallCharacter,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            console.log(response.data);

            if (response.data.mensaje) {
                Alert_Success(response.data.mensaje)
            } else {
                Alert_Error(response.data.error)
            }
            Get_DragonBallCharacters();
        }).catch(function(error) {
            console.log('error', error);
        });
    };

    function fn_deleteDragonBallCharacter(data) {


        $http({
            method: 'DELETE',
            url: 'http://localhost/apiDragon/controller/apis.php/dragonball_characters/' + data.id,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            console.log(response.data);

            if (response.data.mensaje) {
                Alert_Success(response.data.mensaje)
            } else {
                Alert_Error(response.data.error)
            }
            Get_DragonBallCharacters();
        }).catch(function(error) {
            console.log('error', error);
        });
    };
    fn_deleteAll_DragonBallCharacters()

    function fn_deleteAll_DragonBallCharacters() {


        $http({
            method: 'DELETE',
            url: 'http://localhost/apiDragon/controller/apis.php/eliminar_todos_los_personajes',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            console.log(response.data);

            if (response.data.mensaje) {
                Alert_Success(response.data.mensaje)
            } else {
                Alert_Error(response.data.error)
            }
            Get_DragonBallCharacters();
        }).catch(function(error) {
            console.log('error', error);
        });
    };

    function fn_UpdateDragonBallCharacter() {


        $http({
            method: 'PUT',
            url: 'http://localhost/apiDragon/controller/apis.php/actualizar_personaje/' + $scope.newDragonBallCharacter.id,
            data: $scope.newDragonBallCharacter,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            console.log(response.data);

            if (response.data.mensaje) {
                Alert_Success(response.data.mensaje)
            } else {
                Alert_Error(response.data.error)
            }
            Get_DragonBallCharacters();
        }).catch(function(error) {
            console.log('error', error);
        });
    };



    function obtenerUltimoId() {
        if ($scope.dragonball_characters.length === 0) {
            return 1;
        } else {
            const lastDragonBallCharacter = $scope.dragonball_characters[$scope.dragonball_characters.length - 1];
            return lastDragonBallCharacter.id + 1;
        }
    }

    $scope.openModal = function(data, edit) {
        if (edit) {
            $scope.newDragonBallCharacter = data;
        } else {
            $scope.newDragonBallCharacter = {};

        }
        $scope.edit = edit;
        $('#myModal').modal('show');
    };

    $scope.openmodal_info = function(data) {
        $('#myModalinfo').modal('show');
        $scope.Data = data;
    }

    $scope.addDragonBallCharacter = function(_var) {
        $('#myModal').modal('hide');
        if (!$scope.edit) {
            fn_AddDragonBallCharacter();
        } else {
            fn_UpdateDragonBallCharacter()
        }
    };

    $scope.Delete_DragonBallCharacter = function(_var) {
        fn_deleteDragonBallCharacter(_var);
    }

    $scope.Update_DragonBallCharacter = function(_var) {
        fn_UpdateDragonBallCharacter();
    }

    $scope.SearchSelected = function(selected) {

        if (selected.originalObject.name) {
            $scope.newDragonBallCharacter = selected.originalObject;
            $scope.newDragonBallCharacter.id = obtenerUltimoId();
        }
    };

    function Alert_Success(text) {
        Swal.fire({
            position: "center",
            icon: "success",
            title: text,
            showConfirmButton: false,
            timer: 1500
        });
    }

    function Alert_Error(text) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: text,
        });
    }






    const API_URL = 'https://api.exchangerate-api.com/v4/latest/USD';

    // Función para obtener el tipo de cambio USD/MXN
    async function obtenerTipoCambio() {
        const response = await fetch(API_URL);
        const data = await response.json();

        // Extraer el tipo de cambio MXN
        const tipoCambioMXN = data.rates.MXN;

        // Mostrar el tipo de cambio
        console.log(`El tipo de cambio USD/MXN es: ${tipoCambioMXN}`);

        $scope.tipoCambio = tipoCambioMXN;

    }

    // Ejemplo de uso

    obtenerTipoCambio()
});