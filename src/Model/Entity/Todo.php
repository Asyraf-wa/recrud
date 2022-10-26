<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Todo Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $urgency
 * @property string $task
 * @property string $description
 * @property string $note
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Todo extends Entity
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
        'user_id' => true,
        'urgency' => true,
        'task' => true,
        'description' => true,
        'note' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
