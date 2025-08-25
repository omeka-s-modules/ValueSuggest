<?php
namespace ValueSuggest\Suggester\Cc;

use ValueSuggest\Suggester\SuggesterInterface;

class CcSuggestAll implements SuggesterInterface
{
    /**
     * Return all Creative Commons licenses.
     *
     * @see https://creativecommons.org/
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        return [
            [
                'value' => 'CC0 1.0 - CC0 1.0 Universal',
                'data' => [
                    'uri' => 'https://creativecommons.org/publicdomain/zero/1.0/',
                    'info' => 'By marking the work with a CC0 public domain dedication, the creator is giving up their copyright and allowing reusers to distribute, remix, adapt, and build upon the material in any medium or format, even for commercial purposes.',
                ],
            ],
            [
                'value' => 'CC BY 4.0 - Attribution 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to distribute, remix, adapt, and build upon the material in any medium or format, even for commercial purposes.',
                ],
            ],
            [
                'value' => 'CC BY-SA 4.0 - Attribution-ShareAlike 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by-sa/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to distribute, remix, adapt, and build upon the material in any medium or format, even for commercial purposes. If others remix, adapt, or build upon the material, they must license the modified material under identical terms.',
                ],
            ],
            [
                'value' => 'CC BY-ND 4.0 - Attribution-NoDerivatives 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by-nd/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to copy and distribute the material in any medium or format in unadapted form only, even for commercial purposes.',
                ],
            ],
            [
                'value' => 'CC BY-NC 4.0 - Attribution-NonCommercial 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by-nc/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to distribute, remix, adapt, and build upon the material in any medium or format, for noncommercial purposes only.',
                ],
            ],
            [
                'value' => 'CC BY-NC-SA 4.0 - Attribution-NonCommercial-ShareAlike 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to distribute, remix, adapt, and build upon the material in any medium or format, for noncommercial purposes only. If others modify or adapt the material, they must license the modified material under identical terms.',
                ],
            ],
            [
                'value' => 'CC BY-NC-ND 4.0 - Attribution-NonCommercial-NoDerivatives 4.0 International',
                'data' => [
                    'uri' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
                    'info' => 'This license requires that reusers give credit to the creator. It allows reusers to copy and distribute the material in any medium or format in unadapted form and for noncommercial purposes only.',
                ],
            ],
        ];
    }
}
