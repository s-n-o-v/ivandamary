<?php
    require_once('head.php');

    $d = $_REQUEST["date"];

    $sql = sprintf('
                    SELECT 
                        r.num,
                        b.`name` bc,
                        r.`type` rc,
                        w.`name` wtype,
                        s.`start`,
                        s.`end`,
                        p.price + CASE WHEN bed > 0 THEN 30 ELSE 0 END + CASE WHEN towels > 0 THEN 10 ELSE 0 END summ
                    FROM 
                        statistics s
                        JOIN works w ON s.`work`=w.id
                        JOIN rooms r ON s.room=r.id
                        JOIN prices p ON r.`type`=p.room_type AND p.`work`=s.`work`
                        JOIN builds b ON r.build=b.id

                    WHERE 
                        `start` BETWEEN (STR_TO_DATE("%s", "%%d.%%m.%%Y") + INTERVAL 0 SECOND)
                                    AND (STR_TO_DATE("%s", "%%d.%%m.%%Y") + INTERVAL "23:59:59" HOUR_SECOND )
                    ORDER BY `start`
    ',$d, $d);


printf('
    <div class="container-fluid">
        <h1 class="display-3">Список всех работ за %s</h1>
    </div>
    <hr />
', $d);

echo <<<BEGIN_TABLE
    <div class="row justify-content-md-center">
        <div class="col-10">
            <a class="btn btn-link" href="/index.php">Назад</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Номер </th>
                        <th scope="col">Категория номера</th>
                        <th scope="col">Тип уборки</th>
                        <th scope="col">Начало уборки</th>
                        <th scope="col">Конец уборки</th>
                        <th scope="col">Сумма за уборку</th>
                    </tr>
                </thead>
                <tbody>
BEGIN_TABLE;
    if ($d) {
        $res = mysql_query($sql);
        echo mysql_error();
    
        $total = 0;
        $c = mysql_num_rows($res);
        while ($r=mysql_fetch_assoc($res)) {
//            $c++;
            $total += $r['summ'];
            printf('
                        <tr>
                            <td>%s</td>
                            <td>%u</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%u</td>
                        </tr>',
            $r['num'],
            $r['rc'],
            $r['wtype'],
            $r['start'],
            $r['end'],
            $r['summ']);
        }
        if ($c > 0) {
            printf('
                        <tr>
                            <td colspan="5"><strong>Итоговая сумма за день  <strong></td>
                            <td><strong>%u</strong></td>
                        </tr>
        ', $total);
        } else {
            echo '
                        <tr>
                            <td colspan="6">Нет данных</td>
                        </tr>
            ';
        }
    } else {
        echo '
                        <tr>
                            <td colspan="6">Нет данных</td>
                        </tr>
        ';
    }
echo <<<END_TABLE
                </tbody>
            </table>
        </div>
    </div>
END_TABLE;

    require_once('bottom.php');
?>