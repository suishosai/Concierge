<?php


//100をデフォルト
$rand_ary = [
    ["翠実総務に入るにはユニークな試験を通過しなくてはいけません", 100],
    ["翠嵐高校の先生方は個性に溢れています", 100],
    ["なにやら、73期翠実総務には家まで上履きで帰ってしまった人がいるとか...", 100],
    ["翠実総務には恋人ができた人を囲んでタピオカを飲む伝統行事があります", 100],
    ["困ったことがあったら2棟1階生徒会室までお越しください！", 100],
    ["Twitterやってます。<a href='https://twitter.com/suishosai0123'>@suishosai0123</a>です", 100],
    ["今年度の翠翔祭テーマは「Voyage」です", 100],
    ["翠翔祭は6/22（土）23（日）の両日開催されます", 100],
    ["私の名前の由来は翠実総務のメンバーのあだ名です", 100],
    ["翠嵐生は花火大会でリア充になるんだそうですよ", 100],
    ["三ッ沢下町駅より徒歩12分です", 100],
    ["翠嵐祭ではなく翠翔祭です", 100],
    ["翠翔祭では日本円を翠円に換金して使います", 100],
    ["今年は湘南高校と文化祭の日にちが被りませんでした！(拍手", 100].
    ["翠実総務は恋愛に黒歴史を持ってる人が多いです", 100]
];
$sum = 0;
foreach($rand_ary as $value){
    $sum += $value[1];
}

$keywords_ary = [
    "Twitter" =>"翠翔祭のTwitterは<a href='https://twitter.com/suishosai0123'>@suishosai123</a>なのです！",
    "人生、宇宙、すべての答え" => "42",
];

$rand_ary["sum"] = $sum;

$r_str = json_encode($rand_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("randomReply.json", $r_str);

$k_str = json_encode($keywords_ary, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents("keywords.json", $k_str);

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
