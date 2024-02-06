<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\Cama;
use App\Navbar;
use Exception;

class visualizacionController
{

    public function index()
    {

        if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {

            $camasAll = $_GET["camas"] ?? null;
            $userType = $_SESSION["user_type"];
            $navbar= (new Navbar)->render($userType);

            if ($userType === "administrador" || $userType === "asociado") {
                if (isset($camasAll)) {

                    $camas = (new Cama)->getCamasLastMonth();

                    $camasDay = array_filter($camas, function ($var) {
                        $currentDate = date("Y/m/d");
                        $currentDate = str_replace("/", "-", $currentDate);

                        if ($var["fecha"] === $currentDate) {
                            return $var;
                        }
                        //return $var;
                    });

                    $camasWeek = array_filter($camas, function ($var) {
                        $currentDate = date("Y/m/d");
                        $currentDate = str_replace("/", "-", $currentDate);
                        //$currrentDayTimestamp=strtotime($currentDate);
                        $previousWeekTimestamp = strtotime("-1 week -1 day");

                        if (strtotime($var["fecha"]) >= $previousWeekTimestamp) {
                            return $var;
                        }
                        //return $var;
                    });
                    //RESET ARRAY KEYS AND RE INDEX THEM 
                    $camasWeek = array_values($camasWeek);


                    function createSubArrays($arr)
                    {
                        $arr3 = array();
                        $subArr = array();
                        for ($i = 0; $i <= count($arr) - 1; $i++) {
                            //print_r($arr[$i]);
                            $current = $arr[$i];
                            $next = $arr[$i + 1] ?? "";
                            $currentArrDate = $current["fecha"];
                            $nextArrDate = $next["fecha"] ?? "";
                            if ($currentArrDate === $nextArrDate) {
                                if ($i === count($arr) - 1) {
                                    $arr3[] = $subArr;
                                } else {
                                    $subArr[] = $current;
                                }
                            } else {
                                $subArr[] = $current;
                                $arr3[] = $subArr;
                                $subArr = [];
                            }
                        }

                        return $arr3;
                    }
                    //hacer subarrays para todas las camas de cada fecha
                    $camasWeek = createSubArrays($camasWeek);

                    //reset($camasWeek);
                    $camasMonth = array_filter($camas, function ($var) {
                        $previousMonthTimestamp = strtotime("-1 month");

                        if (strtotime($var["fecha"]) >= $previousMonthTimestamp) {
                            return $var;
                        }
                        //return $var;
                    });

                    $camasInfo = [
                        "camasDay" => $camasDay,
                        "camasWeek" => $camasWeek,
                        "camasMonth" => $camasMonth
                    ];

                    $dbData = ["camasInfo" => $camasInfo, "navbar"=>$navbar];
                    $view = new View("Visualizacion", "/styles/visualizacionStyle.css", $dbData);

                    return $view->render();
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }
}
