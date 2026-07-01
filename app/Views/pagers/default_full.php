<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
?>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li>
                <a href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                    <div>
                        <i class="fas fa-chevron-left" style="font-size: 11px;"></i>
                    </div>
                </a>
            </li>
        <?php endif ?>

        <li class="active">
            <span>
                <div><?= $pager->getCurrentPageNumber() ?></div>
            </span>
        </li>

        <?php if ($pager->hasNextPage()) : ?>
            <li>
                <a href="<?= $pager->getNextPage() ?>" aria-label="Next">
                    <div>
                        <i class="fas fa-chevron-right" style="font-size: 11px;"></i>
                    </div>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
