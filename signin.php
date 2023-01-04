<?php
    //Se crean cuatro variables donde se almacenan los datos necesarios para la conexión la base de datos.
    $serverName = "localhost"; //Guarda el nombre del servidor.
    $userName = "knowledge"; //Guarda el nombre del usuario de la base de datos.
    $password = "Knowledge@1234"; //Guarda la contraseña del usuario.
    $dbName = "knowledge"; //Guarda el nombre de la base de datos que queremos usar.

    //Se crean dos variables donde se almacenan los datos optenidos en el formulario crear una cuenta.
    $getNewUserNames = $_POST["newUserNames"]; //Guarda el nombre del usuario a registrar.
    $getNewUserFirstSurname = $_POST["newUserFirstSurname"]; //Guarda el primer apellido del usuario a registrar
    $getNewEmailUser = $_POST["newUserEmail"]; //Guarda el correo electronico del usuario a registrar.
    $getNewUserPassword = $_POST["newUserPassword"]; //Guarda la contraseña del usuario a registrar.
    $getNewUserPasswordAgain = $_POST["newUserPasswordAgain"]; //Guarda de nuevo la contraseña del usuario a registrar para despues comparar si son correctas.
    
    //Se crea una variable donde se almacenara la conexion a la base de datos utilizando las variable donde estan almacenados los datos necesario para la conexion.
    $connection = mysqli_connect($serverName, $userName, $password, $dbName); //Se usa el metodo mysqli_connect el cual se le tiene que pasar cuatro paramentros lo cuales son los datos de conexion.
    
    //Se verfica la conexion a la base de datos
    if (!$connection) { //Mediante un if se compara la variable connection si esta devuelve un false
        die("Connection failed: " . mysqli_connect_error()); //Mediante el metodo die salimos de la conexion si es que no se llevo a cabo.
    }

    //Se verifica que no existan campos vacios.
    if($getNewUserNames != '' and $getNewUserFirstSurname != '' and $getNewEmailUser != '' and $getNewUserPassword != '' and $getNewUserPasswordAgain != '') {
        //Compara si las las contraseñas son iguales.
        if($getNewUserPassword == $getNewUserPasswordAgain) {
            //Verifica si la contraseña se encuentra entre un rago de 4 a 8.
            if((strlen($getNewUserPassword) >= 4) and (strlen($getNewUserPassword) <= 8)) {
                //Se crean dos variables donde se van a guardar la instrucción de insertar los datos en la tabla users y la tabla passwords.
                $insertIntoUsers = "INSERT INTO users(email_u, names_u, first_surname_u) VALUES ('" . $getNewEmailUser . "', '" . $getNewUserNames . "', '" . $getNewUserFirstSurname . "')";
                $insertIntoPasswords = "INSERT INTO passwords(email_u, password_u) VALUES ('" . $getNewEmailUser . "', '" . $getNewUserPassword . "')";
                //Mediante un if se verifica si se inserto correctamente los datos.
                if((mysqli_query($connection, $insertIntoUsers)) and (mysqli_query($connection, $insertIntoPasswords))) {
                    echo "El usuario se registro correctamente!\n";
                } else {
                    echo "Ya existe el usuario!\n";
                }
            } else {
                echo "La contraseña no cumple lo requerido!\n";
            }
        } else {
            echo "La contraseña no coincide!\n";
        }
    } else {
        echo "No deben de existir campos vacios!\n";
    }



    /*
    if($getNewUserNames == '' or $getNewUserFirstSurname == '' or $getNewEmailUser == '' or $getNewUserPassword = '' or $getNewUserPasswordAgain = '') {
        echo 'No deben de existir campos vacios!';
    } else {
        //Validar las dos contraseñas que ingresa el usuario para ver si son correctas.
        if($getNewUserPassword == $getNewUserPasswordAgain) { //Dentro de una estructura if se compara si la contraseña que ingreso el usuario es igual a la contreseña obtenida en la base de datos.
            //Se crea dos variables que guardaran lo que se va a insertar en las tablas users y passwords. 
            /*if(strlen($getNewUserPassword) >= 4 and strlen($getNewUserPassword) <= 8) {
                
                $insertIntoUsers = "INSERT INTO users(email, name_s, surname) VALUES ('" . $getNewEmailUser . "', '" . $getNewUserNames . "', '" . $getNewUserFirstSurname . "')";
                $insertIntoPasswords = "INSERT INTO passwords(email, password_d) VALUES ('" . $getNewEmailUser . "', '" . $getNewUserPassword . "')";
                //Mediante un if hacemos la insercion de los datos del nuevo usuario usando el metodo mysqli_query pero utilizando un operador logico para que sean dos operaciones a la vez, si la insercion se llevo a cabo el if se cumple y manda un mensaje de que se inserto correctamente.
                if(mysqli_query($connection, $insertIntoUsers) && mysqli_query($connection, $insertIntoPasswords)) {
                    echo "Se registro el usuario correctamente!";
                } else {
                    echo "Error de registro!"; //De lo contrario si la insercion manda algun error pues mandara un mensaje de error.
                }
            } else {
                echo "La contraseña debe ser mayo a 4 caracteres y menor a 8!";
            }
            echo "Contraseñas correctas!";
        } else {
            echo "Contraseñas erroneas!"; //Si la contraseñas son diferentes al momento de que las ingrese el usuario, mandara un mensaje para que vea que no son correctas y lo vuelva a intentar.
        }
    }*/



    mysqli_close($connection); //Se usa el metodo mysli_close para cerrar la conexion a la base de datos.
?>