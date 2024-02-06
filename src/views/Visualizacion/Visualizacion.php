<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }

    function logout() {

        let user = fetch(`http://localhost:3000/api/logout`)
            .then(res => {
                console.log("logged out")
                window.location.href = "http://localhost:3000/"
            })

    }
</script>

<script src="https://d3js.org/d3.v4.js"></script>



<?php
/*
    echo "<pre>";
    print_r(DB_DATA["camasInfo"]);
    //var_dump(DB_DATA["camasInfo"][0]["fecha"]);
    echo "</pre>";
    */

$camasInfo = DB_DATA["camasInfo"]["camasDay"];

function renderCamasDia(array $camasArr, $promedios = false, $hoy = false)
{
    $currentDate = (string)date("Y/m/d");
    $currentDate = str_replace("/", "-", $currentDate);

    $sumaTemperatura = 0;
    $sumaHumedad = 0;
    $sumaPH = 0;

    $strCama = "";
    $strTemperatura = "";
    $strHumedad = "";
    $strPH = "";
    $camaFecha = "";
    $fechaTag = $currentDate;

    for ($i = 1; $i <= 13; $i++) {

        $strCama .= "<th>$i</th>";
        $camaisFilled = false;
        foreach ($camasArr as $cama) {

            $temperatura = $cama["temperatura"];
            $humedad = $cama["humedad"];
            $PH = $cama["ph"];

            if ((string)$i === (string)$cama["numero"]) {
                $camaisFilled = true;
                $strTemperatura .= "<td>$temperatura</td>";
                $strHumedad .= "<td>$humedad</td>";
                $strPH .= "<td>$PH</td>";

                $fecha = $cama["fecha"] ?? null;
                if ($fecha) {
                    $ts = strtotime($cama["fecha"]);
                    $camaFecha = date("F j,Y", $ts);
                    $fechaTag = $cama["fecha"];
                }

                $sumaTemperatura += (float)$temperatura;
                $sumaHumedad += (float)$humedad;
                $sumaPH += (float)$PH;

                break;
            }
        }

        if ($camaisFilled === false) {
            $strTemperatura .= "<td>Falta</td>";
            $strHumedad .= "<td>Falta</td>";
            $strPH .= "<td>Falta</td>";
        }
    }

    $divisorTemp = count($camasArr) == 0 ? 1 : count($camasArr);

    $promedioTemperatura = number_format((float)$sumaTemperatura / $divisorTemp, 2, '.', '');
    $promedioHumedad = number_format((float)$sumaHumedad / $divisorTemp, 2, '.', '');
    $promedioPh = number_format((float)$sumaPH / $divisorTemp, 2, '.', '');

    $temperaturaTitle = $promedios ? "Promedio Temperatura" : "Temperatura";
    $humedadTitle = $promedios ? "Promedio Humedad" : "Humedad";
    $phTitle = $promedios ? "Promedio PH" : "PH";
    $promedioTitle = $promedios ? "Promedio Promedios" : "Promedio";

    $strCama .= "<th class='last'>{$promedioTitle}</th>";
    $strTemperatura .= "<td class='last'>{$promedioTemperatura} °C </td>";
    $strHumedad .= "<td class='last'>{$promedioHumedad} %</td>";
    $strPH .= "<td class='last'>{$promedioPh}</td>";

    $graphTempId = $hoy ? "graph-container-temperatura-" . $fechaTag . "-hoy" : "graph-container-temperatura-" . $fechaTag;
    $graphHumId = $hoy ? "graph-container-humedad-" . $fechaTag . "-hoy" : "graph-container-humedad-" . $fechaTag;
    $graphPHId = $hoy ? "graph-container-ph-" . $fechaTag . "-hoy" : "graph-container-ph-" . $fechaTag;
    $tableId = $fechaTag;

    if ($hoy) {
        $tableId = $fechaTag . "-hoy";
    } else if ($promedios) {
        $tableId = "promedios";
        $graphTempId = "graph-container-temperatura-promedio";
        $graphHumId = "graph-container-humedad-promedio";
        $graphPHId = "graph-container-ph-promedio";
    }
    //$tableId = $hoy ? $fechaTag . "-hoy" : $fechaTag;

    return <<<EOD
        <div class="cama-container" >
        <h2>{$camaFecha}</h2>
        <table id={$tableId} class="dataTable">
        <tbody>
            <tr class="cama-number">
                <th>Cama</th>
            {$strCama} 
            </tr>
            <tr class="cama-temperatura">
                <th>{$temperaturaTitle}</th>
                {$strTemperatura}
            </tr>
            <tr class="cama-humedad">
                <th>{$humedadTitle}</th>
                {$strHumedad}
            </tr>
            <tr class="cama-ph">
                <th>{$phTitle}</th>
                {$strPH}
            </tr>
        </tbody>
        </table>
        <br>
        <div class="graphs-container">
            <div class="graph-container" id={$graphTempId}>
            </div>
            <div class="graph-container" id={$graphHumId}>
            </div>
            <div class="graph-container" id={$graphPHId} >
            </div>
        </div>
        </div>
    EOD;
}

function calculateAndRenderPromediosTable($camasArr)
{

    for ($i = 1; $i <= 13; $i++) {

        ${"temperaturaSumCama" . $i} = 0;
        ${"humedadSumCama" . $i} = 0;
        ${"phSumCama" . $i} = 0;
        ${"countCama" . $i} = 0;
    }

    unset($i);

    foreach ($camasArr as $camaArr) {

        for ($j = 0; $j < count($camaArr); $j++) {

            ${"temperaturaSumCama" . $camaArr[$j]["numero"]} += $camaArr[$j]["temperatura"];
            ${"humedadSumCama" . $camaArr[$j]["numero"]} += $camaArr[$j]["humedad"];
            ${"phSumCama" . $camaArr[$j]["numero"]} += $camaArr[$j]["ph"];
            ${"countCama" . $camaArr[$j]["numero"]} += 1;
        }
    }

    $arr = [];

    unset($j);

    for ($i = 1; $i <= 13; $i++) {


        $camaCount = ${"countCama" . $i} !== 0 ? ${"countCama" . $i} : 1;

        $subArr = [
            "numero" => $i,
            "temperatura" => number_format((float)${"temperaturaSumCama" . $i} / $camaCount, 2, '.', ''),
            "humedad" => number_format((float)${"humedadSumCama" . $i} / $camaCount, 2, '.', ''),
            "ph" =>  number_format((float)${"phSumCama" . $i} / $camaCount, 2, '.', ''),
        ];

        $arr[] = $subArr;
    }
    return renderCamasDia($arr, true);
}

?>

<nav class="horizontal_navbar">

    <ul>
        <li id="logo">
            Abonos <br> Samacá
        </li>
        <li id="user-name">
            Bienvenido <?php echo $_SESSION["username"] ?>
        </li>
        <li id="logout">
            <button onclick="logout()">Logout</button>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php echo DB_DATA["navbar"]  ?>

<section id="camas-dia">
    <h1>Camas Hoy</h1>
    <?php
    $camaHoy = DB_DATA["camasInfo"]["camasDay"];
    //print_r($camaHoy);
    echo renderCamasDia(camasArr: $camaHoy, hoy: true);
    ?>
</section>

<section id="camas-semana">
    <h1>Última Semana</h1>
    <?php

    $camasWeek = DB_DATA["camasInfo"]["camasWeek"];
    echo ("<pre>");
    //echo count($camasWeek);
    //print_r($camasWeek);
    //renderCamasDia($camasInfo);
    echo ("</pre>");

    //echo renderCamasDia($camasWeek[0]);

    foreach ($camasWeek as $camasDia) {
        echo renderCamasDia($camasDia, false);
    }
    ?>
</section>

<section id="camas-promedio">
    <h1>Promedio</h1>
    <?php echo calculateAndRenderPromediosTable(DB_DATA["camasInfo"]["camasWeek"]); ?>
</section>

<script>
    function getGraphData($tableId, $type) {

        let table1 = document.getElementById($tableId);
        let camas = table1.children[0].children[0].children
        let values = []

        switch ($type) {
            case "temperatura":
                //console.log("tempratura selected");
                values = table1.children[0].children[1].children
                //console.log(values);
                break;
            case "humedad":
                //console.log("humedad selected");
                values = table1.children[0].children[2].children
                //console.log(values);
                break;
            case "ph":
                //console.log("ph selected");
                values = table1.children[0].children[3].children
                //console.log(values);
                break;
            default:
                values = []
        }

        let objectArr = []


        for (let i = 1; i < camas.length - 1; i++) {
            //camasArr.push(camas[i].innerText);
            let obj = {
                "camaNumber": "cama-" + camas[i].innerText,
                "value": parseFloat(values[i].innerText) ? parseFloat(values[i].innerText) : 0
            }
            objectArr.push(obj)
        }
        return objectArr

    }


    function createGraph(data, divId, type) {

        function getMaxVals(data) {
            //console.log("max")
            //console.log(data)
            let max = 0;
            for (let i = 0; i < data.length; i++) {
                if (parseFloat(data[i].value) > max) {
                    max = parseFloat(data[i].value)
                }
            }
            return max;
        }

        var margin = {
                top: 20,
                right: 0,
                bottom: 40,
                left: 55
            },
            width = 400,

            /*width = 460 - margin.left - margin.right,*/
            height = /*400 - margin.top - margin.bottom;*/ 250

        // append the svg object to the body of the page
        var svg = d3.select(`#${divId}`)
            .append("svg")
            //.attr("preserveAspectRatio", "x200Y200 meet")
            .attr("viewBox", `0 0 380 310`)
            .attr("position", "relative")
            .attr("display", "flex")
            .attr("width", width)
            /*.attr("width", width + margin.left + margin.right)*/
            .attr("class", "graph")
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");

        //add y axis title
        svg.append("text")
            .attr("text-anchor", "end")
            .attr("transform", "rotate(-90)")
            .attr("y", -margin.left + 30)
            .attr("x", /*-margin.top - 60*/ (-height / 2) + 20)
            .text(`${type}`)

        // Parse the Data
        // X axis

        var x = d3.scaleBand()
            .range([0, width - 100])
            .domain(data.map(function(d) {
                return d.camaNumber;
            }))
            /*.attr("width", 300)*/
            .padding(0.2);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "translate(-10,0)rotate(-45)")
            .style("text-anchor", "end");

        // Add Y axis
        var y = d3.scaleLinear()
            .domain([0, parseInt(getMaxVals(data))])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // Bars
        svg.selectAll("mybar")
            .data(data)
            .enter()
            .append("rect")
            .attr("x", function(d) {
                return x(d.camaNumber);
            })
            .attr("y", function(d) {
                return y(d.value);
            })
            .attr("width", x.bandwidth() /* "5%"*/ )
            .attr("height", function(d) {
                return height - y(d.value);
            })
            .attr("fill", /*"#69b3a2"*/ "#45413E")

        console.log()
    }

    function renderGraphsSemana() {

        let tableContainer = document.querySelector("#camas-semana").children;
        tableContainer = Array.prototype.slice.call(tableContainer)
        let graphContainers = tableContainer.slice(2, 9)

        //render 3 graphs per graph container

        for (let z = 0; z < graphContainers.length; z++) {
            let c = Array.prototype.slice.call(graphContainers[z].children)
            let tableId = c[1].id

            let dataTemp = getGraphData(tableId, "temperatura")
            let dataHum = getGraphData(tableId, "humedad")
            let dataPH = getGraphData(tableId, "ph")

            createGraph(dataTemp, "graph-container-temperatura-" + tableId, "Temperatura")
            createGraph(dataHum, "graph-container-humedad-" + tableId, "Humedad")
            createGraph(dataPH, "graph-container-ph-" + tableId, "PH")
        }
    }

    function renderGraphDia(tableIdSelector = null, promedios = false) {
        let tableContainer = document.querySelector(tableIdSelector).children;
        tableContainer = Array.prototype.slice.call(tableContainer)

        console.log(tableContainer)

        //console.log("camas dia",tableContainer[1].children[3].children)

        let graphIdTemp = tableContainer[1].children[3].children[0].id;
        let graphIdHum = tableContainer[1].children[3].children[1].id;
        let graphIdPH = tableContainer[1].children[3].children[2].id;

        let tableId = tableContainer[1].children[1].id
        if (promedios === false) {
            tableId = tableId.slice(0, 10)
        }


        let dataTemp = getGraphData(tableId, "temperatura")
        let dataHum = getGraphData(tableId, "humedad")
        let dataPH = getGraphData(tableId, "ph")

        createGraph(dataTemp, graphIdTemp, "Temperatura")
        createGraph(dataHum, graphIdHum, "Humedad")
        createGraph(dataPH, graphIdPH, "PH")

        // console.log(graphIdTemp, graphIdHum, graphIdPH)

    }

    function renderGraphPromedios(tableIdSelector = "") {

        let tableContainer = document.querySelector(tableIdSelector).children;
        tableContainer = Array.prototype.slice.call(tableContainer)

        console.log(tableContainer)

        //console.log("camas dia",tableContainer[1].children[3].children)

        let graphIdTemp = tableContainer[1].children[3].children[0].id;
        let graphIdHum = tableContainer[1].children[3].children[1].id;
        let graphIdPH = tableContainer[1].children[3].children[2].id;

        let tableId = tableContainer[1].children[1].id

        let data = getGraphData(tableId, "humedad")

        console.log(data)

    }

    renderGraphsSemana()
    renderGraphDia("#camas-dia")
    //renderGraphPromedios("#camas-promedio")
    renderGraphDia("#camas-promedio", promedios = true)
</script>