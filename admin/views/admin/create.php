<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</head>
<body>
    <div class="container">
        <?php echo validation_errors(); ?>
        <?php echo form_open($url); ?>
        <p>
            <label for="username">用户名：</label>
            <input type="input" name="username" value="<?php echo $admin['username'] ?>"/>
        </p>

        <p>
            <label for="password">密码：</label>
            <input type="password" name="password" value=""/>
        </p>
        <p>
            <label for="roleid">用户组：</label>
            <select name="roleid">
                <?php
                foreach ($roles as $rl):
                    ?>
                    <option value="<?php echo $rl['id'] ?>"
                    <?php
                    if ($admin['role'] == $rl['id']) {
                        echo 'selected="selected"';
                    }
                    ?>>
                                <?php echo $rl['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <input type="submit" name="submit" value="<?= $submitvalue ?>" /> 

    </form>
</div>