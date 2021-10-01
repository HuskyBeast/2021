<?php 
ob_start();
?>
    <div class="d-flex justify content-center py-3">
        <div>
            <a href="admin.php?rubrika" class="btn btn-primary btn-lg" tabindex="-1" role="button">Prideti nauja rubrika</a>
        </div>
        <div>   
            <a href="admin.php?straipsnis"  class="btn btn-secondary btn-lg" tabindex="0" role="button">Prideti nauja straipsni</a>
        </div>
    </div>
<?php
    $content = ob_get_clean();
?>