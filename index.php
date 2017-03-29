<?php
    function Poker($member = 4, $POSTCARDS = 52 , $total = 0)
    {
        /*撲克花色*/
        $Poker = [
            'Spades',
            'Hearts',
            'Diamonds',
            'Clubs',
        ];
        /*人頭牌*/
        $CARD = [
            11 => 'J',
            12 => 'Q',
            13 => 'K',
        ];

        /*發牌順序*/
        $P = range(0, $POSTCARDS - 1);
        shuffle($P);

        /*存放結果陣列*/
        $result = [];

        $total = $total ? ($total * $member > count($P) ? count($P) : $total * $member) : count($P);
        for ($i = 0; $i < $total; $i++) {
            /*發給玩家*/
            $t = $i % $member + 1;
            /*發牌編號 0-51*/
            $v = $P[$i];
            /*發牌花色 Spades,Hearts,Diamonds,Clubs*/
            $c = $Poker[$v % count($Poker)];
            /*花色大小 1-13*/
            $k = ($v % 13) + 1;
            $result[$t][$c][$k] = (in_array($k, array_keys($CARD))) ? $CARD[$k] : $k;
            /*依牌大小排序*/
            krsort($result[$t][$c]);
            /*依花色排序*/
            krsort($result[$t]);
        }

        return $result;
    }
    /*印出結果*/
    print_r(Poker(1, 13));
    /*如果要發4個人52張牌*/
    print_r(Poker(4, 52));
?>