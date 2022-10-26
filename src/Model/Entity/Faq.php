<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Faq Entity
 *
 * @property string $id
 * @property string $category
 * @property string $question
 * @property string $answer
 * @property string $slug
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Faq extends Entity
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
        'category' => true,
        'question' => true,
        'answer' => true,
        'slug' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}
