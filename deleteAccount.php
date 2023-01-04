<?php
     //Se crean cuatro variables donde se almacenan los datos necesarios para la conexión la base de datos.
     $serverName = "localhost"; //Guarda el nombre del servidor.
     $userName = "knowledge"; //Guarda el nombre del usuario de la base de datos.
     $password = "Knowledge@1234"; //Guarda la contraseña del usuario.
     $dbName = "knowledge"; //Guarda el nombre de la base de datos que queremos usar.

     $getConfirmEmail = $_POST["confirmEmail"];
     $getConfirmPassword = $_POST["confirmPassword"];

     $getEmailDB = "";
     $getPasswordDB = "";

     //Se crea una variable donde se almacenara la conexion a la base de datos utilizando las variable donde estan almacenados los datos necesario para la conexion.
    $connection = mysqli_connect($serverName, $userName, $password, $dbName); //Se usa el metodo mysqli_connect el cual se le tiene que pasar cuatro paramentros lo cuales son los datos de conexion.

    //Se realiza una consulta que se almacena un variable para obtener la contraseña del usario en la base de datos.
    $queryEmail = "SELECT email_u FROM users WHERE email_u='" . $getConfirmEmail . "'";
    $queryPassword = "SELECT password_u FROM passwords WHERE email_u='" . $getConfirmEmail . "'";
     
    //Guarda la consulta devuelta por el metodo mysqli_query, el cual necesita dos parametros, la conexion y la instruccion. 
    $resultQueryEmail = mysqli_query($connection, $queryEmail);
    $resultQueryPassword = mysqli_query($connection, $queryPassword);

    //Mediante una estructura if compara si el numero de filas del resultado de la consulta el mayor a 0, si es así ejecuta lo que esta dentro del condicional.
    if(mysqli_num_rows($resultQueryEmail) > 0) {

        //Mediante un ciclo while se va almacenando en una variable los elementos del resultado de la consulta.
        while($row = mysqli_fetch_assoc($resultQueryEmail)) {
            $getEmailDB = $row["email_u"];//Se manda a llamar a la variable donde se almacenara la constraseña obtenido de la base de datos.
        }
    } else {
        echo "No se encontro correo electronico!"; //De lo contrario pues le diga al usuario que no existe.
    }

    //Mediante una estructura if compara si el numero de filas del resultado de la consulta el mayor a 0, si es así ejecuta lo que esta dentro del condicional.
    if(mysqli_num_rows($resultQueryPassword) > 0) {

        //Mediante un ciclo while se va almacenando en una variable los elementos del resultado de la consulta.
        while($row = mysqli_fetch_assoc($resultQueryPassword)) {
            $getPasswordDB = $row["password_u"];//Se manda a llamar a la variable donde se almacenara la constraseña obtenido de la base de datos.
        }
    } else {
        echo "No se encontro contraseña!"; //De lo contrario pues le diga al usuario que no existe.
    }

    //Mediante un if se compara que esten llenos los campos del formulario y que el correo electronico del usuario sea igual al de la base de datos al igual que su contraseña.
    if(($getConfirmEmail != '' and $getConfirmPassword != '') and ($getConfirmPassword == $getPasswordDB and $getConfirmEmail == $getEmailDB)) {
        //Se almacena la instruccion para eliminar todo el registro del usuario.
        $queryDeleteAcount = "DELETE FROM users WHERE email_u = '" . $getConfirmEmail . "'";
        //Mediante un if se verifica la la eliminacion se hizo correctamente.
        if(mysqli_query($connection, $queryDeleteAcount)) {
           echo "Tu cuenta ha sido eliminada correctamente!"; 
        } else {
            echo "Ocurrio un error al eliminar la cuenta!";
        }
    } else {
        echo "Correo electronico y/o contraseña incorreta!";
    }
    /*
    //Mediante este if compara la contraseña que ingresa el usuario en el formulario con la contraseña que se obtiene de la base de datos.
    if($getConfirmPassword == $getPasswordDB) {

        //Se almacena la instruccion para eliminar todo el registro del usuario.
        $queryDeleteAcount = "DELETE FROM users WHERE email = '" . $getConfirmEmail . "'";

        //Mediate un if se verifica que el metodo mysqli_query hizo su trabajo el cual manda un true de lo contrario mandara un false.
        if(mysqli_query($connection, $queryDeleteAcount)) {

            echo "Cuenta eliminada!"; //Se le avisa al usuario que se elimino su cuenta.

        } else {
            echo "Se cancelo operacion!"; //Se le avisa al usuario que se cancelo la operacion.
        }
    } else {
        echo "Contraseña incorrecta!"; //Si las contraseñas son incorrectas se le informa al usuario que las contraseñas no coinciden.
    }
    */
    mysqli_close($connection); //Se cierra la conexion a la base de datos.
?>