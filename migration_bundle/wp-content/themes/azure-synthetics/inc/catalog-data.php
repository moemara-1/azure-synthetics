<?php
/**
 * Catalog data for seeded products and localized product copy.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_get_catalog_categories() {
	return array(
		'glp-1-metabolic'     => array(
			'name'           => __( 'GLP-1 / Metabolic Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث GLP-1 والتمثيل الغذائي',
			'description'    => __( 'Incretin-pathway materials with amount, box value, and COA path visible up front.', 'azure-synthetics' ),
			'description_ar' => 'مواد لمسارات الإنكريتين مع الكمية وقيمة الصناديق ومسار COA بوضوح مسبق.',
		),
		'recovery-repair'     => array(
			'name'           => __( 'Recovery & Repair Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث التعافي والإصلاح',
			'description'    => __( 'Repair-pathway materials organized for fast comparison and repeat ordering.', 'azure-synthetics' ),
			'description_ar' => 'مواد لمسارات الإصلاح مرتبة للمقارنة السريعة وإعادة الطلب.',
		),
		'growth-hormone-axis' => array(
			'name'           => __( 'Growth Hormone Axis Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث محور هرمون النمو',
			'description'    => __( 'GHRH and secretagogue-axis materials with concise proof and format details.', 'azure-synthetics' ),
			'description_ar' => 'مواد محور GHRH ومحفزات الإفراز مع إثبات مختصر وتفاصيل الصيغة.',
		),
		'longevity-anti-aging' => array(
			'name'           => __( 'Longevity Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث طول العمر',
			'description'    => __( 'Mitochondrial, redox, copper-peptide, and cellular-aging research materials in one shelf.', 'azure-synthetics' ),
			'description_ar' => 'مواد بحثية للميتوكوندريا والأكسدة والاختزال وببتيدات النحاس والشيخوخة الخلوية في رف واحد.',
		),
		'cognitive-nootropic' => array(
			'name'           => __( 'Cognitive & Nootropic Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث الإدراك والنوتروبيك',
			'description'    => __( 'Neuropeptide materials with clean pricing, amount, and documentation cues.', 'azure-synthetics' ),
			'description_ar' => 'مواد ببتيدية عصبية مع تسعير وكمية وإشارات توثيق واضحة.',
		),
		'body-composition'    => array(
			'name'           => __( 'Body Composition Research', 'azure-synthetics' ),
			'name_ar'        => 'أبحاث تكوين الجسم',
			'description'    => __( 'Receptor and pathway materials for body-composition research comparisons.', 'azure-synthetics' ),
			'description_ar' => 'مواد مستقبلات ومسارات لمقارنات أبحاث تكوين الجسم.',
		),
		'peptide-support'     => array(
			'name'           => __( 'Peptide Support Research', 'azure-synthetics' ),
			'name_ar'        => 'مواد داعمة لأبحاث الببتيدات',
			'description'    => __( 'Support materials and supplies that round out peptide orders.', 'azure-synthetics' ),
			'description_ar' => 'مواد داعمة ومستلزمات تكمل طلبات الببتيدات.',
		),
	);
}

function azure_synthetics_localized_catalog_category_field( array $category, $field ) {
	if ( function_exists( 'azure_synthetics_current_language' ) && 'ar' === azure_synthetics_current_language() ) {
		$localized_key = $field . '_ar';

		if ( ! empty( $category[ $localized_key ] ) ) {
			return $category[ $localized_key ];
		}
	}

	return $category[ $field ] ?? '';
}

function azure_synthetics_get_catalog_products() {
	return array(
		array( 'name' => 'Tirzepatide', 'category' => 'glp-1-metabolic', 'focus' => 'dual incretin receptor-signaling research models', 'focus_ar' => 'نماذج بحثية لمسارات مستقبلات الإنكريتين المزدوجة', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 104.99, 'box' => 446.99 ), array( 'amount' => '10mg', 'vial' => 179.99, 'box' => 764.99 ), array( 'amount' => '15mg', 'vial' => 218.99, 'box' => 930.99 ) ) ),
		array( 'name' => 'Retatrutide', 'category' => 'glp-1-metabolic', 'focus' => 'multi-agonist incretin-pathway research', 'focus_ar' => 'أبحاث مسارات الإنكريتين متعددة الناهضات', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 124.99, 'box' => 531.99 ), array( 'amount' => '20mg', 'vial' => 136.99, 'box' => 582.99 ), array( 'amount' => '30mg', 'vial' => 249.99, 'box' => 1062.99 ) ) ),
		array( 'name' => 'Mazdutide', 'category' => 'glp-1-metabolic', 'focus' => 'glucagon and GLP-1 pathway research', 'focus_ar' => 'أبحاث مسارات الجلوكاجون و GLP-1', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 138.99, 'box' => 590.99 ) ) ),
		array( 'name' => 'BPC-157', 'category' => 'recovery-repair', 'focus' => 'gastric peptide analog and tissue-signaling assay models', 'focus_ar' => 'نماذج بحثية لنظائر الببتيد المعدي وإشارات الأنسجة', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 40.99, 'box' => 174.99 ), array( 'amount' => '10mg', 'vial' => 52.99, 'box' => 225.99 ) ) ),
		array( 'name' => 'TB-500', 'category' => 'recovery-repair', 'focus' => 'thymosin beta-4 fragment and cell-migration assay models', 'focus_ar' => 'أبحاث جزء ثيموسين بيتا-4 ونماذج هجرة الخلايا', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 43.99, 'box' => 186.99 ), array( 'amount' => '10mg', 'vial' => 54.99, 'box' => 233.99 ) ) ),
		array( 'name' => 'BPC-157 + TB-500 Blend', 'category' => 'recovery-repair', 'focus' => 'paired peptide signaling and comparative assay workflows', 'focus_ar' => 'أبحاث إشارات الببتيدات المزدوجة وسير عمل المقارنة المعملية', 'amounts' => array( array( 'amount' => '5mg + 5mg', 'vial' => 59.99, 'box' => 254.99 ), array( 'amount' => '10mg + 10mg', 'vial' => 81.99, 'box' => 348.99 ) ) ),
		array( 'name' => 'KLOW Blend', 'category' => 'recovery-repair', 'focus' => 'multi-component peptide blend inventory studies', 'focus_ar' => 'أبحاث مخزون الخلطات الببتيدية متعددة المكونات', 'amounts' => array( array( 'amount' => '80mg', 'vial' => 142.99, 'box' => 607.99 ) ) ),
		array( 'name' => 'CJC-1295 (No DAC)', 'category' => 'growth-hormone-axis', 'focus' => 'GHRH analog research in no-DAC format', 'focus_ar' => 'أبحاث نظائر GHRH بصيغة بدون DAC', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 34.99, 'box' => 148.99 ), array( 'amount' => '10mg', 'vial' => 60.99, 'box' => 259.99 ) ) ),
		array( 'name' => 'CJC-1295 with DAC', 'category' => 'growth-hormone-axis', 'focus' => 'DAC-modified GHRH analog research', 'focus_ar' => 'أبحاث نظائر GHRH المعدلة بـ DAC', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 49.99, 'box' => 212.99 ) ) ),
		array( 'name' => 'Ipamorelin', 'category' => 'growth-hormone-axis', 'focus' => 'growth hormone secretagogue receptor research', 'focus_ar' => 'أبحاث مستقبلات محفزات إفراز هرمون النمو', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 35.99, 'box' => 152.99 ), array( 'amount' => '10mg', 'vial' => 44.99, 'box' => 191.99 ) ) ),
		array( 'name' => 'GHRP-2', 'category' => 'growth-hormone-axis', 'focus' => 'secretagogue receptor research', 'focus_ar' => 'أبحاث مستقبلات محفزات الإفراز', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 25.99, 'box' => 110.99 ), array( 'amount' => '10mg', 'vial' => 32.99, 'box' => 140.99 ) ) ),
		array( 'name' => 'GHRP-6', 'category' => 'growth-hormone-axis', 'focus' => 'secretagogue receptor research', 'focus_ar' => 'أبحاث مستقبلات محفزات الإفراز', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 25.99, 'box' => 110.99 ), array( 'amount' => '10mg', 'vial' => 33.99, 'box' => 144.99 ) ) ),
		array( 'name' => 'Hexarelin', 'category' => 'growth-hormone-axis', 'focus' => 'hexapeptide secretagogue receptor research', 'focus_ar' => 'أبحاث مستقبلات محفزات الإفراز للببتيدات السداسية', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 42.99, 'box' => 182.99 ) ) ),
		array( 'name' => 'Sermorelin', 'category' => 'growth-hormone-axis', 'focus' => 'GHRH analog research', 'focus_ar' => 'أبحاث نظائر GHRH', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 45.99, 'box' => 195.99 ) ) ),
		array( 'name' => 'Tesamorelin', 'category' => 'growth-hormone-axis', 'focus' => 'GHRH analog research', 'focus_ar' => 'أبحاث نظائر GHRH', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 58.99, 'box' => 250.99 ) ) ),
		array( 'name' => 'HGH', 'category' => 'growth-hormone-axis', 'focus' => 'somatotropin reference-material research', 'focus_ar' => 'أبحاث المواد المرجعية للسوماتوتروبين', 'amounts' => array( array( 'amount' => '10iu', 'vial' => 59.99, 'box' => 254.99 ) ) ),
		array( 'name' => 'GHK-Cu', 'category' => 'longevity-anti-aging', 'focus' => 'copper peptide and matrix-signaling assay context', 'focus_ar' => 'أبحاث ببتيدات النحاس وسياق إشارات المصفوفة', 'amounts' => array( array( 'amount' => '50mg', 'vial' => 56.99, 'box' => 242.99 ), array( 'amount' => '100mg', 'vial' => 74.99, 'box' => 318.99 ) ) ),
		array( 'name' => 'Epitalon', 'category' => 'longevity-anti-aging', 'focus' => 'tetrapeptide cellular-aging assay context', 'focus_ar' => 'أبحاث ببتيدات رباعية في سياق فحوصات شيخوخة الخلايا', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 46.99, 'box' => 199.99 ), array( 'amount' => '50mg', 'vial' => 112.99, 'box' => 480.99 ) ) ),
		array( 'name' => 'NAD+', 'category' => 'longevity-anti-aging', 'focus' => 'cofactor research and redox assay workflows', 'focus_ar' => 'أبحاث العوامل المساعدة وسير عمل فحوصات الأكسدة والاختزال', 'amounts' => array( array( 'amount' => '500mg', 'vial' => 65.99, 'box' => 280.99 ) ) ),
		array( 'name' => 'MOTS-C', 'category' => 'longevity-anti-aging', 'focus' => 'mitochondrial-derived peptide research', 'focus_ar' => 'أبحاث الببتيدات المشتقة من الميتوكوندريا', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 62.99, 'box' => 267.99 ), array( 'amount' => '40mg', 'vial' => 105.99, 'box' => 450.99 ) ) ),
		array( 'name' => 'SS-31 (Elamipretide)', 'category' => 'longevity-anti-aging', 'focus' => 'mitochondrial peptide research', 'focus_ar' => 'أبحاث الببتيدات الميتوكوندرية', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 48.99, 'box' => 208.99 ), array( 'amount' => '50mg', 'vial' => 155.99, 'box' => 662.99 ) ) ),
		array( 'name' => 'SLU-PP-332', 'category' => 'longevity-anti-aging', 'focus' => 'ERR pathway research material', 'focus_ar' => 'مادة بحثية لمسارات ERR', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 46.99, 'box' => 199.99 ) ) ),
		array( 'name' => 'Thymosin Alpha-1', 'category' => 'longevity-anti-aging', 'focus' => 'immune-signaling peptide research', 'focus_ar' => 'أبحاث ببتيدات إشارات المناعة', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 36.99, 'box' => 157.99 ), array( 'amount' => '10mg', 'vial' => 88.99, 'box' => 378.99 ) ) ),
		array( 'name' => 'Glutathione', 'category' => 'longevity-anti-aging', 'focus' => 'redox assay support research', 'focus_ar' => 'أبحاث داعمة لفحوصات الأكسدة والاختزال', 'amounts' => array( array( 'amount' => '600mg', 'vial' => 44.99, 'box' => 191.99 ) ) ),
		array( 'name' => 'Selank', 'category' => 'cognitive-nootropic', 'focus' => 'neuropeptide analog research', 'focus_ar' => 'أبحاث نظائر الببتيدات العصبية', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 50.99, 'box' => 216.99 ), array( 'amount' => '10mg', 'vial' => 37.99, 'box' => 161.99 ) ) ),
		array( 'name' => 'Semax', 'category' => 'cognitive-nootropic', 'focus' => 'ACTH fragment analog research', 'focus_ar' => 'أبحاث نظائر أجزاء ACTH', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 29.99, 'box' => 127.99 ), array( 'amount' => '10mg', 'vial' => 44.99, 'box' => 191.99 ) ) ),
		array( 'name' => 'DSIP', 'category' => 'cognitive-nootropic', 'focus' => 'delta sleep-inducing peptide reference research', 'focus_ar' => 'أبحاث مرجعية لببتيد DSIP', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 28.99, 'box' => 123.99 ), array( 'amount' => '10mg', 'vial' => 50.99, 'box' => 216.99 ) ) ),
		array( 'name' => 'VIP (Vasoactive Intestinal Peptide)', 'category' => 'cognitive-nootropic', 'focus' => 'vasoactive intestinal peptide research', 'focus_ar' => 'أبحاث الببتيد المعوي الفعال وعائيا', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 65.99, 'box' => 280.99 ) ) ),
		array( 'name' => 'AOD-9604', 'category' => 'body-composition', 'focus' => 'fragment 177-191 pathway research', 'focus_ar' => 'أبحاث مسارات الجزء 177-191', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 40.99, 'box' => 174.99 ) ) ),
		array( 'name' => 'IGF-1 LR3', 'category' => 'body-composition', 'focus' => 'IGF-1 receptor-signaling research', 'focus_ar' => 'أبحاث إشارات مستقبل IGF-1', 'amounts' => array( array( 'amount' => '1mg', 'vial' => 132.99, 'box' => 565.99 ) ) ),
		array( 'name' => 'FOXO4-DRI', 'category' => 'body-composition', 'focus' => 'FOXO4-p53 interaction research', 'focus_ar' => 'أبحاث تفاعل FOXO4-p53', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 195.99, 'box' => 832.99 ) ) ),
		array( 'name' => 'Adipotide', 'category' => 'body-composition', 'focus' => 'prohibitin-targeting peptide research', 'focus_ar' => 'أبحاث الببتيدات المستهدفة للبروهيبيتين', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 39.99, 'box' => 169.99 ) ) ),
		array( 'name' => 'AICAR', 'category' => 'body-composition', 'focus' => 'AMPK-pathway research material', 'focus_ar' => 'مادة بحثية لمسار AMPK', 'amounts' => array( array( 'amount' => '50mg', 'vial' => 49.99, 'box' => 212.99 ) ) ),
		array( 'name' => 'Melanotan 1', 'category' => 'body-composition', 'focus' => 'melanocortin receptor research', 'focus_ar' => 'أبحاث مستقبلات الميلانوكورتين', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 41.99, 'box' => 178.99 ) ) ),
		array( 'name' => 'Melanotan 2', 'category' => 'body-composition', 'focus' => 'melanocortin receptor research', 'focus_ar' => 'أبحاث مستقبلات الميلانوكورتين', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 41.99, 'box' => 178.99 ) ) ),
		array( 'name' => 'PT-141', 'category' => 'peptide-support', 'focus' => 'melanocortin receptor research', 'focus_ar' => 'أبحاث مستقبلات الميلانوكورتين', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 40.99, 'box' => 174.99 ) ) ),
		array( 'name' => 'Kisspeptin-10', 'category' => 'peptide-support', 'focus' => 'kisspeptin receptor research', 'focus_ar' => 'أبحاث مستقبلات كيسبيبتين', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 53.99, 'box' => 229.99 ) ) ),
		array( 'name' => 'Gonadorelin', 'category' => 'peptide-support', 'focus' => 'GnRH research material', 'focus_ar' => 'مادة بحثية لـ GnRH', 'amounts' => array( array( 'amount' => '2mg', 'vial' => 58.99, 'box' => 250.99 ) ) ),
		array( 'name' => 'LL-37', 'category' => 'peptide-support', 'focus' => 'cathelicidin peptide research', 'focus_ar' => 'أبحاث ببتيد الكاثليسيدين', 'amounts' => array( array( 'amount' => '5mg', 'vial' => 47.99, 'box' => 203.99 ) ) ),
		array( 'name' => 'KPV', 'category' => 'peptide-support', 'focus' => 'tripeptide research material', 'focus_ar' => 'مادة بحثية للببتيدات الثلاثية', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 48.99, 'box' => 208.99 ) ) ),
		array( 'name' => 'SNAP-8', 'category' => 'peptide-support', 'focus' => 'acetyl octapeptide research material', 'focus_ar' => 'مادة بحثية للأوكتابيبتيد الأسيتيل', 'amounts' => array( array( 'amount' => '10mg', 'vial' => 34.99, 'box' => 148.99 ) ) ),
		array( 'name' => 'PEG-MGF', 'category' => 'peptide-support', 'focus' => 'mechanogrowth factor analog research', 'focus_ar' => 'أبحاث نظائر عامل النمو الميكانيكي', 'amounts' => array( array( 'amount' => '2mg', 'vial' => 49.99, 'box' => 212.99 ) ) ),
		array( 'name' => 'Bacteriostatic Water', 'category' => 'peptide-support', 'focus' => 'laboratory diluent support for validated research workflows only', 'focus_ar' => 'مادة مخبرية داعمة للتخفيف ضمن سير عمل بحثي موثق فقط', 'amounts' => array( array( 'amount' => '10ml', 'vial' => 7.99, 'box' => 33.99 ) ) ),
	);
}

function azure_synthetics_catalog_slug( $name ) {
	$slug = strtolower( remove_accents( $name ) );
	$slug = preg_replace( '/[^a-z0-9]+/', '-', $slug );
	$slug = trim( $slug, '-' );

	return $slug ?: 'catalog-product';
}

function azure_synthetics_catalog_sku( $name ) {
	return 'AZ-' . strtoupper( azure_synthetics_catalog_slug( $name ) );
}

function azure_synthetics_catalog_amount_summary( array $product ) {
	$amounts = wp_list_pluck( $product['amounts'], 'amount' );

	return 1 === count( $amounts ) ? $amounts[0] : implode( ' / ', $amounts );
}

function azure_synthetics_catalog_image_filename( array $product ) {
	return 'products/' . azure_synthetics_catalog_slug( $product['name'] ) . '.png';
}

function azure_synthetics_catalog_product_copy( array $product, $field = 'description', $lang = 'en' ) {
	$categories = azure_synthetics_get_catalog_categories();
	$category   = $categories[ $product['category'] ] ?? reset( $categories );
	$amounts    = azure_synthetics_catalog_amount_summary( $product );

	if ( 'ar' === $lang ) {
		$category_name = $category['name_ar'] ?? $category['name'];
		$focus         = $product['focus_ar'] ?? $product['focus'];

		if ( 'short' === $field ) {
			return sprintf( '%s مع هدف نقاء 99%%+ ومسار COA للدفعة وتسعير واضح.', $amounts );
		}

		if ( 'subtitle' === $field ) {
			return sprintf( '%s | %s', $category_name, $amounts );
		}

		if ( 'descriptor' === $field ) {
			return $category_name;
		}

		return sprintf(
			'%1$s مادة بحثية مجففة بالتجميد لسياق %2$s. قارن الكمية، سعر الفيال، قيمة صندوق الخمس فيالات، هدف النقاء 99%%+، مسار COA، ملف التخزين، ومراجعة الشحن قبل الدفع.',
			$product['name'],
			$focus
		);
	}

	$category_name = $category['name'];

	if ( 'short' === $field ) {
		return sprintf( '%s with 99%%+ target purity, COA and lot workflow, and clear pricing.', $amounts );
	}

	if ( 'subtitle' === $field ) {
		return sprintf( '%s | %s', $category_name, $amounts );
	}

	if ( 'descriptor' === $field ) {
		return $category_name;
	}

	return sprintf(
		'%1$s is listed for %2$s with %3$s formats. Compare vial price, five-vial box value, 99%%+ target purity, COA and lot workflow, storage profile, and shipping review before checkout.',
		$product['name'],
		$product['focus'],
		$amounts
	);
}

function azure_synthetics_catalog_product_profiles() {
	return array(
		'Tirzepatide' => array(
			'mechanism' => 'Dual GIP and GLP-1 receptor agonist literature is used to compare incretin signaling, glucose-handling markers, appetite-pathway models, and metabolic endpoint design.',
			'signals'  => array(
				'Metabolic research literature studies glucose regulation, insulin-response markers, and body-weight endpoints in the incretin drug class.',
				'Buyer context: high-comparison material where amount ladder, price, purity target, and COA path need to be visible before checkout.',
			),
		),
		'Retatrutide' => array(
			'mechanism' => 'Triple agonist literature compares GLP-1, GIP, and glucagon receptor signaling in metabolic-marker and energy-balance research models.',
			'signals'  => array(
				'Investigational literature centers on A1C, body-weight, lipid, and liver-fat endpoints across metabolic research designs.',
				'Positioned as a research-context molecule only; no approved-use claim is made for catalog material.',
			),
		),
		'Mazdutide' => array(
			'mechanism' => 'Dual GLP-1 and glucagon receptor agonist literature is used to compare incretin signaling, energy-expenditure models, and metabolic biomarker endpoints.',
			'signals'  => array(
				'Research literature explores glucose-handling, weight-related, and hepatic/metabolic marker endpoints.',
				'Useful for comparing higher-value metabolic research formats beside purity, COA, and storage data.',
			),
		),
		'BPC-157' => array(
			'mechanism' => 'Stable gastric pentadecapeptide research is used to compare angiogenesis, fibroblast migration, cytoprotection, and tissue-repair pathway models.',
			'signals'  => array(
				'Preclinical literature explores tendon, ligament, muscle, gut-barrier, wound-repair, and cytoprotective pathways.',
				'Human evidence remains limited, so the listing frames possible therapeutic effects as literature signals rather than product outcomes.',
			),
		),
		'TB-500' => array(
			'mechanism' => 'Thymosin beta-4 fragment literature is used to compare actin binding, cell migration, angiogenesis, and tissue-remodeling assay models.',
			'signals'  => array(
				'Preclinical literature studies cell migration, wound-repair, inflammation-resolution, and connective-tissue remodeling pathways.',
				'Pairs naturally with COA, purity, and storage visibility because repeat research buyers often compare it against BPC-157 formats.',
			),
		),
		'BPC-157 + TB-500 Blend' => array(
			'mechanism' => 'Blend literature context compares BPC-157 repair-pathway models with thymosin beta-4 fragment cell-migration and remodeling models.',
			'signals'  => array(
				'Research interest centers on paired angiogenesis, fibroblast migration, connective-tissue, and wound-repair pathway models.',
				'The blend format is presented for comparative lab workflows, not as a combined protocol.',
			),
		),
		'KLOW Blend' => array(
			'mechanism' => 'Multi-component blend context is used for comparing inventory planning, pathway overlap, and batch-documentation needs across a larger research format.',
			'signals'  => array(
				'Research value is framed around multi-compound comparison, bulk economics, and repeat-order planning.',
				'Best suited to buyers checking amount, box value, storage, and verification route before support review.',
			),
		),
		'CJC-1295 (No DAC)' => array(
			'mechanism' => 'GHRH analog literature without DAC is used to compare shorter GH-axis pulse models and IGF-1 biomarker workflows.',
			'signals'  => array(
				'Endocrine research literature explores GH and IGF-1 axis biomarkers, pituitary signaling, and secretagogue comparison models.',
				'Shown as assay and biomarker context only, without performance or body-effect promises.',
			),
		),
		'CJC-1295 with DAC' => array(
			'mechanism' => 'DAC-modified GHRH analog literature is used to compare extended half-life design, GH-axis biomarkers, and IGF-1 signaling models.',
			'signals'  => array(
				'Research literature studies longer-acting GHRH analog exposure and endocrine biomarker response patterns.',
				'Useful for comparing no-DAC and DAC formats beside purity, amount, and COA route.',
			),
		),
		'Ipamorelin' => array(
			'mechanism' => 'Growth hormone secretagogue receptor literature is used to compare ghrelin-receptor signaling and GH-axis biomarker models.',
			'signals'  => array(
				'Endocrine research studies GH release markers, IGF-1 context, and selective secretagogue pathway models.',
				'Often compared with CJC formats for companion inventory planning and lab workflow design.',
			),
		),
		'GHRP-2' => array(
			'mechanism' => 'GHRP secretagogue literature is used to compare ghrelin-receptor signaling, GH-axis biomarker response, and appetite-pathway assay models.',
			'signals'  => array(
				'Research literature explores GH release markers, IGF-1 context, and endocrine signaling pathways.',
				'Catalog value comes from fast comparison of amount, price, storage, and proof route.',
			),
		),
		'GHRP-6' => array(
			'mechanism' => 'GHRP-6 literature is used to compare ghrelin-receptor signaling, GH-axis biomarkers, and appetite-related research models.',
			'signals'  => array(
				'Endocrine literature studies GH/IGF-1 markers and ghrelin-pathway response models.',
				'Presented as pathway context for research buyers, not as an appetite or performance claim.',
			),
		),
		'Hexarelin' => array(
			'mechanism' => 'Hexapeptide secretagogue literature is used to compare GHS-R signaling, GH-axis biomarkers, and receptor-response assay models.',
			'signals'  => array(
				'Research literature studies GH release markers, pituitary signaling, and receptor-selectivity comparisons.',
				'Single-format listing keeps amount, purity, and COA route quick to scan.',
			),
		),
		'Sermorelin' => array(
			'mechanism' => 'GHRH analog literature is used to compare pituitary GHRH receptor signaling, GH pulse models, and IGF-1 biomarker workflows.',
			'signals'  => array(
				'Endocrine research studies GH-axis biomarkers, pituitary signaling, and analog comparison models.',
				'Listing copy keeps mechanism, amount, and proof details close to the price.',
			),
		),
		'Tesamorelin' => array(
			'mechanism' => 'Stabilized GHRH analog literature is used to compare GH-axis signaling, IGF-1 markers, and visceral-adiposity research endpoints.',
			'signals'  => array(
				'Clinical and endocrine literature includes GH/IGF-1 markers and body-composition research endpoints.',
				'Shown as literature context only; the catalog page does not make therapeutic or body-effect claims.',
			),
		),
		'HGH' => array(
			'mechanism' => 'Somatotropin reference-material context is used to compare GH receptor signaling, IGF-1 marker workflows, and assay-control planning.',
			'signals'  => array(
				'Research use centers on endocrine assay design, receptor-signaling context, and reference-material comparison.',
				'The listing focuses on amount, storage, and verification route rather than clinical-use positioning.',
			),
		),
		'GHK-Cu' => array(
			'mechanism' => 'Copper peptide literature is used to compare matrix remodeling, collagen signaling, wound-repair, antioxidant, and inflammation-pathway models.',
			'signals'  => array(
				'Research literature explores skin regeneration, wound repair, collagen expression, matrix remodeling, and antioxidant defense pathways.',
				'Presented as research literature context, not a cosmetic, wound-care, or medical claim.',
			),
		),
		'Epitalon' => array(
			'mechanism' => 'Tetrapeptide aging-biology literature is used to compare telomerase, pineal peptide, circadian, and cellular-senescence research models.',
			'signals'  => array(
				'Longevity literature explores telomere biology, cellular aging markers, circadian signaling, and oxidative-stress models.',
				'The listing frames these as research signals and keeps proof, amount, and storage details visible.',
			),
		),
		'NAD+' => array(
			'mechanism' => 'NAD+ cofactor literature is used to compare sirtuin, PARP, redox, mitochondrial, and cellular-energy assay workflows.',
			'signals'  => array(
				'Research literature explores redox balance, mitochondrial metabolism, DNA-repair enzyme context, and cellular-energy markers.',
				'The product is positioned as research material with storage and verification details, not as supplementation copy.',
			),
		),
		'MOTS-C' => array(
			'mechanism' => 'Mitochondrial-derived peptide literature is used to compare AMPK signaling, metabolic homeostasis, inflammation, and aging-biology models.',
			'signals'  => array(
				'Translational literature explores insulin-resistance models, metabolic stress, inflammation, and exercise-mimetic signaling.',
				'These are researched possible therapeutic signals from the literature, not stated effects of any Azure product.',
			),
		),
		'SS-31 (Elamipretide)' => array(
			'mechanism' => 'Mitochondria-targeted tetrapeptide literature is used to compare cardiolipin binding, cristae stability, oxidative stress, and bioenergetic models.',
			'signals'  => array(
				'Research literature explores mitochondrial dysfunction, oxidative-stress, cardiac, renal, and skeletal-muscle pathway models.',
				'Listed as research context for proof comparison, not as a disease or organ-function claim.',
			),
		),
		'SLU-PP-332' => array(
			'mechanism' => 'ERR agonist literature is used to compare transcriptional signaling, energy metabolism, mitochondrial biogenesis, and endurance-pathway models.',
			'signals'  => array(
				'Research literature explores metabolic programming, mitochondrial markers, and exercise-mimetic pathway models.',
				'The listing avoids performance claims and keeps the focus on pathway research and proof visibility.',
			),
		),
		'Thymosin Alpha-1' => array(
			'mechanism' => 'Immune-signaling peptide literature is used to compare T-cell maturation, toll-like receptor context, cytokine markers, and immune-response models.',
			'signals'  => array(
				'Research literature studies immune modulation, T-cell signaling, viral-response models, and inflammation markers.',
				'Presented as immunology research context, not as immune-support positioning.',
			),
		),
		'Glutathione' => array(
			'mechanism' => 'Tripeptide redox literature is used to compare antioxidant capacity, oxidative-stress markers, detoxification enzymes, and cellular-protection assays.',
			'signals'  => array(
				'Research literature explores oxidative stress, mitochondrial redox balance, detoxification pathways, and inflammation markers.',
				'The listing positions it as redox assay material with visible storage and proof details.',
			),
		),
		'Selank' => array(
			'mechanism' => 'Neuropeptide analog literature is used to compare GABAergic signaling, neuroimmune pathways, stress-response models, and cognitive markers.',
			'signals'  => array(
				'Research literature explores anxiety-like behavior models, stress response, cognition, and neuroimmune signaling.',
				'Shown as neuroscience literature context only, not as an anxiolytic or cognitive-use claim.',
			),
		),
		'Semax' => array(
			'mechanism' => 'ACTH fragment analog literature is used to compare BDNF/NGF expression, monoamine signaling, neuroprotection, and cognition models.',
			'signals'  => array(
				'Research literature explores neuroprotection, ischemia models, learning/memory markers, BDNF, and NGF pathways.',
				'The listing keeps possible therapeutic effects framed as literature signals, not product promises.',
			),
		),
		'DSIP' => array(
			'mechanism' => 'Delta sleep-inducing peptide literature is used to compare sleep architecture, stress-axis, opioid-peptide, and neuroendocrine research models.',
			'signals'  => array(
				'Research literature explores sleep-state markers, stress response, pain models, and neuroendocrine signaling.',
				'Presented as research context, not as sleep, pain, or wellness positioning.',
			),
		),
		'VIP (Vasoactive Intestinal Peptide)' => array(
			'mechanism' => 'VIP receptor literature is used to compare VPAC signaling, neuroimmune modulation, vascular signaling, and inflammatory pathway models.',
			'signals'  => array(
				'Research literature explores immune modulation, vasodilation pathways, pulmonary and gut-barrier models, and inflammation markers.',
				'The product page frames these as pathway signals only, without therapeutic claims.',
			),
		),
		'AOD-9604' => array(
			'mechanism' => 'HGH fragment 177-191 literature is used to compare lipid metabolism, adipocyte signaling, and body-composition research models.',
			'signals'  => array(
				'Research literature explores lipolysis, fat-metabolism markers, and body-composition endpoints.',
				'Listed as body-composition research context, not as weight-loss positioning.',
			),
		),
		'IGF-1 LR3' => array(
			'mechanism' => 'Long-acting IGF-1 analog literature is used to compare IGF-1 receptor signaling, cellular growth, differentiation, and anabolic pathway models.',
			'signals'  => array(
				'Research literature explores IGF-1 receptor activity, protein synthesis markers, cell proliferation, and tissue-development models.',
				'The listing avoids performance claims and focuses on assay context, amount, and verification.',
			),
		),
		'FOXO4-DRI' => array(
			'mechanism' => 'FOXO4-p53 interaction literature is used to compare senescence, apoptosis-signaling, DNA-damage response, and cellular-aging models.',
			'signals'  => array(
				'Research literature explores senescent-cell models, p53 pathway interaction, tissue-aging markers, and cell-survival signaling.',
				'Presented as cellular-aging research context, not as an anti-aging therapeutic claim.',
			),
		),
		'Adipotide' => array(
			'mechanism' => 'Prohibitin-targeting peptide literature is used to compare vascular targeting, adipose-tissue models, and body-composition research endpoints.',
			'signals'  => array(
				'Preclinical literature explores adipose vasculature, body-composition endpoints, and metabolic-marker models.',
				'The listing does not imply weight-loss use; it keeps the context in research-model language.',
			),
		),
		'AICAR' => array(
			'mechanism' => 'AMPK-pathway literature is used to compare cellular energy sensing, glucose uptake models, mitochondrial signaling, and endurance biology.',
			'signals'  => array(
				'Research literature explores AMPK activation, metabolic stress, glucose-handling markers, and exercise-mimetic models.',
				'Presented as pathway research material, not as performance or metabolic-outcome copy.',
			),
		),
		'Melanotan 1' => array(
			'mechanism' => 'Melanocortin receptor literature is used to compare MC1R signaling, pigmentation-pathway models, and photobiology research endpoints.',
			'signals'  => array(
				'Research literature explores melanogenesis, pigmentation models, and photoprotection pathway signals.',
				'The listing avoids tanning or cosmetic-use claims and keeps the focus on receptor research.',
			),
		),
		'Melanotan 2' => array(
			'mechanism' => 'Melanocortin agonist literature is used to compare MC1R, MC3R, and MC4R signaling across pigmentation and central-pathway models.',
			'signals'  => array(
				'Research literature explores melanogenesis, melanocortin receptor signaling, appetite-pathway models, and sexual-function research endpoints.',
				'Presented as receptor research context only, not as cosmetic-use positioning.',
			),
		),
		'PT-141' => array(
			'mechanism' => 'Bremelanotide melanocortin receptor literature is used to compare MC4R signaling, central arousal pathways, and neuroendocrine models.',
			'signals'  => array(
				'Research literature explores melanocortin signaling, sexual-function endpoints, and CNS pathway models.',
				'The listing states research context only and does not present a libido or clinical-use claim.',
			),
		),
		'Kisspeptin-10' => array(
			'mechanism' => 'KISS1R/GPR54 agonist literature is used to compare GnRH neuron signaling, LH/FSH biomarkers, and reproductive-axis research models.',
			'signals'  => array(
				'Endocrine literature explores HPG-axis signaling, puberty/fertility research models, and gonadotropin biomarker response.',
				'Presented as receptor and biomarker context only, not as reproductive-use positioning.',
			),
		),
		'Gonadorelin' => array(
			'mechanism' => 'Synthetic GnRH literature is used to compare pituitary receptor signaling, LH/FSH biomarker response, and HPG-axis research workflows.',
			'signals'  => array(
				'Endocrine research explores GnRH receptor signaling, gonadotropin markers, and reproductive-axis assay models.',
				'The listing keeps the emphasis on reference-material and verification details.',
			),
		),
		'LL-37' => array(
			'mechanism' => 'Cathelicidin peptide literature is used to compare antimicrobial, innate-immune, wound-repair, and inflammation pathway models.',
			'signals'  => array(
				'Research literature explores host-defense peptides, biofilm models, wound repair, and immune-signaling pathways.',
				'Presented as innate-immunity research context, not as antimicrobial or wound-care positioning.',
			),
		),
		'KPV' => array(
			'mechanism' => 'Alpha-MSH tripeptide fragment literature is used to compare melanocortin-linked anti-inflammatory, gut-barrier, and cytokine pathway models.',
			'signals'  => array(
				'Research literature explores NF-kB signaling, cytokine markers, gut epithelial models, and inflammation pathways.',
				'The listing keeps these as researched possible therapeutic signals, not product outcomes.',
			),
		),
		'SNAP-8' => array(
			'mechanism' => 'Acetyl octapeptide literature is used to compare SNARE-complex interference, neuromuscular signaling, and cosmetic-biochemistry models.',
			'signals'  => array(
				'Research literature explores neurotransmitter-release models, expression-line signaling, and cosmetic peptide assay endpoints.',
				'Presented as biochemical research context, not as a cosmetic effect claim.',
			),
		),
		'PEG-MGF' => array(
			'mechanism' => 'PEGylated mechano-growth factor analog literature is used to compare IGF-1 splice-variant signaling, muscle-cell, and repair-model workflows.',
			'signals'  => array(
				'Research literature explores muscle-cell repair models, satellite-cell signaling, and tissue-remodeling markers.',
				'The listing avoids performance claims and keeps the focus on pathway research and proof route.',
			),
		),
		'Bacteriostatic Water' => array(
			'mechanism' => 'Laboratory diluent support material used to compare preparation workflow, sterile handling context, storage, and companion-order planning.',
			'signals'  => array(
				'No therapeutic effect is claimed; the listing is support-material context for validated research workflows.',
				'Buyer value is practical: clear volume, storage, companion-order fit, and fulfillment review.',
			),
		),
	);
}

function azure_synthetics_catalog_product_profile( array $product, $lang = 'en' ) {
	$amounts = azure_synthetics_catalog_amount_summary( $product );

	if ( 'ar' === $lang ) {
		$focus = $product['focus_ar'] ?? $product['focus'];

		return array(
			'mechanism'    => sprintf( 'سياق بحثي حول %s مع مقارنة الكمية، هدف النقاء، ومسار COA قبل الطلب.', $focus ),
			'verification' => 'هدف نقاء 99%+ مع مسار COA ومرجع دفعة عند التجهيز.',
			'fulfillment'  => 'تتم مراجعة التوفر، الوجهة، الشحن، واحتياجات التوثيق قبل التجهيز.',
			'signals'      => array(
				sprintf( 'تستعرض الأدبيات البحثية إشارات محتملة مرتبطة بسياق %s دون تقديم وعد علاجي.', $focus ),
				sprintf( 'القيمة الشرائية واضحة: %s، سعر الفيال، قيمة الصندوق، التخزين، ومسار الإثبات.', $amounts ),
			),
		);
	}

	$profiles = azure_synthetics_catalog_product_profiles();
	$profile  = $profiles[ $product['name'] ] ?? array(
		'mechanism' => sprintf( 'Research literature is used to compare %s beside amount, purity target, storage, and verification route.', $product['focus'] ),
		'signals'  => array(
			sprintf( 'Research literature explores pathway signals related to %s.', $product['focus'] ),
			'The listing keeps possible therapeutic effects framed as literature context, not stated effects of catalog material.',
		),
	);

	$profile['verification'] = '99%+ target purity with COA, lot-reference handoff, and HPLC/MS identity context reviewed before fulfillment.';
	$profile['fulfillment']  = 'Availability, destination, shipping method, temperature handling, payment route, and document needs are reviewed before fulfillment.';

	return $profile;
}

function azure_synthetics_catalog_product_by_slug( $slug ) {
	foreach ( azure_synthetics_get_catalog_products() as $product ) {
		if ( $slug === azure_synthetics_catalog_slug( $product['name'] ) ) {
			return $product;
		}
	}

	return array();
}

function azure_synthetics_catalog_product_profile_for_product_id( $product_id, $lang = '' ) {
	$product_id = absint( $product_id );
	$lang       = $lang ?: ( function_exists( 'azure_synthetics_current_language' ) ? azure_synthetics_current_language() : 'en' );
	$slug       = get_post_meta( $product_id, '_azure_catalog_slug', true );
	$slug       = $slug ?: get_post_field( 'post_name', $product_id );
	$product    = $slug ? azure_synthetics_catalog_product_by_slug( $slug ) : array();

	if ( empty( $product ) ) {
		$post_title = get_the_title( $product_id );

		foreach ( azure_synthetics_get_catalog_products() as $candidate ) {
			if ( $post_title === $candidate['name'] ) {
				$product = $candidate;
				break;
			}
		}
	}

	return empty( $product ) ? array() : azure_synthetics_catalog_product_profile( $product, $lang );
}
