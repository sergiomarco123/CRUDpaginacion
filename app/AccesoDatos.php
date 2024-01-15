<?php
include_once "Cliente.php";
include_once "config.php";
class MySQLException extends Exception {};

/*
 * Acceso a datos con BD Clientes: 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh = null; 
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo cuantos filas tiene la tabla

    public function numClientes ():int {
      $result = $this->dbh->query("SELECT id FROM Clientes");
      $num = $result->rowCount();  
      return $num;
    } 
    

    // SELECT Devuelvo la lista de Clients
    public function getClientes ($primero,$cuantos):array {
        $tuser = [];
        // Crea la sentencia preparada
        $stmt_usuarios  = $this->dbh->prepare("select * from Clientes limit $primero,$cuantos");
         // Los resultados se devuelven como objetos de la clase Cliente
         $stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        // Obtengo los resultados
        $result = $stmt_usuarios->fetch();
        // Ejecuto la sentencias
        if ( $stmt_usuarios->execute() ){
                    //$tuser = $stmt_usuarios->fetchAll();
                    // Mientra $user no sea false, sea un objeto
                while ( $user = $stmt_usuarios->fetch()){
                // añado ese objeto a la tabla
                $tuser[]= $user;
                }
        // Devuelvo el array de objetos
        return $tuser;
        }
    }

    public function getCliente (String $id) {
        $user = false;
        $stmt_cliente   = $this->dbh->prepare("select * from Clientes where id=$id");
        $stmt_cliente->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        if ( $stmt_cliente->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_cliente->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }

   /* public function setClientes($nombre,$apellido,$email,$genero,$ip,$telefono){
           
        $stmt_add_usuarios  = $this->dbh->prepare("insert into Clientes (first_name,last_name,email,gender,ip_address,telefono) Values($nombre,$apellido,$email,$genero,$ip,$telefono)");
       // if ( $stmt_add_usuarios == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        $stmt_add_usuarios->execute();
        if($this->dbh->query($stmt_add_usuarios)) {
            $estado = "<p>Registro insertado con éxito</p>";
          } else {
            $estado = "<p>Hubo un error al ejecutar la sentencia de inserción: {$$this->dbh->error}</p>";
          }
       
        $output="llega con exito";
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";

        return $estado;

    }*/

    public function addUsuario($cliente):bool{
        try{
        $stmt_creauser  = $this->dbh->prepare("insert into Clientes (first_name,last_name,email,gender,ip_address,telefono) Values(?,?,?,?,?,?)");
        $stmt_creauser->execute([$cliente->first_name,$cliente->last_name,$cliente->email,$cliente->gender,$cliente->ip_address,$cliente->telefono]);
        $resu = ($stmt_creauser->rowCount() == 1);
        $_SESSION['añadido'] = "$cliente->first_name añadido con exito";
        return $resu; 
        } catch (PDOException $e) {
            // Manejo de la excepción
            echo "Error: " . $e->getMessage();
            $_SESSION['añadido'] = "Cliente NO se ha añadido con exito";
            return false;
        }
    }

    public function deleteUsuario($id):bool{
        try{
            $stmt_deleteuser  = $this->dbh->prepare("DELETE FROM clientes where id=$id");
            $stmt_deleteuser->execute();
            $resu = ($stmt_deleteuser->rowCount() == 1);
            echo "<script>alert('El cliente se ha eliminado con exito');</script>";
            return $resu; 
            } catch (PDOException $e) {
                // Manejo de la excepción
                echo "Error: " . $e->getMessage();
                echo "<script>alert('El cliente NO ha podido eliminar');</script>";
                return false;
            }
    }

    public function modUsuario($cliente):bool{
        try{
        $stmt_modauser  = $this->dbh->prepare("UPDATE clientes SET first_name='$cliente->first_name',last_name='$cliente->last_name',email='$cliente->email',gender='$cliente->gender',ip_address='$cliente->ip_address',telefono='$cliente->telefono' WHERE id=$cliente->id");
        $stmt_modauser->execute();
        $resu = ($stmt_modauser->rowCount() == 1);
        $_SESSION['modificado'] = "$cliente->first_name modificado con exito. Con id $cliente->id";
        return $resu; 
        } catch (PDOException $e) {
            // Manejo de la excepción
            echo "Error: " . $e->getMessage();
            $_SESSION['modificado'] = "Cliente NO se ha modificado";
            return false;
        }
    }
    
}
    
