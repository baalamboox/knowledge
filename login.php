<?php

    //Se crean cuatro variables donde se almacenan los datos necesarios para la conexión la base de datos.
    $serverName = "localhost"; //Guarda el nombre del servidor.
    $userName = "knowledge"; //Guarda el nombre del usuario de la base de datos.
    $password = "Knowledge@1234"; //Guarda la contraseña del usuario.
    $dbName = "knowledge"; //Guarda el nombre de la base de datos que queremos usar.

    //Se crean dos variables donde se almacenan los datos optenidos en el formulario.
    $getEmailUser = $_POST["userEmail"]; //Guarda el correo electronico del usuario.
    $getPasswordUser = $_POST["userPassword"]; //Guarda la contraseña del usuario.

    //Se crean variables inicializadas con valor vacio para depues usarlas para guadar los datos optenidos de la base de datos.
    $getEmailDB = ""; //Guarda el correo electronico optenido de la base de datos.
    $getPasswordDB = ""; //Guarda la contraseña optenida de la base de datos.

    //Se crea una variable donde se almacenara la conexion a la base de datos utilizando las variable donde estan almacenados los datos necesario para la conexion.
    $connection = mysqli_connect($serverName, $userName, $password, $dbName); //Se usa el metodo mysqli_connect el cual se le tiene que pasar cuatro paramentros lo cuales son los datos de conexion.

    //Se verfica la conexion a la base de datos
    if(!$connection) { //Mediante un if se compara la variable connection si esta devuelve un false
        die("Connection failed: " . mysqli_connect_error()); //Mediante el metodo die salimos de la conexion si es que no se llevo a cabo.
    }
    
        //Se almacenan las consultas en variable, las cuales van a obtener el email y la contraseña de la base de datos la referencia para llevarlo a cabo es con el correo electronico.
        $queryEmail = "SELECT email_u FROM users WHERE email_u = '" . $getEmailUser . "'"; //Se genera una consulta para obtener el correo electronico del usuario.
        $queryPassword = "SELECT password_u FROM passwords WHERE email_u = '" . $getEmailUser . "'"; //Se genera una consulta que obtiene la contraseña del usuario.

        //Se crean dos variable donde se almacenaran la consulta del correo electronico y de la contraseña.
        $resultQueryEmail = mysqli_query($connection, $queryEmail); //Se utiliza el metodo mysqli_query para poder realizar la consulta del correo electronico, este metodo necesita dos paramentros los cuales son: la conexion a la base de datos y la consulta que queremos que realice.
        $resultQueryPassword = mysqli_query($connection, $queryPassword); //Se utiliza el metodo mysqli_query para poder realizar la consulta de la contraseña, este metodo necesita dos paramentros los cuales son: la conexion a la base de datos y la consulta que queremos que realice.
    
    
    //Se crea una estructura if para poder optener el correo electronico y almacenarlo en la variable $getEmailDB.
    if(mysqli_num_rows($resultQueryEmail) > 0) { //Mediante un if comparamos si el numero de filas es mayor a 0, para poder saber la cantidad de filas se usa el metodo mysqli_num_rows el cual necesita como parametro la consulta ya obtenida.
        //Salida de los datos.
        while($row = mysqli_fetch_assoc($resultQueryEmail)) { //Mediante un bucle while en una variable llamada $row donde se va a ir almacenando cada registro de la tabla en forma de array, dentro de este bucle se manda a llamar la variable creada al principio llamada $getEmailDB. 
            $getEmailDB = $row["email_u"]; //Mediante esta variable se va a alcenar lo que hay en la variable $row la cual tiene como valor por cada iteracion lo que haya en el campo email de la tabla. 
        }
    } else {
        echo "No se encontro correo electronico!\n";//Si no se ecuentra el registro manda error de que no existe o no esta en la base de datos.
    }

     //Se crea una estructura if para poder optener la contraseña y almacenarla en la variable $getPasswordDB.
    if(mysqli_num_rows($resultQueryPassword) > 0) {
        // Salida de los datos.
        while($row = mysqli_fetch_assoc($resultQueryPassword)) {//Mediante un bucle while en una variable llamada $row donde se va a ir almacenando cada registro de la tabla en forma de array, dentro de este bucle se manda a llamar la variable creada al principio llamada $getPasswordDB.
            $getPasswordDB = $row["password_u"];//Mediante esta variable se va a alcenar lo que hay en la variable $row la cual tiene como valor por cada iteracion lo que haya en el campo password_d de la tabla. 
        }
    } else {
        echo "No se econtro contraseña!\n";//Si no se ecuentra el registro manda un error de que no existe o no esta en la base de datos.
    }

    //Mediante un if se compara que los campos en el formulario no se encuentren vacios y que el correo electronico ingresado por el usuario se el mismo del que se obtiene de la base de datos al igual que la contraseña.
    if(($getEmailUser != '' and $getPasswordUser != '') and ($getEmailUser == $getEmailDB and $getPasswordUser == $getPasswordDB)) {
        header("Location: knowledge.html"); //Se se cumple el if cargara la pagina de perfil
    } else {
        echo "Correo electronico y/o contraseña incorreta!\n"; //En el caso de que no se cumpla el if mandara un error.
    }

    /*
    //Se crea un if para realizar la validacion del usuario.
    if(($getEmailUser == '' and $getEmailDB == '') and ($getPasswordUser == '' and $getPasswordDB == '')) {
        echo "Error registro invalido!";
    } else {
        if(($getEmailUser == $getEmailDB) and ($getPasswordUser == $getPasswordDB)) { //Dentro del if se utiliza el operador logico and para comparar el correo electronico del usuario que ingresa en el formulario, con los datos que se encuentran en la base de datos lo cuales estan almacenados en las variables $getEmailDB y $getPasswordDB. 
            echo header("Location: knowledge.html");//Si es correcto lo que ingresa el usuario con respecto a la base de datos, cargara su perfil. 
        } else {
            echo "Acceso denegado"; //Si no es correcto lo que ingresa el usuario con respecto a la base de datos, no cargara su perfil. 
        }
    }*/
    mysqli_close($connection);//Se usa el metodo mysli_close para cerrar la conexion a la base de datos.
?>