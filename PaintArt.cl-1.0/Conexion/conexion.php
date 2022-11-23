<?php
 
    class Conexion{
        private static $instance; //Singleton, que solo existe un objeto de la clase.
        private $host;
        private $user;
        private $pass;
        private $bd;
        private $pdo;
        private $charset;

        private function __construct(){
            $this->host = "localhost:3307";// localhost->127.0.0.1 = Mi computador
            $this->user = "root";
            $this->pass = "";
            $this->bd = "paintart";
            $this->charset = "utf8mb4";
        }
        
        public static function getInstance()
        {
            if(!self::$instance instanceof self)
            {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function openConnection(){
            $dsn = "mysql:host=".$this->host.";dbname=".$this->bd.";charset=".$this->charset; //"mysql:localhost=;dbname=disenoweb;charset=utf8mb4"
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return 0;
        }
        public function query(UsuarioRegistrado $user)
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "impulsarte";
            $fecha= $user->getFechaNac();
            $f= explode("/", $fecha);
            $f=$f[2]."-".$f[0]."-".$f[1];
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql= "INSERT INTO `usuario_registrado` (`idUsuario_Registrado`, `nombre`, `apellido`, `correo`, `numeroTel`, `contraseña`, `fechaNac`, `permisos`, `rut`) VALUES ('NULL','$user->getNombre()', '$user->getApellido()','$user->getCorreo()','$user->getNumTel()','$user->getContraseña()','$f','$user->getPermiso()','$user->getRut()' ";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            
            $conn->close();              

        }

        public function useConnection()
        {
            if($this->pdo != NULL)
                return $this->pdo;
            else 
                return 0;
        }

        public function closeConnection(){
            $this->pdo = null;
        }


        public function saluda()
        {
            echo 'hola';
        }
    }
?>