<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>

<nav class="horizontal_navbar">

    <ul>
        <li id="logo">
            Abonos <br> Samacá
        </li>
        <li id="user-name">
            Bienvenido <?php echo $_SESSION["username"]; /* print_r(DB_DATA["userInfo"]["username"])*/ ?>
        </li>
        <li id="logout">
            <button onclick="logout()">Logout</button>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php echo DB_DATA["navbar"]  ?>

<div id="messages">
    <?php
    /*
    echo ("<pre>");
    print_r(DB_DATA["actividades"]);
    echo ("</pre>");
    */

    ?>
</div>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Fecha Inicial</th>
            <th>Fecha Final</th>
            <th>Encargado</th>
            <th>Descripcion</th>
            <th>Estado</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $actividades = DB_DATA["actividades"];
        foreach ($actividades as $actividad) {

            $message = strlen($actividad["descripcion"]) > 30 ? substr($actividad["descripcion"], 0, 30) : $actividad["descripcion"];
            //$numero = $actividad["n"] ?? "";
            $buttonClassName = $actividad["estado"] === "No Completado" ? "button_no_completado" : "button_completado";

            $msg = <<<EOD
        <tr id="mensaje-row-{$actividad['id']}" style="overflow-x:hidden">
            <td onclick="getMessage({$actividad['id']})" ><a>{$actividad["id"]}</a></td>
            <td id="titulo-{$actividad['id']}" >{$actividad["titulo"]}</td>
            <td id="fecha-inicio-{$actividad['id']}" >{$actividad["fecha_inicial"]}</td>
            <td id="fecha-final-{$actividad['id']}" >{$actividad["fecha_final"]}</td>
            <td id="encargado-{$actividad['id']}" >{$actividad["encargado"]}</td>
            <td>$message<td id="mensaje-{$actividad['id']}" style="display:none">{$actividad["descripcion"]}</td></td>
            <td> 
            <button id="estado-{$actividad['id']}" style="z-index:1000;" class=$buttonClassName onclick="openCategoria({$actividad['id']},`{$actividad['estado']}`)">{$actividad["estado"]}</button>
              </td>
            
        </tr>
        EOD;

            echo $msg;
        }
        ?>

    </tbody>
</table>

<?php include "editarEstadoPopup.php"  ?>


<script>
    function displayMessage(obj) {

        console.log("clicked")

        let body = document.getElementsByTagName("body")
        console.log(body)

        let popup = document.createElement("section")
        popup.className = "message-container"
        popup.id = `popup_message_${obj.id_}`

        popup.innerHTML = `
        <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " onclick="closeMessage('popup_message',${obj.id_})"> <strong>cerrar</strong> </button>

        <ul style="list-style-type: none ; margin:0;">
            <li><strong>Titulo: </strong>${obj.titulo}</li>
            <li><strong>Fecha Inicio: </strong>${obj.fechaInicio}</li>
            <li><strong>Fecha Final: </strong>${obj.fechaFinal} </li>
            <li><strong>Encargado: </strong>${obj.encargado} </li>
            <li><strong>Estado: </strong>${obj.estado} </li>
        </ul>
        <h4 style="border-bottom:5px solid black; margin-left: 5vh;">Mensaje</h4>
        <p style="justify-content:center;">${obj.msg}</p>

        `
        //console.log(popup)

        body[0].appendChild(popup);


    }

    function getMessage(e) {
        // console.log(e.target.id)
        console.log("clicked")

        let titulo = document.getElementById(`titulo-${e}`).innerText
        let fechaInicio = document.getElementById(`fecha-inicio-${e}`).innerText
        let fechaFinal = document.getElementById(`fecha-final-${e}`).innerText
        let encargado = document.getElementById(`encargado-${e}`).innerText
        let msg = document.getElementById(`mensaje-${e}`).innerText
        let estado = document.getElementById(`estado-${e}`).innerText


        let obj = {
            "id_": e,
            "titulo": titulo,
            "fechaInicio": fechaInicio,
            "fechaFinal": fechaFinal,
            "encargado": encargado,
            "msg": msg,
            "estado": estado,
        }


        //console.log(msg.innerText)
        //msg.style.display="table-cell";
        console.log(obj)

        displayMessage(obj)

    }

    function closeMessage(tag, id) {

        console.log(`${tag}_${id}`)
            let element = document.getElementById(`${tag}_${id}`);
            console.log(element)
            element.remove()

    }

    function openCategoria(id_, estado) {

        console.log("clicked")
        oppositeEstado= ""

        if(estado==="No Completado"){
            oppositeEstado="<option value='Completado'>Completado</option>"
        }else{
            oppositeEstado="<option value='No Completado'>No Completado</option>"
        }

        let body = document.getElementsByTagName("body")
        //console.log(body)

        let popup = document.createElement("section")
        popup.className = "form-categoria"
        popup.id = `form_categoria_add_enabled`

        popup.innerHTML = `
        <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh "
         onclick="closeMessage('form_categoria_add','enabled')"> <strong>cerrar</strong> </button>
        <h3 style="margin-top:0;margin-bottom:5vh;margin-left:5vw;">Crear Categoría</h3>

        <div class="popup-container-categoria">
            <form action="/edit-estado-actividad?actividadId=${id_}" method="POST">
                <div class="row">
                 <div class="col-25">
                     <label for="estado">Estado</label>
                    </div>
                 <div class="col-75">
                      <select id="estado" name="estado">
                         ${oppositeEstado}
                      </select>
                   </div>
             </div>
              <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " type="submit" class="btn-filled-dark" value="Submit">Crear</button>
            </form>
        </div> `

        //console.log(popup)

        body[0].appendChild(popup);

    }


    function logout() {

        let user = fetch(`http://localhost:3000/api/logout`)
            .then(res => {
                console.log("logged out")
                window.location.href = "http://localhost:3000/"
            })
    }
</script>





<script>
    $(function() {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#fecha-inicial").datepicker({
            firstDay: 1
        });

        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#fecha-final").datepicker({
            firstDay: 1
        });
    });
</script>