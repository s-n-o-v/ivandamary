<?php
    require_once('head.php');

    $sql = sprintf('
                    WITH stat AS (
                        SELECT
                            DATE_FORMAT(`start`, "%%d.%%m.%%Y") DDD,
                            CASE WHEN s.`work`= 0 THEN `start` ELSE NULL END `start`,
                            CASE WHEN s.`work`= 0 THEN `end` ELSE NULL END `end`,
                            CASE
                                WHEN s.WORK=2 THEN 1
                                ELSE 0 
                            END gu,
                            CASE
                                WHEN s.WORK=3 THEN 1
                                ELSE 0 
                            END tu,
                            CASE
                                WHEN s.WORK=1 THEN 1
                                ELSE 0 
                            END arrival,
                            bed,
                            towels,
                            s.`work`,
                            r.`type`,
                            p.price,
                            p.price + CASE WHEN bed > 0 THEN 30 ELSE 0 END + CASE WHEN towels > 0 THEN 10 ELSE 0 END summ
                            
                        FROM statistics s
                            LEFT JOIN rooms r ON s.room=r.id
                            LEFT JOIN prices p ON r.`type`=p.room_type AND p.`work`=s.`work`
                        WHERE
                            staff = %u
                    )
                    SELECT
                        DDD,
                        MAX(`start`) `start`,
                        MAX(`end`) `end`,
                        SUM(gu) gu,
                        SUM(tu) tu,
                        SUM(arrival) arrival,
                        SUM(summ) total
                    FROM stat
                    GROUP BY DDD
                    ORDER BY 1;
    ',167);

echo <<<TITLE_BLOCK
    <div class="container-fluid">
        <h1 class="display-3">Отчёт по всем работам</h1>
    </div>
    <hr />
TITLE_BLOCK;

echo <<<BEGIN_TABLE
    <div class="row justify-content-md-center">
        <div class="col-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Начало рабочего дня</th>
                        <th scope="col">Конец рабочего дня</th>
                        <th scope="col">Кол-во генеральных уборок</th>
                        <th scope="col">Кол-во текущих уборок</th>
                        <th scope="col">Кол-во заездов</th>
                        <th scope="col">Сумма оплаты за день</th>
                    </tr>
                </thead>
                <tbody>
BEGIN_TABLE;

    $res = mysql_query($sql);
    echo mysql_error();
    
    $total = 0;
    while ($r=mysql_fetch_assoc($res)) {
        $total += $r['total'];
        printf('
                    <tr>
                        <td><a href="/detail.php?date=%s">%s</a></td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%u</td>
                        <td>%u</td>
                        <td>%u</td>
                        <td>%u</td>
                    </tr>',
        $r['DDD'],
        $r['DDD'],
        $r['start'],
        $r['end'],
        $r['gu'],
        $r['tu'],
        $r['arrival'],
        $r['total']);
    }
    printf('
                    <tr>
                        <td colspan="6"><strong>Итоговая сумма<strong></td>
                        <td><strong>%u</strong></td>
                    </tr>
    ', $total);

echo <<<END_TABLE
                </tbody>
            </table>
        </div>
    </div>
END_TABLE;

    require_once('bottom.php');
?>