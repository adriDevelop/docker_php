<?php
// Creación del espacio de nombres
namespace exra631\orm;

// Debemos de hacer uso de PDO para poder instanciar un objeto de este

use exra631\entidad\RegistroAsistente;
use PDO;
use PDOException;

// Creación de la clase ORMResgistro
class ORMRegistro{
    // Constantes de la clase
    protected const TABLA_A_GESTIONAR = 'registro_asistente';
    protected const NOMBRE_CLAVE_PRIMARIA = 'id';

    // Propiedades de la clase
    protected PDO $pdo;

    // Constructor de la clase
    public function __construct()
    {
        // Asignamos a nuestra propiedad PDO una instancia con los parámetros de conexión anteriores
        try {
        $dsn = "mysql:host=192.168.12.71;dbname=examen;charset=utf8mb4";
        $user = "examen";
        $pass = "usuario";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE
        ];

        // Creación de PDO
        $this->pdo = new PDO($dsn, $user, $pass, $opciones);

        }catch (PDOException $pdoe){
            echo "<h2>Message error: " . $pdoe->getMessage() . "</h2>";
            echo "<h2>Code error: " . $pdoe->getCode() . "</h2>";
        }
    }

    // Método insertar
    public function insertar(RegistroAsistente $asistente): bool{
        // Preparamos la consulta sql
        $sql = "INSERT INTO registro_asistente VALUES (null, :email, :fecha_inscripcion, :actividad)";
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los valores que obtenemos del objeto
        $stmt->bindValue(':email', $asistente->getEmail());
        $stmt->bindValue(':fecha_inscripcion', $asistente->getFechaInscripcion());
        $stmt->bindValue(':actividad', $asistente->getActividad());

        // Una vez vinculados, debemos de ejecutar la consulta y comprobar que todo ha ido correctamente
        if ($stmt->execute() && $stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    // Método listar
    public function listar(string $email): array{

        // Preparamos la consulta sql
        $sql = "SELECT id, email, fecha_inscripcion, actividad";
        $sql.= " FROM registro_asistente";
        $sql.= " WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos el valor que vamos a buscar
        $stmt->bindParam(':email', $email);

        // Ejecutamos la consulta y devolvemos todos los elementos en un array de Asistentes
        if ($stmt->execute()){
            $arr_asistentes_coincidentes = [];
            while ($elementos = $stmt->fetch()){
                $arr_asistentes_coincidentes[] = new RegistroAsistente($elementos['id'], $elementos['email'], $elementos['fecha_inscripcion'], $elementos['actividad']);
            }
        }
        // Si contiene datos devolvemos el array y si no devolvemos un array vacío
        if ($arr_asistentes_coincidentes){
            return $arr_asistentes_coincidentes;
        } else {
            return [];
        }
    }
}
?>