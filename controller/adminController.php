<?php

class adminController
{
    private $render;
    private $model;

    public function __construct($render, $model)
    {
        $this->render = $render;
        $this->model = $model;
    }

    public function usuariosTotales(){
        list($fecha_inicial, $fecha_final) = $this->getFechasPorPost();
        $dataUser = $this->getEstadisticasPorUsuarios($fecha_inicial, $fecha_final);
        $data = $dataUser;
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $data["jugadoresTotales"];
        $registros = $this->model->getJugadoresParciales($fecha_inicial, $fecha_final, $registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'todosLosJugadores' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual,
            'jugadoresTotales' => $totalRegistros
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }

        $data['previous'] = ($paginaActual == 1) ? $paginaActual : $paginaActual - 1;
        $data['next'] = ($paginaActual >= $totalPaginas) ? $paginaActual : $paginaActual + 1;
        $this->render->printView("listaJugadores", $data);
    }

    public function partidasTotales()
    {
        list($fecha_inicial, $fecha_final) = $this->getFechasPorPost();
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $this->model->getPartidasTotales($fecha_inicial, $fecha_final);
        $registros = $this->model->getPartidasParciales($fecha_inicial, $fecha_final, $registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'todasLasPartidas' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }

        $data['previous'] = ($paginaActual == 1) ? $paginaActual : $paginaActual - 1;
        $data['next'] = ($paginaActual >= $totalPaginas) ? $paginaActual : $paginaActual + 1;
        $data["partidasTotales"] = $totalRegistros;
        return $this->render->printView("listaPartidas", $data);
    }

    public function preguntasTotales()
    {
        list($fecha_inicial, $fecha_final) = $this->getFechasPorPost();
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $this->model->getPreguntasTotales($fecha_inicial, $fecha_final);
        $registros = $this->model->getPreguntasParciales($fecha_inicial, $fecha_final,$registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'todasLasPreguntas' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }

        $data['previous'] = ($paginaActual == 1) ? $paginaActual : $paginaActual - 1;
        $data['next'] = ($paginaActual >= $totalPaginas) ? $paginaActual : $paginaActual + 1;

        $data["preguntasTotales"] = $totalRegistros;

        $this->render->printView("listaPreguntas", $data);
    }

    private function getFechasPorPost()
    {
        $fecha_inicial = isset($_POST['fecha_inicial']) && !empty($_POST['fecha_inicial']) ? $_POST['fecha_inicial'] : null;
        $fecha_final = isset($_POST['fecha_final']) && !empty($_POST['fecha_final']) ? $_POST['fecha_final'] : null;
        return [$fecha_inicial, $fecha_final];
    }

    private function getEstadisticasPorUsuarios($fecha_inicial, $fecha_final)
    {
        $data = array(
            'usuariosPorEdad' => $this->model->getUsuariosPorEdad($fecha_inicial, $fecha_final),
            'usuariosPorGenero' => $this->model->getUsuariosPorGenero($fecha_inicial, $fecha_final),
            'usuariosPorPais' => $this->model->getJugadoresTotalPorPais($fecha_inicial, $fecha_final),
            //'usersNews' => $this->model->getTotalUsersNews(),
            'todosLosJugadores' => $this->model->getTodosLosJugadores($fecha_inicial, $fecha_final),
            'jugadoresTotales' => $this->model->getJugadoresTotales($fecha_inicial, $fecha_final));

        if (empty($data['usuariosPorEdad']) && empty($data['usuariosPorGenero']) && empty($data['usuariosPorPais'])
            && empty($data['todosLosJugadores']) && empty($data['jugadoresTotales'])) {
            $data['empty'] = true;
        }

        return $data;
    }

    private function getStatisticsForGraph()
    {
        $data = array(
            'usuariosPorEdad' => $this->model->getTotalPorEdad(),
        );
        if (empty($data['usuariosPorEdad'])){
            $data['empty'] = true;
        }
        return $data;
    }

    public function graficoDeJugadores()
    {
        list($fecha_inicial, $fecha_final) = $this->getFechasPorPost();
        $data = $this->getEstadisticasPorUsuarios($fecha_inicial, $fecha_final);

        // Obtén los datos de género de los usuarios
        $genero = $data['usuariosPorGenero'];
        $pais=$data['usuariosPorPais'];
        $edad=$data['usuariosPorEdad'];
        $data["imagePathGenre"]= $this->graficoUsuariosPorGenero($genero);
        $data["imagePathCountry"]=$this->graficoUsuariosPorPais($pais);
        $data["imagePathAge"]=$this->graficoUsuariosPorEdad($edad);
        //$tabla=$this->model->imprimirUsuariosTotalesPorGenero();
        $this->render->printView("grafico", $data);
    }

    private function graficoUsuariosPorGenero($genero)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por género");
        $graph->SetBox(true);

        $values = array_column($genero, 'cantidad_usuarios');
        $labels = array_column($genero, 'Genero');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'genre_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }

    private function graficoUsuariosPorPais($pais)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por País");
        $graph->SetBox(true);

        $values = array_column($pais, 'cantidadUsuarios');
        $labels = array_column($pais, 'Pais');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'country_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }

    private function graficoUsuariosPorEdad($edad)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por Edad");
        $graph->SetBox(true);

        $values = array_column($edad, 'cantidad_usuarios');
        $labels = array_column($edad, 'grupo_edad');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'age_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }

    public function totalJugadoresPdf(){
        require('helper/totalJugadores.php');
        $pdf = new PDF("L");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->model->imprimirTodosLosJugadores();
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->Cell(20, 20, utf8_decode($fila["Id"]), 1, 0, 'C', 0);
            $pdf->Cell(50, 20, utf8_decode($fila["nombre_usuario"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 20, utf8_decode($fila["mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 20, utf8_decode($fila["sexo"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["fecha_nacimiento"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["fecha_registro"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["veces_bien"]), 1, 0, 'C', 0);
            $pdf->Ln();
        }
        $pdf->Output('JugadoresTotales.pdf', 'D');
    }

    public function graficoJugadoresPdf(){
        require('helper/graficoJugadores.php');
        $pdf = new PDF("P");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas

        $tablaGenre=$this->model->imprimirUsuariosTotalesPorGenero();
        $tablaCountry=$this->model->imprimirTotalUsuariosPorPais();
        $tablaAge=$this->model->imprimirTotalUsuariosPorEdad();
        $pdf->Ln();
        $pdf->Image($this->graficoUsuariosPorGenero($tablaGenre),60);
        $pdf->Image($this->graficoUsuariosPorPais($tablaCountry),60);
        $pdf->Image($this->graficoUsuariosPorEdad($tablaAge),60);

        $pdf->Output('GraficoUsuarios.pdf', 'D');
    }

    public function partidaTotalesPdf(){
        require('helper/partidaTotales.php');
        $pdf = new PDF("P");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->model->imprimirTodasLasPartidas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(30, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 10, ($fila["id_usuario"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 10, ($fila["puntaje"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 10, ($fila["fecha"]), 1, 0, 'C', 0);
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PartidasTotales.pdf', 'D');
    }

    public function preguntasTotalesPdf(){
        require('helper/totalPreguntas.php');
        $pdf = new PDF("L");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->model->imprimirTodasLasPreguntas();
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->SetX( 10+100);
            $pdf->Cell(30, 20, utf8_decode($fila["A"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 20, utf8_decode($fila["B"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 20, utf8_decode($fila["C"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 20, utf8_decode($fila["D"]), 1, 0, 'C', 0);
            $pdf->Cell(18, 20, utf8_decode($fila["opcionCorrecta"]), 1, 0, 'C', 0);
            $pdf->Cell(20, 20, utf8_decode($fila["fecha_creacion"]), 1, 0, 'C', 0);
            $pdf->Cell(22, 20, utf8_decode($fila["veces_bien"]), 1, 0, 'C', 0);
            $pdf->SetX( 10);
            $descripcion = utf8_decode($fila["descripcion"]);
            $pdf->MultiCell(100,20,$descripcion, 1,'C', 0);
        }
        $pdf->Output('PreguntasTotales.pdf', 'D');
    }

}