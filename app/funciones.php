<?php
include_once "AccesoDatos.php";
function accionNuevo(){
        $cliente = new Cliente();
        $cliente->first_name = "";
        $cliente->last_name="";
        $cliente->email ="";
        $cliente->gender="";
        $cliente->ip_address="";
        $cliente->telefono="";

        $orden= "Nuevo";
        include_once "plantillas/Formulario.php";
        exit();
    }
    function accionPostAlta(){
        $cliente = new Cliente();
        $cliente->first_name = $_GET['nombre'];
        $cliente->last_name=$_GET['apellido'];
        $cliente->email =$_GET['email'];
        $cliente->gender=$_GET['genero'];
        $cliente->ip_address=$_GET['ip'];
        $cliente->telefono=$_GET['telefono'];
        

        $db = AccesoDatos::getModelo();
        $db->addUsuario($cliente);
        $estado=$_SESSION['añadido'];
        echo "<script>alert('". $estado ."');</script>";
       // echo "<script>alert('hola');</script>";
    }
    function accionBorrar($id){
        $db = AccesoDatos::getModelo();
        $db->deleteUsuario($id);
    }
    function accionModificar($id){
        //$_SESSION['id_cliente'] =$id;
        $db = AccesoDatos::getModelo();
        $cliente=$db->getCliente($id);
        $orden= "Modificar";
        include_once "plantillas/Formulario.php";
        exit();
    }
    function accionPostModificar(){
        $cliente = new Cliente();
        $cliente->id = $_GET['id'];
        $cliente->first_name = $_GET['nombre'];
        $cliente->last_name=$_GET['apellido'];
        $cliente->email =$_GET['email'];
        $cliente->gender=$_GET['genero'];
        $cliente->ip_address=$_GET['ip'];
        $cliente->telefono=$_GET['telefono'];
        

        $db = AccesoDatos::getModelo();
        $db->modUsuario($cliente);
        $estado=$_SESSION['modificado'];
        echo "<script>alert('". $estado ."');</script>";
    }
