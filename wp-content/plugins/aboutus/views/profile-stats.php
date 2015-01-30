            <?php foreach( $stats as $stat ) : ?>
            <li class="<?php echo $stat['key']; ?>">
                <span class="icon"></span>
                <span class="value"><?php echo $stat['value']; ?></span>
                <span class="caption"><?php echo $stat['title']; ?></span>
            </li>
            <?php endforeach; ?>