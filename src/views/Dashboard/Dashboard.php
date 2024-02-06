<script>
  /*
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    let email = getCookie("email");

    let user = fetch(`http://localhost:3000/api/user?email=${email}`).then(res => res.json())
        .then(res => {
            
            let response = res[0];
            let user = document.getElementById("user_");
            user.innerText = "Bienvenido "+response["name"];


        })
    //console.log(user)

    //console.log(cookie);

    */

  var containerHTML = "";

  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }



  function registrarCama(e) {
    console.log("cama registrada")

  }

  function cancelarEdicion(idString) {

    console.log(idString);
    event.preventDefault();

    let y = document.getElementById(idString.id);
    y.innerHTML = containerHTML
    y.className = "container_new"

    //console.log(containerHTML);
  }

  function editarCama(idString) {
    console.log(idString.id);
    event.preventDefault();


    let y = document.getElementById(idString.id);
    let stringId = idString.id.toString()
    //let camaNumero = (stringId[stringId.length])
    let camaNumero=stringId.slice(4,stringId.length)
    y.className = "container";
    // containerHTML=`<div class="container_new" id='cama${camaNumero}'>`+ y.innerHTML + "</div>";
    containerHTML = y.innerHTML
    //console.log(y);
    y.innerHTML = `
    <form action="/actualizar_camas?cama_numero=${camaNumero}"  style="background-color: #ddd;margin-bottom: 3%;margin-right: 6%;"  method="POST">
    <h3 class="cama-title" >Cama ${camaNumero}</h3>
    <div class="row">
      <div class="col-25">
        <label for="temperatura">Temperatura</label>
      </div>
      <div class="col-75">
        <input type="number" id="temperatura" name="temperatura" placeholder="°C" min="0" max="100" step="0.1" value="35.0" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="humedad">Humedad</label>
      </div>
      <div class="col-75">
        <input type="number" id="humedad" name="humedad" placeholder="Humedad" min="0" max="100" step="0.1" value="35.0" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="ph">PH</label>
      </div>
      <div class="col-75">
        <input type="number" id="ph" name="ph" placeholder="ph" min="0" max="15" step="0.1" value="5.0" required>
      </div>
    </div>
    <br>
    <div class="button-row">
      <button id="cama1"  type="submit" value="Submit">Enviar</button>
      <button onclick="cancelarEdicion(cama${camaNumero})">Cancelar</button>
    </div>
  </form>
    `
  }

  function logout() {

    let user = fetch(`http://localhost:3000/api/logout`)
      .then(res => {
        console.log("logged out")
        window.location.href = "http://localhost:3000/"
      })

    /*
      console.log("script was succesfully loaded")
      clearCookie("userId","")
      console.log(document.cookie)
      window.location.href="http://localhost:3000/"*/

  }
</script>

<nav class="horizontal_navbar">

  <ul>
    <li id="logo">
      Abonos <br> Samacá
    </li>
    <li id="user-name">
      Bienvenido <?php echo DB_DATA["userInfo"]["name"] ?>
    </li>
    <li id="logout">
      <button onclick="logout()">Logout</button>
    </li>
  </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php echo DB_DATA["navbar"]  ?>

<br>

<div class="main-camas-container">
  <?php

  $camasDia = DB_DATA["camasInfo"];

  for ($i = 1; $i <= 13; $i++) {

    $text = <<<EOD
  <div class="container" id="cama{$i}">
  <form action="/enviar_camas?cama_numero={$i}" method="POST">
    <span class="no-registrada">Cama No Registrada</span>
    <h3 class="cama-title">Cama {$i}</h3>
    <div class="row">
      <div class="col-25">
        <label for="temperatura">Temperatura</label>
      </div>
      <div class="col-75">
        <input type="number" id="temperatura" name="temperatura" placeholder="°C" min="0" max="100" step="0.1" value="35.0" required>
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="humedad">Humedad</label>
      </div>
      <div class="col-75">
        <input type="number" id="humedad" name="humedad" placeholder="Humedad" min="0" max="100" step="0.1" value="35.0" required>
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="ph">PH</label>
      </div>
      <div class="col-75">
        <input type="number" id="ph" name="ph" placeholder="ph" min="0" max="15" step="0.1" value="5.0" required>
      </div>
    </div>
    <div class="row">
      <button class="cama-button" type="submit" value="Submit" onclick="registrarCama(event)">Enviar</button>
    </div>
  </form>
  
</div>
EOD;

    foreach ($camasDia as $cama) {

      if ($i === (int)$cama["numero"]) {
        $text = <<<EOD
      <div class="container_new" id='cama{$cama["numero"]}'>
        <span class="exitoso">
        Cama Registrada Exitosamente
        </span>
        <h3 class="cama-title">Cama {$cama["numero"]}</h3>
        <ul>
          <li><strong>Temperatura: </strong>{$cama["temperatura"]}°C </li>
          <li><strong>Humedad: </strong>{$cama["humedad"]} °PPM </li>
          <li><strong>PH: </strong>{$cama["ph"]}</li>
        </ul>
        <div class="row">
          <button class="cama-button" onclick ='editarCama(cama{$cama["numero"]})' value="Submit">Editar</button>
        </div>
      </div>
      EOD;
        break;
      }
    }

    echo $text;
  }

  ?>
</div>