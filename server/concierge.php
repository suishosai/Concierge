<?php

const FILE_NAME = "./output.csv";

if ( ! isset( $_POST["query"] ) ) {
    echo "Invalid Argument";
    return;
}

$data = [];

const TEMPLATE_FOR_SERACH_NUM = "お探しの情報は%d件見つかりました。";
const TEMPLATE_FOR_NO_FOUND = "お探しの情報は見つかりませんでした。キーワードを変えるか、減らして再度お試しください";
const TEMPLATE_FOR_INFO = "%s<br><br>%s<br><br><a href='%s'>リンクはこちら</a>";

$query = (string) urldecode($_POST["query"]);
$query = str_replace("\n", "", $query);

if(strpos($query, "@q") !== FALSE){
    $query = str_replace("@q ", "@q", $query);
    $query = str_replace("@q", "", $query);

    $keywords = explode(" ", $query);

    $result_array = [];
    $cache = [];

    $file_contents = file_get_contents(FILE_NAME);
    $cache = explode("\n", $file_contents);
    $cache2 = [];

    foreach($cache as $row){
        list($o_id, $o_name, $o_description, $o_keywords, $o_url) = explode(",", $row);
        $cache2[$o_id] = [];
        $cache2[$o_id] = ["name" => $o_name, "description" => $o_description, "url" => $o_url, "keywords" => $o_keywords];
        $result_array[$o_id] = 0;
    }

    foreach($keywords as $keyword){
        if($keyword === "") continue;
        foreach($cache2 as $_o_id_ => $o_data){
            $result_array[$_o_id_] += strpos($o_data["keywords"], $keyword) !== FALSE ? 1 : 0;
        }
    }

    arsort($result_array);

    $i = 0;
    $max = 5;
    $data[0] = "";
    foreach($result_array as $key => $value){
        if($value === 0) break;
        $data[$i + 1] = sprintf(TEMPLATE_FOR_INFO, $cache2[$key]["name"], $cache2[$key]["description"], $cache2[$key]["url"]);
        $i++;
    }
    if($i === 0){
        $data[0] = TEMPLATE_FOR_NO_FOUND;
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        return;
    }
    $data[0] = sprintf(TEMPLATE_FOR_SERACH_NUM, $i);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    return;
}else{

    if($query === "gyoza"){
        $data[0] = "The secret key was given";
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        return; 
    }

    if($query === "upsidedown"){
        $data[0] = "Up Side Down";
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        return;
    }

    if($query === "starwars"){
        $data[0] = "May the Force be with you";
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        return;
    }

    $keywords = json_decode(file_get_contents("./keywords.json"), true);
    if(isset($keywords[$query])){
        $data[0] = $keywords[$query];
        echo json_encode($data, JSON_UNESCAPED_UNICODE); 
    }else{
        $rand_ary = json_decode(file_get_contents("./randomReply.json"), true);
        $sum = $rand_ary["sum"];
        $rand = rand(0, $sum);
        $k = 0;
        $res = "";
        foreach($rand_ary as $value){
            $k += $value[1];
            if($k >= $rand){
                $res = $value[0];
                break;
            }
        }
        $data[0] = $rand_ary[$res];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

