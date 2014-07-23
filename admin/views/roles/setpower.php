<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</head>
<body>
    <div class="container">
        <h1><?php echo $roles['name'] ?>的权限设置</h1>
        <?php echo validation_errors(); ?>
        <form action="<?php echo $link_url . 'power/' . $id ?>" method="post">
            <?php foreach ($powers as $p): ?>
                <p><input name="models[]" type="checkbox" value="<?php echo $p['id'] ?>"
                    <?php
                    $id = strval($p['id']);
                    if ($models[$id] == 1) {
                        echo 'checked="checked"';
                    }
                    ?>              
                          /><?php echo $p['name'] ?></p>
                <?php endforeach ?>
            <input name="action" value="ok" type="hidden"/>
            <input type="submit" value="提交"/>
        </form>
    </div>