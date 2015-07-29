<?php
namespace ADmad\I18n\Routing\Route;

use Cake\Core\Configure;
use Cake\Routing\Route\DashedRoute;
use Cake\Utility\Hash;

class I18nRoute extends DashedRoute
{

    /**
     * Regular expression for `lang` route element
     *
     * @var string
     */
    public static $langRegEx = null;

    /**
     * Constructor for a Route
     *
     * @param string $template Template string with parameter placeholders
     * @param array $defaults Array of defaults for the route.
     * @param string $options Array of parameters and additional options for the Route
     * @return void
     */
    public function __construct($template, $defaults = [], array $options = [])
    {
        if (strpos($template, ':lang') === false) {
            $template = '/:lang' . $template;
        }
        if ($template === '/:lang/') {
            $template = '/:lang';
        }

        $options['inflect'] = 'dasherize';
        $options['persist'][] = 'lang';

        if (!array_key_exists('lang', $options)) {
            if (self::$langRegEx === null &&
                $langs = Configure::read('I18n.languages')
            ) {
                self::$langRegEx = implode('|', array_keys(Hash::normalize($langs)));
            }
            $options['lang'] = self::$langRegEx;
        }

        parent::__construct($template, $defaults, $options);
    }
}