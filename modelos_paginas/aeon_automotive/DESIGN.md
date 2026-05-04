```markdown
# Design System Document: Precision & Prestige

This design system is a comprehensive framework designed for a high-end Korean car importer. It moves beyond traditional automotive e-commerce layouts, embracing an editorial-tech aesthetic that mirrors the engineering precision of the vehicles themselves.

## 1. Overview & Creative North Star: "The Kinetic Gallery"
The Creative North Star for this system is **The Kinetic Gallery**. This concept treats every vehicle listing and data point not as a database entry, but as a curated exhibit. 

To break the "template" look common in automotive imports, we utilize:
*   **Intentional Asymmetry:** Off-center hero placements and staggered grid systems that mimic the movement of a car.
*   **Tonal Depth:** Replacing harsh lines with sophisticated layers of blue and grey to create a sense of infinite space.
*   **Authority through Scale:** Drastic contrast between massive, architectural headlines (`display-lg`) and precise, utilitarian metadata (`label-sm`).

## 2. Colors: The Depth of Midnight
The palette is rooted in a deep, oceanic blue (`primary`) and high-tech greys. It is designed to feel "expensive" and impenetrable.

*   **Primary (`#001a38`)**: Use for high-authority moments. It represents the reliability of the brand.
*   **Surface Hierarchy (The "No-Line" Rule)**: 
    *   **Prohibition:** Never use 1px solid borders to separate sections.
    *   **Implementation:** Sectioning must be achieved via background shifts. Place a `surface-container-low` (`#f2f4f6`) section directly against the `surface` (`#f7f9fb`) background.
*   **The "Glass & Gradient" Rule**: To avoid a flat, "SaaS-like" appearance, use semi-transparent overlays for navigation and floating cards.
    *   **Signature Texture**: For primary CTAs, apply a subtle linear gradient from `primary` (`#001a38`) to `primary_container` (`#002e5d`) at a 135-degree angle. This adds a "metallic" luster reminiscent of premium car paint.

## 3. Typography: Architectural Clarity
We utilize a dual-font strategy to balance high-tech precision with editorial elegance.

*   **Headlines (Manrope)**: A modern, geometric sans-serif used for `display` and `headline` scales. Its wide stance conveys stability and forward motion.
*   **Body & Utility (Inter)**: A highly legible, neutral sans-serif for `title`, `body`, and `label` scales. Inter provides the "efficient" feel required for complex technical specs and admin data.
*   **Scale Hierarchy**:
    *   **Display LG (3.5rem)**: Reserved for hero car names and marquee marketing statements.
    *   **Label MD/SM**: Used for car specs (Horsepower, Year, VIN) to provide a "instrument cluster" feel.

## 4. Elevation & Depth: Tonal Layering
In this design system, shadows are a last resort. Depth is a product of material stacking.

*   **The Layering Principle**:
    *   Base: `surface`
    *   Section: `surface-container-low`
    *   Cards/Elements: `surface-container-lowest` (Pure White)
    *   This stack creates a natural "lift" that feels integrated into the environment.
*   **Ambient Shadows**: When an element must float (e.g., a modal or a floating action button), use a "Ghost Shadow": `0px 20px 40px rgba(0, 26, 56, 0.06)`. The tint is derived from our `primary` blue, not black, to keep the light feeling natural.
*   **Glassmorphism**: Use `surface_container_lowest` at 70% opacity with a `20px` backdrop blur for navigation bars. This allows the vibrant car imagery to "bleed" into the UI, softening the experience.

## 5. Components: The High-Tech Toolkit

### Cards & Listings
*   **Rule**: Forbid divider lines. Use `surface_container_highest` for a subtle header area or simply rely on 24px-32px padding gaps.
*   **Listing Card**: A `surface_container_lowest` vessel on a `surface_container_low` background. Use `xl` (0.75rem) roundedness for the main container but `none` for the car image to give it a "full-bleed" professional photography look.

### Status Badges
*   **Available**: `on_primary_container` text on a `primary_fixed` background.
*   **Sold**: `on_surface_variant` text on a `surface_dim` background. 
*   **Shape**: Use the `full` (9999px) roundedness scale for badges to contrast against the architectural `md` and `lg` corners of the cards.

### The Admin Data Table
*   **Header**: Use `surface_container_high` with `label-md` typography in all-caps with 0.05em letter spacing.
*   **Rows**: Avoid striped rows. Use a 1px `outline-variant` at 10% opacity only if strictly necessary; otherwise, use a hover state shift to `surface_container_low`.

### Buttons
*   **Primary**: Gradient fill (`primary` to `primary_container`). `md` (0.375rem) roundedness. No border.
*   **Secondary**: `outline-variant` "Ghost Border" (20% opacity) with `on_surface` text.
*   **Interactive State**: On hover, the primary button should shift +2px on the Y-axis with an Ambient Shadow.

### Input Fields
*   **Style**: "Soft Inset." Use `surface_container_highest` with a bottom-only `outline` at 2px. This creates a high-tech, minimalist "terminal" look for search and filters.

## 6. Do's and Don'ts

### Do:
*   **Do** use extreme white space. A car listing needs room to "breathe" to feel premium.
*   **Do** use `tertiary` (deep warm tones) for micro-interactions or high-value alerts to break the cool blue/grey monotony.
*   **Do** align text-heavy data in the admin panel to a strict grid, but allow car imagery in the consumer site to break the grid slightly (staggered layouts).

### Don't:
*   **Don't** use pure black (#000000). Use `primary` or `inverse_surface` for dark tones to maintain the color-rich "Midnight" atmosphere.
*   **Don't** use standard "drop shadows" with 20%+ opacity. They look "cheap" and dated.
*   **Don't** use 1px solid borders for layout containment. If the user can't tell where a section ends via background color, increase the contrast between the `surface` tokens.

## 7. Spacing & Rhythm
Rhythm is dictated by the `8px` grid. 
*   **Section Spacing**: 80px, 120px, or 160px.
*   **Component Padding**: 16px, 24px, or 32px.
*   **Consistency**: Always use the `DEFAULT` (0.25rem) or `md` (0.375rem) corner radius for functional elements (buttons/inputs) and `lg` or `xl` for structural containers (cards/sections).```