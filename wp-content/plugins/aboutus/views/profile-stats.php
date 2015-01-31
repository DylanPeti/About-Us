            <?php foreach( $stats as $stat ) : ?>
            <li class="<?php echo $stat['key']; ?>">
                <i class="fa fa-<?php echo $stat['key']; ?>"></i>
                <span class="value"><?php echo $stat['value']; ?></span>
                <span class="caption"><?php echo $stat['title']; ?></span>
            </li>
            <?php endforeach; ?>