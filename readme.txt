=== ACF Repeater Field ===
Contributors: rajaishtiaq6
Tags: acf, repeater, custom-fields, advanced-custom-fields
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.3-beta
Date: 19.01.2025
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful repeater field add-on for Advanced Custom Fields that helps you manage repeatable content like sliders, team members, and CTA blocks.

== Description ==

The Repeater field provides a clean and flexible solution for managing repeating sets of data such as sliders, team members, testimonials, or CTA tiles.

This field type acts as a parent container for a set of sub fields which can be repeated multiple times. Any ACF field type can be used inside a repeater, and there is no hard limit on the number of rows unless defined in the field settings.

**Note:** This plugin is an independent add-on for Advanced Custom Fields and is not affiliated with or endorsed by the ACF team.

= Version Compatibility =

* **ACF 6.7+** — Full support for ACF Pro 6.7 features including improved nonce verification, field_prefix support, and enhanced clone field handling
* **ACF 6.2 – 6.6** — Support for pagination and other ACF 6.x features
* **ACF 5.7 – 6.1** — Legacy support
* **ACF 5.0 – 5.6** — Legacy support

= Settings =

= Sub Fields =
Defines the set of repeatable sub fields.

= Collapsed =
Allows each row to be collapsed by selecting a single sub field to display as the row label.

= Minimum Rows =
Sets the minimum number of rows required.

= Maximum Rows =
Sets the maximum number of rows allowed.

= Layout =
Defines how sub fields are displayed.

* **Table** — Sub fields are displayed in a table with labels in the header.
* **Block** — Sub fields are displayed as stacked blocks.
* **Row** — Sub fields are displayed in a two-column layout with labels on the left.

= Button Label =
Customizes the text shown in the **Add Row** button.

= Pagination =
Introduced in ACF 6.0. Limits the number of rows loaded per page in the admin interface. This setting does not affect frontend output or REST API responses.

Note: Pagination is not supported inside flexible content fields or nested repeater fields.

= Rows per Page =
Introduced in ACF 6.0. Sets the number of rows displayed per page when pagination is enabled.

= Template Usage =

The Repeater field returns an array of rows, where each row contains the values of its sub fields.

ACF provides helper functions for working with repeater fields:
`have_rows()`, `the_row()`, `get_sub_field()`, and `the_sub_field()`.

= Basic Loop =

    <?php
    if ( have_rows('repeater_field_name') ) :
        while ( have_rows('repeater_field_name') ) : the_row();
            $sub_value = get_sub_field('sub_field');
            // Use the value as needed.
        endwhile;
    endif;
    ?>

= Display a Slider =

    <?php if ( have_rows('slides') ) : ?>
        <ul class="slides">
            <?php while ( have_rows('slides') ) : the_row(); ?>
                <?php $image = get_sub_field('image'); ?>
                <li>
                    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                    <p><?php echo acf_esc_html( get_sub_field('caption') ); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>


= Foreach Loop =

    <?php
    $rows = get_field('repeater_field_name');
    if ( $rows ) {
        echo '<ul class="slides">';
        foreach ( $rows as $row ) {
            echo '<li>';
            echo wp_get_attachment_image( $row['image'], 'full' );
            echo wp_kses_post( wpautop( $row['caption'] ) );
            echo '</li>';
        }
        echo '</ul>';
    }
    ?>

= Nested Loops =

    <?php
    if ( have_rows('parent_repeater') ) :
        while ( have_rows('parent_repeater') ) : the_row();
            $parent_title = get_sub_field('parent_title');
            if ( have_rows('child_repeater') ) :
                while ( have_rows('child_repeater') ) : the_row();
                    $child_title = get_sub_field('child_title');
                endwhile;
            endif;
        endwhile;
    endif;
    ?>

= Editing a Repeater =

Editing a repeater field is straightforward. Click the **Add Row** button to add new rows and edit the values of the visible sub fields.

= Pagination Notes =

The pagination setting introduced in ACF 6.0 helps improve performance when working with large repeater fields in the admin area.

Pagination is not supported in frontend forms, ACF blocks, flexible content fields, or nested repeaters.

---

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/acf-repeater-field` directory.
2. Activate the plugin through the Plugins screen in WordPress.
3. Make sure Advanced Custom Fields is installed and activated.
4. Create a new field group and add a Repeater field.

---

== FAQ ==

= Does this plugin require ACF Pro? =
No. This plugin works with both ACF Free and ACF Pro.

= Is this plugin affiliated with ACF? =
No. This is an independent add-on and is not affiliated with the ACF team.

= Does it support nested repeaters? =
Yes, nested repeaters are supported.


---

== Screenshots ==

1. Repeater field settings screen
2. Repeater field rows in the admin editor
3. Repeater field output on the frontend


---

== Changelog ==

= 1.0.0 (2026-01-17) =

* Initial release

= 1.0.1 (2026-01-19) =

* Added auto update feature

---

== License ==

This plugin is licensed under the GPLv2 or later.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
