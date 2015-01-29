<?php if(count($news_feed)): foreach($news_feed as $news): ?>
              <li>
                <div class="item">
                  <span class="date"><?php echo date('j M Y', strtotime($news->post_date)) ?></span>
                  <h3><a href="<?php echo get_permalink($news->ID) ?>"><?php echo $news->post_title ?></a></h3>
                  <div class="news-feed-thumb"><a href="<?php echo get_permalink($news->ID) ?>"><?php echo get_the_post_thumbnail($news->ID,'medium')?></a></div>
                  <div class="content">
                    <p><?php echo get_field('summary', $news->ID); ?></p>
                  </div>
                </div>
              </li>
<?php endforeach; endif ?>