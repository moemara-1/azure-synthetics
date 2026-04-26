from __future__ import annotations

from dataclasses import dataclass
from pathlib import Path

from PIL import Image, ImageDraw, ImageFont


ROOT = Path(__file__).resolve().parents[1]
THEME_IMAGES = ROOT / "wp-content" / "themes" / "azure-synthetics" / "assets" / "images"
PRODUCT_IMAGES = THEME_IMAGES / "products"
SOURCE_IMAGES = ROOT / "images"
MASTER_PATH = THEME_IMAGES / "product-vial-master.png"
LOGO_PATH = THEME_IMAGES / "azure-logo-transparent.png"

INK = (9, 36, 52)
LABEL_CENTER_X = 512


@dataclass(frozen=True)
class ProductSpec:
    slug: str
    title: str
    label_title: str | None = None
    label_subtitle: str = "Research Peptide | 10mg"


PRODUCTS = (
    ProductSpec("adipotide", "Adipotide"),
    ProductSpec("aicar", "AICAR"),
    ProductSpec("aod-9604", "AOD-9604"),
    ProductSpec("bpc-157", "BPC-157"),
    ProductSpec("bpc-157-tb-500-blend", "BPC-157 + TB-500 Blend", "BPC-157\n+ TB-500"),
    ProductSpec("bacteriostatic-water", "Bacteriostatic Water", "BACTERIOSTATIC\nWATER", "Laboratory Diluent | 10ml"),
    ProductSpec("cjc-1295-no-dac", "CJC-1295 (No DAC)", "CJC-1295\nNO DAC"),
    ProductSpec("cjc-1295-ipamorelin", "CJC-1295 / Ipamorelin", "CJC-1295\n/ IPA"),
    ProductSpec("cjc-1295-with-dac", "CJC-1295 with DAC", "CJC-1295\nWITH DAC"),
    ProductSpec("dsip", "DSIP"),
    ProductSpec("epitalon", "Epitalon"),
    ProductSpec("foxo4-dri", "FOXO4-DRI"),
    ProductSpec("ghk-cu", "GHK-Cu"),
    ProductSpec("ghrp-2", "GHRP-2"),
    ProductSpec("ghrp-6", "GHRP-6"),
    ProductSpec("glutathione", "Glutathione"),
    ProductSpec("gonadorelin", "Gonadorelin"),
    ProductSpec("hexarelin", "Hexarelin"),
    ProductSpec("hgh", "HGH"),
    ProductSpec("igf-1-lr3", "IGF-1 LR3"),
    ProductSpec("ipamorelin", "Ipamorelin"),
    ProductSpec("kisspeptin-10", "Kisspeptin-10"),
    ProductSpec("klow-blend", "KLOW Blend", "KLOW BLEND"),
    ProductSpec("kpv", "KPV"),
    ProductSpec("ll-37", "LL-37"),
    ProductSpec("mazdutide", "Mazdutide"),
    ProductSpec("melanotan-1", "Melanotan 1", "MELANOTAN 1"),
    ProductSpec("melanotan-2", "Melanotan 2", "MELANOTAN 2"),
    ProductSpec("mots-c", "MOTS-c", "MOTS-C"),
    ProductSpec("mots-c-2", "MOTS-C", "MOTS-C"),
    ProductSpec("nad", "NAD+", "NAD+"),
    ProductSpec("peg-mgf", "PEG-MGF"),
    ProductSpec("pt-141", "PT-141"),
    ProductSpec("retatrutide", "Retatrutide"),
    ProductSpec("selank", "Selank"),
    ProductSpec("semax", "Semax"),
    ProductSpec("sermorelin", "Sermorelin"),
    ProductSpec("slu-pp-332", "SLU-PP-332"),
    ProductSpec("snap-8", "SNAP-8"),
    ProductSpec("ss-31-elamipretide", "SS-31 (Elamipretide)", "SS-31"),
    ProductSpec("tb-500", "TB-500"),
    ProductSpec("tesamorelin", "Tesamorelin"),
    ProductSpec("thymosin-alpha-1", "Thymosin Alpha-1", "THYMOSIN\nALPHA-1"),
    ProductSpec("tirzepatide", "Tirzepatide"),
    ProductSpec("vip-vasoactive-intestinal-peptide", "VIP (Vasoactive Intestinal Peptide)", "VIP"),
)


def font(name: str, size: int) -> ImageFont.FreeTypeFont:
    path = Path("C:/Windows/Fonts") / name
    if path.exists():
        return ImageFont.truetype(str(path), size=size)

    fallback = Path("/usr/share/fonts/truetype/dejavu") / "DejaVuSans-Bold.ttf"
    if fallback.exists():
        return ImageFont.truetype(str(fallback), size=size)

    return ImageFont.load_default()


def text_bbox(text: str, fnt: ImageFont.FreeTypeFont) -> tuple[int, int]:
    bbox = ImageDraw.Draw(Image.new("RGBA", (1, 1))).textbbox((0, 0), text, font=fnt)
    return bbox[2] - bbox[0], bbox[3] - bbox[1]


def tracked_width(text: str, fnt: ImageFont.FreeTypeFont, tracking: int) -> int:
    if not text:
        return 0

    return sum(text_bbox(char, fnt)[0] for char in text) + tracking * (len(text) - 1)


def draw_tracked_center(draw: ImageDraw.ImageDraw, y: int, text: str, fnt: ImageFont.FreeTypeFont, tracking: int, fill=INK) -> int:
    x = LABEL_CENTER_X - tracked_width(text, fnt, tracking) / 2

    for char in text:
        draw.text((x, y), char, font=fnt, fill=fill)
        x += text_bbox(char, fnt)[0] + tracking

    return y + text_bbox(text, fnt)[1]


def draw_center(draw: ImageDraw.ImageDraw, y: int, text: str, fnt: ImageFont.FreeTypeFont, fill=INK) -> int:
    width, height = text_bbox(text, fnt)
    draw.text((LABEL_CENTER_X - width / 2, y), text, font=fnt, fill=fill)
    return y + height


def logo_mark(width: int) -> Image.Image:
    img = Image.open(LOGO_PATH).convert("RGBA")
    bbox = img.getbbox()
    if bbox:
        img = img.crop(bbox)

    ratio = width / img.width
    return img.resize((width, int(img.height * ratio)), Image.Resampling.LANCZOS)


def wrap_lines(text: str, fnt: ImageFont.FreeTypeFont, max_width: int) -> list[str]:
    words = text.replace("/", " / ").replace("+", " + ").split()
    lines: list[str] = []
    current = ""

    for word in words:
        candidate = f"{current} {word}".strip()
        if not current or text_bbox(candidate, fnt)[0] <= max_width:
            current = candidate
            continue

        lines.append(current)
        current = word

    if current:
        lines.append(current)

    return lines


def fit_product_title(title: str, max_width: int) -> tuple[ImageFont.FreeTypeFont, list[str]]:
    manual_lines = title.upper().splitlines()

    if len(manual_lines) > 1:
        for size in range(46, 23, -2):
            fnt = font("segoeuib.ttf", size)
            if all(text_bbox(line, fnt)[0] <= max_width for line in manual_lines):
                return fnt, manual_lines

    for size in range(48, 21, -2):
        fnt = font("segoeuib.ttf", size)
        lines = wrap_lines(title.upper(), fnt, max_width)
        if len(lines) <= 2 and all(text_bbox(line, fnt)[0] <= max_width for line in lines):
            return fnt, lines

    fnt = font("segoeuib.ttf", 21)
    return fnt, wrap_lines(title.upper(), fnt, max_width)[:2]


def add_label_art(base: Image.Image, spec: ProductSpec) -> Image.Image:
    img = base.copy()
    draw = ImageDraw.Draw(img, "RGBA")

    mark = logo_mark(112)
    img.alpha_composite(mark, (LABEL_CENTER_X - mark.width // 2, 392))

    azure_font = font("segoeui.ttf", 50)
    synth_font = font("seguisb.ttf", 25)
    draw_tracked_center(draw, 512, "AZURE", azure_font, tracking=4)
    draw_tracked_center(draw, 568, "SYNTHETICS", synth_font, tracking=2)

    title_font, lines = fit_product_title(spec.label_title or spec.title, 245)
    subtitle_font = font("segoeui.ttf", 22)
    title_height = sum(text_bbox(line, title_font)[1] for line in lines) + 4 * max(0, len(lines) - 1)
    subtitle_height = text_bbox(spec.label_subtitle, subtitle_font)[1]
    block_height = title_height + subtitle_height + 14
    y = 625 + max(0, (122 - block_height) // 2)

    for line in lines:
        y = draw_center(draw, y, line, title_font)
        y += 4

    y += 8
    draw_center(draw, y, spec.label_subtitle, subtitle_font)

    return img


def save_rgb(image: Image.Image, target: Path) -> None:
    target.parent.mkdir(parents=True, exist_ok=True)
    temp = target.with_name(f"{target.stem}.tmp{target.suffix}")
    image.convert("RGB").save(temp, quality=94, optimize=True)

    try:
        temp.replace(target)
    except OSError:
        temp.unlink(missing_ok=True)
        image.convert("RGB").save(target, quality=94, optimize=True)


def write_product(base: Image.Image, spec: ProductSpec) -> None:
    save_rgb(add_label_art(base, spec), PRODUCT_IMAGES / f"{spec.slug}.png")


def write_copy(source_name: str, output_name: str, size: tuple[int, int] | None = None) -> None:
    img = Image.open(SOURCE_IMAGES / source_name).convert("RGBA")
    if size:
        img = img.resize(size, Image.Resampling.LANCZOS)
    save_rgb(img, THEME_IMAGES / output_name)


def copy_product_to_theme(slug: str, output_name: str) -> None:
    img = Image.open(PRODUCT_IMAGES / f"{slug}.png").convert("RGB")
    save_rgb(img, THEME_IMAGES / output_name)


def main() -> None:
    base = Image.open(MASTER_PATH).convert("RGBA").resize((1024, 1024), Image.Resampling.LANCZOS)

    for product in PRODUCTS:
        write_product(base, product)

    copy_product_to_theme("bpc-157", "card-bpc157.png")
    copy_product_to_theme("mots-c", "card-motsc.png")
    copy_product_to_theme("mots-c", "longevity-motsc.png")
    copy_product_to_theme("cjc-1295-ipamorelin", "card-cjcipa.png")
    copy_product_to_theme("retatrutide", "card-glp3.png")
    copy_product_to_theme("retatrutide", "metabolic-retatrutide.png")
    copy_product_to_theme("retatrutide", "collections-side.png")
    copy_product_to_theme("bpc-157-tb-500-blend", "hero-vial.png")

    write_copy("promo_vials.png", "promo-vials.png")
    write_copy("generated-1776563993993.png", "recovery-stack.png")
    write_copy("generated-1776563999382.png", "story-branded-vials.png")
    write_copy("generated-1776563993993.png", "science-assay.png")
    write_copy("generated-1776563996640.png", "story-lab.png")


if __name__ == "__main__":
    main()
