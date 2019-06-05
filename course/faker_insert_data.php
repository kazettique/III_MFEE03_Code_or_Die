<?php
require __DIR__ . './../login/__connect_db.php';

// microtime: Return current Unix timestamp with microseconds
// 顯示開始時間（毫秒）
$begin = microtime(true);
echo $begin . '<br>';

$sql = "INSERT INTO `course`(
            `c_title`, `c_subtitle`, `c_intro`, `c_cover`, `c_level`,
            `c_courseDate`, `c_courseLocation`, `c_coachName`, `c_coachAvatar`, `c_coachNationality`,
            `c_backers`, `c_fundNow`, `c_fundGoal`, `c_createDate`, `c_startDate`,
            `c_endDate`, `c_status`
            ) VALUES (
              ?, ?, ?, ?, ?,
              ?, ?, ?, ?, ?,
              ?, ?, ?, ?, ?,
              ?, ?
            )";

$stmt = $pdo->prepare($sql);

// 開始 Transaction
// 'PDO::beginTransaction': Initiates a transaction
$pdo->beginTransaction();

for ($i = 1; $i < 100; $i++) {

    $fundNow = $i * 1000;
    $fundGoal = $i * 10000;
    $nowTime = date('Y-m-d H:i:s');
    $stmt->execute([
        "特技單車課程_$i",
        "入門課程，歡迎新手加入，一起探索特技單車的世界吧！",
        "你好，這裡是課程的詳細介紹文章",
        "$i.jpg",
        "入門",

        "2019/07/10",
        "台北市",
        "Dave Mirra_$i",
        "$i.png",
        "美國",

        "0",
        "$fundNow",
        "$fundGoal",
        "$nowTime",
        "2019-03-26",

        "2019-08-31",
        "集資中"
    ]);
}

// 提交 Transaction
// 'PDO::commit': Commits a transaction
// PS. 沒有提交的話，transaction中所做的處理結匯被放棄
// 不是所有的地方都需要用transaction
// 一堆sql要處理的時候，才需要用到transaction

$pdo->commit();

$end = microtime(true);
echo $end . '<br>';
echo $end - $begin . '<br>';

?>