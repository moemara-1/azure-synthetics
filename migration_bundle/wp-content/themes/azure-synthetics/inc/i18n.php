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
		'For research use only. Not for human consumption.' => 'للاستخدام البحثي فقط. غير مخصص للاستهلاك البشري.',
		'For research use only. Not for human consumption. Handle and store according to the published product guidance.' => 'للاستخدام البحثي فقط. غير مخصص للاستهلاك البشري. يتم التعامل والتخزين حسب إرشادات المنتج المنشورة.',
		'I confirm this order is placed for lawful laboratory or research use only, and not for human consumption.' => 'أؤكد أن هذا الطلب مخصص لاستخدام مختبري أو بحثي قانوني فقط، وليس للاستهلاك البشري.',
		'Research-use peptides' => 'ببتيدات للاستخدام البحثي',
		'Buy research peptides with proof where your team needs it.' => 'اشتر ببتيدات بحثية مع التوثيق في المكان الذي يحتاجه فريقك.',
		'Azure Synthetics helps qualified labs source lyophilized research peptides with lot-aware CoA context, clear vial formats, and storage notes visible before checkout.' => 'تساعد Azure Synthetics المختبرات المؤهلة على شراء ببتيدات بحثية مجففة بالتجميد مع سياق CoA حسب الدفعة، وصيغ فيالات واضحة، وملاحظات تخزين ظاهرة قبل إتمام الطلب.',
		'Shop research catalog' => 'تصفح الكتالوج البحثي',
		'CoA, purity range, and handling notes on flagship lots.' => 'CoA ونطاق النقاء وملاحظات التعامل للدفعات الرئيسية.',
		'For laboratory, analytical, and investigational use only. Not for human or veterinary use.' => 'للاستخدام المختبري والتحليلي والبحثي فقط. غير مخصص للاستخدام البشري أو البيطري.',
		'Lot visibility' => 'وضوح الدفعة',
		'Batch references, assay method notes, and storage profile stay close to each vial.' => 'تظل مراجع الدفعة وملاحظات طريقة الفحص وملف التخزين قريبة من كل فيال.',
		'Designed for faster reorder decisions: purity range, format, amount, and handling notes in one view.' => 'مصمم لتسريع قرارات إعادة الطلب: نطاق النقاء والصيغة والكمية وملاحظات التعامل في عرض واحد.',
		'Diligence wins orders' => 'الثقة تبدأ من التوثيق',
		'Purity data up front' => 'بيانات النقاء أولا',
		'HPLC/MS context and lot references are easy to review before purchase.' => 'يسهل مراجعة سياق HPLC/MS ومراجع الدفعات قبل الشراء.',
		'Handling before checkout' => 'إرشادات التعامل قبل الدفع',
		'Transit and storage expectations are stated where buying decisions happen.' => 'تظهر توقعات الشحن والتخزين في مكان اتخاذ قرار الشراء.',
		'Cleaner repeat purchasing' => 'إعادة شراء أكثر وضوحا',
		'Repeat buyers can match vial format, lot notes, and documentation requests without starting over.' => 'يمكن للمشترين المتكررين مطابقة صيغة الفيال وملاحظات الدفعة وطلبات التوثيق دون البدء من جديد.',
		'Why researchers stay' => 'لماذا يعود الباحثون',
		'Less uncertainty between product search and purchase.' => 'تقليل الغموض بين البحث عن المنتج وإتمام الشراء.',
		'Every page is written to answer the questions that slow qualified buyers down: what the vial is, what documentation exists, how it ships, and what support can provide.' => 'كل صفحة مكتوبة للإجابة عن الأسئلة التي تبطئ المشترين المؤهلين: ما هي المادة، ما التوثيق المتاح، كيف يتم شحنها، وما الذي يمكن لفريق الدعم توفيره.',
		'Clarity before checkout.' => 'وضوح قبل الدفع.',
		'Documentation near the decision' => 'التوثيق قرب قرار الشراء',
		'CoA references, purity ranges, and storage notes sit beside the product instead of hiding in support threads.' => 'تظهر مراجع CoA ونطاقات النقاء وملاحظات التخزين بجانب المنتج بدلا من إخفائها في محادثات الدعم.',
		'Format confidence' => 'ثقة في الصيغة',
		'Vial amount, lyophilized form, and kit structure stay visible across catalog and product pages.' => 'تظل كمية الفيال والصيغة المجففة بالتجميد وبنية الكيت واضحة في الكتالوج وصفحات المنتجات.',
		'Bulk support without friction' => 'دعم الجملة بدون تعقيد',
		'Recurring orders can be handled with documentation and fulfillment notes intact.' => 'يمكن إدارة الطلبات المتكررة مع الحفاظ على التوثيق وملاحظات التجهيز.',
		'Shop by research area' => 'تسوق حسب مجال البحث',
		'Find the right research material faster.' => 'اعثر على المادة البحثية المناسبة بسرعة أكبر.',
		'Flagship research materials' => 'مواد بحثية رئيسية',
		'Popular catalog entries' => 'منتجات مطلوبة في الكتالوج',
		'Open full catalog' => 'افتح الكتالوج الكامل',
		'Operational rigor' => 'انضباط تشغيلي',
		'Testing, packaging, and replenishment in one place.' => 'الفحص والتغليف وإعادة الطلب في مكان واحد.',
		'Assay context, storage notes, and reorder details stay visible from product discovery through checkout.' => 'يبقى سياق الفحص وملاحظات التخزين وتفاصيل إعادة الطلب ظاهرة من اكتشاف المنتج حتى الدفع.',
		'View science notes' => 'عرض ملاحظات العلم',
		'Cold-chain' => 'شحن مبرد',
		'Repeat-ready' => 'جاهز لإعادة الطلب',
		'Release discipline from batch review to reorder.' => 'انضباط الإصدار من مراجعة الدفعة حتى إعادة الطلب.',
		'Identity testing, purity ranges, handling notes, and lot context are presented together for research-use purchasing.' => 'تظهر اختبارات الهوية ونطاقات النقاء وملاحظات التعامل وسياق الدفعة معا لشراء مخصص للاستخدام البحثي.',
		'What gets documented' => 'ما الذي يتم توثيقه',
		'Lot identifiers, assay references, purity bands, storage notes, and form-factor details.' => 'معرفات الدفعات، مراجع الفحوصات، نطاقات النقاء، ملاحظات التخزين، وتفاصيل الصيغة.',
		'How handling is framed' => 'كيف يتم عرض إرشادات التعامل',
		'Cold-pack cues, inspection guidance, and storage notes stay operational.' => 'تظل إرشادات الشحن المبرد والفحص والتخزين عملية وواضحة.',
		'Get release updates without inbox noise.' => 'احصل على تحديثات الإصدارات بدون ازدحام في بريدك.',
		'Batch releases, CoA availability, cold-chain notices, and preferred reorder windows.' => 'إصدارات الدفعات، توفر CoA، تنبيهات الشحن المبرد، ونوافذ إعادة الطلب المفضلة.',
		'Coming soon' => 'قريبا',
		'Subscribe for release windows and 10% off your first qualified order.' => 'اشترك للحصول على نوافذ الإصدار وخصم 10% على أول طلب مؤهل.',
		'Request bulk support' => 'اطلب دعم الجملة',
		'Collections' => 'المجموعات',
		'Compliance' => 'الامتثال',
		'Filters' => 'الفلاتر',
		'No products found.' => 'لم يتم العثور على منتجات.',
		'Adjust your filters or return later when the next release batch is published.' => 'عدّل الفلاتر أو ارجع لاحقا عند نشر دفعة جديدة.',
		'Flagship' => 'رئيسي',
		'Variable format' => 'صيغة متعددة',
		'Choose options' => 'اختر الخيارات',
		'Choose an option' => 'اختر خيارا',
		'Add to cart' => 'أضف إلى السلة',
		'Select options' => 'اختر الخيارات',
		'%s quantity' => 'كمية %s',
		'Default sorting' => 'الترتيب الافتراضي',
		'Showing all %d results' => 'عرض كل النتائج (%d)',
		'Research notice' => 'تنبيه بحثي',
		'For research use only' => 'للاستخدام البحثي فقط',
		'Technical overview' => 'نظرة تقنية',
		'Product FAQ' => 'أسئلة المنتج',
		'Continue browsing' => 'تابع التصفح',
		'Related formulations' => 'مواد ذات صلة',
		'Search' => 'بحث',
		'Search products' => 'ابحث في المنتجات',
		'Science and documentation' => 'العلم والتوثيق',
		'A research-use catalog needs documentation before persuasion.' => 'كتالوج الاستخدام البحثي يحتاج إلى التوثيق قبل الإقناع.',
		'Lot integrity, release data, form factors, and handling notes for research-use purchasing.' => 'سلامة الدفعات، بيانات الإصدار، الصيغ، وملاحظات التعامل لشراء مخصص للاستخدام البحثي.',
		'Compare peptide evidence, identity, and documentation before you order.' => 'قارن أدلة الببتيدات والهوية والتوثيق قبل الطلب.',
		'A practical research-use reference for compound aliases, evidence maturity, CoA access, storage expectations, and claim boundaries.' => 'مرجع عملي للاستخدام البحثي يوضح أسماء المركبات البديلة، مستوى الأدلة، توفر CoA، توقعات التخزين، وحدود الادعاءات.',
		'Use this page to compare compound identity, evidence maturity, CoA access, and handling requirements without dosing advice or human-use claims.' => 'استخدم هذه الصفحة لمقارنة هوية المركب ومستوى الأدلة وتوفر CoA ومتطلبات التعامل بدون إرشادات جرعات أو ادعاءات استخدام بشري.',
		'What to verify before a product reaches the cart.' => 'ما يجب التحقق منه قبل إضافة المنتج إلى السلة.',
		'Designed for qualified labs, inventory teams, and documentation-first buyers.' => 'مصمم للمختبرات المؤهلة وفرق المخزون والمشترين الذين يضعون التوثيق أولا.',
		'Navigate' => 'التنقل',
		'Support desk' => 'فريق الدعم',
		'Mon-Fri 09:00-18:00' => 'الإثنين-الجمعة 09:00-18:00',
		'Research use only' => 'للاستخدام البحثي فقط',
		'No diagnosis, treatment, mitigation, cure, human-use, or veterinary-use claims.' => 'لا توجد ادعاءات تشخيص أو علاج أو تخفيف أو شفاء أو استخدام بشري أو بيطري.',
		'How to read a release' => 'كيف تقرأ بيانات الإصدار',
		'Release data, handling, and lot context stay close to each product.' => 'تبقى بيانات الإصدار وإرشادات التعامل وسياق الدفعة قريبة من كل منتج.',
		'Identity, amount, storage, shipping, and batch references are visible before checkout.' => 'تظهر الهوية والكمية والتخزين والشحن ومراجع الدفعة قبل الدفع.',
		'Buyer diligence' => 'مراجعة المشتري',
		'Release details at a glance.' => 'تفاصيل الإصدار في لمحة.',
		'Identity and purity' => 'الهوية والنقاء',
		'Compound identity, target purity range, assay context, and lot references are surfaced before purchase.' => 'تظهر هوية المركب ونطاق النقاء المستهدف وسياق الفحص ومراجع الدفعة قبل الشراء.',
		'Format and handling' => 'الصيغة والتعامل',
		'Powder, dual-vial kits, pack sizes, and handling notes are presented as lab inventory details.' => 'يتم عرض المسحوق والكيتات ثنائية الفيال وأحجام العبوات وملاحظات التعامل كتفاصيل مخزون مختبري.',
		'Storage and transit' => 'التخزين والنقل',
		'Temperature, inspection, and storage notes are visible before checkout.' => 'تظهر ملاحظات الحرارة والفحص والتخزين قبل الدفع.',
		'Release workflow' => 'مسار الإصدار',
		'A clean path from batch data to reorder confidence.' => 'مسار واضح من بيانات الدفعة إلى ثقة إعادة الطلب.',
		'Need a clearer path?' => 'تحتاج إلى مسار أوضح؟',
		'Frequently asked questions' => 'الأسئلة الشائعة',
		'Documentation, handling, shipping, and account answers in one place.' => 'إجابات التوثيق والتعامل والشحن والحساب في مكان واحد.',
		'Start here' => 'ابدأ هنا',
		'Quick diligence checklist.' => 'قائمة مراجعة سريعة.',
		'Product form, documentation, handling, shipping, and account questions together.' => 'أسئلة صيغة المنتج والتوثيق والتعامل والشحن والحساب معا.',
		'Before ordering' => 'قبل الطلب',
		'Confirm the form factor, vial amount, storage expectations, and whether the product page lists current lot documentation.' => 'تأكد من الصيغة، كمية الفيال، توقعات التخزين، وما إذا كانت صفحة المنتج تعرض توثيق الدفعة الحالي.',
		'After delivery' => 'بعد التسليم',
		'Inspect temperature-sensitive shipments promptly and keep published storage guidance attached to the receiving record.' => 'افحص الشحنات الحساسة للحرارة بسرعة واحتفظ بإرشادات التخزين المنشورة مع سجل الاستلام.',
		'Need documentation?' => 'تحتاج إلى توثيق؟',
		'Product FAQs, batch references, and the support desk cover assay or lot documentation requests.' => 'تغطي أسئلة المنتج ومراجع الدفعة وفريق الدعم طلبات الفحص أو توثيق الدفعات.',
		'No. Azure Synthetics products are sold for lawful laboratory, analytical, and investigational use only. They are not for human or veterinary use, injection, diagnosis, treatment, or consumption.' => 'لا. تباع منتجات Azure Synthetics للاستخدام المختبري والتحليلي والبحثي القانوني فقط. وهي غير مخصصة للاستخدام البشري أو البيطري أو الحقن أو التشخيص أو العلاج أو الاستهلاك.',
		'Flagship products surface purity ranges, batch references, and lot-linked CoA context close to the purchase decision.' => 'تعرض المنتجات الرئيسية نطاقات النقاء ومراجع الدفعات وسياق CoA المرتبط بالدفعة بالقرب من قرار الشراء.',
		'Yes. Contact support for recurring demand, preferred pricing, and documentation needs for qualified research-use buyers.' => 'نعم. تواصل مع الدعم للاحتياج المتكرر، والأسعار المفضلة، وطلبات التوثيق للمشترين المؤهلين للاستخدام البحثي.',
		'Talk to the support desk' => 'تواصل مع فريق الدعم',
		'Bulk pricing, documentation requests, shipping questions, and catalog assistance.' => 'أسعار الجملة، طلبات التوثيق، أسئلة الشحن، والمساعدة في الكتالوج.',
		'Need a clearer path through the catalog?' => 'تحتاج إلى مسار أوضح داخل الكتالوج؟',
		'Fast answers on product form, documentation, handling, and account support.' => 'إجابات سريعة حول صيغة المنتج والتوثيق والتعامل ودعم الحساب.',
		'Release screen' => 'مراجعة الإصدار',
		'Batch data is reviewed before a product is published for research-use purchase.' => 'تتم مراجعة بيانات الدفعة قبل نشر المنتج للشراء المخصص للاستخدام البحثي.',
		'Package for handling' => 'تجهيز مناسب للتعامل',
		'Cold-chain and storage notes travel with the order record.' => 'تظل ملاحظات الشحن المبرد والتخزين مرفقة بسجل الطلب.',
		'Keep the lot traceable' => 'حافظ على تتبع الدفعة',
		'Lot references and COA context remain easy to find.' => 'تبقى مراجع الدفعات وسياق CoA سهلة الوصول.',
		'Product category' => 'فئة المنتج',
		'Language' => 'اللغة',
		'GLP-1 / Metabolic Research' => 'أبحاث GLP-1 والتمثيل الغذائي',
		'Recovery & Repair Research' => 'أبحاث التعافي والإصلاح',
		'Growth Hormone Axis Research' => 'أبحاث محور هرمون النمو',
		'Longevity Research' => 'أبحاث طول العمر',
		'Cognitive & Nootropic Research' => 'أبحاث الإدراك والنوتروبيك',
		'Body Composition Research' => 'أبحاث تكوين الجسم',
		'Peptide Support Research' => 'مواد داعمة لأبحاث الببتيدات',
		'Lyophilized research peptides with CoA-per-batch workflow, EU cold-chain shipping, and amount/box pricing visible before checkout.' => 'ببتيدات بحثية مجففة بالتجميد مع مسار CoA لكل دفعة، وشحن أوروبي مبرد، وتسعير الكميات والصناديق ظاهر قبل الدفع.',
		'Lyophilized research material' => 'مادة بحثية مجففة بالتجميد',
		'CoA per batch; lot reference supplied on fulfillment.' => 'CoA لكل دفعة؛ يتم توفير مرجع الدفعة عند التجهيز.',
		'EU cold-chain shipping included for catalog orders. Inspect promptly and reconcile lot/CoA references on receipt.' => 'الشحن الأوروبي المبرد مشمول لطلبات الكتالوج. افحص الشحنة بسرعة وطابق مراجع الدفعة و CoA عند الاستلام.',
		'Store unopened lyophilized material frozen at -20°C or according to the lot CoA/SDS. Protect from light and moisture and minimize temperature cycling.' => 'تخزن المادة المجففة غير المفتوحة عند -20°C أو حسب CoA/SDS للدفعة. احمها من الضوء والرطوبة وقلل دورات تغير الحرارة.',
		'Reference validated laboratory SOPs only. Not for human or veterinary use, diagnosis, treatment, injection, or consumption.' => 'ارجع فقط إلى إجراءات تشغيل مختبرية موثقة. غير مخصص للاستخدام البشري أو البيطري أو التشخيص أو العلاج أو الحقن أو الاستهلاك.',
		'For research use only. Not for human or veterinary use. Not for diagnosis, treatment, injection, or consumption.' => 'للاستخدام البحثي فقط. غير مخصص للاستخدام البشري أو البيطري أو التشخيص أو العلاج أو الحقن أو الاستهلاك.',
		'Purity' => 'النقاء',
		'Storage' => 'التخزين',
		'Reconstitution' => 'إرشادات التحضير',
		'Shipping notes' => 'ملاحظات الشحن',
		'Batch reference' => 'مرجع الدفعة',
		'Research disclaimer' => 'إخلاء مسؤولية بحثي',
		'Browse the catalog' => 'تصفح الكتالوج',
		'Reach the team' => 'تواصل مع الفريق',
		'Email' => 'البريد الإلكتروني',
		'Phone' => 'الهاتف',
		'Hours' => 'ساعات العمل',
		'Core disclaimer' => 'إخلاء المسؤولية الأساسي',
		'Shipping note' => 'ملاحظة الشحن',
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
		return 'ببتيدات بحثية موثقة مع إرشادات التخزين والشحن';
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
	if ( 'ar' !== azure_synthetics_current_language() ) {
		return $label;
	}

	$labels = array(
		'Amount'    => 'الكمية',
		'Pack Size' => 'حجم العبوة',
	);

	return $labels[ $label ] ?? $label;
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
