<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<style>
    * {
        text-align: center;
    }
    body > div {
        display: inline-block;
    }
</style>
<body>
<div style="border-right: 1px solid gray; padding-right: 3%">
    <table>
        <tr>
            <th colspan="2">SUM</th>
        </tr>
        <tr>
            <th>regdate</th>
            <th>count</th>
        </tr>
        <?php
            foreach ($visitSum as $value) {
        ?>
            <tr>
                <td><?=$value->reg_date?></td>
                <td><?=$value->count?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</div>

<div style="padding-left: 3%">
    <table>
        <tr>
            <th colspan="2">COUNT</th>
        </tr>
        <tr>
            <th>regdate</th>
            <th>count</th>
        </tr>
        <?php
        foreach ($visitCount as $value) {
            ?>
            <tr>
                <td><?=$value->reg_date?></td>
                <td><?=$value->count?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>


</body>
</html>
