<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medico_id = $_POST["medico"];
    $paciente_cedula = $_POST["paciente"];
    $servicio_id = $_POST["servicio"];
    $tiempo = $_POST["tiempo"];
    $lugar = trim($_POST["lugar"]);

    if (empty($medico_id) || empty($paciente_cedula) || empty($servicio_id) || empty($tiempo) || empty($lugar)) {
        die(json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']));
    }

    try {
        //Obtener paciente seleccionado
        $queryPaciente = "SELECT id FROM Pacientes WHERE cedula = :paciente_cedula";
        $stmtPaciente = $conn->prepare($queryPaciente);
        $stmtPaciente->bindParam(":paciente_cedula", $paciente_cedula);
        $stmtPaciente->execute();

        $paciente = $stmtPaciente->fetch(PDO::FETCH_ASSOC);
        if (!$paciente) {
            die(json_encode(['success' => false, 'message' => 'Paciente no encontrado.']));
        }
        $paciente_id = $paciente['id'];

        //Obtener dias de la semana en ingles y traducirlos a español
        $dia_semana = date('l', strtotime($tiempo));
        $dias_map = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];
        $dia_semana = $dias_map[$dia_semana];

        //Verificar si esta disponible ese dia
        $queryHorario = "SELECT * FROM HorarioMedico 
                         WHERE usuario_id = :medico_id 
                         AND dia_semana = :dia_semana";

        $stmtHorario = $conn->prepare($queryHorario);
        $stmtHorario->bindParam(":medico_id", $medico_id);
        $stmtHorario->bindParam(":dia_semana", $dia_semana);
        $stmtHorario->execute();

        $horario = $stmtHorario->fetch(PDO::FETCH_ASSOC);

        if (!$horario) {
            die(json_encode(['success' => false, 'message' => 'El médico no tiene disponibilidad en este horario.']));
        }

        //Verificar disponibilidad de cupo
        $queryCitas = "SELECT COUNT(*) AS total_citas FROM Citas 
                       WHERE medico_id = :medico_id AND DATE(tiempo) = DATE(:tiempo)";
        $stmtCitas = $conn->prepare($queryCitas);
        $stmtCitas->bindParam(":medico_id", $medico_id);
        $stmtCitas->bindParam(":tiempo", $tiempo);
        $stmtCitas->execute();

        $citas = $stmtCitas->fetch(PDO::FETCH_ASSOC);

        if ($citas['total_citas'] >= $horario['max_citas']) {
            die(json_encode(['success' => false, 'message' => 'No hay cupos disponibles para este médico en la fecha seleccionada.']));
        }

        //Agregar cita
        $queryAgregarCita = "INSERT INTO Citas (tiempo, lugar, paciente_id, medico_id) 
                             VALUES (:tiempo, :lugar, :paciente_id, :medico_id)";
        $stmtAgregarCita = $conn->prepare($queryAgregarCita);
        $stmtAgregarCita->bindParam(":tiempo", $tiempo);
        $stmtAgregarCita->bindParam(":lugar", $lugar);
        $stmtAgregarCita->bindParam(":paciente_id", $paciente_id);
        $stmtAgregarCita->bindParam(":medico_id", $medico_id);
        $stmtAgregarCita->execute();

        $cita_id = $conn->lastInsertId();

        $queryVerificarServicio = "SELECT COUNT(*) FROM Servicios WHERE id = :servicio_id";
        $stmtVerificarServicio = $conn->prepare($queryVerificarServicio);
        $stmtVerificarServicio->bindParam(":servicio_id", $servicio_id);
        $stmtVerificarServicio->execute();
        $existeServicio = $stmtVerificarServicio->fetchColumn();

        //Agregar servicio de la cita
        $queryAgregarServicio = "INSERT INTO Citas_Servicios (cita_id, servicio_id) 
                                 VALUES (:cita_id, :servicio_id)";
        $stmtAgregarServicio = $conn->prepare($queryAgregarServicio);
        $stmtAgregarServicio->bindParam(":cita_id", $cita_id);
        $stmtAgregarServicio->bindParam(":servicio_id", $servicio_id);
        $stmtAgregarServicio->execute();

        echo json_encode(['success' => true, 'message' => 'Cita agendada con éxito.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $conn = null;
}
