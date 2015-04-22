---
title: Maera Restaurant - Documentation

language_tabs:
  - shell
  - twig
  - php

toc_footers:
  - <a href='https://press.codes/downloads/maera-restaurant-shell/'>Download the Restaurant Shell</a>
  - <a href='http://press.codes' target='_blank'>Visit Press.Codes</a>

includes:
  - restaurant
  - menu-widget
  - slider-widget
  - sections
  - customization

search: true
---

# Introduction
Welcome to the Maera Restuarant documentation.  We will help you understand how the shell works, what plugins will be required,
how to build your front page, and how to use the restaurant functionality.

# Shell Logic
Maera Restaurant uses five, front-page, widgetized sections that allow you to build in your content how you see fit.  What makes
this exceptional, is that when coupled with the Maera widget class, you can specify how much area is used by your widgets.  You can then build in content as you like.   We have included a fallback to include the latest posts on the front page in case you haven't added any widgets yet.

Maera Restaurant comes with two brand new widgets; the new slider widget, built using Timber/Twig, and with its own custom post type, and also the menu widget.  This is not to be confused with navigation menus, but rather food menu (items).

<aside class="notice">Maera Restaurant also uses the standard Maera actions and filters for injecting and handling content, and how data is displayed.  You can read more about them <a href="https://github.com/presscodes/maera/wiki" target="_blank">here</a>, or inside your theme's documentation under Appearance > Theme Options, and selecting the "Documentation" tab.</aside>

<aside class="warning">This documentation is considered incomplete until the project is more mature, and is subject to change.</aside>

# Getting Started
Setting your Restaurant based website up with the Maera Restaurant shell is easy.  To mimic the demo site, we have included our default customizer options which can be found at this gist: https://gist.github.com/briancwelch/50cf36e9949134ff09c5 , as well as <a href="https://www.dropbox.com/s/q6wehtc7m1yq7py/maera_restaurant_sample_data.xml?dl=0">the exported sample data.</a>

## Importing Data and Options
To import the customizer options, select all the text from the gist and copy it.  In the WordPress admin area, go to Appearance > Theme Options and select the "Settings" tab.  In the bottom box, labeled "Import Customizer options.", paste the text from the gist into the box, and select "Save Options"

To import the sample data, in the WordPress admin area, go to Tools > Import in the admin menu and click "WordPress."  This may prompt you to install the WordPress data import plugin.  If so, install the plugin and when prompted, browse for the .xml file you downloaded above, and select "Upload file and import".  Otherwise, select the file, and import it using the same method outlined above.  When the XML file is uploaded, you will be prompted on which data you would like to import, and, if so, what user to attribute the posts to.  By default, they are set to "Administrator".  You may want to change the user to one that is on your site.  Select all the data to import, and run the importer.  After that, you're finished and ready to start editing!
