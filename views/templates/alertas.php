<?php

foreach ($alerts as $type => $messages):
    foreach ($messages as $message):
?>
        <p class="alert <?php echo $type; ?>"><?php echo $message; ?></p>
<?php
    endforeach;
endforeach;
?>
