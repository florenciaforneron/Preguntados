<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once('third-party/PHPMailer-master/src/Exception.php');
include_once('third-party/PHPMailer-master/src/PHPMailer.php');
include_once('third-party/PHPMailer-master/src/SMTP.php');

class homeController {
    private $render;
    private $model;

    public function __construct($render, $model) {
        $this->render = $render;
        $this->model = $model;

    }

    public function list() {
        if(!isset($_SESSION["usuario"])) {
            $data = [];
            $this->render->printView('home', $data);
        }
    }

    public function alta(){
        $data = [];

        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }

        $data['action'] = '/home/procesarAlta';
        $data['submitText'] = 'Crear';
        $this->render->printView('formAlta', $data);
    }

    public function procesarAlta() {
        if (empty($_POST['contrasenia']) || empty($_POST['usuario']) || empty($_POST['correo']) || empty($_POST['nombreCompleto'])
            || empty($_POST['fecha_nacimiento']) || empty($_POST["pais"]) || empty($_POST['sexo'])) {
            $_SESSION["error"] = "Alguno de los campos era erróneo o vacío";
            Redirect::to('/home/alta');
        }

        $contrasenia = $_POST["contrasenia"];
        $usuario = $_POST['usuario'];
        $mail = $_POST['correo'];
        $nombreCompleto = $_POST['nombreCompleto'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $nacionalidad = $_POST["pais"];
        $sexo = $_POST['sexo'];
        $imagen = isset($_FILES["foto_perfil"]["name"]) ? "/public/imagenes/".$_FILES["foto_perfil"]["name"] : "";

        if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == 0) {
            $imagen = $_FILES["foto_perfil"]["name"];
            $rutaTemporal = $_FILES["foto_perfil"]["tmp_name"];

            // Directorio donde se guardarán las imágenes
            $directorioDestino = "public/imagenes/";

            // Asegúrate de que el directorio exista o créalo
            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            // Mueve el archivo a la ubicación deseada
            $rutaDestino = $directorioDestino . $imagen;
            move_uploaded_file($rutaTemporal, $rutaDestino);


            echo "Imagen subida con éxito.";
        } else {
            echo "Error al subir la imagen.";
        }

        if($_SESSION['idRol'] == 0) {
            $this->sendMail($mail, $usuario);
        } else {
            echo("poner algun error");
        }


        $this->model->alta($contrasenia, $usuario, $mail, $nombreCompleto, $fecha_nacimiento, $nacionalidad, $sexo, $imagen);



        //FALTA VERIFICAR SI EL USUARIO ESTA VALIDADO Y SI NO ES ASI, LLAMAR AL METODO SEND.
        Redirect::root();
    }

    public function sendMail($mailUsuario, $usuario) {
        //florenciaforneron93@gmail.com
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com'; // Cambia esto al host SMTP correspondiente
        $mail->SMTPAuth = true;
        $mail->Username = 'mentestpw2@outlook.com'; // Cambia esto al correo de origen
        $mail->Password = 'prograweb2'; // Cambia esto a tu contraseña de correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O ENCRYPTION_SMTPS si tu servidor SMTP lo usa
        $mail->Port = 587; // Cambia esto al puerto SMTP correspondiente

        // Configurar el correo
        $mail->setFrom('mentestpw2@outlook.com', 'Mentest');
        $mail->addAddress($mailUsuario, $usuario);
        $mail->Subject = 'Validación de cuenta';
        $mail->isHTML(true);
        $enlace = 'https://localhost:80/validarCuenta.php?usuario=' . urlencode($usuario); // Enlace para validar cuenta
        $mail->Body = 'Por favor, haz clic en este <a href="' . $_SERVER['SERVER_NAME'] . '">enlace</a> para validar tu cuenta.';

        try {
            // Enviar correo
            $mail->send();
            echo 'Correo enviado correctamente';
        } catch (Exception $e) {
            echo 'Error al enviar el correo: ', $mail->ErrorInfo;
        }
    }

    public function login(){

        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['password'];
        $usuarioConectado = $this->model->usuarioPorNombreYContrasenia($usuario, $contrasenia);


        if(sizeof($usuarioConectado)==1){
            $idRol = $this->model->getIdRolPorUsuario($usuario);
            if($idRol == 0){
                Redirect::to("/home");
            }
            $_SESSION["usuario"]=$usuario;
            $_SESSION["idRol"]=$idRol;
            Redirect::to("/lobby");

        }else Redirect::to("/home");
    }



    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /home");
        exit();
    }
}