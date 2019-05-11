<?php


//100をデフォルト
$rand_ary = [
    ["翠実総務に入るにはユニークな試験を通過しなくてはいけません", 100],
    ["翠嵐高校の先生方は個性に溢れています", 100],
    ["なにやら、73期翠実総務には家まで上履きで帰ってしまった人がいるとか...", 100],
    ["ダースベーダーが出てくる映画といえば?", 50]
];
$sum = 0;
foreach($rand_ary as $value){
    $sum += $value[1];
}

$keywords_ary = [
    "Twitter" =>"翠翔祭のTwitterは<a href='https:\/\/twitter.com\/suishosai0123'>@suishosai123<\/a>なのです！",
    "人生、宇宙、すべての答え" => "42",
];

$rand_ary["sum"] = $sum;

$r_str = json_encode($rand_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("randomReply.json", $r_str);

$k_str = json_encode($keywords_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("keywords.json", $k_str);
