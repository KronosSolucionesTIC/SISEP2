<?php
/**/
include_once 'genericoDAO.php';
include_once 'usuariosDAO.php';

class resignificacionDAO extends UsuariosDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getResignificaciones($pkID_proyectoM)
    {

        $query = "SELECT *,resignificacion.pkID AS pkID,CONCAT(nombre_funcionario,' ',apellido_funcionario) AS asesor FROM resignificacion
                INNER JOIN funcionario ON funcionario.pkID = resignificacion.fkID_asesor
                INNER JOIN institucion ON institucion.pkID = resignificacion.fkID_institucion
                WHERE resignificacion.estadoV = 1 AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getResignificacion($filtro, $pkID_proyectoM)
    {

        if ($filtro == "'Todos'") {
            $where_anio = '';
        } else {
            $where_anio = "AND YEAR(fecha) = " . $filtro;
        }

        $query = "SELECT *,resignificacion.pkID AS pkID,CONCAT(nombre_funcionario,' ',apellido_funcionario) AS asesor FROM resignificacion
                INNER JOIN funcionario ON funcionario.pkID = resignificacion.fkID_asesor
                INNER JOIN institucion ON institucion.pkID = resignificacion.fkID_institucion
                WHERE resignificacion.estadoV = 1 " . $where_anio . " AND fkID_proyecto_marco = " . $pkID_proyectoM;

        return $this->EjecutarConsulta($query);
    }

    public function getGruposUsuario($pkID)
    {

        $query = "select DISTINCT grupo.*, grado.nombre as nom_grado, sede.nombre as nom_institucion

                     FROM usuarios

                     INNER JOIN usuario_grupo ON usuario_grupo.fkID_usuario = usuarios.pkID

                     INNER JOIN grupo ON grupo.pkID = usuario_grupo.fkID_grupo

                     INNER JOIN rol ON rol.pkID = usuario_grupo.fkID_rol

                     INNER JOIN sede ON sede.pkID = grupo.fkID_institucion

                     INNER JOIN grado ON grado.pkID = (CASE

                            WHEN grupo.fkID_grado = 0 THEN 6

                            WHEN grupo.fkID_grado != 0 THEN grupo.fkID_grado

                        END)

                     INNER JOIN grupos_proyectoM ON grupos_proyectoM.fkID_grupo = grupo.pkID

                     WHERE usuario_grupo.fkID_usuario = " . $pkID . " AND grupos_proyectoM.fkID_proyectoM = " . $this->getcpm();

        return $this->EjecutarConsulta($query);
    }

    public function getGruposInactivos()
    {

        $query = "select grupo.pkID, grupo.nombre as nombre, grupo.fkID_estado

                        FROM `grupo`


                        WHERE fkID_estado = 2";

        return $this->EjecutarConsulta($query);
    }

    public function getTipoGrupo()
    {

        $query = "select pkID, nombre FROM `tipo_proyecto`";

        return $this->EjecutarConsulta($query);
    }

    public function getTutor()
    {

        $query = "select  pkID, concat_ws(' ',nombre_funcionario,apellido_funcionario) as nombres FROM `funcionario` ORDER BY nombre_funcionario";

        return $this->EjecutarConsulta($query);
    }

    public function getNumGruposInactivos()
    {

        $query = "select count(grupo.pkID) as ngi, grupo.fkID_estado

                        FROM `grupo`

                        WHERE fkID_estado = 2

                        GROUP BY grupo.fkID_estado ";

        return $this->EjecutarConsulta($query);

    }

    public function getGruposId($pkID)
    {

        $query = "SELECT *,resignificacion.pkID AS pkID,CONCAT(nombre_funcionario,' ',apellido_funcionario) AS asesor FROM resignificacion
                INNER JOIN funcionario ON funcionario.pkID = resignificacion.fkID_asesor
                INNER JOIN institucion ON institucion.pkID = resignificacion.fkID_institucion
                WHERE resignificacion.pkID =" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getproyectoId($pkID)
    {

        $query = "select * FROM `proyecto_grupo` WHERE estadoV=1 and fkID_grupo=" . $pkID;

        return $this->EjecutarConsulta($query);
    }

    public function getEstadoGrupo($pkID)
    {

        $query = "select grupo.*, estado_grupo_inv.nombre

                        FROM `grupo`

                        INNER JOIN estado_grupo_inv ON estado_grupo_inv.pkID = grupo.fkID_estado

                        WHERE grupo.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);

    }

    public function getGrados()
    {

        $query = "select * FROM `grado`";

        return $this->EjecutarConsulta($query);
    }

    public function getInstitucion()
    {

        $query = "select sede.*

                    FROM sede

                    INNER JOIN institucion_proyectoM ON sede.fkID_institucion = institucion_proyectoM.fkID_institucion

                    WHERE institucion_proyectoM.fkID_proyectoM = " . $this->getcpm();

        return $this->EjecutarConsulta($query);
    }

    public function getRoles($pkID_tipo)
    {

        $query = "select * FROM `rol` WHERE fkID_tipo_usuario = " . $pkID_tipo;

        return $this->EjecutarConsulta($query);
    }

    public function getGradoUsuarios($pkID_grado, $pkID_institucion)
    {

        $query = "select usuarios.*, grado.nombre as nom_grado, sede.nombre as nom_institucion

                    FROM `usuarios`

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    INNER JOIN grado ON usuario_grado.fkID_grado = grado.pkID

                    INNER JOIN sede ON sede.pkID = usuarios.fkID_institucion

                    WHERE grado.pkID = " . $pkID_grado . " AND sede.pkID = " . $pkID_institucion . " AND usuarios.fkID_tipo = 9";

        return $this->EjecutarConsulta($query);
    }

    public function getDocentesGrado($pkID_grado)
    {

        $query = "select usuarios.*, grado.nombre as nom_grado

                    from usuarios

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    INNER JOIN grado ON usuario_grado.fkID_grado = grado.pkID

                    WHERE usuarios.fkID_tipo = 8 AND grado.pkID = " . $pkID_grado;

        return $this->EjecutarConsulta($query);
    }

    public function getGrupoUsuarios($fkID_tipo_usuario, $pkID_grupo)
    {

        $query = "select usuarios.*, usuarios.nombre as nom, usuarios.apellido as apell, rol.nombre as nom_rol

                    FROM `usuario_grupo`

                    INNER JOIN usuarios ON usuarios.pkID = usuario_grupo.fkID_usuario

                    INNER JOIN rol ON rol.pkID = usuario_grupo.fkID_rol

                    LEFT JOIN grupo ON grupo.pkID = usuario_grupo.fkID_grupo

                    WHERE usuarios.fkID_tipo = " . $fkID_tipo_usuario . " AND usuario_grupo.fkID_grupo = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getNumEstudiantesGrupo($fkID_tipo_usuario, $pkID_grupo, $pkID_grado)
    {

        $query = "select count(usuarios.pkID) as num_estudiantes FROM `usuario_grupo`

                    INNER JOIN usuarios ON usuario_grupo.fkID_usuario = usuarios.pkID

                    INNER JOIN rol ON usuario_grupo.fkID_rol = rol.pkID

                    INNER JOIN tipo_usuario ON rol.fkID_tipo_usuario = tipo_usuario.pkID

                    INNER JOIN usuario_grado ON usuario_grado.fkID_usuario = usuarios.pkID

                    WHERE usuarios.fkID_tipo = " . $fkID_tipo_usuario . " AND usuario_grado.fkID_grado = " . $pkID_grado . " AND usuario_grupo.fkID_grupo = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoGrupo($fkID_grupo)
    {

        $query = "SELECT *,proyecto_marco.nombre AS nombre_proyecto FROM proyecto_marco
                INNER JOIN grupo ON grupo.fkID_proyecto_marco = proyecto_marco.pkID
                WHERE grupo.pkID = " . $fkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getEstudiantesGrupo($pkID_grupo)
    {
        $query = "SELECT *,CONCAT(nombre_docente,' ',apellido_docente) AS nombre FROM acompanamiento_docente
                INNER JOIN acompanamiento ON acompanamiento.pkID = acompanamiento_docente.fkID_acompanamiento
                INNER JOIN docente ON docente.pkID = acompanamiento_docente.fkID_docente
                INNER JOIN estado_acompanamiento ON estado_acompanamiento.pkID = acompanamiento_docente.fkID_estado
                WHERE acompanamiento.pkID = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getEvidencias($pkID_resignificacion)
    {
        $query = "select * FROM evidencia_resignificacion
                WHERE estadoV = 1 AND fkID_resignificacion   = " . $pkID_resignificacion;

        return $this->EjecutarConsulta($query);
    }

    public function getAsistencias($pkID_grupo)
    {

        $query = "SELECT * FROM acompanamiento_asistencia
                WHERE fkID_acompanamiento = " . $pkID_grupo;

        return $this->EjecutarConsulta($query);
    }

    public function getAlbumResignificacion($pkID_resignificacion){  
       
      $query = "select * FROM `galeria_resignificacion` WHERE estadoV=1 and fkID_resignificacion=".$pkID_resignificacion;

      return $this->EjecutarConsulta($query);
    }

    public function getFotosResignificacion($pkID_album){  
       
      $query = "select * FROM `fotos_resignificacion` WHERE estadoV=1 and fkID_album=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getResignificacionGaleria($pkID_album){  
       
      $query = "select galeria_resignificacion.*, proyecto_marco.pkID as fkID_proyecto FROM galeria_resignificacion 
            INNER JOIN resignificacion on resignificacion.pkID = galeria_resignificacion.fkID_resignificacion
            INNER JOIN proyecto_marco on proyecto_marco.pkID = resignificacion.fkID_proyecto_marco
            WHERE galeria_resignificacion.pkID=".$pkID_album;

      return $this->EjecutarConsulta($query);
    }

    public function getEstado()
    {

        $query = "SELECT * FROM estado_acompanamiento";

        return $this->EjecutarConsulta($query);
    }
}
