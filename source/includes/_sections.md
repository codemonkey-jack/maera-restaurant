# Front Page Sections

## How To Use
The front page is laid out with 5 different sections in which you can build your content.  Each section is a widgetized area that supports action filters for injecting content both before and after the content.
This allows developers to greatly expand the front page content.

``` twig
	{% do action( 'maera/restaurant/before_section_1' ) %}
	{% include 'section_1.twig' %}
	{% do action( 'maera/restaurant/after_section_1' ) %}
```

``` php
<?php
function my_custom_action() {
    include_once( dirname( __FILE__ ) . '/includes/my-file.php' );
}
add_action( 'maera/restaurant/before_section_1', 'my_custom_action' );
?>
```
