<?php

    //Se crean cuatro variables donde se almacenan los datos necesarios para la conexión la base de datos.
    $serverName = "localhost"; //Guarda el nombre del servidor.
    $userName = "knowledge"; //Guarda el nombre del usuario de la base de datos.
    $password = "Knowledge@1234"; //Guarda la contraseña del usuario.
    $dbName = "knowledge"; //Guarda el nombre de la base de datos que queremos usar.

    //Se crean dos variables donde se almacenan los datos optenidos en el formulario.
    $getEmailUser = $_POST["updateUserEmail"]; //Guarda el correo electronico del usuario.
    $getNamesUser = $_POST["updateUserNames"];
    $getSurnameUser = $_POST["updateUserSurname"];
    $getPasswordUser = $_POST["updatePasswordUser"];
    $getConfirmPasswordUser = $_POST["updateConfirmPasswordUser"];

    //Se crea una variable donde se almacenara la conexion a la base de datos utilizando las variable donde estan almacenados los datos necesario para la conexion.
    $connection = mysqli_connect($serverName, $userName, $password, $dbName); //Se usa el metodo mysqli_connect el cual se le tiene que pasar cuatro paramentros lo cuales son los datos de conexion.

    //Se verifica la conexion a la base de datos
    if(!$connection) { //Mediante un if se compara la variable connection si esta devuelve un false
        die("Connection failed: " . mysqli_connect_error()); //Mediante el metodo die salimos de la conexion si es que no se llevo a cabo.
    }
    //Verifica si el correo electronico existe para poder realizar actualizaciones.
    if($getEmailUser != '') {
        //Se verifica mediante un if si existe algo en ese campo para poder actualizar.
        if($getNamesUser != '') {
            $updateNames = "UPDATE users SET names_u='" . $getNamesUser . "' WHERE email_u='" . $getEmailUser . "'";
            if(mysqli_query($connection, $updateNames)) {
                echo "Nombre(s) actualizados correctamente!\n";
            } else {
                echo "No se actualizo Nombre(s)!\n";
            }
        } else {
            echo "No se actualizo Nombre(s)!\n";
        }
         //Se verifica mediante un if si existe algo en ese campo para poder actualizar.
        if($getSurnameUser != '') {
            $updateSurname = "UPDATE users SET surname_u='" . $getSurnameUser . "' WHERE email_u='" . $getEmailUser . "'";
            if(mysqli_query($connection, $updateSurname)) {
                echo "Apellido actualizado!\n";
            } else {
            echo  "No se actualizo Apellido!\n";
            }
        } else {
            echo "No se actualizo Apellido!\n";
        }
        //Se verfica mediante un if si las contraseñas a actualizar son correctas. 
        if($getPasswordUser == $getConfirmPasswordUser) {
             //Se verifica mediante un if si existe algo en ese campo para poder actualizar.
            if($getPasswordUser != '' and $getConfirmPasswordUser != '') {
                $updatePassword = "UPDATE passwords SET password_u='" . $getPasswordUser . "' WHERE email_u='" . $getEmailUser . "'";
                if(mysqli_query($connection, $updatePassword)) {
                    echo "Contraseña actualizada!\n";
                } else {
                    echo "Contraseña no actualizada!\n";
                }
            } else {
                echo "Contraseña no actualizada!\n";
            }
        } else {
            echo "La contraseña no coincide!\n";
        }
    } else {
        echo "Se debe ingresar correo electronico para actualizar datos!\n";
    }
    /*
    //Se almacenan las consultas en variable, las cuales van a obtener el email y la contraseña de la base de datos la referencia para llevarlo a cabo es con el correo electronico.
    $queryEmail = "SELECT email FROM users WHERE email = '" . $getEmailUser . "'"; //Se genera una consulta para obtener el correo electronico del usuario.
    $queryPassword = "SELECT password_d FROM passwords WHERE email = '" . $getEmailUser . "'"; //Se genera una consulta que obtiene la contraseña del usuario.

    //Se crean dos variable donde se almacenaran la consulta del correo electronico y de la contraseña.
    $resultQueryEmail = mysqli_query($connection, $queryEmail); //Se utiliza el metodo mysqli_query para poder realizar la consulta del correo electronico, este metodo necesita dos paramentros los cuales son: la conexion a la base de datos y la consulta que queremos que realice.
    $resultQueryPassword = mysqli_query($connection, $queryPassword); //Se utiliza el metodo mysqli_query para poder realizar la consulta de la contraseña, este metodo necesita dos paramentros los cuales son: la conexion a la base de datos y la consulta que queremos que realice.
    
    
    //Se crea una estructura if para poder optener el correo electronico y almacenarlo en la variable $getEmailDB.
    if(mysqli_num_rows($resultQueryEmail) > 0) { //Mediante un if comparamos si el numero de filas es mayor a 0, para poder saber la cantidad de filas se usa el metodo mysqli_num_rows el cual necesita como parametro la consulta ya obtenida.
        //Salida de los datos.
        while($row = mysqli_fetch_assoc($resultQueryEmail)) { //Mediante un bucle while en una variable llamada $row donde se va a ir almacenando cada registro de la tabla en forma de array, dentro de este bucle se manda a llamar la variable creada al principio llamada $getEmailDB. 
            $getEmailDB = $row["email"]; //Mediante esta variable se va a alcenar lo que hay en la variable $row la cual tiene como valor por cada iteracion lo que haya en el campo email de la tabla. 
        }
    } else {
        echo "No se encontro correo electronico!";//Si no se ecuentra el registro manda error de que no existe o no esta en la base de datos.
    }

     //Se crea una estructura if para poder optener la contraseña y almacenarla en la variable $getPasswordDB.
    if(mysqli_num_rows($resultQueryPassword) > 0) {
        // Salida de los datos.
        while($row = mysqli_fetch_assoc($resultQueryPassword)) {//Mediante un bucle while en una variable llamada $row donde se va a ir almacenando cada registro de la tabla en forma de array, dentro de este bucle se manda a llamar la variable creada al principio llamada $getPasswordDB.
            $getPasswordDB = $row["password_d"];//Mediante esta variable se va a alcenar lo que hay en la variable $row la cual tiene como valor por cada iteracion lo que haya en el campo password_d de la tabla. 
        }
    } else {
        echo "No se econtro contraseña!";//Si no se ecuentra el registro manda un error de que no existe o no esta en la base de datos.
    }
    */
    mysqli_close($connection);//Se usa el metodo mysli_close para cerrar la conexion a la base de datos.
?>