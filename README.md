# ACF Repeater Field

[![WordPress Plugin Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://wordpress.org/plugins/shaqi-acf-repeater/)
[![License](https://img.shields.io/badge/license-GPLv2-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-8892BF.svg)](https://php.net/)
[![WordPress](https://img.shields.io/badge/wordpress-%3E%3D6.0-21759B.svg)](https://wordpress.org/)

The Repeater field provides a neat solution for repeating content – think slides, team members, CTA tiles and alike.

## Description

This field type acts as a parent to a set of sub fields which can be repeated again and again. What makes this field type so special is its versatility. Any kind of field can be used within a Repeater, and there are no limits to the number of repeats either (unless defined in the field settings).

**Note:** This plugin is an independent add-on for Advanced Custom Fields and is not affiliated with or endorsed by the ACF team.

## Version Compatibility

| Plugin Version | ACF Version | Notes |
|----------------|-------------|-------|
| 1.0.0 | 6.7+ | Full support for ACF Pro 6.7 features |
| 1.0.0 | 6.2 - 6.6 | Support for pagination and ACF 6.x features |
| 1.0.0 | 5.7 - 6.1 | Legacy support |
| 1.0.0 | 5.0 - 5.6 | Legacy support |

## Installation

1. Upload the plugin files to `/wp-content/plugins/shaqi-acf-repeater/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Make sure Advanced Custom Fields (free version) is installed and activated
4. Create a new field group and add a Repeater field

## Settings

- **Sub Fields** - Defines the set of repeatable sub fields
- **Collapsed** - Enables each row to be collapsed by specifying a single sub field to display
- **Minimum Rows** - Sets a limit on how many rows of data are required
- **Maximum Rows** - Sets a limit on how many rows of data are allowed
- **Layout** - Defines the layout style (Table, Block, or Row)
- **Button Label** - The text shown in the 'Add Row' button
- **Pagination** - (ACF 6.0+) Load a set number of rows per page
- **Rows per page** - (ACF 6.0+) Number of rows displayed per page

## Template Usage

### Basic Loop

```php
<?php
if( have_rows('repeater_field_name') ):
    while( have_rows('repeater_field_name') ) : the_row();
        $sub_value = get_sub_field('sub_field');
        // Do something...
    endwhile;
endif;
?>
```

### Display a Slider

```php
<?php if( have_rows('slides') ): ?>
    <ul class="slides">
    <?php while( have_rows('slides') ): the_row(); 
        $image = get_sub_field('image');
        ?>
        <li>
            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
            <p><?php echo esc_html( get_sub_field('caption') ); ?></p>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>
```

### Nested Loops

```php
<?php
if( have_rows('parent_repeater') ):
    while( have_rows('parent_repeater') ) : the_row();
        $parent_title = get_sub_field('parent_title');
        
        if( have_rows('child_repeater') ):
            while( have_rows('child_repeater') ) : the_row();
                $child_title = get_sub_field('child_title');
            endwhile;
        endif;
    endwhile;
endif;
?>
```

## Changelog

### 1.0.0 (2026-01-17)
- Initial release
- Support for ACF 5.0 through 6.7+
- Pagination support for ACF 6.0+

## License

This plugin is licensed under the GPLv2 or later.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

