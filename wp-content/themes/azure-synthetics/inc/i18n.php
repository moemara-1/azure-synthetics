<?php
/**
 * Lightweight storefront language support.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_supported_languages() {
	return array(
		'en' => array(
			'label' => 'EN',
			'name'  => 'English',
			'dir'   => 'ltr',
		),
		'ar' => array(
			'label' => 'AR',
			'name'  => 'العربية',
			'dir'   => 'rtl',
		),
	);
}

function azure_synthetics_current_language() {
	$languages = azure_synthetics_supported_languages();
	$lang      = isset( $_GET['lang'] ) ? sanitize_key( wp_unslash( $_GET['lang'] ) ) : '';

	if ( ! $lang && isset( $_COOKIE['azure_lang'] ) ) {
		$lang = sanitize_key( wp_unslash( $_COOKIE['azure_lang'] ) );
	}

	return isset( $languages[ $lang ] ) ? $lang : 'en';
}

function azure_synthetics_store_language_choice() {
	if ( empty( $_GET['lang'] ) ) {
		return;
	}

	$lang = sanitize_key( wp_unslash( $_GET['lang'] ) );

	if ( ! isset( azure_synthetics_supported_languages()[ $lang ] ) ) {
		return;
	}

	setcookie( 'azure_lang', $lang, time() + YEAR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true );
	$_COOKIE['azure_lang'] = $lang;
}
add_action( 'init', 'azure_synthetics_store_language_choice', 1 );

function azure_synthetics_filter_locale( $locale ) {
	return 'ar' === azure_synthetics_current_language() ? 'ar' : $locale;
}
add_filter( 'locale', 'azure_synthetics_filter_locale' );

function azure_synthetics_filter_language_attributes( $output ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $output;
	}

	return 'lang="ar" dir="rtl"';
}
add_filter( 'language_attributes', 'azure_synthetics_filter_language_attributes' );

function azure_synthetics_body_language_class( $classes ) {
	$classes[] = 'azure-lang-' . azure_synthetics_current_language();

	if ( 'ar' === azure_synthetics_current_language() ) {
		$classes[] = 'rtl';
	}

	return $classes;
}
add_filter( 'body_class', 'azure_synthetics_body_language_class' );

function azure_synthetics_ar_translations() {
	return array(
		'Home' => 'الرئيسية',
		'Shop' => 'المتجر',
		'Science' => 'العلم',
		'FAQ' => 'الأسئلة الشائعة',
		'Contact' => 'تواصل معنا',
		'Account' => 'الحساب',
		'Bulk Orders' => 'طلبات الجملة',
		'Shipping and Returns' => 'الشحن والإرجاع',
		'Privacy Policy' => 'سياسة الخصوصية',
		'Terms and Conditions' => 'الشروط والأحكام',
		'Research Use Policy' => 'سياسة الاستخدام البحثي',
		'For research purposes only.' => 'لأغراض البحث فقط.',
		'I confirm this order is for lawful research purposes only.' => 'أؤكد أن هذا الطلب مخصص لأغراض بحثية قانونية فقط.',
		'Research peptides' => 'ببتيدات بحثية',
		'Shop catalog' => 'تصفح الكتالوج',
		'Catalog proof points' => 'نقاط إثبات الكتالوج',
		'99%+ target purity' => 'هدف نقاء 99%+',
		'COA per batch' => 'COA لكل دفعة',
		'Lot visibility' => 'وضوح الدفعة',
		'Batch references, assay method notes, and storage profile stay close to each vial.' => 'تظل مراجع الدفعة وملاحظات طريقة الفحص وملف التخزين قريبة من كل فيال.',
		'Designed for faster reorder decisions: purity range, format, amount, and handling notes in one view.' => 'مصمم لتسريع قرارات إعادة الطلب: نطاق النقاء والصيغة والكمية وملاحظات التعامل في عرض واحد.',
		'Target purity' => 'هدف النقاء',
		'Purity target and COA context are visible before you choose a format.' => 'هدف النقاء وسياق COA ظاهران قبل اختيار الصيغة.',
		'Batch context' => 'سياق الدفعة',
		'Lot references and documentation requests stay close to the order.' => 'تبقى مراجع الدفعة وطلبات التوثيق قريبة من الطلب.',
		'Vial and box pricing' => 'تسعير الفيال والصندوق',
		'Compare single-vial and 5-vial box options without leaving the catalog.' => 'قارن خيار الفيال الواحد وصندوق الخمس فيالات دون مغادرة الكتالوج.',
		'Why buyers switch' => 'لماذا يغيّر المشترون المورد',
		'Less guessing. Faster reorder decisions.' => 'تخمين أقل. قرارات إعادة طلب أسرع.',
		'The catalog keeps the comparison points close: amount, pack size, purity target, COA workflow, shipping review, and support.' => 'يبقي الكتالوج نقاط المقارنة قريبة: الكمية، حجم العبوة، هدف النقاء، مسار COA، مراجعة الشحن، والدعم.',
		'Built for vendor-aware buyers.' => 'مصمم لمشترين يعرفون الموردين.',
		'Proof beside the price' => 'الإثبات بجانب السعر',
		'Purity target, COA workflow, and lot context sit where buyers compare products.' => 'هدف النقاء ومسار COA وسياق الدفعة في مكان مقارنة المنتجات.',
		'Formats that scan quickly' => 'صيغ سهلة القراءة',
		'Amount, pack size, and lyophilized format stay visible from card to checkout.' => 'تبقى الكمية وحجم العبوة والصيغة المجففة واضحة من البطاقة حتى الدفع.',
		'Bulk without the back-and-forth' => 'طلبات الجملة بدون مراسلات طويلة',
		'Repeat orders can be reviewed for price, destination, documentation, and payment before fulfillment.' => 'يمكن مراجعة الطلبات المتكررة من حيث السعر والوجهة والتوثيق والدفع قبل التجهيز.',
		'Shop by category' => 'تسوق حسب الفئة',
		'Scan the catalog by use case.' => 'تصفح الكتالوج حسب الاستخدام.',
		'Popular compounds' => 'مركبات شائعة',
		'Frequently compared products' => 'منتجات تتم مقارنتها كثيرا',
		'Open full catalog' => 'افتح الكتالوج الكامل',
		'Proof without drag' => 'إثبات بدون إطالة',
		'The signals buyers actually compare.' => 'الإشارات التي يقارنها المشترون فعلا.',
		'Purity target, COA context, form factor, storage, and reorder support stay visible from product discovery through checkout.' => 'يبقى هدف النقاء وسياق COA والصيغة والتخزين ودعم إعادة الطلب ظاهرا من التصفح حتى الدفع.',
		'View proof notes' => 'عرض ملاحظات الإثبات',
		'Proof points made easy to compare.' => 'نقاط إثبات سهلة المقارنة.',
		'Purity target, COA workflow, handling notes, and lot context are presented together for faster purchasing decisions.' => 'يتم عرض هدف النقاء ومسار COA وملاحظات التعامل وسياق الدفعة معا لتسريع قرار الشراء.',
		'What buyers check' => 'ما يفحصه المشترون',
		'Amount, price, purity, COA path, storage, and fulfillment timing.' => 'الكمية والسعر والنقاء ومسار COA والتخزين وتوقيت التجهيز.',
		'How orders move' => 'كيف تتحرك الطلبات',
		'Destination, payment, and temperature handling are confirmed before final fulfillment.' => 'يتم تأكيد الوجهة والدفع والتعامل الحراري قبل التجهيز النهائي.',
		'Get release updates without inbox noise.' => 'احصل على تحديثات الإصدارات بدون ازدحام في بريدك.',
		'Batch releases, COA availability, bulk windows, and price changes only.' => 'إصدارات الدفعات، توفر COA، نوافذ الجملة، وتغيرات الأسعار فقط.',
		'Coming soon' => 'قريبا',
		'Need bulk pricing or a cleaner repeat order?' => 'تحتاج إلى سعر جملة أو إعادة طلب أسهل؟',
		'Ask for vial-box pricing, COA availability, destination review, and payment options before the invoice is finalized.' => 'اسأل عن تسعير الصناديق، توفر COA، مراجعة الوجهة، وخيارات الدفع قبل اعتماد الفاتورة.',
		'Request order support' => 'اطلب دعم الطلب',
		'Collections' => 'المجموعات',
		'Research use' => 'الاستخدام البحثي',
		'Filters' => 'الفلاتر',
		'No products found.' => 'لم يتم العثور على منتجات.',
		'Adjust your filters or check back when the next batch is published.' => 'عدّل الفلاتر أو تحقق لاحقا عند نشر الدفعة التالية.',
		'Popular' => 'شائع',
		'Choose options' => 'اختر الخيارات',
		'Choose an option' => 'اختر خيارا',
		'Add to cart' => 'أضف إلى السلة',
		'Select options' => 'اختر الخيارات',
		'View cart' => 'عرض السلة',
		'View cart, %d item' => 'عرض السلة، عنصر واحد',
		'View cart, %d items' => 'عرض السلة، %d عناصر',
		'Toggle navigation' => 'فتح وإغلاق التنقل',
		'Primary navigation' => 'التنقل الرئيسي',
		'Research Peptide Catalog' => 'كتالوج الببتيدات البحثية',
		'%s quantity' => 'كمية %s',
		'Default sorting' => 'الترتيب الافتراضي',
		'Showing all %d results' => 'عرض كل النتائج (%d)',
		'Research purposes only' => 'لأغراض البحث فقط',
		'Continue browsing' => 'تابع التصفح',
		'Related compounds' => 'مركبات ذات صلة',
		'Search' => 'بحث',
		'Search products' => 'ابحث في المنتجات',
		'Proof stack' => 'طبقة الإثبات',
		'Purity, COA, and handling signals without the maze.' => 'النقاء وCOA وإشارات التعامل بدون تعقيد.',
		'A quick read on the proof points buyers compare before choosing a peptide supplier.' => 'قراءة سريعة لنقاط الإثبات التي يقارنها المشترون قبل اختيار المورد.',
		'Find compounds, pack sizes, pricing, and documentation cues across the catalog.' => 'ابحث عن المركبات وأحجام العبوات والأسعار وإشارات التوثيق في الكتالوج.',
		'Use the catalog, FAQ, or support desk to get back to the order path.' => 'استخدم الكتالوج أو الأسئلة أو الدعم للعودة إلى مسار الطلب.',
		'Built for fast comparison: price, purity, COA context, and support before checkout.' => 'مصمم للمقارنة السريعة: السعر، النقاء، سياق COA، والدعم قبل الدفع.',
		'Navigate' => 'التنقل',
		'Support desk' => 'فريق الدعم',
		'Mon-Fri 09:00-18:00' => 'الإثنين-الجمعة 09:00-18:00',
		'Short proof points, clean pricing, and order review before fulfillment.' => 'نقاط إثبات قصيرة وتسعير واضح ومراجعة طلب قبل التجهيز.',
		'How to compare' => 'كيف تقارن',
		'Price, purity, COA, and fulfillment cues stay close to each product.' => 'يبقى السعر والنقاء وCOA وإشارات التجهيز قريبة من كل منتج.',
		'Amount, pack size, storage, shipping review, and batch references are visible before checkout.' => 'تظهر الكمية وحجم العبوة والتخزين ومراجعة الشحن ومراجع الدفعة قبل الدفع.',
		'Buyer diligence' => 'مراجعة المشتري',
		'The comparison layer.' => 'طبقة المقارنة.',
		'Identity and purity' => 'الهوية والنقاء',
		'Compound identity, target purity, and lot references are surfaced before purchase.' => 'تظهر هوية المركب وهدف النقاء ومراجع الدفعة قبل الشراء.',
		'Format and price' => 'الصيغة والسعر',
		'Vial amounts, 5-vial boxes, and handling notes are presented as buying details.' => 'تظهر كميات الفيال وصناديق الخمس فيالات وملاحظات التعامل كتفاصيل شراء.',
		'Shipping and payment review' => 'مراجعة الشحن والدفع',
		'Destination availability, temperature handling, and payment options are confirmed before fulfillment.' => 'يتم تأكيد توفر الوجهة والتعامل الحراري وخيارات الدفع قبل التجهيز.',
		'Order workflow' => 'مسار الطلب',
		'From comparison to repeat order.' => 'من المقارنة إلى إعادة الطلب.',
		'Buyer answers' => 'إجابات المشتري',
		'Fast answers before checkout.' => 'إجابات سريعة قبل الدفع.',
		'Pricing, COA, shipping, payment review, and reorder questions in one place.' => 'أسئلة التسعير وCOA والشحن ومراجعة الدفع وإعادة الطلب في مكان واحد.',
		'Start here' => 'ابدأ هنا',
		'Quick buyer checklist.' => 'قائمة مشتري سريعة.',
		'Price, purity, COA, shipping review, and payment questions together.' => 'السعر والنقاء وCOA ومراجعة الشحن وأسئلة الدفع معا.',
		'Before ordering' => 'قبل الطلب',
		'Check amount, pack size, price, purity target, and COA workflow.' => 'تحقق من الكمية وحجم العبوة والسعر وهدف النقاء ومسار COA.',
		'After delivery' => 'بعد التسليم',
		'Keep tracking, storage notes, and lot references with your order record.' => 'احتفظ بالتتبع وملاحظات التخزين ومراجع الدفعة مع سجل الطلب.',
		'Need order help?' => 'تحتاج إلى مساعدة في الطلب؟',
		'Ask about COA availability, bulk pricing, destination review, or payment options.' => 'اسأل عن توفر COA أو أسعار الجملة أو مراجعة الوجهة أو خيارات الدفع.',
		'What should I compare first?' => 'ما الذي أقارنه أولا؟',
		'Start with amount, price, target purity, COA workflow, storage notes, and whether you need single vials or box pricing.' => 'ابدأ بالكمية والسعر وهدف النقاء ومسار COA وملاحظات التخزين وما إذا كنت تحتاج فيالات فردية أو تسعير صناديق.',
		'How are COA and lot details handled?' => 'كيف تتم إدارة COA وتفاصيل الدفعة؟',
		'Can I ask about bulk, shipping, or payment before checkout?' => 'هل يمكنني السؤال عن الجملة أو الشحن أو الدفع قبل الدفع؟',
		'Yes. Contact support for vial-box pricing, destination review, documentation requests, and available payment routes.' => 'نعم. تواصل مع الدعم لتسعير الصناديق ومراجعة الوجهة وطلبات التوثيق وطرق الدفع المتاحة.',
		'Support' => 'الدعم',
		'Ask before you order.' => 'اسأل قبل الطلب.',
		'Bulk pricing, payment review, shipping availability, and COA requests.' => 'أسعار الجملة، مراجعة الدفع، توفر الشحن، وطلبات COA.',
		'Questions buyers ask first.' => 'أسئلة يطرحها المشترون أولا.',
		'Price, COA, shipping, payment review, and reorder support without the long sales pitch.' => 'السعر وCOA والشحن ومراجعة الدفع ودعم إعادة الطلب بدون عرض طويل.',
		'Compare' => 'قارن',
		'Scan price, amount, purity target, and COA workflow in one pass.' => 'راجع السعر والكمية وهدف النقاء ومسار COA في مرور واحد.',
		'Review' => 'راجع',
		'Confirm destination, documentation needs, and payment route before final invoice.' => 'أكد الوجهة واحتياجات التوثيق وطريقة الدفع قبل الفاتورة النهائية.',
		'Fulfill' => 'جهّز',
		'Receive tracking and keep the lot reference tied to the order record.' => 'استلم التتبع واحتفظ بمرجع الدفعة مرتبطا بسجل الطلب.',
		'Product category' => 'فئة المنتج',
		'Language' => 'اللغة',
		'GLP-1 / Metabolic Research' => 'أبحاث GLP-1 والتمثيل الغذائي',
		'Recovery & Repair Research' => 'أبحاث التعافي والإصلاح',
		'Growth Hormone Axis Research' => 'أبحاث محور هرمون النمو',
		'Longevity Research' => 'أبحاث طول العمر',
		'Cognitive & Nootropic Research' => 'أبحاث الإدراك والنوتروبيك',
		'Body Composition Research' => 'أبحاث تكوين الجسم',
		'Peptide Support Research' => 'مواد داعمة لأبحاث الببتيدات',
		'Lyophilized material' => 'مادة مجففة بالتجميد',
		'COA per batch; lot reference supplied on fulfillment.' => 'COA لكل دفعة؛ يتم توفير مرجع الدفعة عند التجهيز.',
		'Shipping method and temperature handling are confirmed during order review.' => 'يتم تأكيد طريقة الشحن والتعامل الحراري أثناء مراجعة الطلب.',
		'Shipping method, temperature handling, and destination availability are confirmed during order review.' => 'يتم تأكيد طريقة الشحن والتعامل الحراري وتوفر الوجهة أثناء مراجعة الطلب.',
		'Store unopened lyophilized material frozen at -20°C or according to the lot CoA/SDS. Protect from light and moisture and minimize temperature cycling.' => 'تخزن المادة المجففة غير المفتوحة عند -20°C أو حسب CoA/SDS للدفعة. احمها من الضوء والرطوبة وقلل دورات تغير الحرارة.',
		'Reference validated laboratory SOPs for preparation and handling.' => 'ارجع إلى إجراءات تشغيل مختبرية موثقة للتحضير والتعامل.',
		'Purity' => 'النقاء',
		'Storage' => 'التخزين',
		'Shipping notes' => 'ملاحظات الشحن',
		'Batch reference' => 'مرجع الدفعة',
		'Browse the catalog' => 'تصفح الكتالوج',
		'Reach the team' => 'تواصل مع الفريق',
		'Email' => 'البريد الإلكتروني',
		'Phone' => 'الهاتف',
		'Hours' => 'ساعات العمل',
		'Know the price. Check the proof. Order faster.' => 'اعرف السعر. تحقق من الإثبات. اطلب بسرعة أكبر.',
		'Built for vendor-aware buyers comparing 99%+ target purity, COA and lot workflow, vial and box pricing, and order review before fulfillment.' => 'مصمم للمشترين الذين يقارنون الموردين حسب هدف نقاء 99%+، ومسار COA والدفعة، وتسعير الفيال والصندوق، ومراجعة الطلب قبل التجهيز.',
		'COA + lot workflow' => 'مسار COA والدفعة',
		'Vial + box value' => 'قيمة الفيال والصندوق',
		'Purity signal' => 'إشارة النقاء',
		'Target purity and COA path appear before format decisions.' => 'يظهر هدف النقاء ومسار COA قبل قرار اختيار الصيغة.',
		'Lot proof' => 'إثبات الدفعة',
		'Batch references, assay notes, and support requests stay with the order.' => 'تبقى مراجع الدفعة وملاحظات الفحص وطلبات الدعم مع الطلب.',
		'Box value' => 'قيمة الصندوق',
		'Single-vial and 5-vial pricing are visible without a quote chase.' => 'تظهر أسعار الفيال الواحد وخمس فيالات دون ملاحقة عرض سعر.',
		'Less guessing. More buying signal.' => 'تخمين أقل. إشارات شراء أوضح.',
		'The catalog keeps price, amount, pack size, purity target, COA path, shipping review, and support close to the decision.' => 'يبقي الكتالوج السعر والكمية وحجم العبوة وهدف النقاء ومسار COA ومراجعة الشحن والدعم قريبة من القرار.',
		'Made for people already comparing suppliers.' => 'مصمم لمن يقارنون الموردين بالفعل.',
		'Proof next to price' => 'الإثبات بجانب السعر',
		'Purity target, COA workflow, and lot context sit directly beside buying choices.' => 'يوجد هدف النقاء ومسار COA وسياق الدفعة مباشرة بجانب خيارات الشراء.',
		'Faster catalog reads' => 'قراءة أسرع للكتالوج',
		'Amount, pack size, format, and storage notes are kept short and scannable.' => 'تبقى الكمية وحجم العبوة والصيغة وملاحظات التخزين قصيرة وسهلة المسح.',
		'Bulk without drag' => 'الجملة بدون تعطيل',
		'Repeat and box orders can be reviewed for price, destination, documents, and payment route before fulfillment.' => 'يمكن مراجعة الطلبات المتكررة والصناديق من حيث السعر والوجهة والوثائق ومسار الدفع قبل التجهيز.',
		'Find the right shelf fast.' => 'اعثر على الرف المناسب بسرعة.',
		'Proof should not feel like homework.' => 'لا ينبغي أن يبدو الإثبات كواجب طويل.',
		'Purity target, COA path, form factor, storage profile, and reorder support stay visible from product discovery through checkout.' => 'يبقى هدف النقاء ومسار COA والصيغة وملف التخزين ودعم إعادة الطلب ظاهرا من التصفح حتى الدفع.',
		'View proof dashboard' => 'عرض لوحة الإثبات',
		'Proof that moves at catalog speed.' => 'إثبات يتحرك بسرعة الكتالوج.',
		'Purity target, COA path, lot handoff, storage profile, and reorder support stay visible from first scan to checkout.' => 'يبقى هدف النقاء ومسار COA وتسليم مرجع الدفعة وملف التخزين ودعم إعادة الطلب ظاهرا من أول تصفح حتى الدفع.',
		'Compare faster' => 'قارن بسرعة أكبر',
		'Amount, price, purity target, COA path, storage, and fulfillment review in one pass.' => 'الكمية والسعر وهدف النقاء ومسار COA والتخزين ومراجعة التجهيز في مرور واحد.',
		'Order with context' => 'اطلب مع السياق',
		'Destination, payment route, temperature handling, and documentation needs are reviewed before fulfillment.' => 'تتم مراجعة الوجهة ومسار الدفع والتعامل الحراري واحتياجات التوثيق قبل التجهيز.',
		'High-intent picks' => 'اختيارات عالية النية',
		'Products buyers compare first' => 'منتجات يقارنها المشترون أولا',
		'Questions before support.' => 'أسئلة قبل الدعم.',
		'Price, COA path, shipping review, payment route, and reorder support without the long sales pitch.' => 'السعر ومسار COA ومراجعة الشحن ومسار الدفع ودعم إعادة الطلب بدون عرض طويل.',
		'Batch releases, COA availability, bulk windows, and price changes. Nothing padded.' => 'إصدارات الدفعات وتوفر COA ونوافذ الجملة وتغيرات الأسعار. بدون حشو.',
		'Buying boxes or reordering?' => 'تشتري صناديق أو تعيد الطلب؟',
		'Ask for vial-box pricing, COA availability, destination review, and payment route before the invoice is finalized.' => 'اسأل عن تسعير الفيال والصندوق وتوفر COA ومراجعة الوجهة ومسار الدفع قبل اعتماد الفاتورة.',
		'Fast answers before money moves.' => 'إجابات سريعة قبل الدفع.',
		'Pricing, COA path, shipping review, payment route, and reorder questions in one place.' => 'أسئلة التسعير ومسار COA ومراجعة الشحن ومسار الدفع وإعادة الطلب في مكان واحد.',
		'Purity, COA, and lot proof without the maze.' => 'النقاء وCOA وإثبات الدفعة بدون تعقيد.',
		'A graph-led view of the proof points buyers compare before choosing a peptide supplier.' => 'عرض مدعوم بالرسوم لنقاط الإثبات التي يقارنها المشترون قبل اختيار مورد الببتيدات.',
		'Bulk pricing, payment review, shipping availability, COA requests, and repeat-order help.' => 'أسعار الجملة ومراجعة الدفع وتوفر الشحن وطلبات COA ومساعدة إعادة الطلب.',
		'Compact research-use terms.' => 'شروط استخدام بحثي مختصرة.',
		'The research-purpose notice, order acknowledgment, and fulfillment review terms in one place.' => 'تنبيه الغرض البحثي وإقرار الطلب وشروط مراجعة التجهيز في مكان واحد.',
		'Use this page to check the proof path: target purity, COA handoff, lot record, storage profile, and order review.' => 'استخدم هذه الصفحة للتحقق من مسار الإثبات: هدف النقاء وتسليم COA وسجل الدفعة وملف التخزين ومراجعة الطلب.',
		'Proof dashboard' => 'لوحة الإثبات',
		'The data buyers want before they choose a vial.' => 'البيانات التي يريدها المشترون قبل اختيار الفيال.',
		'A clean release view beats a wall of disclaimers: purity target, assay path, lot handoff, and fulfillment review stay in one place.' => 'عرض إصدار واضح أفضل من جدار تنبيهات: يبقى هدف النقاء ومسار الفحص وتسليم الدفعة ومراجعة التجهيز في مكان واحد.',
		'Released lots are positioned around a clear HPLC purity target.' => 'يتم عرض الدفعات حول هدف نقاء HPLC واضح.',
		'Lot-linked documents' => 'وثائق مرتبطة بالدفعة',
		'COA, assay context, and lot reference stay tied to the order record.' => 'يبقى COA وسياق الفحص ومرجع الدفعة مرتبطا بسجل الطلب.',
		'Box pricing view' => 'عرض تسعير الصندوق',
		'Single-vial and five-vial options are compared before checkout.' => 'تتم مقارنة خيارات الفيال الواحد وخمس فيالات قبل الدفع.',
		'Support handoff' => 'تسليم للدعم',
		'Bulk, shipping, payment, and document questions route to a human review path.' => 'تتجه أسئلة الجملة والشحن والدفع والوثائق إلى مسار مراجعة بشري.',
		'HPLC-style view' => 'عرض بأسلوب HPLC',
		'Release profile at a glance' => 'ملف الإصدار بنظرة سريعة',
		'99%+ target' => 'هدف 99%+',
		'HPLC-style target purity profile' => 'ملف هدف النقاء بأسلوب HPLC',
		'Illustrative release dashboard showing a main purity peak and support readings for buyer comparison.' => 'لوحة إصدار توضيحية تعرض قمة النقاء الرئيسية وقراءات داعمة لمقارنة المشتري.',
		'main peak' => 'القمة الرئيسية',
		'assay window' => 'نافذة الفحص',
		'HPLC target band' => 'نطاق هدف HPLC',
		'Identity review' => 'مراجعة الهوية',
		'MS path' => 'مسار MS',
		'Mass-confirmation context belongs with the lot record.' => 'سياق تأكيد الكتلة يبقى مع سجل الدفعة.',
		'COA handoff' => 'تسليم COA',
		'Lot linked' => 'مرتبط بالدفعة',
		'Documents are tracked against the order, not buried after purchase.' => 'يتم تتبع الوثائق مع الطلب، لا دفنها بعد الشراء.',
		'COA and lot matrix' => 'مصفوفة COA والدفعة',
		'Documentation is treated as part of the product.' => 'يتم التعامل مع التوثيق كجزء من المنتج.',
		'The order path keeps proof, storage, and support context close enough to compare before money moves.' => 'يبقي مسار الطلب الإثبات والتخزين وسياق الدعم قريبا بما يكفي للمقارنة قبل الدفع.',
		'HPLC chromatogram' => 'كروماتوغرام HPLC',
		'Certificate path tied to each batch release.' => 'مسار الشهادة مرتبط بكل إصدار دفعة.',
		'Purity profile kept close to the product record.' => 'يبقى ملف النقاء قريبا من سجل المنتج.',
		'Mass confirmation' => 'تأكيد الكتلة',
		'Identity check context for the listed compound.' => 'سياق تحقق الهوية للمركب المدرج.',
		'Lot record' => 'سجل الدفعة',
		'Batch reference matched to fulfillment notes.' => 'مرجع الدفعة مطابق لملاحظات التجهيز.',
		'Storage profile' => 'ملف التخزين',
		'Temperature and retest notes stay visible.' => 'تبقى ملاحظات الحرارة وإعادة الفحص ظاهرة.',
		'Support trail' => 'مسار الدعم',
		'Bulk, shipping, and payment questions are handled before final invoice.' => 'تتم معالجة أسئلة الجملة والشحن والدفع قبل الفاتورة النهائية.',
		'Storage and transit' => 'التخزين والنقل',
		'Temperature notes are not an afterthought.' => 'ملاحظات الحرارة ليست فكرة لاحقة.',
		'Lot CoA/SDS' => 'COA/SDS للدفعة',
		'Storage guidance follows the published lot documentation.' => 'تتبع إرشادات التخزين وثائق الدفعة المنشورة.',
		'Transit' => 'النقل',
		'Reviewed' => 'تمت المراجعة',
		'Temperature handling is confirmed during order review.' => 'يتم تأكيد التعامل الحراري أثناء مراجعة الطلب.',
		'Retest' => 'إعادة الفحص',
		'Tracked' => 'متتبع',
		'Retest windows and lot notes stay part of the release record.' => 'تبقى نوافذ إعادة الفحص وملاحظات الدفعة جزءا من سجل الإصدار.',
		'Release workflow' => 'مسار الإصدار',
		'From batch proof to repeat order.' => 'من إثبات الدفعة إلى إعادة الطلب.',
		'Set release spec' => 'تحديد مواصفة الإصدار',
		'Amount, format, target purity, storage profile, and document path are defined before a lot reaches the catalog.' => 'يتم تحديد الكمية والصيغة وهدف النقاء وملف التخزين ومسار الوثائق قبل وصول الدفعة إلى الكتالوج.',
		'Match lot to proof' => 'مطابقة الدفعة مع الإثبات',
		'COA, HPLC, MS, and lot references stay attached to the product record buyers review.' => 'تبقى مراجع COA وHPLC وMS والدفعة مرتبطة بسجل المنتج الذي يراجعه المشترون.',
		'Review order route' => 'مراجعة مسار الطلب',
		'Shipping, temperature handling, destination, and payment options are checked before fulfillment.' => 'يتم فحص الشحن والتعامل الحراري والوجهة وخيارات الدفع قبل التجهيز.',
		'Keep reorder memory' => 'حفظ ذاكرة إعادة الطلب',
		'Lot references, pack size, and support notes make repeat orders easier to compare.' => 'تجعل مراجع الدفعة وحجم العبوة وملاحظات الدعم إعادة الطلب أسهل مقارنة.',
		'Fast enough for comparison buyers. Careful enough for research orders.' => 'سريع بما يكفي لمشتري المقارنة. ودقيق بما يكفي لطلبات البحث.',
		'Purity proof' => 'إثبات النقاء',
		'Target purity, HPLC context, and lot references are visible before purchase.' => 'هدف النقاء وسياق HPLC ومراجع الدفعة ظاهرة قبل الشراء.',
		'No digging through policy pages.' => 'لا حاجة للتنقيب في صفحات السياسات.',
		'Price logic' => 'منطق السعر',
		'Vial amounts and 5-vial box options are presented as buying details, not quote bait.' => 'تظهر كميات الفيال وخيارات صندوق الخمس فيالات كتفاصيل شراء، لا كطعم لعرض السعر.',
		'Compare cost before checkout.' => 'قارن التكلفة قبل الدفع.',
		'Fulfillment confidence' => 'ثقة التجهيز',
		'Destination, temperature handling, document needs, and payment route are reviewed before fulfillment.' => 'تتم مراجعة الوجهة والتعامل الحراري واحتياجات الوثائق ومسار الدفع قبل التجهيز.',
		'Support stays close to the order.' => 'يبقى الدعم قريبا من الطلب.',
		'Scan price, amount, purity target, COA path, and box value in one pass.' => 'راجع السعر والكمية وهدف النقاء ومسار COA وقيمة الصندوق في مرور واحد.',
		'Verify' => 'تحقق',
		'Confirm document needs, destination, temperature handling, and payment route before the invoice is finalized.' => 'أكد احتياجات الوثائق والوجهة والتعامل الحراري ومسار الدفع قبل اعتماد الفاتورة.',
		'Reorder' => 'أعد الطلب',
		'Keep tracking, lot reference, pack size, and support notes tied to the order record.' => 'احتفظ بالتتبع ومرجع الدفعة وحجم العبوة وملاحظات الدعم مرتبطة بسجل الطلب.',
		'Check amount, pack size, price, target purity, COA path, and box value.' => 'تحقق من الكمية وحجم العبوة والسعر وهدف النقاء ومسار COA وقيمة الصندوق.',
		'Before fulfillment' => 'قبل التجهيز',
		'Confirm shipping review, temperature handling, payment route, and document needs.' => 'أكد مراجعة الشحن والتعامل الحراري ومسار الدفع واحتياجات الوثائق.',
		'Ask about COA availability, bulk pricing, destination review, or repeat-order support.' => 'اسأل عن توفر COA أو أسعار الجملة أو مراجعة الوجهة أو دعم إعادة الطلب.',
		'Start with amount, price, target purity, COA path, storage profile, and whether single vials or 5-vial boxes fit the order.' => 'ابدأ بالكمية والسعر وهدف النقاء ومسار COA وملف التخزين وما إذا كان الفيال الواحد أو صندوق الخمس فيالات يناسب الطلب.',
		'Product pages keep the COA path and lot-reference handoff close to the purchase decision.' => 'تبقي صفحات المنتج مسار COA وتسليم مرجع الدفعة قريبا من قرار الشراء.',
		'Yes. Contact support for box pricing, destination review, documentation requests, and available payment routes.' => 'نعم. تواصل مع الدعم لتسعير الصناديق ومراجعة الوجهة وطلبات التوثيق ومسارات الدفع المتاحة.',
		'Price, purity target, COA path, shipping review, payment route, and reorder questions together.' => 'السعر وهدف النقاء ومسار COA ومراجعة الشحن ومسار الدفع وأسئلة إعادة الطلب معا.',
		'Compare research peptides by 99%+ target purity, COA and lot workflow, vial pricing, and box value before checkout.' => 'قارن الببتيدات البحثية حسب هدف نقاء 99%+، ومسار COA والدفعة، وتسعير الفيال، وقيمة الصناديق قبل الدفع.',
		'Proof at a glance' => 'الإثبات بنظرة سريعة',
		'Buyer FAQ' => 'أسئلة المشتري',
		'Lab handling' => 'التعامل المخبري',
		'COA and lot reference supplied on fulfillment.' => 'يتم توفير مرجع COA والدفعة عند التجهيز.',
		'Built for fast comparison: price, purity target, COA path, lot context, and support before checkout.' => 'مصمم للمقارنة السريعة: السعر وهدف النقاء ومسار COA وسياق الدفعة والدعم قبل الدفع.',
		'Fulfillment review' => 'مراجعة التجهيز',
		'Research peptides with price, purity target, and proof up front.' => 'ببتيدات بحثية مع السعر وهدف النقاء والإثبات أولا.',
		'Research peptides with 99%+ target purity, COA and lot workflow, clear vial and box pricing, and order review before fulfillment.' => 'ببتيدات بحثية مع هدف نقاء 99%+ ومسار COA والدفعة وتسعير واضح للفيال والصندوق ومراجعة الطلب قبل التجهيز.',
		'Browse Azure Synthetics by compound, amount, pack size, target purity, COA path, lot handoff, and box value before checkout.' => 'تصفح Azure Synthetics حسب المركب والكمية وحجم العبوة وهدف النقاء ومسار COA وتسليم الدفعة وقيمة الصندوق قبل الدفع.',
		'Research-purpose notice' => 'تنبيه الغرض البحثي',
		'Substance profiles' => 'ملفات المواد',
		'Click through the compounds buyers compare first.' => 'تنقل بين المركبات التي يقارنها المشترون أولا.',
		'A current proof dashboard mixed with the older profile idea: each substance gets its own price, format, document, storage, and reorder snapshot.' => 'لوحة إثبات حديثة ممزوجة بفكرة الملفات القديمة: لكل مادة لقطة خاصة للسعر والصيغة والوثائق والتخزين وإعادة الطلب.',
		'Substance profile selector' => 'محدد ملف المادة',
		'Profile snapshot' => 'لقطة الملف',
		'View product' => 'عرض المنتج',
		'Target band' => 'نطاق الهدف',
		'Formats' => 'الصيغ',
		'Vial range' => 'نطاق سعر الفيال',
		'Box range' => 'نطاق سعر الصندوق',
		'Assay path' => 'مسار الفحص',
		'Document path' => 'مسار الوثائق',
		'GLP-1 comparison' => 'مقارنة GLP-1',
		'HPLC + MS identity path' => 'مسار هوية HPLC + MS',
		'COA and lot handoff before fulfillment' => 'تسليم COA والدفعة قبل التجهيز',
		'Frozen storage by lot CoA/SDS' => 'تخزين مجمد حسب CoA/SDS للدفعة',
		'A high-comparison profile for buyers checking amount ladder, vial cost, box value, and document path fast.' => 'ملف عالي المقارنة للمشترين الذين يفحصون سلم الكميات وتكلفة الفيال وقيمة الصندوق ومسار الوثائق بسرعة.',
		'Three amount options make price comparison clearer.' => 'ثلاثة خيارات كمية تجعل مقارنة السعر أوضح.',
		'COA path and lot handoff stay attached to the order.' => 'يبقى مسار COA وتسليم الدفعة مرتبطين بالطلب.',
		'Shipping and payment route are reviewed before release.' => 'تتم مراجعة الشحن ومسار الدفع قبل الإصدار.',
		'Multi-agonist shelf' => 'رف متعدد الناهضات',
		'Release screen with mass confirmation' => 'فحص إصدار مع تأكيد الكتلة',
		'COA, lot, and support notes linked to order' => 'COA والدفعة وملاحظات الدعم مرتبطة بالطلب',
		'Temperature handling reviewed by route' => 'مراجعة التعامل الحراري حسب المسار',
		'Built for buyers comparing higher-value formats where box economics and documentation confidence matter.' => 'مصمم للمشترين الذين يقارنون صيغ أعلى قيمة حيث تهم اقتصاديات الصندوق وثقة الوثائق.',
		'Large-format ladder keeps vial and box decisions together.' => 'يحافظ سلم الصيغ الكبيرة على قرارات الفيال والصندوق معا.',
		'Release proof is framed around assay and lot continuity.' => 'يتم تأطير إثبات الإصدار حول الفحص واستمرارية الدفعة.',
		'Support review catches destination and payment questions early.' => 'تلتقط مراجعة الدعم أسئلة الوجهة والدفع مبكرا.',
		'Repair-pathway profile' => 'ملف مسار الإصلاح',
		'HPLC purity target with lot reference' => 'هدف نقاء HPLC مع مرجع الدفعة',
		'COA workflow plus batch reference' => 'مسار COA مع مرجع الدفعة',
		'Frozen, dry, light-protected storage profile' => 'ملف تخزين مجمد وجاف ومحمي من الضوء',
		'A fast-read profile for buyers comparing low-friction reorder value, familiar format sizes, and proof access.' => 'ملف سريع القراءة للمشترين الذين يقارنون قيمة إعادة الطلب السهلة وأحجام الصيغ المألوفة وإتاحة الإثبات.',
		'Two common amount options keep the decision simple.' => 'خياران شائعان للكمية يحافظان على بساطة القرار.',
		'Batch reference and COA workflow are visible buying cues.' => 'مرجع الدفعة ومسار COA إشارات شراء ظاهرة.',
		'Box value supports repeat-order planning.' => 'قيمة الصندوق تدعم تخطيط إعادة الطلب.',
		'GHRH analog profile' => 'ملف نظير GHRH',
		'Identity and purity screen by lot' => 'فحص الهوية والنقاء حسب الدفعة',
		'COA route with paired support context' => 'مسار COA مع سياق دعم مرافق',
		'Frozen storage with minimized temperature cycling' => 'تخزين مجمد مع تقليل دورات تغير الحرارة',
		'A profile for buyers who compare format, companion inventory, and repeat kit logic before checkout.' => 'ملف للمشترين الذين يقارنون الصيغة والمخزون المرافق ومنطق إعادة طلب الأطقم قبل الدفع.',
		'Format range supports single-vial or repeat-order planning.' => 'نطاق الصيغ يدعم تخطيط الفيال الواحد أو إعادة الطلب.',
		'Identity and purity checks stay attached to the lot.' => 'تبقى فحوص الهوية والنقاء مرتبطة بالدفعة.',
		'Support can review companion-product questions before invoice.' => 'يمكن للدعم مراجعة أسئلة المنتجات المرافقة قبل الفاتورة.',
		'Copper peptide profile' => 'ملف ببتيد النحاس',
		'Purity target plus form-factor review' => 'هدف النقاء مع مراجعة الصيغة',
		'COA path and storage record tracked together' => 'مسار COA وسجل التخزين متتبعان معا',
		'Moisture-aware frozen storage profile' => 'ملف تخزين مجمد يراعي الرطوبة',
		'A profile for shoppers comparing larger vial amounts, box savings, and storage expectations in one pass.' => 'ملف للمتسوقين الذين يقارنون كميات فيال أكبر وتوفير الصندوق وتوقعات التخزين في مرور واحد.',
		'Higher amount formats make unit economics easy to scan.' => 'الصيغ ذات الكميات الأعلى تجعل اقتصاديات الوحدة سهلة الفحص.',
		'Storage profile is treated as release data, not fine print.' => 'يتم التعامل مع ملف التخزين كبيانات إصدار، لا كنص مخفي.',
		'Box pricing keeps repeat inventory planning visible.' => 'يبقي تسعير الصناديق تخطيط المخزون المتكرر ظاهرا.',
		'Mitochondrial profile' => 'ملف الميتوكوندريا',
		'HPLC target with identity confirmation path' => 'هدف HPLC مع مسار تأكيد الهوية',
		'Lot record, COA path, and reorder notes' => 'سجل الدفعة ومسار COA وملاحظات إعادة الطلب',
		'Frozen storage and transit review' => 'تخزين مجمد ومراجعة النقل',
		'A proof-heavy profile for buyers comparing specialty pricing, amount spread, and lot continuity.' => 'ملف غني بالإثبات للمشترين الذين يقارنون التسعير المتخصص وتنوع الكمية واستمرارية الدفعة.',
		'Specialty amount spread makes the catalog feel less generic.' => 'تنوع الكميات المتخصصة يجعل الكتالوج أقل عمومية.',
		'Lot continuity matters for repeat research inventory.' => 'استمرارية الدفعة مهمة لمخزون البحث المتكرر.',
		'Transit review keeps temperature handling in the buying path.' => 'تحافظ مراجعة النقل على التعامل الحراري ضمن مسار الشراء.',
		'Price ladder' => 'سلم السعر',
		'Proof fit' => 'ملاءمة الإثبات',
		'Reorder fit' => 'ملاءمة إعادة الطلب',
		'Evidence context' => 'سياق الأدلة',
		'Researched therapeutic signals' => 'إشارات علاجية قيد البحث',
		'Clinical drug-class literature' => 'أدبيات سريرية لفئة الدواء',
		'Incretin-pathway research around glucose regulation and body-weight endpoints.' => 'أبحاث مسار الإنكريتين حول تنظيم الجلوكوز ونقاط قياس وزن الجسم.',
		'Clinical trial literature for approved tirzepatide medicines; not a claim about this catalog material.' => 'أدبيات تجارب سريرية لأدوية تيرزيباتيد المعتمدة؛ وليس ادعاء حول مادة هذا الكتالوج.',
		'Investigational clinical literature' => 'أدبيات سريرية استقصائية',
		'Triple-agonist research around A1C, body weight, and metabolic markers.' => 'أبحاث الناهض الثلاثي حول A1C ووزن الجسم والمؤشرات الأيضية.',
		'Studied as an investigational molecule; no approved-use claim is made here.' => 'تتم دراسته كجزيء استقصائي؛ ولا يوجد هنا ادعاء استخدام معتمد.',
		'Preclinical-heavy literature' => 'أدبيات يغلب عليها ما قبل السريري',
		'Animal and cell-model literature explores tissue-repair, tendon, ligament, and cytoprotective pathways.' => 'تستكشف أدبيات النماذج الحيوانية والخلوية مسارات إصلاح الأنسجة والأوتار والأربطة والحماية الخلوية.',
		'Human evidence remains limited; this is a research-context summary, not therapeutic positioning.' => 'تبقى الأدلة البشرية محدودة؛ هذا ملخص سياق بحثي وليس تموضعا علاجيا.',
		'Endocrine biomarker literature' => 'أدبيات مؤشرات الغدد الصماء',
		'GHRH-analog research around GH and IGF-1 axis signaling.' => 'أبحاث نظائر GHRH حول إشارات محور GH وIGF-1.',
		'The science page frames biomarkers and release data only; it does not imply performance outcomes.' => 'تعرض صفحة العلم المؤشرات الحيوية وبيانات الإصدار فقط؛ ولا تلمح إلى نتائج أداء.',
		'Regeneration-pathway literature' => 'أدبيات مسارات التجدد',
		'Copper-peptide literature explores skin regeneration, wound-repair, collagen, and matrix-remodeling pathways.' => 'تستكشف أدبيات ببتيدات النحاس مسارات تجدد الجلد وإصلاح الجروح والكولاجين وإعادة تشكيل المصفوفة.',
		'Presented as literature context for research buyers, not as a cosmetic or medical claim.' => 'يتم عرضه كسياق أدبي للمشترين البحثيين، وليس كادعاء تجميلي أو طبي.',
		'Translational metabolism literature' => 'أدبيات أيضية انتقالية',
		'Mitochondrial-derived peptide literature explores metabolic homeostasis, insulin-resistance models, inflammation, and aging biology.' => 'تستكشف أدبيات الببتيدات المشتقة من الميتوكوندريا الاتزان الأيضي ونماذج مقاومة الإنسولين والالتهاب وبيولوجيا الشيخوخة.',
		'These are research signals from the literature, not stated effects of any Azure product.' => 'هذه إشارات بحثية من الأدبيات، وليست تأثيرات معلنة لأي منتج من Azure.',
		'Send a message' => 'أرسل رسالة',
		'Ask about COA availability, a product, bulk pricing, payment route, or shipping review. The message is saved first, then emailed to the support desk.' => 'اسأل عن توفر COA أو منتج أو تسعير الجملة أو مسار الدفع أو مراجعة الشحن. يتم حفظ الرسالة أولا ثم إرسالها إلى مكتب الدعم.',
		'Message received. The support desk has your request.' => 'تم استلام الرسالة. أصبح طلبك لدى مكتب الدعم.',
		'Please wait a moment before sending another message.' => 'يرجى الانتظار قليلا قبل إرسال رسالة أخرى.',
		'Please complete the required fields with a valid email address.' => 'يرجى إكمال الحقول المطلوبة باستخدام بريد إلكتروني صالح.',
		'The message could not be sent. Please check the fields and try again.' => 'تعذر إرسال الرسالة. يرجى التحقق من الحقول والمحاولة مرة أخرى.',
		'Name' => 'الاسم',
		'Topic' => 'الموضوع',
		'Order or product reference' => 'مرجع الطلب أو المنتج',
		'Optional' => 'اختياري',
		'Message' => 'الرسالة',
		'Company' => 'الشركة',
		'Send message' => 'إرسال الرسالة',
		'Order support' => 'دعم الطلب',
		'Product question' => 'سؤال عن منتج',
		'COA or lot documents' => 'COA أو وثائق الدفعة',
		'Bulk or reorder pricing' => 'تسعير الجملة أو إعادة الطلب',
		'Shipping review' => 'مراجعة الشحن',
		'Payment route' => 'مسار الدفع',
		'Other' => 'أخرى',
		'Amount' => 'الكمية',
		'Pack size' => 'حجم العبوة',
		'Proof' => 'الإثبات',
		'Vial amount' => 'كمية الفيال',
		'Form' => 'الصيغة',
		'Mechanism' => 'الآلية',
		'Verification route' => 'مسار التحقق',
		'Researched possible therapeutic effects' => 'تأثيرات علاجية محتملة قيد البحث',
		'Sterile solution' => 'محلول معقم',
		'Store according to the lot label/SDS. Keep sealed and protected from excess heat and light.' => 'يخزن حسب ملصق الدفعة أو SDS. يحفظ مغلقا ومحميًا من الحرارة الزائدة والضوء.',
		'99%+ target purity with COA, lot-reference handoff, and HPLC/MS identity context reviewed before fulfillment.' => 'هدف نقاء 99%+ مع COA وتسليم مرجع الدفعة وسياق هوية HPLC/MS تتم مراجعته قبل التجهيز.',
		'Availability, destination, shipping method, temperature handling, payment route, and document needs are reviewed before fulfillment.' => 'تتم مراجعة التوفر والوجهة وطريقة الشحن والتعامل الحراري ومسار الدفع واحتياجات الوثائق قبل التجهيز.',
		'Literature-context signals buyers often compare before choosing a research supplier. These are research themes, not stated effects of this catalog material.' => 'إشارات من سياق الأدبيات يقارنها المشترون عادة قبل اختيار مورد بحثي. هذه موضوعات بحثية، وليست تأثيرات معلنة لهذه المادة في الكتالوج.',
		'Order review' => 'مراجعة الطلب',
	);
}

function azure_synthetics_translate_string( $text ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $text;
	}

	$translations = azure_synthetics_ar_translations();

	return $translations[ $text ] ?? $text;
}

function azure_synthetics_gettext( $translation, $text, $domain ) {
	$domains = array( 'azure-synthetics', 'azure-synthetics-core', 'woocommerce', 'default' );

	if ( ! in_array( $domain, $domains, true ) ) {
		return $translation;
	}

	return azure_synthetics_translate_string( $text );
}
add_filter( 'gettext', 'azure_synthetics_gettext', 20, 3 );

function azure_synthetics_ngettext( $translation, $single, $plural, $number, $domain ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $translation;
	}

	if ( 'Showing all %d results' === $plural || 'Showing the single result' === $single ) {
		return sprintf( 'عرض كل النتائج (%d)', (int) $number );
	}

	return azure_synthetics_gettext( $translation, $plural, $domain );
}
add_filter( 'ngettext', 'azure_synthetics_ngettext', 20, 5 );

function azure_synthetics_ngettext_with_context( $translation, $single, $plural, $number, $context, $domain ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $translation;
	}

	if ( 'Showing %1$d&ndash;%2$d of %3$d results' === $plural || 'Showing %1$d&ndash;%2$d of %3$d result' === $single ) {
		return 'عرض %1$d&ndash;%2$d من %3$d نتيجة';
	}

	return azure_synthetics_ngettext( $translation, $single, $plural, $number, $domain );
}
add_filter( 'ngettext_with_context', 'azure_synthetics_ngettext_with_context', 20, 6 );

function azure_synthetics_language_url( $lang ) {
	$url = remove_query_arg( 'lang' );

	return add_query_arg( 'lang', $lang, $url );
}

function azure_synthetics_preserve_language_url( $url ) {
	$lang = azure_synthetics_current_language();

	if ( 'en' === $lang || empty( $url ) ) {
		return $url;
	}

	return add_query_arg( 'lang', $lang, $url );
}

function azure_synthetics_render_language_switcher() {
	$current = azure_synthetics_current_language();
	?>
	<div class="azure-language-switcher" aria-label="<?php esc_attr_e( 'Language', 'azure-synthetics' ); ?>">
		<?php foreach ( azure_synthetics_supported_languages() as $lang => $details ) : ?>
			<a class="<?php echo esc_attr( $current === $lang ? 'is-active' : '' ); ?>" href="<?php echo esc_url( azure_synthetics_language_url( $lang ) ); ?>" hreflang="<?php echo esc_attr( $lang ); ?>" lang="<?php echo esc_attr( $lang ); ?>">
				<?php echo esc_html( $details['label'] ); ?>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
}

function azure_synthetics_get_site_tagline() {
	if ( 'ar' === azure_synthetics_current_language() ) {
		return 'السعر وهدف النقاء والإثبات أولا';
	}

	return get_bloginfo( 'description' );
}

function azure_synthetics_get_localized_product_meta( $product_id, $key, $fallback = '' ) {
	if ( 'ar' === azure_synthetics_current_language() ) {
		$ar = get_post_meta( $product_id, '_azure_' . $key . '_ar', true );

		if ( '' !== $ar ) {
			return $ar;
		}
	}

	return $fallback;
}

function azure_synthetics_attribute_label( $label, $name, $product ) {
	$key    = sanitize_title( $name ?: $label );
	$labels = array(
		'amount'    => __( 'Amount', 'azure-synthetics' ),
		'pack-size' => __( 'Pack size', 'azure-synthetics' ),
	);

	return $labels[ $key ] ?? $label;
}
add_filter( 'woocommerce_attribute_label', 'azure_synthetics_attribute_label', 20, 3 );

function azure_synthetics_variation_option_name( $name ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $name;
	}

	$options = array(
		'1 vial'        => 'فيال واحد',
		'Box (5 vials)' => 'صندوق (5 فيالات)',
	);

	return $options[ $name ] ?? $name;
}
add_filter( 'woocommerce_variation_option_name', 'azure_synthetics_variation_option_name' );

function azure_synthetics_woocommerce_breadcrumbs( $crumbs ) {
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $crumbs;
	}

	foreach ( $crumbs as &$crumb ) {
		if ( empty( $crumb[0] ) ) {
			continue;
		}

		$crumb[0] = azure_synthetics_translate_string( $crumb[0] );
	}

	return $crumbs;
}
add_filter( 'woocommerce_get_breadcrumb', 'azure_synthetics_woocommerce_breadcrumbs' );

function azure_synthetics_loop_add_to_cart_link_aria( $html, $product, $args = array() ) {
	if ( 'ar' !== azure_synthetics_current_language() || ! $product instanceof WC_Product ) {
		return $html;
	}

	$label = sprintf( 'اختر خيارات %s', $product->get_name() );

	if ( $product->is_type( 'simple' ) ) {
		$label = sprintf( 'أضف %s إلى السلة', $product->get_name() );
	}

	if ( preg_match( '/aria-label="[^"]*"/', $html ) ) {
		return preg_replace( '/aria-label="[^"]*"/', 'aria-label="' . esc_attr( $label ) . '"', $html, 1 );
	}

	return preg_replace( '/<a\b/', '<a aria-label="' . esc_attr( $label ) . '"', $html, 1 );
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'azure_synthetics_loop_add_to_cart_link_aria', 20, 3 );
