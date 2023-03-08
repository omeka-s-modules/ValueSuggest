<?php
namespace ValueSuggest\Suggester;

/**
 * Interface for suggesters that use contextual parameters beyond "lang".
 *
 * Contextual parameters include:
 *   - property_id: the current value's property ID
 *   - resource_template_id: the current resource's resource template ID
 *   - resource_class_id: the current resource's resource class ID
 */
interface SuggesterWithContextInterface extends SuggesterInterface
{
    public function getSuggestions($query, $lang = null, array $context = []);
}
