<?php

if (!empty($_POST['clear'])) {
    switch ($_POST['clear']) {
        case 'apcu':
            apcu_clear_cache();
            header('Location: /apc.php'); die();
        case 'opcache':
            opcache_reset();
            header('Location: /apc.php'); die();
    }
}

function cache_info($limit = false)
{
    if (function_exists('apcu_cache_info')) {
        return apcu_cache_info($limit);
    }

    return apc_cache_info($limit);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APC Status</title>
        <link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                padding-top: 60px;
            }
        </style>
        <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <form method="post" action="/apc.php">
                <input type="hidden" name="clear" id="clear">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <table class="table table-bordered table-hover table-striped">
                            <caption>APCu</caption>
                            <tbody>
                                <tr>
                                    <th>operations</th>
                                    <td><button onclick="$('#clear').val('apcu').parents(form).submit()" class="btn btn-default btn-sm">Clear</button></td>
                                </tr>
                                <?php foreach (cache_info(true) as $key => $val): ?>
                                    <tr>
                                        <th><?php echo $key ?></th>
                                        <td><?php echo $val ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <table class="table table-bordered table-hover table-striped">
                            <caption>OPcache</caption>
                            <tbody>
                                <tr>
                                    <th>operations</th>
                                    <td><button onclick="$('#clear').val('opcache').parents(form).submit()" class="btn btn-default btn-sm">Clear</button></td>
                                </tr>
                                <?php foreach (opcache_get_status(false) as $key => $val): ?>
                                    <tr>
                                        <th><?php echo $key ?></th>
                                        <td>
                                            <?php if (is_array($val)): ?>
                                                <dl>
                                                    <?php foreach ($val as $key2 => $val2): ?>
                                                        <dt><?php echo $key2 ?></dt>
                                                        <dd><?php echo $val2 ?></dd>
                                                    <?php endforeach ?>
                                                </dl>
                                            <?php else: ?>
                                                <?php echo $val ?>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
