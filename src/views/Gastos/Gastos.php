<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<nav class="horizontal_navbar">

    <ul>
        <li id="logo">
            Abonos <br> Samacá
        </li>
        <li id="user-name">
            Bienvenido <?php echo "user"; /* print_r(DB_DATA["userInfo"]["username"])*/ ?>
        </li>
        <li id="logout">
            <button onclick="logout()">Logout</button>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php echo DB_DATA["navbar"]  ?>

<section id="contact-form" class="form-contact">

    <p style="margin-bottom:0; font-size:5vh; font-weight:bold">Nuevo Gasto</p>

    <div class="container">
        <form action="/submit-gasto" method="POST" id="form-gastos">
            <div class="row">
                <div class="col-25">
                    <label for="titulo">Título</label>
                </div>
                <div class="col-75">
                    <input type="text" id="titulo" name="titulo" placeholder="Título Gasto.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fecha">Fecha</label>
                </div>
                <div class="col-75">
                    <input id="fecha" name="fecha" placeholder="Fecha.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="destinatario">Destinatario</label>
                </div>
                <div class="col-75">
                    <input type="text" id="destinatario" name="destinatario" placeholder="Destinatario.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="categoria">Categoría</label>
                </div>
                <div class="col-75">
                    <select id="categoria" name="categoria">
                        <?php

                        $categorias = DB_DATA["categorias"];
                        foreach ($categorias as $categoria) {

                            $titulo = $categoria['titulo'];
                            $str = <<<EOD
                            <option value="$titulo">$titulo</option>
                            EOD;
                            echo $str;
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="valor">Valor</label>
                </div>
                <div class="col-75">
                    <input type="number" id="valor" name="valor" placeholder="Valor" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="descripcion">Descripción</label>
                </div>
                <div class="col-75" style="height: fit-content;">
                    <textarea id="descripcion" name="descripcion" placeholder="Descripcion" style="height:30vh" required></textarea>
                </div>
            </div>
            <div class="row" style="display: flex; flex-direction:row;">
                <div class="col-25">
                    <button type="submit" class="btn-filled-dark" value="Submit">Añadir</button>
                </div>
                <div class="col-75" style="display: flex; flex-direction:row; justify-content:flex-end">
                    <button class="btn-filled-dark" onclick="openCategoria('crear')">Crear Categoría</button>
                    <button class="btn-filled-dark" onclick="openCategoria('delete')">Eliminar Categoría</button>
                </div>

            </div>
        </form>
    </div>
</section>

<?php include "addCategoria.php"  ?>
<?php $categorias = DB_DATA["categorias"];
include "deleteCategoria.php";

?>


<div id="messages">
    <?php

    /*
    echo ("<pre>");
    print_r(DB_DATA["gastosCurrentMonth"]);
    echo ("</pre>");

*/
    ?>
</div>
<h3>Gastos Mes Actual</h3>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Destinatario</th>
            <th>Categoria</th>
            <th>Valor</th>
            <th>Descripcion</th>
            <th>#</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $gastos = DB_DATA["gastosCurrentMonth"];
        foreach ($gastos as $gasto) {

            $descripcion = strlen($gasto["descripcion"]) > 30 ? substr($gasto["descripcion"], 0, 30) : $gasto["descripcion"];
            $formattedValorGasto=number_format($gasto["valor"]);
            //$numero = $gasto["n"] ?? "";

            $msg = <<<EOD
        <tr id="mensaje-row-{$gasto['id']}" style="overflow-x:hidden"  >
            <td><a onclick="getMessage({$gasto['id']})" >{$gasto["id"]}</a></td>
            <td id="titulo-{$gasto['id']}">{$gasto["titulo"]}</td>
            <td id="fecha-{$gasto['id']}" >{$gasto["fecha"]}</td>
            <td id="destinatario-{$gasto['id']}" >{$gasto["destinatario"]}</td>
            <td id="categoria-{$gasto['id']}" >{$gasto["categoria"]}</td>
            <td id="valor-{$gasto['id']}" >$ $formattedValorGasto </td>
            <td>$descripcion<td id="descripcion-{$gasto['id']}" style="display:none">{$gasto["descripcion"]}</td></td>
            
            <td> 
            <button style="z-index:1000; "class="btn-filled-dark" onclick=toggleEditar({$gasto['id']}) >Editar</button>
              </td>
            
        </tr>

        EOD;

            echo $msg;
        }
        ?>

    </tbody>
</table>

<h3>Gastos Por Categorías</h3>

<table class="dataTable">

    <?php

    $gastos = DB_DATA["gastosCurrentMonth"];

    function getCategorias($gastos)
    {
        $categoriasArr = [];
        foreach ($gastos as $gasto) {
            $gastoCategoria = $gasto["categoria"];
            $gastoValor = $gasto["valor"];
            if (!array_key_exists($gastoCategoria, $categoriasArr)) {
                $catArr = [$gastoValor];

                $categoriasArr[$gastoCategoria]["gastos"] = $catArr;
            } else {
                $categoriasArr[$gastoCategoria]["gastos"][] = $gastoValor;
            }
        }

        return $categoriasArr;

        $newArr = [
            "test1" => 1
        ];

        //return $newArr;
    }

    $categoriasArr = getCategorias($gastos);

    ?>

    <thead>
        <tr>
            <th>Categoria</th>
            <th>Valor</th>

        </tr>
    </thead>
    <tbody>
        <?php



        $arrayKeys = array_keys($categoriasArr);
        $gastoTotalMes=0;
        foreach ($arrayKeys as $categoriaName) {
            $categoriaTotalGasto = 0;
            foreach ($categoriasArr[$categoriaName]["gastos"] as $gasto) {
                $categoriaTotalGasto += $gasto;
            }
            //setlocale(LC_MONETARY,"en_US");
            //$formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            //$formattedValue=$formatter->formatCurrency(-0.99, 'USD');
            $formattedValue=number_format($categoriaTotalGasto);

            echo "<tr>
                <td>$categoriaName</td>
                <td>$ $formattedValue</td>
                </tr>";
            $gastoTotalMes+=$categoriaTotalGasto;
        }
        $formattedTotalGastoMes=number_format($gastoTotalMes);
        echo "<tr><th>Total </th><td>$ $formattedTotalGastoMes</td></tr>";

        ?>
    

    </tbody>
</table>




<script>
    function getMessage(e) {
        // console.log(e.target.id)
        console.log("clicked")

        let titulo = document.getElementById(`titulo-${e}`).innerText
        let fecha = document.getElementById(`fecha-${e}`).innerText
        let destinatario = document.getElementById(`destinatario-${e}`).innerText
        let categoria = document.getElementById(`categoria-${e}`).innerText
        let descripcion = document.getElementById(`descripcion-${e}`).innerText
        let valor = document.getElementById(`valor-${e}`).innerText


        let obj = {
            "id_": e,
            "titulo": titulo,
            "fecha": fecha,
            "destinatario": destinatario,
            "categoria": categoria,
            "descripcion": descripcion,
            "valor": valor,
        }


        //console.log(msg.innerText)
        //msg.style.display="table-cell";
        console.log(obj)

        displayMessage(obj)

    }



    function deleteMessage(e) {
        /*
        console.log(`http://localhost:3000/delete-gasto?gastoId=${e}`)
        let user = fetch(`http://localhost:3000/delete-gasto?gastoId=${e}`)
            .then(res => {
                console.log(`deleted gasto ${e}`)
               // window.location.href = "/gastos"
            })
            */

        window.location.href = `http://localhost:3000/delete-gasto?gastoId=${e}`;

    }

    function displayMessage(obj) {

        console.log("clicked")

        let body = document.getElementsByTagName("body")
        console.log(body)

        let popup = document.createElement("section")
        popup.className = "gasto-container"
        popup.id = `popup_gasto_${obj.id_}`

        popup.innerHTML = `
        <button style="position:relative;cursor:pointer; margin-bottom:4vh; margin-top:2vh ; margin-left:2vh " onclick="closeMessage('popup_gasto',${obj.id_})"> <strong>cerrar</strong> </button>

        <ul style="list-style-type: none ; margin:0;">
            <li><strong>Titulo: </strong>${obj.titulo}</li>
            <li><strong>Fecha: </strong>${obj.fecha}</li>
            <li><strong>Destinatario: </strong>${obj.destinatario} </li>
            <li><strong>Categoría: </strong>${obj.categoria} </li>
            <li><strong>Valor: </strong>${obj.valor} </li>
        </ul>
        <h4 style="border-bottom:5px solid black; margin-left: 5vh;">Descripcion</h4>
        <p style="justify-content:center;">${obj.descripcion}</p>
        <form action="/delete-gasto?gastoId=${parseInt(obj.id_)}" method="POST">
        <button type="submit" class="btn-filled-dark"">Eliminar</button>
        </form>


        `
        //console.log(popup)

        body[0].appendChild(popup);


    }

    function closeMessage(tag, id, categoria = false) {

        if (!categoria) {
            let element = document.getElementById(`${tag}_${id}`);
            element.remove()
        } else {
            let element = document.getElementById(`${tag}_${id}`);
            element.id = `${tag}_disabled`
        }

    }

    function logout() {

        let user = fetch(`http://localhost:3000/api/logout`)
            .then(res => {
                console.log("logged out")
                window.location.href = "http://localhost:3000/"
            })
    }

    function toggleEditar(e) {


        let form = document.getElementById("contact-form")
        let formHtml = form.innerHTML

        let body = document.getElementsByTagName("body")
        let popup = document.createElement("section")


        popup.className = "gasto-popup"
        popup.style.display = "flex"
        popup.style.flexDirection = "column"
        popup.style.justifyContent = "center"
        popup.style.alignItems = "center"
        popup.id = `gasto_popup_${e}`

        popup.innerHTML = formHtml
        let children = popup.children
        //children[0].remove()
        let container = children[1]
        //console.log("container", container)
        container.style.marginRight = "0"
        container.style.background = "transparent"
        let h2Tag = children[0]
        h2Tag.innerText = ""
        let formInnerHtml = children[1].children[0].innerHTML
        let formTag = children[1].children[0]
        formTag.action = `/edit-gasto?gastoId=${e}`
        let formTagChildren = formTag.children;
        let dateInput = formTagChildren[1]
        dateInput.remove();

        /*
                dateInput=dateInput.children[1]
                dateInput=dateInput.children[0]
                dateInput.id="fecha-2"
        */
        let buttonRow = formTagChildren[5]
        buttonRow.style.display = "flex"
        buttonRow.style.flexDirection = "row"
        buttonRow.style.marginTop = "2vh"
        buttonRow.style.marginBottom = "2vh"
        buttonRow.innerHTML = `
        <button class="btn-filled-dark" type="submit">Editar</button>
        <button class="btn-filled-dark" onclick="closeMessage('gasto_popup',${e})">Cancelar</button>
        `

        body[0].appendChild(popup);

    }

    function openCategoria(type) {



        if (type === "crear") {
            // let categoriaForm = document.getElementsByClassName("form-categoria-add")
            //categoriaForm[0].id = "form-categoria-enabled"
            let categoriaForm = document.getElementById("form_categoria_add_disabled")
            categoriaForm.id = "form_categoria_add_enabled"
        } else if (type === "delete") {
            let categoriaForm = document.getElementById("form_categoria_delete_disabled")
            categoriaForm.id = "form_categoria_delete_enabled"
        }


        /*
        categoriaForm.outerHTML="<h2>clicked</h2>"
        categoriaForm.style.position="fixed";
        categoriaForm.style.display="absolute";
        console.log("clicked", categoriaForm)
        */
    }

    //console.log("hey")
</script>





<script>
    $(function() {
        /*$.datepicker.setDefaults($.datepicker.regional["es"])*/
        $("#fecha").datepicker({
            firstDay: 1
        });

        /*
        $("#fecha-2").datepicker({
            firstDay: 1
        });
        */

    });
</script>