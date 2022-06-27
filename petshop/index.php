<?php

error_reporting(0);
session_start();

class Facade
{
    protected $subsystem1;
    protected $subsystem2;

    public function __construct( Subsystem1 $subsystem1 = null, Subsystem2 $subsystem2 = null ) {
        $this->subsystem1 = $subsystem1 ?: new Subsystem1();
        $this->subsystem2 = $subsystem2 ?: new Subsystem2();
    }

    public function operation(): string
    {
        if(isset($_SESSION["usuarioId"])){

            if($_SESSION['usuarioNiveisAcessoId'] == "1"){ 

                return $this->subsystem1->gotoadmin();
            }
            else
            {
                return $this->subsystem2->gotohome();
            } 
        }
        else{
            return $this->subsystem2->gotohome();
        }    
    }
}

// Site -> Administração
class Subsystem1
{
    public function gotoadmin(): string
    {
        return "admin/index.php";
    }  
    
    public function gotoAdminLogin() : string
    {
        return "admin/login.php";
    }
}

// Site -> área comum
class Subsystem2
{
    public function gotohome(): string
    {
        return "site/index.php";
    }

    public function gotoAdminRegistration() : string
    {
        return "site/index.php";
    }
}


function clientCode(Facade $facade)
{
    return $facade->operation();
}


$subsystem1 = new Subsystem1();
$subsystem2 = new Subsystem2();
$facade = new Facade($subsystem1, $subsystem2);
header("Location: " . clientCode($facade));