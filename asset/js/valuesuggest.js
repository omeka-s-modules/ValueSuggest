$(document).on('o:prepare-value', function(e, type, value) {
    if (0 === type.indexOf('valuesuggest:')) {
        // @see https://github.com/devbridge/jQuery-Autocomplete
        $(value).find('.input-body input').autocomplete({
            serviceUrl: valueSuggestProxyUrl,
            params: {type: type},
            deferRequestBy: 200,
            minChars: 3,
            // Must disable preventBadQueries or autocomple will not fire on
            // queries that share a root that previously returned no results.
            preventBadQueries: false,
        });
    }
});
