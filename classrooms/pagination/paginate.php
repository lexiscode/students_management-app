<?php $base = strtok($_SERVER['REQUEST_URI'], '?'); ?>

<div style="display: flex; justify-content: center;">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($paginator->previous):?>
                <li class="page-item"><a class="page-link" href="<?= $base; ?>?page=<?= $paginator->previous; ?>">Previous</a></li>
            <?php else:?>
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
            <?php endif;?>
        

            <?php if ($paginator->next): ?>
                <li class="page-item"><a class="page-link" href="<?= $base; ?>?page=<?= $paginator->next; ?>">Next</a></li>
            <?php else:?>
                <li class="page-item disabled">
                    <a class="page-link">Next</a>
                </li>
            <?php endif;?>

        </ul> 
    </nav>
</div>