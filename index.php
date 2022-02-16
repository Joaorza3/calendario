<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste calendário</title>
    <style>
    * {
        box-sizing: border-box;
    }

    .container {
        display: flex;
        margin: auto;
        width: 80%;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: Arial, Helvetica, sans-serif;
    }

    .container>h1 {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 40px;
        color: #844;
    }

    .calendario_container {
        width: 100%;
    }

    table {
        width: 60%;
        /* border-collapse: collapse; */
        margin: auto;
        border-spacing: 10px;
    }

    thead {
        color: #844;
    }

    tbody td {
        padding: 20px 20px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0px 0px 5px #E63F1332;
        cursor: pointer;
    }

    .calendario_box {
        font-size: 1.5em;
        margin: 10px;
    }

    .box {
        background-color: #fff;
        transition: all 0.3s;

    }

    .box:hover {
        background-color: #E0A943;
        color: #fff;
        transform: scale(1.1);
        box-shadow: -3px 4px 8px #E63F1342;
    }

    .fim_de_semana {
        background-color: #EEC89F;
        color: #fff;
    }

    .vazio {
        background-color: #00000000;
        box-shadow: none;
    }

    .aniversario {
        background-color: #F58559 !important;
        color: #fff;
    }

    .form_div {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
    }

    .form_div>input[type=submit] {
        outline: none;
        border: none;
        background-color: #09F54F;
        padding: 10px 20px;
        font-size: 1.1em;
        border-radius: 8px;
        cursor: pointer;
        margin-left: 15px;
        font-weight: 900;
        color: #fff;
    }

    input[name=mes] {
        outline: none;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 8px;
        width: 95%;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.1em;
        box-shadow: -3px 4px 8px #E63F1322;
        color: #444;
    }

    .label_aniversarios {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.1em;
        cursor: pointer;
        color: #844;
        margin: 30px 0;
    }

    .label_aniversarios>label>input {
        outline: none;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 8px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Calendário</h1>

        <div class="calendario_container">
            <table>
                <thead>
                    <tr>
                        <th class="dia_semana">Dom</th>
                        <th class="dia_semana">Seg</th>
                        <th class="dia_semana">Ter</th>
                        <th class="dia_semana">Qua</th>
                        <th class="dia_semana">Qui</th>
                        <th class="dia_semana">Sex</th>
                        <th class="dia_semana">Sáb</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    function geraCalendario($mes, $ano, $array_aniversarios = [])
                    {
                        $data = mktime(0, 0, 0, $mes, 1, $ano);
                        $ultimo_dia = date('t', $data);

                        $primeiro_dia = $dia_w = date('w', mktime(0, 0, 0, $mes, 1, $ano));
                        $i = 1;
                        $achou_o_primeiro_dia = false;

                        while ($i < $ultimo_dia + 1) {

                            if ($i == $primeiro_dia + 1) {
                                $achou_o_primeiro_dia = true;

                                for ($j = 1; $j < $ultimo_dia + 1; $j++) {

                                    $dia_semana = mktime(0, 0, 0, $mes, $j, $ano);
                                    $dia_w = date('w', mktime(0, 0, 0, $mes, $j, $ano));

                                    if ($dia_w == 0) {
                                        echo "<tr>";
                                    }

                                    if (in_array($j, $array_aniversarios)) {
                                        echo "<td class='box aniversario'>$j</td>";
                                    } else if ($dia_w == 6 || $dia_w == 0) {
                                        echo "<td class='box fim_de_semana'>$j</td>";
                                    } else {
                                        echo "<td class='box'>$j</td>";
                                    }

                                    if ($dia_w == 6) {
                                        echo "</tr>";
                                    }
                                }
                                break;
                            }

                            if (!$achou_o_primeiro_dia) {
                                echo "<td class='vazio'></td>";
                            }
                            $i++;
                        }
                    }

                    if (isset($_POST['mes'])) {

                        $array_aniversarios = [];

                        $mes = substr($_POST['mes'], 5);
                        $ano = substr($_POST['mes'], 0, 4);
                        $array_aniversarios = explode(',', $_POST['array_aniversarios']);
                        sort($array_aniversarios);

                        geraCalendario($mes, $ano, $array_aniversarios);
                    } else {
                        geraCalendario(date('m'), date('Y'));
                    }

                    ?>

                </tbody>
            </table>
        </div>

        <form method="POST">
            <div class="form_div" style="flex-direction: column;">
                <div class="label_aniversarios">
                    <label for="">Datas de aniversários:
                        <input type="text" name="array_aniversarios" placeholder="5, 15, 18">
                    </label>
                </div>

                <div class="form_div">
                    <input type="month" value='<?php echo date('Y-m'); ?>' name="mes">
                    <input type="submit" value="Enviar">
                </div>
            </div>
        </form>

    </div>

</body>

</html>