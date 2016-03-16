# Gravity Forms Help Scout Search Field

Add a Help Scout Docs search field to your Gravity Forms form. Used on the [Easy Digital Downloads ticket submission page](https://easydigitaldownloads.com/support/).

## To use:

1. The Help Scout Docs Search Field plugin requires an API key. Define it using the `HELPSCOUT_DOCS_API_KEY` constant, or set it using the `gf_helpscout_docs_api_key` filter.
1. Add a text field to your Gravity Forms form, then add `helpscout-docs` to the "Custom CSS Class" setting (in the field's Appearance tab).

### Modify the script settings

You can change the script configuration using the `gf_helpscout_docs_script_settings` filter. Modify the following array keys:

```
'debug' => false, // Print debug logs or not
'hideSubmit' => true, // Whether to hide the submit button until search is performed
'minLength' => 3, // Minimum number of characters required to trigger search
'limit' => 5, // Max limit for # of results to show
'text' => array(
    'result_found' => '{count} result found&hellip;',
    'results_found' => '{count} results found&hellip;',
    'no_results_found' => 'No results found&hellip;',
    'enter_search' => 'Please enter a search term.',
    'not_long_enough' => 'Search must be at least {minLength} characters.',
    'error' => 'There was an error fetching search results.',
),
'template' => array(
    'wrap_class' => 'docs-search-wrap',
    'before' => '<ul class="docs-search-results">',
    'item' => '<li class="article"><a href="{url}" title="{preview}">{name}</a></li>',
    'after' => '</ul>',
    'results_found' => '<span class="{css_class}">{text}</span>',
)
```