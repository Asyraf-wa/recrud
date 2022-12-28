<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

/**
 * Menu helper
 */
class MenuHelper extends HtmlHelper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    // protected $_defaultConfig = [];

    /* public function link($title, $url = null, array $options = []): string
    {
        // controller:action

        if (filter_var($url, FILTER_VALIDATE_URL) === false && strpos($url, ':') !== false) {
            [$controller, $action] = explode(':', $url);
            $url = compact('controller', 'action');
        }

        return parent::link($title, $url, $options);
    } */
}
