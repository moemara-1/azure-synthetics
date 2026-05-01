#!/usr/bin/env python3
"""Generate branded catalog product art and photographic lab scene assets."""

from __future__ import annotations

import re
from pathlib import Path

from PIL import Image, ImageChops, ImageDraw, ImageEnhance, ImageFilter, ImageFont, ImageOps


ROOT = Path(__file__).resolve().parents[1]
THEME_IMAGES = ROOT / "wp-content" / "themes" / "azure-synthetics" / "assets" / "images"
CATALOG_DATA = ROOT / "wp-content" / "themes" / "azure-synthetics" / "inc" / "catalog-data.php"
PRODUCT_DIR = THEME_IMAGES / "products"
LOGO_PATH = THEME_IMAGES / "azure-logo-transparent.png"
SOURCE_IMAGE_DIR = ROOT / "images"
HERO_VIAL_BASE = SOURCE_IMAGE_DIR / "hero_vial.png"


def font(size: int, bold: bool = False) -> ImageFont.FreeTypeFont | ImageFont.ImageFont:
    candidates = [
        "/System/Library/Fonts/Supplemental/Arial Bold.ttf" if bold else "/System/Library/Fonts/Supplemental/Arial.ttf",
        "/System/Library/Fonts/Supplemental/Helvetica Bold.ttf" if bold else "/System/Library/Fonts/Supplemental/Helvetica.ttf",
        "/Library/Fonts/Arial Bold.ttf" if bold else "/Library/Fonts/Arial.ttf",
    ]
    for candidate in candidates:
        try:
            return ImageFont.truetype(candidate, size=size)
        except OSError:
            continue
    return ImageFont.load_default()


def slugify(value: str) -> str:
    value = value.lower()
    value = re.sub(r"[^a-z0-9]+", "-", value)
    return value.strip("-") or "catalog-product"


def stable_index(value: str, count: int) -> int:
    """Return a repeatable index without relying on Python's randomized hash()."""
    return sum((index + 1) * ord(char) for index, char in enumerate(value)) % count


def catalog_products() -> list[dict[str, object]]:
    text = CATALOG_DATA.read_text()
    starts = [m.start() for m in re.finditer(r"array\( 'name' => '", text)]
    products: list[dict[str, object]] = []

    for index, start in enumerate(starts):
        end = starts[index + 1] if index + 1 < len(starts) else text.find("\n\t);", start)
        block = text[start:end]
        name_match = re.search(r"'name' => '([^']+)'", block)
        category_match = re.search(r"'category' => '([^']+)'", block)
        amounts = re.findall(r"'amount' => '([^']+)'", block)

        if name_match:
            products.append(
                {
                    "name": name_match.group(1),
                    "category": category_match.group(1) if category_match else "peptide-support",
                    "amounts": amounts,
                }
            )

    return products


def rounded_rectangle(draw: ImageDraw.ImageDraw, xy: tuple[int, int, int, int], radius: int, fill, outline=None, width: int = 1):
    draw.rounded_rectangle(xy, radius=radius, fill=fill, outline=outline, width=width)


def cover_crop(path: Path, size: tuple[int, int], focal: tuple[float, float] = (0.5, 0.5)) -> Image.Image:
    """Crop a source photograph to fill the target size without distortion."""
    img = Image.open(path).convert("RGB")
    target_w, target_h = size
    source_w, source_h = img.size
    scale = max(target_w / source_w, target_h / source_h)
    resized = img.resize((round(source_w * scale), round(source_h * scale)), Image.Resampling.LANCZOS)

    max_left = max(0, resized.width - target_w)
    max_top = max(0, resized.height - target_h)
    left = round(max_left * focal[0])
    top = round(max_top * focal[1])

    return resized.crop((left, top, left + target_w, top + target_h))


def azure_grade(img: Image.Image, vignette_strength: float = 0.46) -> Image.Image:
    """Apply the site's teal/gold grade while keeping photographic detail."""
    img = ImageOps.autocontrast(img.convert("RGB"), cutoff=1)
    img = ImageEnhance.Contrast(img).enhance(1.08)
    img = ImageEnhance.Color(img).enhance(0.86)
    graded = img.convert("RGBA")
    w, h = graded.size

    tint = Image.new("RGBA", graded.size, (8, 42, 54, 38))
    graded = Image.alpha_composite(graded, tint)

    mask = Image.new("L", graded.size, 0)
    mask_pixels = mask.load()
    max_alpha = int(150 * vignette_strength)
    for y in range(h):
        ny = (y - h / 2) / (h / 2)
        for x in range(w):
            nx = (x - w / 2) / (w / 2)
            distance = (nx * nx + ny * ny) ** 0.5
            alpha = max(0, min(1, (distance - 0.42) / 0.64))
            mask_pixels[x, y] = int(alpha * alpha * max_alpha)

    shadow = Image.new("RGBA", graded.size, (0, 8, 13, 0))
    shadow.putalpha(mask)
    graded = Image.alpha_composite(graded, shadow)

    return graded.convert("RGB")


def wide_vial_scene(path: Path, size: tuple[int, int]) -> Image.Image:
    """Place the full square vial render into a wide photographic hero frame."""
    background = cover_crop(path, size, (0.5, 0.5)).filter(ImageFilter.GaussianBlur(18)).convert("RGBA")
    background = ImageEnhance.Brightness(background).enhance(0.72)

    vial = Image.open(path).convert("RGBA").resize((size[1], size[1]), Image.Resampling.LANCZOS)
    mask = Image.new("L", vial.size, 255)
    mask_pixels = mask.load()
    feather = 96
    for y in range(vial.height):
        for x in range(vial.width):
            edge = min(x, vial.width - 1 - x, y, vial.height - 1 - y)
            if edge < feather:
                mask_pixels[x, y] = int(255 * (edge / feather) ** 0.7)

    x = round(size[0] * 0.55 - vial.width / 2)
    background.paste(vial, (x, 0), mask)

    return background.convert("RGB")


def fit_text(draw: ImageDraw.ImageDraw, text: str, max_width: int, start_size: int, min_size: int = 34) -> ImageFont.ImageFont:
    size = start_size
    while size >= min_size:
        fnt = font(size, True)
        if draw.textbbox((0, 0), text, font=fnt)[2] <= max_width:
            return fnt
        size -= 2
    return font(min_size, True)


def paste_logo(label: Image.Image, logo: Image.Image, xy: tuple[int, int], width: int) -> None:
	logo = logo.copy()
	logo.thumbnail((width, width), Image.Resampling.LANCZOS)
	label.alpha_composite(logo, xy)


def draw_centered_text(draw: ImageDraw.ImageDraw, box: tuple[int, int, int, int], text: str, max_size: int, min_size: int, fill) -> None:
	x1, y1, x2, y2 = box
	max_width = x2 - x1 - 18
	max_height = y2 - y1

	for size in range(max_size, min_size - 1, -2):
		fnt = font(size, True)
		words = text.split()
		lines: list[str] = []
		current = ""

		for word in words:
			proposed = f"{current} {word}".strip()
			if draw.textbbox((0, 0), proposed, font=fnt)[2] <= max_width:
				current = proposed
			else:
				if current:
					lines.append(current)
				current = word
		if current:
			lines.append(current)

		line_height = size + 4
		total_height = line_height * len(lines)
		if total_height <= max_height and all(draw.textbbox((0, 0), line, font=fnt)[2] <= max_width for line in lines):
			y = y1 + (max_height - total_height) / 2
			for line in lines:
				bounds = draw.textbbox((0, 0), line, font=fnt)
				draw.text((x1 + (x2 - x1 - (bounds[2] - bounds[0])) / 2, y), line, font=fnt, fill=fill)
				y += line_height
			return

	fnt = font(min_size, True)
	bounds = draw.textbbox((0, 0), text, font=fnt)
	draw.text((x1 + (x2 - x1 - (bounds[2] - bounds[0])) / 2, y1), text, font=fnt, fill=fill)


def product_label_name(name: str) -> str:
    overrides = {
        "BPC-157 + TB-500 Blend": "BPC-157 + TB-500",
        "CJC-1295 (No DAC)": "CJC-1295",
        "CJC-1295 with DAC": "CJC-1295 DAC",
        "SS-31 (Elamipretide)": "SS-31",
        "VIP (Vasoactive Intestinal Peptide)": "VIP",
        "Bacteriostatic Water": "BAC WATER",
        "Thymosin Alpha-1": "THYMOSIN A1",
        "Melanotan 1": "MELANOTAN I",
        "Melanotan 2": "MELANOTAN II",
    }
    return overrides.get(name, name).upper()


def amount_summary(product: dict[str, object]) -> str:
    amounts = [str(amount) for amount in product.get("amounts", [])]
    if not amounts:
        return "Research Peptide"
    if len(amounts) == 1:
        return f"Research Peptide | {amounts[0]}"
    return " / ".join(amounts[:3])


def base_image_for_product(product: dict[str, object]) -> tuple[Path, dict[str, object]]:
    return HERO_VIAL_BASE, {
        "label_box": (375, 438, 646, 808),
        "logo_y": 0.205,
        "title_y": 0.615,
    }


def feathered_label_mask(size: tuple[int, int], radius: int = 10) -> Image.Image:
    width, height = size
    mask = Image.new("L", size, 0)
    mask_draw = ImageDraw.Draw(mask)
    mask_draw.rounded_rectangle((0, 0, width, height), radius=radius, fill=255)

    # The reference vial has a very slight cylindrical wrap. The soft edge mask lets
    # the original glass/label boundary remain visible instead of reading as a flat sticker.
    pixels = mask.load()
    edge_fade = max(16, int(width * 0.08))
    for y in range(height):
        vertical = min(1.0, y / max(1, edge_fade), (height - 1 - y) / max(1, edge_fade))
        for x in range(width):
            horizontal = min(1.0, x / max(1, edge_fade), (width - 1 - x) / max(1, edge_fade))
            wrap = min(horizontal, vertical) ** 0.55
            pixels[x, y] = int(pixels[x, y] * (0.72 + 0.28 * wrap))

    return mask.filter(ImageFilter.GaussianBlur(0.45))


def draw_centered(draw: ImageDraw.ImageDraw, y: int, text: str, fnt: ImageFont.ImageFont, fill, width: int) -> None:
    bounds = draw.textbbox((0, 0), text, font=fnt)
    draw.text(((width - (bounds[2] - bounds[0])) / 2, y), text, font=fnt, fill=fill)


def paper_texture(size: tuple[int, int]) -> Image.Image:
    width, height = size
    paper = Image.new("RGBA", size, (242, 243, 238, 255))
    pixels = paper.load()

    for y in range(height):
        vertical = 1 - abs((y / max(1, height - 1)) - 0.5) * 0.06
        for x in range(width):
            edge = abs((x / max(1, width - 1)) - 0.5) * 2
            cylinder = 1.035 - (edge ** 2.2) * 0.13
            grain = (((x * 17 + y * 31) % 23) - 11) * 0.72
            r = max(0, min(255, int((242 + grain) * cylinder * vertical)))
            g = max(0, min(255, int((243 + grain) * cylinder * vertical)))
            b = max(0, min(255, int((238 + grain) * cylinder * vertical)))
            pixels[x, y] = (r, g, b, 255)

    return paper


def build_printed_label(product: dict[str, object], logo: Image.Image, size: tuple[int, int], logo_y: float, title_y: float) -> Image.Image:
    label_w, label_h = size
    scale = 3
    canvas_w = label_w * scale
    canvas_h = label_h * scale
    label = paper_texture((canvas_w, canvas_h))
    draw = ImageDraw.Draw(label, "RGBA")

    logo_mark = logo.copy()
    logo_mark.thumbnail((int(canvas_w * 0.32), int(canvas_h * 0.32)), Image.Resampling.LANCZOS)
    logo_x = (canvas_w - logo_mark.width) // 2
    label.alpha_composite(logo_mark, (logo_x, int(canvas_h * logo_y) - logo_mark.height // 2))

    azure_font = font(max(28, int(canvas_w * 0.155)), True)
    synth_font = font(max(12, int(canvas_w * 0.057)), True)
    draw_centered(draw, int(canvas_h * (logo_y + 0.145)), "AZURE", azure_font, (24, 72, 91, 246), canvas_w)
    draw_centered(draw, int(canvas_h * (logo_y + 0.265)), "SYNTHETICS", synth_font, (24, 72, 91, 236), canvas_w)

    product_name = product_label_name(str(product["name"]))
    title_box = (
        int(canvas_w * 0.075),
        int(canvas_h * title_y),
        int(canvas_w * 0.925),
        int(canvas_h * (title_y + 0.165)),
    )
    draw_centered_text(draw, title_box, product_name, max(38, int(canvas_w * 0.102)), max(15, int(canvas_w * 0.039)), (18, 47, 66, 248))

    detail = amount_summary(product)
    if "Bacteriostatic Water" == str(product["name"]):
        detail = "Lab Diluent | 10ml"
    detail_box = (
        int(canvas_w * 0.095),
        int(canvas_h * (title_y + 0.178)),
        int(canvas_w * 0.905),
        int(canvas_h * (title_y + 0.248)),
    )
    draw_centered_text(draw, detail_box, detail, max(15, int(canvas_w * 0.039)), max(9, int(canvas_w * 0.024)), (32, 50, 57, 226))

    notice_box = (
        int(canvas_w * 0.13),
        int(canvas_h * 0.905),
        int(canvas_w * 0.87),
        int(canvas_h * 0.962),
    )
    draw_centered_text(draw, notice_box, "FOR RESEARCH USE ONLY", max(12, int(canvas_w * 0.029)), max(8, int(canvas_w * 0.019)), (130, 100, 42, 168))

    label = label.resize(size, Image.Resampling.LANCZOS)
    alpha = feathered_label_mask(size)
    label.putalpha(alpha)
    return label


def apply_vial_lighting(label: Image.Image, source_crop: Image.Image) -> Image.Image:
    """Use the original label's broad light falloff so new print sits inside the vial scene."""
    lum = ImageOps.grayscale(source_crop.convert("RGB")).filter(ImageFilter.GaussianBlur(20))
    lum = ImageEnhance.Contrast(lum).enhance(0.72)
    light = lum.point(lambda p: max(180, min(255, int(211 + (p - 176) * 0.44))))
    rgb = ImageChops.multiply(label.convert("RGB"), Image.merge("RGB", (light, light, light)))
    integrated = rgb.convert("RGBA")
    integrated.putalpha(label.getchannel("A"))

    width, height = label.size
    wrap = Image.new("RGBA", label.size, (0, 0, 0, 0))
    pixels = wrap.load()
    for y in range(height):
        for x in range(width):
            edge = abs((x / max(1, width - 1)) - 0.5) * 2
            side_alpha = int((edge ** 2.35) * 58)
            pixels[x, y] = (4, 20, 27, side_alpha)

    highlight = Image.new("RGBA", label.size, (0, 0, 0, 0))
    draw = ImageDraw.Draw(highlight, "RGBA")
    draw.rounded_rectangle(
        (int(width * 0.19), int(height * 0.04), int(width * 0.31), int(height * 0.96)),
        radius=max(8, int(width * 0.035)),
        fill=(255, 255, 255, 24),
    )
    draw.rounded_rectangle(
        (int(width * 0.76), int(height * 0.04), int(width * 0.84), int(height * 0.96)),
        radius=max(8, int(width * 0.035)),
        fill=(255, 255, 255, 12),
    )
    highlight = highlight.filter(ImageFilter.GaussianBlur(max(2, int(width * 0.02))))

    source_highlights = ImageOps.grayscale(source_crop.convert("RGB")).filter(ImageFilter.GaussianBlur(2))
    source_highlights = source_highlights.point(lambda p: max(0, min(48, int((p - 202) * 0.6))))
    glints = Image.new("RGBA", label.size, (255, 255, 255, 0))
    glints.putalpha(source_highlights)

    integrated = Image.alpha_composite(integrated, wrap)
    integrated = Image.alpha_composite(integrated, highlight)
    return Image.alpha_composite(integrated, glints)


def product_image(product: dict[str, object], logo: Image.Image) -> Image.Image:
    name = str(product["name"])
    base_path, spec = base_image_for_product(product)
    img = Image.open(base_path).convert("RGBA").resize((1024, 1024), Image.Resampling.LANCZOS)
    label_box = spec["label_box"]
    label_size = (label_box[2] - label_box[0], label_box[3] - label_box[1])
    printed = build_printed_label(product, logo, label_size, float(spec["logo_y"]), float(spec["title_y"]))
    printed = apply_vial_lighting(printed, img.crop(label_box))
    img.paste(printed, label_box[:2], printed)

    return img.convert("RGB")


def generate_site_images() -> None:
    specs = {
        "science-assay.png": (SOURCE_IMAGE_DIR / "stock" / "lab-pipette-unsplash-adam-bezer.jpg", (0.50, 0.50), 0.30),
        "story-lab.png": (SOURCE_IMAGE_DIR / "stock" / "cleanroom-hood-pexels-pavel.jpg", (0.50, 0.45), 0.22),
        "collections-side.png": (SOURCE_IMAGE_DIR / "stock" / "cleanroom-cart-pexels-tima.jpg", (0.50, 0.45), 0.18),
        "promo-vials.png": (SOURCE_IMAGE_DIR / "stock" / "lab-vials-pexels-cottonbro.jpg", (0.55, 0.50), 0.26),
    }

    azure_grade(wide_vial_scene(SOURCE_IMAGE_DIR / "hero_vial.png", (1408, 768)), 0.28).save(THEME_IMAGES / "hero-vial.png", quality=94)

    fallback = SOURCE_IMAGE_DIR / "generated-1776561351087.png"
    for filename, (source, focal, vignette) in specs.items():
        source_path = source if source.exists() else fallback
        img = cover_crop(source_path, (1408, 768), focal)
        azure_grade(img, vignette).save(THEME_IMAGES / filename, quality=94)


def main() -> None:
    PRODUCT_DIR.mkdir(parents=True, exist_ok=True)
    logo = Image.open(LOGO_PATH).convert("RGBA")

    for product in catalog_products():
        out = PRODUCT_DIR / f"{slugify(str(product['name']))}.png"
        product_image(product, logo).save(out, quality=94)

    generate_site_images()

    aliases = {
        "card-bpc157.png": "bpc-157.png",
        "card-motsc.png": "mots-c.png",
        "card-cjcipa.png": "cjc-1295-no-dac.png",
        "card-glp3.png": "tirzepatide.png",
    }
    for dest, source in aliases.items():
        src = PRODUCT_DIR / source
        if src.exists():
            Image.open(src).save(THEME_IMAGES / dest, quality=94)

    print(f"Generated {len(catalog_products())} product images in {PRODUCT_DIR}")


if __name__ == "__main__":
    main()
