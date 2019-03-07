@if(@Auth::user()->role =='writer'))
@include('layouts.gentella')
@else
<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>

<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group" style="">
			@include('layouts.speedy.main')
		</div>
		@if(!Auth::user())
		<div class="sidebar sidebar-1 four columns"><div class="widget-area clearfix " style="min-height: 685px;"><aside id="widget_mfn_menu-4" class="widget widget_mfn_menu"><div class="menu-all-container"><ul id="menu-all" class="menu submenus-show"><li id="menu-item-96" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-96"><a href="http://www.hwexperts.com/corporate-intellectual-property-rights/">CORPORATE INTELLECTUAL PROPERTY RIGHTS</a></li>
<li id="menu-item-97" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-97"><a href="http://www.hwexperts.com/disclaimer/">Disclaimer</a></li>
<li id="menu-item-98" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-98"><a href="http://www.hwexperts.com/faq/">FAQ</a></li>
<li id="menu-item-100" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-100"><a href="http://www.hwexperts.com/how-it-works/">How it works</a></li>
<li id="menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-101"><a href="http://www.hwexperts.com/information-security/">INFORMATION SECURITY</a></li>
<li id="menu-item-102" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-102"><a href="http://www.hwexperts.com/money-back-guarantee/">Money Back Guarantee</a></li>
<li id="menu-item-103" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-103"><a href="http://www.hwexperts.com/our-terms/">Our Terms</a></li>
<li id="menu-item-104" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-104"><a href="http://www.hwexperts.com/privacy-policy/">PRIVACY POLICY</a></li>
<li id="menu-item-105" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-105"><a href="http://www.hwexperts.com/revision-policy/">REVISION POLICY</a></li>
<li id="menu-item-107" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-107"><a href="http://www.hwexperts.com/terms-of-use/">Terms of use</a></li>
</ul></div></aside></div></div>
<style type="text/css">
.sections_group{
width: 75%; float:left;
}
</style>
		@endif
			
	</div>
</div>

<?php get_footer();
?>
@endif