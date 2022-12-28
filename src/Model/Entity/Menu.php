<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property int|null $level
 * @property string|null $name
 * @property string|null $url
 * @property bool|null $active
 * @property bool|null $disabled
 * @property int|null $status
 * @property bool|null $divider_before
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Menu $parent_menu
 * @property \App\Model\Entity\Menu[] $child_menus
 */
class Menu extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'level' => true,
        'icon' => true,
        'controller' => true,
        'action' => true,
        'target' => true,
        'name' => true,
        'url' => true,
        'prefix' => true,
        'auth' => true,
        'admin' => true,
        'active' => true,
        'disabled' => true,
        'status' => true,
        'divider_before' => true,
        'created' => true,
        'modified' => true,
        'parent_menu' => true,
        'child_menus' => true,
        'division' => true,
		'parent_separator' => true,
    ];
}
