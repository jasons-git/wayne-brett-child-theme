#Wayne Brett Metro Genesis Child Theme

This is a basic starter **Genesis Child Theme** to be used with the **Genesis Framework** on **WordPress**.

This Genesis child theme is declaring support for HTML5, it is responsive and has a number of widgets.

**Widgetised Areas**
- The theme contains the following widgets
* Pre-Header Left
* Pre-Header Right
* Hero - Home Page only *front-page.php*
* Main Content 1 Top Left 33% - Main Content Page only *front-page.php*
* Main Content 2 Top Middle 33% - Main Content Page only *front-page.php*
* Main Content 3 Top Right 33% - Main Content Page only *front-page.php*
* Main Content 4 Bottom Left 33% - Main Content Page only *front-page.php*
* Main Content 5 Bottom Left 33% - Main Content Page only *front-page.php*
* Main Content 6 Bottom Left 33% - Main Content Page only *front-page.php*
* Main Content 1-2 Top Left 66% - Main Content Page only *front-page.php*
* Main Content 2-3 Top Right 66% - Main Content Page only *front-page.php*
* Main Content 4-5 Bottom Left 66% - Main Content Page only *front-page.php*
* Main Content 5-6 Bottom Right 66% - Main Content Page only *front-page.php*
* Before Content *posts only*
* After Content *posts only*
* Footer Widget Header
* Footer Widgets 1, 2, 3
* Footer

**Home Page**
The Home Page has been widgetised and the default Genesis loop has been removed, so any content entered in the visual editor for the home page will not be displayed.

To reverse this behaviour tweak the **front-page.php** file by commenting line 28:
```php
//cgp_genesis_no_content();
```

and uncommenting line 90:
```php
genesis();
```

**Example**
For an online visual:
http://dev2.practicalit.info/

**Menus**
- Primary Menu is positioned in Header Right Widget Hook and set to Primary Location
- Secondary Menu remains in default area and is Secondary Location
- SlickNav responsive menu targeted for the Primary Navigation set to toggle at 600px wide - Commented in **functions.php** and **style.css** for adjustments

**Background Image**
- Background Images is supported, a background image can be uploaded in the WP Dashboard via Appearance > Background, this will scale to fit any viewport via BackstrechJS.

**Javascripts**
- FontAwesome is enabled.
- placeholder.js is enabled.
- backstretch.min.js is enabled (via CDN) if a custom background is used.

**CSS**
- Regular style.css with all Genesis Framework and placeholders to start new project
- 2 x IE styles in CSS directory, one targets IE8 and lower, the other IE9 and lower

**WooCommerce**
- WooCommerce style sheet set to load before main style sheet
- Some generic CSS styles declared in styles.css
- WooCommerce theme support declared as an action in functions.php but commented out

**Miscellaneous**
- PHP is enabled to execute in widget areas
- Shortcode enabled in widget areas
- 'Read More' link is enabled on post excerpts
- Comments header changed to 'Leave a Comment'
- HTML Tags and Attributes is removed from comments
- Facebook HTML5 function and action are declared in functions.php but commented out
- The font 'Open Sans' is enqueued from Google Fonts in functions.php
- Author name removed in Post Meta for posts

Download the zip rename the theme '**genesischild**' - place this theme in your WordPress installation **"/wp-content/themes/"** and activate in WordPress Dashboard

![Wayne Brett Metro Genesis Child Theme Widgetized Home Page](http://waynebrett.com/wp-content/uploads/2014/08/widgets-metro-wayne-brett-child-theme-e1409177512869.png)

![Wayne Brett Metro Genesis Child Theme Widget Area (All the Widgets with "Alt" in the name are for the widgetized home page)](http://waynebrett.com/wp-content/uploads/2014/08/widgets-metro-wayne-brett-child-theme1.png)

![Wayne Brett Metro Genesis Child Theme Widget Areas (with a detailed description)](http://waynebrett.com/wp-content/uploads/2014/08/widgets-open-metro-wayne-brett-child-theme.png)
