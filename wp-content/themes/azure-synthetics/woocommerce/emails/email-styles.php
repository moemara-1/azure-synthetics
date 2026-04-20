<?php
/**
 * Email styles.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
body {
	background-color: #f3f0e8;
	font-family: "Geist", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
	color: #0f1921;
}

#wrapper {
	background-color: #f3f0e8;
}

#template_container {
	border-radius: 28px;
	background-color: #fbf8f2;
	box-shadow: 0 24px 48px rgba(15, 25, 33, 0.08);
}

#template_header {
	background: linear-gradient(135deg, #09141a 0%, #102532 56%, #08141a 100%);
	border-radius: 28px 28px 0 0;
}

#template_header h1 {
	font-family: "Funnel Sans", "Avenir Next", "Segoe UI", sans-serif;
	font-weight: 700;
	color: #f4faf9;
}

#body_content_inner,
#body_content_inner p,
#body_content_inner td,
.td {
	color: #2c3943;
	font-family: "Geist", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.td,
.address {
	border-color: #d8d1c3 !important;
}

a {
	color: #2f8698;
}

.button {
	border-radius: 999px;
	background: #70c9bf;
	color: #0f1921;
}
