<?php
include_once './config/Autoload.php';

$continue0 = true;
$continue1 = true;
$continue2 = true;

$bComposer = false;
if (file_exists('./vendor/autoload.php')) {
    include_once './vendor/autoload.php';
    $bComposer = true;
}

///////////////////////////////////////////////////////////
// KISS-ORM INCLUSIÓN NECESARIA
// Previo al primer uso de dependencias kiss_orm
///////////////////////////////////////////////////////////
if (file_exists('./config/kissorm/Bootstrap.php')) {
    include_once './config/kissorm/Bootstrap.php';
}
// En este ejemplo el primer acceso a kissOrm será por
// la llamada a class_exists. User dependerá de EntityModel
///////////////////////////////////////////////////////////

if (!class_exists('demo\classes\User')) {
    $continue0 = false;
} else {

    try {
        $user = new demo\classes\User();

        if (!is_a($user, '\levitarmouse\kiss_orm\EntityModel')) {
            $continue1 = false;
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $continue2 = false;
    }
}
?>
<html>
    <head></head>
    <body>

        <?php if (!$bComposer) { ?>
            <h2>Aún no ejecutó composer install en su proyecto!</h2>

            <?php
            die;
        }
        
        $continue3 = true;
        try {
            
            $model = new levitarmouse\kiss_orm\GenericEntity();
            $dbTest = 'select now() as time';
            
            $result = $model->getMapper()->select($dbTest);
            
            echo "La fecha y hora actual en su sistema es :".$result[0]['time'];
            echo "<br>";
            echo "<br>";
        
        }
        catch (\Exception $ex) {
            echo $ex->getMessage();
            $continue3 = false;
        }
        
        ?>

        <?php
        if (!$continue0 || !$continue1 || !$continue2 || !$continue3) {
            ?>
            <table style="width: 100%">
                <tr >
                    <td style="width: 20%"></td>
                    <td style="width: 60%">
                        <h3>Demostración KISS-ORM</h3>
                        <b>Demostración basada en el supuesto de que cuenta con una base de datos MySql
                            con una Tabla o Vista llamada Users</b><br><br>
                            <br>
                        <hr>
                        Aviso.<br><br>

                        <?php if (!$continue1) { ?>

                            La clase <b>User para la demostración</b> no respeta la herencia esperada!.<br><br>
                            Recuerde:
                            <br>
                            La clase debe extender a <b>levitarmouse\kiss_orm\EntityModel</b>
                            para tener disponible las funcionalidades de KissORM.<br>
                            <br>

                        <?php } ?>

                        <?php if (!$continue0) { ?>

                            La clase <b>User para la demostración</b> no ha sido hallada!.<br><br>
                            Puede crearla manualmente dentro de la carpeta <b>src</b>.<br><br>
                            El <b>namespace</b> debe ser <b>demo\classes</b> y
                            debe respetar PSR0 de modo que la clase debe ser creada dentro de la subCarpeta
                            <b>demo/classes</b>.<br>
                            <br>
                            La clase debe extender a <b>levitarmouse\kiss_orm\EntityModel</b>
                            para tener disponible las funcionalidades de KissORM.<br>
                            <br>
                            Adicionalmente;
                        <?php } ?>

                        <?php if (!$continue0 || !$continue1 || !$continue2  || !$continue3) { ?>

                            Debe crear un descriptor para la clase!.<br>
                            Es la configuración a través de la cual el ORM conoce
                            que es lo que representa la Clase en el Modelo de datos!
                            <br>
                            <br>
                            <br>

                            <u>Ejemplo de un descriptor para el modelo <b>RDMS</b>:</u><br>
                            <br>
                            El mismo es el contenido de un archivo INI ubicado <br>
                            en el mismo lugar donde se encuentra la clase que describe.<br>
                            El nombre del archivo INI debe ser igual al nombre de la Clase<br>
                            <br>
                            <span>
                                <pre style="border: solid 1px grey; background-color: lightgrey;">
            <span style="font-family:monospace; font-size: 90%;">
            [table]
            schema = databaseName
            table  = users

            [details]

            [fields]
            userId    = USER_ID    ; int(11)      |NO  |PRI |   |auto_increment
            realName  = REAL_NAME  ; varchar(20)  |NO  |UNI |   |
            userName  = USER_NAME  ; varchar(20)  |NO  |UNI |   |
            mail      = MAIL       ; varchar(100) |YES |UNI |   |
            password  = PASSWORD   ; varchar(100) |NO  |    |   |

            [fields_read]

            [fields_write]

            [primary_key]
            userid        = USERID

            [unique_key]</span>
                                </pre>
                            </span>
                            <span style="font-family:monospace; font-size: 110%;">
                                Detalle:<br>
                                <ul>
                                    <li>
                                        [table]
                                        <ol>
                                            <li><b>schema</b>: es el nombre de la base de datos</li>
                                            <li><b>table</b>: es el nombre de la tabla que representará la clase</li>
                                        </ol>
                                    </li>
                                    <li>
                                        [fields]<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>cada uno de los campos que se desea mapear</u>
                                        <ol>
                                            <li><b>userid</b>: nombre del atributo en la clase User. No es requerido que coincida con la DB</li>
                                            <li><b>USERID</b>: nombre de campo en la tabla Users</li>
                                            <li><b>; HASTA EOL</b>: Descripción del campo; Validaciones automáticas en versiones futuras</li>
                                        </ol>
                                    </li>
                                    <li>
                                        [primary_key]<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>El campo indicado en la DB como clavé primaria</u>
                                        <ol>
                                            <li><b>userid</b>: nombre del atributo en la clase User. (debe estár presente en la sección [fields])</li>
                                            <li><b>USERID</b>: nombre de campo en la tabla Users</li>
                                        </ol>
                                    </li>
                                </ul>
                            </span>

                            <br>
                            <b>* Pregunta?</b><br> Es necesario hacer esto con cada elemento de la DB que deseo mapear?
                            <br>
                            <br>
                            <b>* Respuesta</b><br>
                            Para NO repetir o incluso ejecutar estos pasos una sola vez debe usar: 
                            <br><br>
                            <span style="font-weight: bold;
                                         font-size: 3em;
                                         font-family: monospace;
                                         position: relative; left: 35%;">kissGen!.</span>
                                         <br><u><b>Seguir los siguientes pasos:</b></u><br>
                            <ol>
                                <?php if ( !$continue3) { ?>
                                <li style="padding: 5px; color: red; font-weight: bold;">
                                    Configurar el acceso a
                                    la base de datos en : <b>config/kissorm/database.ini</b>
                                </li>                                    
                                <?php } else { ?>
                                <li style="padding: 5px;">
                                    Configurar el acceso a
                                    la base de datos en : <b>config/kissorm/database.ini</b>
                                </li>
                                <?php } ?>
<!--                                <li style="padding: 5px;">
                                    Probar la configuración con el comando:<br>
                                    <b>$ php kissGen.php testsCfg</b>
                                </li>-->
                                <li style="padding: 5px;">
                                    Modificar el archivo <b>./tables.ini</b><br>
                                    Indicando el nombre de cada tabla que deseas mapear y el nombre de la Clase a través de la cuál
                                    gestionarás dicha tabla. Adicionalmente, se puede configurar el namespace de dicha clase.
                                </li>
                                <li style="padding: 5px;">
                                    Como último paso ejecutar el comando:
                                    <b>$ php kissGen.php</b><br>
                                    El mismo leerá la lista de tablas del archivo tables.ini y por cada uno de ellas
                                    creará el descriptor y la clase PHP. Almacenando lo generado en <b>./descriptors</b>
                                    <br>
                                    <b>Importante!</b><br>
                                    EL generado automático del descriptor y la clase, creará un un descriptor con atributos de clase
                                    de mismo nombre de los campos en la base de datos, sin embargo esto no es obligatorio.
                                    El nombre de los atributos en la clase luego puede ser cambiados en el descriptor al nombre más
                                    apropiado que se desee.<br>
                                    Es importante también hacer notar que el generador automático, creará un bloque de documentación
                                    en la clase que permite en algunos IDEs el uso de esta documentación durante el desarrollo.
                                    Ese nombre de atributo también debería ser actualizado al mismo valor que se indicará en el
                                    descriptor de la clase (archivo .ini)
                                </li>
                            </ol>

<!--                            También puede usar KissGen indicando por linea de comandos que tabla desea mapear!.
                            Simplemente ejecute: <b>$ php kissGen.php t:tableName</b>-->

                            <br>
                            <br>

                        <?php } ?>
                    </td>
                    <td style="width: 20%"></td>
                </tr>
                <tr></tr>
            </table>
        <?php } ?>

        <?php
        if ($continue0 && $continue1 && $continue2 && $continue3) {
            if ($continue1) {
                
                $user->getAll();

                echo "<b>El contenido de su tabla users es el siguiente:</b><br>";
                while ($cu = $user->getNext()) {
                    echo "<span style='font-size: 14px;'>";
                    $cont = json_encode($cu->getValues()) . '<br>';
                    $cont = str_replace('","', '", "', $cont);
                    echo $cont;
                    echo "</span><br>";
                }

                echo "<br>";
                echo "<br>";
                echo "<u>ahora ordenados</u>" . '<br>';

                $filterDto = new levitarmouse\kiss_orm\dto\GetByFilterDTO();
                $orderDto = new \levitarmouse\kiss_orm\dto\OrderByDTO();
                
                $orderDto->real_name = \levitarmouse\kiss_orm\dto\OrderByDTO::ASC;
                $user->getByFilter($filterDto, $orderDto);

                while ($cu = $user->getNext()) {
                    echo json_encode($cu->real_name) . '<br>';
                }
            }

        }
        ?>
    </body>
</html>