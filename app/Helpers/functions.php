<?php

function kataleko()
{
    echo "Julião f.k.";
}

function hashtag($string) {

    $htag = "#";
    $arr = explode(" ", $string);
    $arrc = count($arr);
    $i = 0;
    $texto = implode(" ", $arr);
    while($i < $arrc) {
        if(substr($arr[$i], 0 , 1) == $htag){
            $l = substr($arr[$i], 1);
            $arr[$i] = "<a href='?h=$l'>#$l</a>";
        }else if(substr($arr[$i], 0 , 1) == "#"){
            $l = substr($arr[$i], 1);
            $arr[$i] = "<a href='?h=$l'>#$l</a>";
        }else if(substr($arr[$i], 0 , 4) == "http"){
            $l = $arr[$i];
            $arr[$i] = "<a target='_blank' href='$l'>$l</a>";
        }else if(substr($arr[$i], 0 , 6) == "https:"){
            $l = $arr[$i];
            $arr[$i] = "<a target='_blank' href='$l'>$l</a>";
        }else if(substr($arr[$i], 0 , 4) == "www."){
            $l = $arr[$i];
            $arr[$i] = "<a target='_blank' href='http://$l'>$l</a>";
        }else if(substr($arr[$i], 0 , 2) == "m."){
            $l = $arr[$i];
            $arr[$i] = "<a target='_blank' href='http://$l'>$l</a>";
        }
        $i++;
    }

    return implode(" ", $arr);

}

function removeImage($image) {  
    if(file_exists(public_path($image)) && is_file(public_path($image))){
        unlink(public_path($image));
    }
}

function movimentKind($mov) {  
    if($mov == 1) echo "Saldo inicial";
    if($mov == 2) echo "Ganhos";
    if($mov == 3) echo "Gastos e Despesas";
    if($mov == 4) echo "Dívidas";
}

function userCategory($role) {
    if($role == 1) echo "Administrador do sistema";
    else echo "Administrador do Hotel";
}

function dateProcess($date) {
    $unixTimestamp = strtotime($date);
    $dayOfWeek = date("l", $unixTimestamp);
    if($dayOfWeek == "Thursday") {
    $dayOfWeek = "Quinta-feira";
    } else if($dayOfWeek == "Monday") {
    $dayOfWeek = "Segunda-feira";
    } else if($dayOfWeek == "Tuesday") {
    $dayOfWeek = "Terça-feira";
    } else if($dayOfWeek == "Wednesday") {
    $dayOfWeek = "Quarta-feira";
    } else if($dayOfWeek == "Friday") {
    $dayOfWeek = "Sexta-feira";
    } else if($dayOfWeek == "Saturday") {
    $dayOfWeek = "Sábado";
    } else if($dayOfWeek == "Sunday") {
    $dayOfWeek = "Domingo";
    }
    $day = date("d",strtotime($date));
    $month = date("m",strtotime($date));
    $year = date("Y",strtotime($date));
    if($month == "01") {
    $month = "Janeiro";
    }
    if($month == "02") {
    $month = "Fevereiro";
    }
    if($month == "03") {
    $month = "Março";
    }
    if($month == "04") {
    $month = "Abril";
    }
    if($month == "05") {
    $month = "Maio";
    }
    if($month == "06") {
    $month = "Junho";
    }
    if($month == "07") {
    $month = "Julho";
    }
    if($month == "08") {
    $month = "Agosto";
    }
    if($month == "09") {
    $month = "Setembro";
    }
    if($month == "10") {
    $month = "Outubro";
    }
    if($month == "11") {
    $month = "Novembro";
    }
    if($month == "12") {
    $month = "Dezembro";
    }
    echo "<div><i class='far fa-calendar'></i> $dayOfWeek, Dia $day de $month de $year
    às ".substr($date,-8)."hs</div>";
}

// getting the ip
function getIp(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}

function choosePlatform($type) {
    if($type == 1) echo "Acessado do website";
    else if($type == 2) echo "Acessado do aplicativo";
    else echo "Origem desconhecida";
}

function slug( $string ) {
    if (is_string($string)) {
            $string = strtolower(trim(utf8_decode($string)));

            $before = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
            $after  = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';           
            $string = strtr($string, utf8_decode($before), $after);

            $replace = array(
                    '/[^a-z0-9.-]/'	=> '-',
                    '/-+/'			=> '-',
                    '/\-{2,}/'		=> ''
            );
            $string = preg_replace(array_keys($replace), array_values($replace), $string);
    }
    return $string;
}