<?php

$pageTitle = 'Rules';
require('_header.php');


$rules = Queries::orderAll('rules', 'id', 'DESC');

?>

<div class="container">
    <div class="rules-wrapper">
    <?php if (!empty($rules)) { ?>
        <?php foreach ($rules as $rule) { ?>
            <div class="rule">
                <div class="rule-header">
                <p><?php echo $rule->title; ?></p>
                </div>
                <div class="rule-body">
                <p><?php echo $rule->description; ?></p>
                <p class="rule-punish"><i class="fas fa-ban"></i> Punishment: <?php echo $rule->punishment; ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } 
    else { 
        echo("<div class='embed-error'><p>No rules currently exist..</p></div>"); 
    } ?>
    </div>
</div>

<?php

require('_footer.php');