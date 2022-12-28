<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="menus view content">
            <h3><?= h($menu->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parent Menu') ?></th>
                    <td><?= $menu->has('parent_menu') ? $this->Html->link($menu->parent_menu->name, ['controller' => 'Menus', 'action' => 'view', $menu->parent_menu->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menu->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($menu->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menu->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($menu->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($menu->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Level') ?></th>
                    <td><?= $this->Number->format($menu->level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $menu->active ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Disabled') ?></th>
                    <td><?= $menu->disabled ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Divider Before') ?></th>
                    <td><?= $menu->divider_before ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Menus') ?></h4>
                <?php if (!empty($menu->child_menus)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Level') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Disabled') ?></th>
                            <th><?= __('Divider Before') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menu->child_menus as $childMenus) : ?>
                        <tr>
                            <td><?= h($childMenus->id) ?></td>
                            <td><?= h($childMenus->parent_id) ?></td>
                            <td><?= h($childMenus->lft) ?></td>
                            <td><?= h($childMenus->rght) ?></td>
                            <td><?= h($childMenus->level) ?></td>
                            <td><?= h($childMenus->name) ?></td>
                            <td><?= h($childMenus->url) ?></td>
                            <td><?= h($childMenus->active) ?></td>
                            <td><?= h($childMenus->disabled) ?></td>
                            <td><?= h($childMenus->divider_before) ?></td>
                            <td class="actions">
                               
<div class="btn-group shadow" role="group" aria-label="Basic example">
<?php echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $childMenus->id], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) ?>
<?php echo $this->Html->link(__('<i class="fa-solid fa-pen-to-square"></i>'), ['action' => 'edit', $childMenus->id],['class'=> 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
<?php //echo $this->Form->postLink(__('<i class="fa-regular fa-trash-can"></i>'), ['action' => 'delete', $menu->id],['class'=> 'btn btn-outline-danger btn-xs', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
<?php echo $this->Form->postLink(__('<i class="fa-regular fa-trash-can"></i>'), ['action' => 'removeAndDelete', $childMenus->id],['class'=> 'btn btn-outline-danger btn-xs', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to remove and delete # {0}?', $childMenus->id)]) ?>
</div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
