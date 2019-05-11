<?php


$rand_ary = [
];

$keywords_ary = [
];

$r_str = json_encode($rand_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("randomReply.json", $r_str);

$k_str = json_encode($keywords_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("keywords.json", $k_str);
