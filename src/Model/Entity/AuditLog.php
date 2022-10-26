<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuditLog Entity
 *
 * @property int $id
 * @property string $transaction
 * @property string $type
 * @property int|null $primary_key
 * @property string $source
 * @property string|null $parent_source
 * @property string|null $original
 * @property string|null $changed
 * @property string|null $meta
 * @property \Cake\I18n\FrozenTime|null $created
 */
class AuditLog extends Entity
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
        'transaction' => true,
        'type' => true,
        'primary_key' => true,
        'source' => true,
        'parent_source' => true,
        'original' => true,
        'changed' => true,
        'meta' => true,
        'created' => true,
    ];
}
