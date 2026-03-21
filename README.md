# Ntara Coding Challenge 

## Project Overview
Custom WP theme built for Ntara as a coding challenge. Implements a storefront that has filtering, search, sorting, and pagination with a custom post type and taxonomy. Was started in Full Site Editor for structure and theme compatibility, but the project requirements worked better in standard WP templating. 

## Live Demo
[TasteWP Ntara Coding Challenge](https://dazzlingmap.s5-tastewp.com/)

## Setup Instructions
1. Install WordPress locally or via TasteWP/InstaWP
2. Upload the theme to /wp-content/themes/
3. Activate the theme
4. Create sample products
5. Assign menus: 
    - Primary Menu
    - Footer About
    - Footer Customer Service
6. Upload a site logo (Appearance -> Editor, or Customizer)

## Features Implemented
- Product CPT
- CPT categories taxonomy
- "Price" meta field
- Product Grid (12 per page)
- Pagination
- Search functionality (Not native WP search either)
- Category filtering
- Sorting: 
    - Price (low -> high, high -> low)
    - Title (A-Z, Z-A)
- Single product details page (single-product.php)
- Responsive layout

## Accessibility & Performance
- Semantic HTML 
- Accessible form labels and nav
- Keyboard-friendly interactions
- Optimized image usage
- Minimal JS

## Security Considerations
- Sanitization of all query parameters
- Escaping of all output
- Nonce and capability checks on meta saving
- Controlled SVG uploads