<nav class="horizontal_navbar">

    <ul>
        <li id="logo">
            Abonos <br> Samacá
        </li>
        <li id="user-name">
            Bienvenido <?php print_r(DB_DATA["userInfo"]["username"]) ?>
        </li>
        <li id="logout">
            <button onclick="logout()">Logout</button>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php echo DB_DATA["navbar"] ?>

<div id="messages">
    <?php


    /*
    echo ("<pre>");
    print_r(DB_DATA["mensajes"][0]);
    echo ("</pre>");

*/
    ?>
</div>


<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Mensaje</th>
            <th>Numero</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $mensajes = DB_DATA["mensajes"];
        foreach ($mensajes as $mensaje) {

            $message = strlen($mensaje["mensaje"]) > 30 ? substr($mensaje["mensaje"], 0, 30) : $mensaje["mensaje"];
            $numero = $mensaje["numero"] ?? "";

            $msg = <<<EOD
        <tr id="mensaje-row-{$mensaje['id']}" style="overflow-x:hidden"  onclick="getMessage({$mensaje['id']})">
            <td><a>{$mensaje["id"]}</a></td>
            <td id="email-{$mensaje['id']}" >{$mensaje["email"]}</td>
            <td id="nombre-{$mensaje['id']}" >{$mensaje["nombre"]}</td>
            <td id="fecha-{$mensaje['id']}" >{$mensaje["fecha"]}</td>
            <td>$message<td id="mensaje-{$mensaje['id']}" style="display:none">{$mensaje["mensaje"]}</td></td>
            <td id="numero-{$mensaje['id']}">{$numero}</td>
        </tr>

        EOD;

            echo $msg;
        }
        ?>

    </tbody>
</table>


<script>
    function getMessage(e) {
        // console.log(e.target.id)


        let nombre = document.getElementById(`nombre-${e}`).innerText
        let email = document.getElementById(`email-${e}`).innerText
        let fecha = document.getElementById(`fecha-${e}`).innerText
        let numero = document.getElementById(`numero-${e}`).innerText
        let msg = document.getElementById(`mensaje-${e}`).innerText

        let infoArr = [nombre, email, fecha, numero, msg]

        let obj = {
            "id_": e,
            "nombre": nombre,
            "email": email,
            "fecha": fecha,
            "numero": numero,
            "msg": msg,
        }


        //console.log(msg.innerText)
        //msg.style.display="table-cell";
        console.log(obj)

        displayMessage(obj)

    }

    function displayMessage(obj) {

        console.log("clicked")

        let body = document.getElementsByTagName("body")
        console.log(body)

        let popup = document.createElement("section")
        popup.className = "message-container"
        popup.id = `popup-message-${obj.id_}`

        /*
        popup.style.width = "60vw"
        popup.style.height = "50vh"
        popup.style.display = "flex"
        popup.style.flexDirection = "column"
        popup.style.justifyContent = "center"
        popup.style.alignItems = "center"
        popup.style.backgroundColor = "red"
        popup.style.position = "fixed"
        popup.style.left = "20vw"
        popup.style.top = "25vh";
        */

        popup.innerHTML = `
        <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " onclick="closeMessage(${obj.id_})"> <strong>cerrar</strong> </button>

        <ul style="list-style-type: none ; margin:0;">
            <li><strong>Nombre: </strong>${obj.nombre}</li>
            <li><strong>Correo: </strong>${obj.email}</li>
            <li><strong>Fecha: </strong>${obj.fecha} </li>
            <li><strong>Numero: </strong>${obj.numero} </li>
        </ul>
        <h4 style="border-bottom:5px solid black; margin-left: 5vh;">Mensaje</h4>
        <p style="justify-content:center;">${obj.msg}</p>

        `
        //console.log(popup)

        body[0].appendChild(popup);


    }

    function closeMessage(id) {

        const element = document.getElementById(`popup-message-${id}`);
        element.remove()

    }

    function logout() {

        let user = fetch(`http://localhost:3000/api/logout`)
            .then(res => {
                console.log("logged out")
                window.location.href = "http://localhost:3000/"
            })
    }
</script>