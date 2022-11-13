<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $ticket
 * @property string $subject
 * @property string $category
 * @property string $name
 * @property string $email
 * @property string $notes
 * @property string $note_admin
 * @property string $ip
 * @property string $status
 * @property \Cake\I18n\FrozenTime $respond_date_time
 * @property string|null $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Contact extends Entity
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
        'ticket' => true,
        'subject' => true,
        'category' => true,
        'name' => true,
        'email' => true,
        'notes' => true,
        'note_admin' => true,
        'ip' => true,
        'status' => true,
        'is_replied' => true,
        'respond_date_time' => true,
        'slug' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
