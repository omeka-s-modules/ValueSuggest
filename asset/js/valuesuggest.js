$(document).on('o:prepare-value', function(e, type, value) {
    if (0 === type.indexOf('valuesuggest:')) {

        var thisValue = $(value);
        var suggestInput = thisValue.find('.valuesuggest-input');
        var labelInput = thisValue.find('input[data-value-key="o:label"]');
        var idInput = thisValue.find('input[data-value-key="@id"]');
        var valueInput = thisValue.find('input[data-value-key="@value"]');
        var idContainer = thisValue.find('.valuesuggest-id-container');

        // Literal is the default type.
        idInput.prop('disabled', true);
        labelInput.prop('disabled', true);
        valueInput.prop('disabled', false);
        idContainer.hide();

        // Set existing values duing initial load.
        if (idInput.val()) {
            // Set value as URI type
            suggestInput.val(labelInput.val())
                .attr('placeholder', labelInput.val());
            idInput.prop('disabled', false);
            labelInput.prop('disabled', false);
            valueInput.prop('disabled', true);
            var link = $('<a>')
                .attr('href', idInput.val())
                .attr('target', '_blank')
                .text(idInput.val());
            idContainer.show().find('.valuesuggest-id').html(link);
        } else if (valueInput.val()) {
            // Set value as Literal type
            suggestInput.val(valueInput.val())
                .attr('placeholder', valueInput.val());
            idInput.prop('disabled', true);
            labelInput.prop('disabled', true);
            valueInput.prop('disabled', false);
        }

        // Synchronize the suggest input with o:label or @value.
        suggestInput.on('input', function(e) {
            if (idInput.val()) {
                labelInput.val($(this).val());
            } else {
                valueInput.val($(this).val());
            }
        });

        // Remove the @id from URI type and transform it into Literal type.
        idContainer.find('.valuesuggest-id-remove').on('click', function(e) {
            e.preventDefault();
            idContainer.hide();
            valueInput.val(labelInput.val());
            idInput.prop('disabled', true);
            labelInput.prop('disabled', true);
            valueInput.prop('disabled', false);
        });

        suggestInput.autocomplete({
            serviceUrl: valueSuggestProxyUrl,
            params: {type: type},
            deferRequestBy: 200,
            minChars: 3,
            // Must disable preventBadQueries or autocomplete will not fire on
            // queries that share a root that previously returned no results.
            preventBadQueries: false,
            // Must disable triggerSelectOnValidInput or onSelect will be
            // triggered whether the user wants it or not. The user must
            // explicitly select the suggestion.
            triggerSelectOnValidInput: false,
            onSearchStart: function() {
                $(this).css('cursor', 'progress');
            },
            onSearchComplete: function(query, suggestions) {
                $(this).css('cursor', 'default');
            },
            onSearchError: function (query, jqXHR, textStatus, errorThrown) {
                // Silently handle error.
                $(this).css('cursor', 'default');
            },
            // Prepare the value when the user selects a suggestion.
            onSelect: function (suggestion) {
                // Set value as URI type
                suggestInput.val(suggestion.value)
                    .attr('placeholder', suggestion.value);
                idInput.val(suggestion.data.uri);
                labelInput.val(suggestion.value);
                idInput.prop('disabled', false);
                labelInput.prop('disabled', false);
                valueInput.prop('disabled', true);
                var link = $('<a>')
                    .attr('href', suggestion.data.uri)
                    .attr('target', '_blank')
                    .text(suggestion.data.uri);
                idContainer.show().find('.valuesuggest-id').html(link);
            },
            // Prepare the suggestions prior to rendering them.
            beforeRender: function(container, suggestions) {
                // Add title attribute to each suggestion for disambiguation.
                container.children().each(function(index) {
                    $(this).attr('title', suggestions[index].data.info);
                });
            }
        });
    }
});
