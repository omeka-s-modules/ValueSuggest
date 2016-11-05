$(document).on('o:prepare-value', function(e, type, value) {
    if (0 === type.indexOf('valuesuggest:')) {

        var thisValue = $(value);
        var suggestInput = thisValue.find('.valuesuggest-input');
        var labelInput = thisValue.find('input[data-value-key="o:label"]');
        var idInput = thisValue.find('input[data-value-key="@id"]');
        var valueInput = thisValue.find('input[data-value-key="@value"]');
        var idDisplay = thisValue.find('.valuesuggest-id');

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
            idDisplay.html(link);
        } else if (valueInput.val()) {
            // Set value as Literal type
            suggestInput.val(valueInput.val())
                .attr('placeholder', valueInput.val());
            idInput.prop('disabled', true);
            labelInput.prop('disabled', true);
            valueInput.prop('disabled', false);
        }

        suggestInput.autocomplete({
            serviceUrl: valueSuggestProxyUrl,
            params: {type: type},
            deferRequestBy: 200,
            minChars: 3,
            // Must disable preventBadQueries or autocomple will not fire on
            // queries that share a root that previously returned no results.
            preventBadQueries: false,
            onSearchStart: function() {
                //~ $('*').css('cursor', 'progress');
            },
            onSearchComplete: function(query, suggestions) {
                //~ $('*').css('cursor', 'default');
            },
            // Prepare the entire value when the user selects a suggestion.
            onSelect: function (suggestion) {
                if (typeof suggestion.data !== 'undefined' && suggestion.data.uri) {
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
                    idDisplay.html(link);
                } else {
                    // Set value as Literal type
                    suggestInput.val(suggestion.value)
                        .attr('placeholder', suggestion.value);
                    valueInput.val(suggestion.value);
                    idInput.prop('disabled', true);
                    labelInput.prop('disabled', true);
                    valueInput.prop('disabled', false);
                }
            },
        });
    }
});
