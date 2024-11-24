=== AppSheet Functions ===
Contributors: Bachacode
Donate link: https://bachacode.com
Tags: appsheet
Requires at least: 3.0.1
Tested up to: 6.6.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Custom made plugin for TailorSheet website used to manage AppSheet related content through CPTs and Custom Taxonomies

== Description ==

Custom made plugin for TailorSheet website used to manage AppSheet related content through CPTs and Custom Taxonomies

### AppSheet Functions Post Type
CPT for AppSheet Functions management in a single place.

### Elementor Widgets
Custom Elementor Widgets handmade to display AppSheet Functions and their examples with ease.

== Changelog ==

= 2.4.2 =
* Fixed bad code that called undefined variable in post type file
* Added app_gallery meta field to "ejemplos-appsheet"
* Changed metabox "descriptive tabs" title to "app tabs"
* Fixed exopite bug where gallery type field checked an always undefined variable
* Made "add_button" translatable in metabox fields
* Fixed issue where "create_menu" callback would always run even in public side

= 2.4.1 =
* Removed "categoria-de-ejemplo" taxonomy
* Removed "etiqueta-de-ejemplo" taxonomy

= 2.4.0 =
* Ejemplos Appsheet archive is now changeable
* Expresiones Appsheet archive is now changeable

= 2.3.5 =
* Changed esc_url_raw for htmlspecialchars function for field fe_expected

= 2.3.4 =
* Changed sanitize text field for esc_url_raw function for field fe_expected

= 2.3.3 =
* Changed absint function to fe_expected to sanitize string

= 2.3.2 =
* Changed taxonomy "Sector de App" Show in REST value to true
* Changed taxonomy "Funcionalidad de App" Show in REST value to true
* Changed taxonomy "Integración de App" Show in REST value to true

= 2.3.1 =
* Removed "Whatsapp Message" metadata field from "AppSheet Examples" CPT

= 2.3.0 =
* Added new taxonomy "Sector de App"
* Added new taxonomy "Funcionalidad de App"
* Added new taxonomy "Integración de App"
* Updated translations to replace "Ejemplo/s" with "App/s"

= 2.2.1 =
* Changed metadata "automatizations" to "functionality"

= 2.2.0 =
* Added excerpt and app information field to "Ejemplos AppSheet"

= 2.1.0 =
* Added metadata to "Ejemplos AppSheet"


= 2.0.1 =
* Cleaning up unused files

= 2.0.0 =
* Added CPT "Ejemplos AppSheet"
* Added Custom taxonomies "Categoría de Ejemplo" and "Etiqueta de Ejemplo" to CPT "Ejemplos AppSheet"
* Added Plugin Menu Option and Settings Page for plugin
* Added all CPT and custom taxonomies to Plugin Menu Option as submenus
* Fixed Highlight bug with custom taxonomies under the Plugin Menu

= 1.2.7 =
* Changed plugin name from "Appsheet Functions" to "TailorSheet Manager"

= 1.2.6 =
* Disabled public visibility of "ejemplos de appsheet"

= 1.2.5 =
* Fixed category filter labels only selecting the first category

= 1.2.4 =
* Increased width of AppSheet Functions Main Cards to fix better the titles again

= 1.2.3 =
* Increased width of AppSheet Functions Main Cards to fix better the titles

= 1.2.2 =
* Removed appsheet functions thumbnail
* Added CSS to improve responsiveness of AppSheet Function Main Widget

= 1.2.1 =
* Normalized default styles in AppSheet Functions Main CSS

= 1.2.0 =
* Removed alpinejs from dependencies
* Created AppSheet Functions Main
* Added filter functionality to AppSheet Functions Main widget
* Added query by name functionality to AppSheet Functions Main widget
* Added default image to AppSheet Functions Main widget

= 1.1.2 =
* Spanish localization

= 1.1.1 =
* Fixed changelog format

= 1.1.0 =
* Added auto updater
* First release with auto updater

= 1.0.0 =
* Initial version.
* First release of the AppSheet Functions Plugin
