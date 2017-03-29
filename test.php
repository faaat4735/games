<?php
    function cmp($a, $b)
    {
        $a = $a % 54;
        $b = $b % 54;
        return $a == 0 ? 1 : $a > $b;
    }
    $puOne = 54;
    $puNum = 2;
    $puArr = ['大王',
              '红心A', '红心2', '红心3', '红心4', '红心5', '红心6', '红心7', '红心8', '红心9', '红心10', '红心J', '红心Q', '红心K',
              '方块A', '方块2', '方块3', '方块4', '方块5', '方块6', '方块7', '方块8', '方块9', '方块10', '方块J', '方块Q', '方块K',
              '黑桃A', '黑桃2', '黑桃3', '黑桃4', '黑桃5', '黑桃6', '黑桃7', '黑桃8', '黑桃9', '黑桃10', '黑桃J', '黑桃Q', '黑桃K',
              '梅花A', '梅花2', '梅花3', '梅花4', '梅花5', '梅花6', '梅花7', '梅花8', '梅花9', '梅花10', '梅花J', '梅花Q', '梅花K',
              '小王'];
    $member = array(0, 1, 2, 3);
    $memberNum = count($member);
    $pu = range(1, $puOne * $puNum);
    shuffle($pu);
    $count = $memberNum * 3;
    $results = array();

    for ($i = 0;$i < $count;$i++) {
        $memberNow = $i % $memberNum;
        $results[$member[$memberNow]][] = $pu[$i];
    }
    foreach ($results as &$result) {
        usort($result, "cmp");
        foreach ($result as &$value) {
            $value = $puArr[$value % 54];
        }
    }
    var_dump($results);
?>