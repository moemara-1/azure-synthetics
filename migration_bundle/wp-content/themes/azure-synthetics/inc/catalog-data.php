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
