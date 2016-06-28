=== Gravity Forms - Help Scout Docs Search Field ===
Author URI: https://pippinsplugins.com
Plugin URI: https://pippinsplugins.com/gravity-forms-help-scout-docs-search-field
Contributors: mordauk, katzwebservices
Donate link: http://pippinsplugins.com/support-the-site
Tags: gravity forms, help scout, helpscout, documentation
Requires at least: 3.6
Tested up to: 4.6
Stable Tag: 2.1.1
License: GNU Version 2 or Any Later Version

Add a Help Scout Docs search field to your Gravity Forms form.

== Description ==

Add a Help Scout Docs search field to your Gravity Forms form. Used on the [Easy Digital Downloads ticket submission page](https://easydigitaldownloads.com/support/).

This plugin requires [Gravity Forms](https://gravityforms.com) and a [Help Scout](https://helpscout.net) account.

See the Installation tab for instructions on configuring the plugin.

![Demo](https://pippinspluginscom.c.presscdn.com/wp-content/uploads/2016/06/Jun-28-2016-13-44-03.gif)

Find a bug? Have a suggestion? Let us know on [GitHub](https://github.com/easydigitaldownloads/gravity-forms-help-scout-search)!

== Installation ==

1. The Help Scout Docs Search Field plugin requires an API key. Define it using the HELPSCOUT_DOCS_API_KEY constant, or set it using the gf_helpscout_docs_api_key filter.
`
define( 'HELPSCOUT_DOCS_API_KEY', 'Your key here' );
`

2. Add a text field to your Gravity Forms form, then add `helpscout-docs` to the "Custom CSS Class" setting (in the field's Appearance tab).

3. Optionally, use the GF_HELPSCOUT_DOCS_COLLECTIONS constant to specify the collection IDs the plugin should search in. Example:
`
define( 'GF_HELPSCOUT_DOCS_COLLECTIONS', '538f1914e4b034fd486247ce:548f192ae4b07d03cb25288e:5488f10de4bs2c8d3cacdf29' );
`


== Changelog ==

= 2.1, June 28, 2016 =

* First offical release of the plugin after being in private use for many months!