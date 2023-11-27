<?php

class adminModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getJugadoresTotales($fecha_inicial, $fecha_final)
    {
        $query = "SELECT COUNT(*) AS total_usuarios FROM usuario WHERE id_rol = 3";

        if ($fecha_inicial != null && $fecha_final!= null) {
            $query .= " AND fecha_registro >= '$fecha_inicial' AND fecha_registro <= '$fecha_final' ";
        }

        $result = $this->database->singleQuery($query);
        return $result['total_usuarios'];
    }

    public function getTodosLosJugadores($fecha_inicial, $fecha_final)
    {
        $query= "SELECT * FROM usuario WHERE id_rol = 3";

        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " AND fecha_registro >= '$fecha_inicial' AND fecha_registro <= '$fecha_final' ";
        }
        $result = $this->database->query($query);
        return $result;
    }

    public function getJugadoresParciales($fecha_inicial, $fecha_final, $registrosPorPagina, $offset)
    {
        $query= "SELECT * FROM usuario WHERE id_rol = 3";

        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " AND fecha_registro >= '$fecha_inicial' AND fecha_registro <= '$fecha_final' ";
        }
        $query .= " LIMIT $registrosPorPagina OFFSET $offset";

        return $this->database->query($query);
    }

    public function imprimirTodosLosJugadores()
    {
        $query= "SELECT * FROM usuario WHERE id_rol = 3";
        $result = $this->database->print($query);
        return $result;
    }

    public function getJugadoresTotalPorPais($fecha_inicial, $fecha_final)
    {
        $query = "SELECT p.nombre AS Pais, COUNT(u.Id) AS cantidad_usuarios
              FROM usuario AS u
              JOIN pais AS p ON u.id_pais = p.id WHERE id_rol =3
               ";

        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= "AND u.fecha_registro >= '$fecha_inicial' AND u.fecha_registro <= '$fecha_final' ";
        }
        $query .= " GROUP BY p.nombre";
        $result = $this->database->query($query);

        $data = array();
        foreach ($result as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidad_usuarios'];
            $data[] = array('Pais' => $nombrePais, 'cantidadUsuarios' => $cantidadUsuarios);
        }

        return $data;
    }

    public function getUsuariosPorGenero($fecha_inicial, $fecha_final)
    {
        $query = "SELECT sexo, COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE id_rol =3
               ";

        if ($fecha_inicial !=null && $fecha_final !=null) {
            $query .= "AND fecha_registro >= '$fecha_inicial' AND fecha_registro <= '$fecha_final' ";
        }

        $query .= " GROUP BY sexo";

        return $this->database->query($query);
    }

    public function imprimirUsuariosTotalesPorGenero()
    {
        $query = "SELECT sexo, COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE id_rol =3
               ";

        $query .= " GROUP BY sexo";

        return $this->database->print($query);
    }

    public function imprimirTotalUsuariosPorPais()
    {
        $query = "SELECT p.nombre AS Pais, COUNT(u.Id) AS cantidad_usuarios
              FROM usuario AS u
              JOIN pais AS p ON u.id_pais = p.id WHERE id_rol =3
               ";

        $query .= " GROUP BY p.nombre";
        $result = $this->database->print($query);

        $data = array();
        foreach ($result as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidad_usuarios'];
            $data[] = array('Pais' => $nombrePais, 'cantidadUsuarios' => $cantidadUsuarios);
        }

        return $data;
    }

    public function imprimirTotalUsuariosPorEdad()
    {
        $query = "SELECT
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) < 18 THEN 'Menor (-18)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 'Adulto (18 a 64)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 65 THEN 'Jubilado (+65)'
                END AS grupo_edad,
                COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE id_rol =3
               ";


        $query .= " GROUP BY grupo_edad";

        return $this->database->print($query);
    }

    public function getUsuariosPorEdad($fecha_inicial, $fecha_final)
    {
        $query = "SELECT
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) < 18 THEN 'Menor (-18)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 'Adulto (18 a 64)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 65 THEN 'Jubilado (+65)'
                END AS grupo_edad,
                COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE id_rol =3 
               ";

        if ($fecha_inicial !=null && $fecha_final !=null) {
            $query .= "AND fecha_registro >= '$fecha_inicial' AND fecha_registro <= '$fecha_final' ";
        }

        $query .= " GROUP BY grupo_edad";

        return $this->database->query($query);
    }

    public function getTotalPorEdad()
    {
        $query = "SELECT
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) < 18 THEN 'Menor (-18)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 'Adulto (18 a 64)'
                    WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 65 THEN 'Jubilado (+65)'
                END AS grupo_edad,
                COUNT(*) AS cantidad_usuarios
              FROM usuario WHERE id_rol =3 
               ";

        $query .= " GROUP BY grupo_edad";

        return $this->database->query($query);
    }

    public function getPartidasTotales($fecha_inicial, $fecha_final)
    {
        $query= "SELECT COUNT(p.id) AS total_partidas FROM partida AS p";
        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " WHERE p.fecha >= '$fecha_inicial' AND p.fecha <= '$fecha_final' ";
        }
        $result = $this->database->singleQuery($query);
        return $result['total_partidas'];
    }

    public function getPartidasParciales($fecha_inicial, $fecha_final, $registrosPorPagina, $offset)
    {
        $query = "SELECT * FROM partida";

        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " WHERE fecha >= '$fecha_inicial' AND fecha <= '$fecha_final'";
        }

        $query .= " LIMIT $registrosPorPagina OFFSET $offset";

        return $this->database->query($query);
    }

    public function imprimirTodasLasPartidas()
    {
        $query = "SELECT DISTINCT * FROM partida";
        return $this->database->print($query);
    }

    public function getPreguntasTotales($fecha_inicial, $fecha_final)
    {
        $query = "SELECT COUNT(*) AS total_preguntas FROM pregunta p";
        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " WHERE p.fecha_creacion >= '$fecha_inicial' AND p.fecha_creacion <= '$fecha_final'";
        }
        $result = $this->database->singleQuery($query);
        return $result['total_preguntas'];
    }

    public function getPreguntasParciales($fecha_inicial, $fecha_final, $registrosPorPagina, $offset)
    {
        $query="SELECT * FROM pregunta AS p JOIN respuesta AS r ON p.id = r.id_pregunta";
        if ($fecha_inicial != null && $fecha_final != null) {
            $query .= " WHERE p.fecha_creacion >= '$fecha_inicial' AND p.fecha_creacion <= '$fecha_final'";
        }
        $query .= " LIMIT $registrosPorPagina OFFSET $offset";

        return $this->database->query($query);
    }

    public function imprimirTodasLasPreguntas()
    {
        $query = "SELECT DISTINCT * FROM pregunta AS p JOIN respuesta AS r ON p.id=r.id_pregunta";
        return $this->database->print($query);
    }

}