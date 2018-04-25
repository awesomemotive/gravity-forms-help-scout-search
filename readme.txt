=== Gravity Forms - Help Scout Docs Search Field ===
Author URI: https://pippinsplugins.com
Plugin URI: https://pippinsplugins.com/gravity-forms-help-scout-docs-search-field
Contributors: mordauk, katzwebservices
Donate link: https://pippinsplugins.com/support-the-site
Tags: gravity forms, help scout, helpscout, documentation
Requires at least: 3.6
Tested up to: 4.9.5
Stable Tag: 3.0.3
License: GNU Version 2 or Any Later Version

Add a Help Scout Docs search field to your Gravity Forms form.

== Description ==

Add a Help Scout Docs search field to your Gravity Forms form. Used on the [Easy Digital Downloads ticket submission page](https://easydigitaldownloads.com/support/).

This plugin requires [Gravity Forms](https://gravityforms.com) and a [Help Scout](https://helpscout.net) account.

See the Installation tab for instructions on configuring the plugin.

![Demo](https://pippinspluginscom.c.presscdn.com/wp-content/uploads/2016/06/Jun-28-2016-13-44-03.gif)

Find a bug? Have a suggestion? Let us know on [GitHub](https://github.com/easydigitaldownloads/gravity-forms-help-scout-search)!

== Installation ==

1. The Help Scout Docs Search Field plugin requires the Help Scout Docs sub-domain to be set. Define it using the `HELPSCOUT_DOCS_SUBDOMAIN` constant, or set it using the `gf_helpscout_docs_subdomain` filter. You can find it in Help Scout under "Manage" > "Docs" > "Site Settings" > "Sub-domain".
`
define( 'HELPSCOUT_DOCS_SUBDOMAIN', 'Your sub-domain here' );
`

2. Add a text field to your Gravity Forms form, then add `helpscout-docs` to the "Custom CSS Class" setting (in the field's Appearance tab).

3. Optionally, use the GF_HELPSCOUT_DOCS_COLLECTIONS constant to specify the collection IDs the plugin should search in. Example:
`
define( 'GF_HELPSCOUT_DOCS_COLLECTIONS', '538f1914e4b034fd486247ce:548f192ae4b07d03cb25288e:5488f10de4bs2c8d3cacdf29' );
`


== Changelog ==

= 3.0.3, April 26, 2018 =

* Fix: Prevent scripts from running once for each form on a page
* Fix: Prevent styles from printing multiple times
* Fix: Javascript error on Form Preview when the form doesn't have a Help Scout search field
* Improvements to results template
    - Fixed: Convert HTML entities in doc preview so quotation marks in an article no longer breaks rendering
    - Modified: Add an ellipses "…" at the end of the article preview
    - Fix: Replace multiple spaces and replace with one (HS strips HTML tags and leaves whitespace)
    - Fix: Replacing multiple instances of a template tag not working
* Added: `gf_helpscout_docs_spinner_after` action after the CSS is printed

= 3.0.2, July 7, 2016 =

* Fix: Next page shown before search results are added to the page
* Fix: Search could be bypassed by entering enter key
* Tweak: Plugin now loaded on plugins_loaded
* Tweak: Added JS browser events
* Tweak: Added a loading icon when search is processing

= 3.0.1, June 28, 2016 =

* Fixed: Search no longer worked when clicking "back" on an AJAX form with multiple pages

= 3.0, June 28, 2016 =

* No longer requires a Help Scout API key
* Now requires setting your Help Scout Docs sub-domain by using the `HELPSCOUT_DOCS_SUBDOMAIN` constant or `gf_helpscout_docs_subdomain` filter. Find your sub-domain in Help Scout under "Manage" > "Docs" > "Site Settings" > "Sub-domain".

= 2.1, June 28, 2016 =

* First offical release of the plugin after being in private use for many months!