# Copilot Agent Instructions

## CSS Classes

**Only use CSS classes that exist in this project's compiled styleguide** (`public/styleguide/css/style.css`). The framework is **CurlyFramework**, which bundles Tachyons utility classes plus custom partials.

**Never use Tailwind CSS classes** — even though `tailwind.config.js` exists at the root, Tailwind is not wired to the layout and its classes are not available at runtime.

### Available utility classes (Tachyons)

**Naming pattern:** `{property}{value}` — e.g. `pa3` = padding all 1rem, `mt2` = margin-top 0.5rem.

**Responsive suffixes:** none = all sizes, `-ns` = ≥30em, `-m` = 30–60em, `-l` = ≥60em.

**Spacing scale:** 0=0, 1=0.25rem, 2=0.5rem, 3=1rem, 4=2rem, 5=4rem, 6=8rem, 7=16rem.
- Padding: `pa/pl/pr/pt/pb/pv/ph` + number
- Margin: `ma/ml/mr/mt/mb/mv/mh` + number

**Typography:** `f1`=0.75rem … `f7`=2rem. Weight: `fw1`–`fw9`, `b`, `normal`.

**Colors:** text = class name (`blue`, `dark-gray`), bg = `bg-` prefix, border = `b--` prefix.
Grayscale: `black`, `near-black`, `dark-gray`, `mid-gray`, `gray`, `silver`, `light-silver`, `moon-gray`, `light-gray`, `near-white`, `white`.

**Display:** `dn`, `db`, `dib`, `flex`, `inline-flex`, `dg` (grid).

**Flexbox:** `flex-column`, `flex-row`, `items-center`, `justify-between`, `justify-center`, `flex-auto`, `flex-none`.

**Grid:** `cols-{n}` for column count, `cols-{n}-m` for responsive, `g{n}` for gap.

**Borders:** `ba/bt/br/bb/bl/bn` (sides), `bw0`–`bw5` (width), `b--solid/dashed/none`.
Border radius: `br0`–`br4`, `br-100`, `br-pill`. Directional: `br--top`, `br--bottom`.

**Position:** `static`, `relative`, `absolute`, `fixed`, `sticky` + `top-0`, `right-0`, `bottom-0`, `left-0`.

**Visibility/opacity:** `o-0`–`o-100`, `v-hidden`, `v-visible`, `clip`.

**Z-index:** `z-0`–`z-5`, `z-999`, `z-9999`, `z-max`.

**Hovers:** prefix color/bg class with `hover-` (e.g. `hover-bg-blue`).

### Custom partials

Custom component classes are defined in `resources/css/` partials and follow BEM naming (`.component__element--modifier`). Key files:
- `_head.scss`, `_btn.scss`, `_form.scss`, `_typo.scss`, `_icons.scss`, `_contentblocks.scss`, `_animation.scss`, `_a11y.scss`, `_home.scss`, `_mixins.scss`, `_reset.scss`

### Design tokens

Defined in `resources/css/_vars.scss`, scoped to `.curlyframework`. Use CSS custom properties for brand values:
- Brand color: `--violet-5: #351788`
- Spacing: `--spacing-1` through `--spacing-8`
- Type scale: `--typo-1` through `--typo-5`
- Breakpoints: `--breakpoint-small` (30em), `--breakpoint-medium` (48em), `--breakpoint-large` (60em)

## Templates

This is a Statamic v6 / Laravel 13 project. Templates use **Antlers** syntax (`.antlers.html` files in `resources/views/`). Use `{{ tag }}` and `{{ collection:entries }}...{{ /collection:entries }}` pairs, not Blade.

## JavaScript

All interactivity uses **Alpine.js v3**. Do not introduce other JS frameworks or libraries. Available plugins: `x-collapse`, `x-trap`, `x-intersect`, `$persist`.

## Accessibility

All interactive components require proper ARIA attributes and keyboard navigation (WCAG 2.2).
