            <li class="visits">
              <span class="icon"></span>
              <span class="value">
                  <?php 
                  if(isset($stats[0]['value'])){
                  echo intval($stats[0]['value']);
                  } ?>
              </span>
              <span class="caption">Visits</span>
            </li>
            <li class="emails">
              <span class="icon"></span>
              <span class="value">
              <?php 
              if(isset($stats[1]['value'])){
              echo intval($stats[1]['value']); 
              }
              ?>
              </span>
              <span class="caption">Emails</span>
            </li>
            <li class="maps">
              <span class="icon"></span>
              <span class="value">
              <?php 
              if(isset($stats[2]['value'])){
              echo intval($stats[2]['value']);
              } 
              ?>
              </span>
              <span class="caption">Map Views</span>
            </li>
            <li class="social">
              <span class="icon"></span>
              <span class="value"><?php if(isset($stats[3])) { echo intval((int)$stats[3]['value'] + (int)$stats[4]['value']); } ?></span>
              <span class="caption">Social</span>
            </li>