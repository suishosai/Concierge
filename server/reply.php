<?php


$rand_ary = [
    "本日はお越しいただきありがとうございます！",
    "翠実総務に入るにはユニークな試験を通過しなくてはいけません",
    "翠嵐高校の先生方は個性に溢れています",
    "なにやら、73期翠実総務には家まで上履きで帰ってしまった人がいるとか..."
];

$keywords_ary = [
    "うんち" => "うんち大好き！！",
    "Twitter" => "翠翔祭のTwitterは<a href='https://twitter.com/suishosai0123'>@suishosai123</a>なのです！",
    "人生、宇宙、すべての答え" => "42"
];

$r_str = json_encode($rand_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("randomReply.json", $r_str);

$k_str = json_encode($keywords_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("keywords.json", $k_str);