$(document).on('o:prepare-value', function(e, type, value) {
    if (0 === type.indexOf('valuesuggest:')) {

        var labelInput = $(value).find('input[data-value-key="o:label"]');
        var idInput = labelInput.siblings('input[data-value-key="@id"]');

        // Remove the @id value when the user changes the o:label input value.
        labelInput.on('input', function(e) {
            idInput.val('');
        });

        // @see https://github.com/devbridge/jQuery-Autocomplete
        labelInput.autocomplete({
            serviceUrl: valueSuggestProxyUrl,
            params: {type: type},
            deferRequestBy: 200,
            minChars: 3,
            // Must disable preventBadQueries or autocomple will not fire on
            // queries that share a root that previously returned no results.
            preventBadQueries: false,
            onSearchStart: function() {
                $('*').css('cursor', 'progress');
            },
            onSearchComplete: function(query, suggestions) {
                $('*').css('cursor', 'default');
            },
            // Set the @id value when the user selects a suggestion.
            onSelect: function (suggestion) {
                idInput.val(suggestion.data.uri);
            },
        });
    }
});
