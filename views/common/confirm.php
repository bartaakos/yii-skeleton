<div class="textModal">
    <h3>Confirmation</h3>

    <p><?php echo str_replace(array_keys($params),array_values($params),$body); ?></p>

    <div class="form">
        <a href="<?php echo $confirmedUrl; ?>" class="button redBg default<?php echo $ajax ? ' ajax' : ''; ?>"><?php echo $confirmedBtnLbl; ?></a>
        <a href="#" class="secondary close">Cancel</a>
    </div>
</div>
