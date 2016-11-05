$(document).on('o:prepare-value', function(e, type, value) {
    if (0 === type.indexOf('valuesuggest:')) {

        var labelInput = $(value).find('input[data-value-key="o:label"]');
        var uriInput = labelInput.siblings('input[data-value-key="@id"]');
        var displayUri = labelInput.siblings('.valuesuggest-uri');

        // Populate o:label placeholder and display URI for an existing value.
        labelInput.attr('placeholder', labelInput.val());
        var link = $('<a>')
            .attr('href', uriInput.val())
            .attr('target', '_blank')
            .text(uriInput.val());
        displayUri.html(link);

        // Flag the display URI as invalid when there is no o:label. Otherwise,
        // remove the flag.
        labelInput.on('input', function(e) {
            if ('' === labelInput.val().trim()) {
                displayUri.addClass('error');
            } else {
                displayUri.removeClass('error');
            }
        });

        // Set up autocomplete for the label input field.
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
            // Prepare the entire value when the user selects a suggestion.
            onSelect: function (suggestion) {
                uriInput.val(suggestion.data.uri);
                var link = $('<a>')
                    .attr('href', suggestion.data.uri)
                    .attr('target', '_blank')
                    .text(suggestion.data.uri);
                displayUri.html(link);
                displayUri.removeClass('error');
                labelInput.attr('placeholder', suggestion.value);
            },
        });
    }
});
