<?php
/**
 * Checkout Form
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in() ) {
  echo do_shortcode( '[woocommerce_my_account]' );
  echo '<hr/>';
	echo '<h5 class="callout medium-padding">' . apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) . '</h5>';
	return;
}

?>

<?php if ( $checkout->get_checkout_fields() ) do_action( 'g365_collect_data_fields' ); ?>

<form id="woocommerce-checkout-form" name="checkout" method="post" class="checkout woocommerce-checkout ogp-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

    <header class="entry-header">
        <h2 class="entry-title"><?php _e( 'Checkout', 'woocommerce' ); ?></h2>
    </header>

    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="grid-x grid-margin-x" id="customer_details">
			<div class="cell small-12 medium-6 gray-bg small-padding">
				<?php
        do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="cell small-12 medium-6 gray-bg small-padding">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
      
		</div>

    <div class="waiver-container ">
        <h2>Waiver and Release of Liability</h2>
      <p>In consideration of being allowed to participate in, attend, and/or observe as a participant, parent and or spectator, in any event or program (the “Programs) of Open Gym Premier, LLC (“OGP”) including any event or program operated under the name or brand of any subsidiary or partner entity or brand including but not limited to Elite Basketball Circuit (“EBC”), Grassroots 365 (“G365”), Pulse Athletics ("Pulse"), The Stage Circuit (The Stage), Scholastic Series ("SS"), Hype Her Hoops ("HHH"), Youth Basketball League ("YBL), The Passport and or Sports Boardroom (collectively the “Providers”) consisting of sports, activities and or sporting events, including but not limited to basketball and volleyball events and programs such as club teams, camps, tournaments, leagues, and training, or any other sporting events and related activities (collectively “Activities”), at any facility used for the Activities (the “Premises”), the below signed participant, and the participant’s parent(s) or legal guardian(s) if the participant is a minor and or spectator, agree to waive, release and discharge the Providers and each of their respective officers, directors, employees, representatives, affiliates, successors and assigns as follows:</p>
      <p><span class="waiver__sub-heading">CONSENT OF A MINOR</span>: Any children age 13 or under must have a parent present to complete this release waiver and consent form. If a child under the age of 13 completes this release waiver and consent form without the knowledge of a parent, the parent should reach out to the Provider immediately. A parent can contact the Provider at any time to address, restrict or remove any online profile or publicity of personal information that is within the control of the Provider. If a parent or child(ren) experience any challenge participating in the youth sports programs offered by the Provider due to an unwillingness to provide personal information or consent to the terms and conditions set for by the Provider, the parent should contact the Provider in writing, addressed to management, with specific concerns, examples and requests. </p>
      <p><span class="waiver__sub-heading">MEDICAL RELEASE</span>: Pursuant to the provisions of sections 6910 et seq. of the California Family Code, and other applicable laws, I hereby authorize Providers to procure and consent to, medical, hospital or dental care for myself or my child in the event of injury as a result of participation in the Providers’ Programs or Activities.</p>
      <p><span class="waiver__sub-heading">COVID-19</span>: I understand that Providers cannot prevent the presence of COVID-19 at the Premises or prevent the possibility that me or my child(ren) will be exposed to, contract with, or spread COVID-19 while entering into and or utilizing the Premises. I am aware of and acknowledge the seriousness of the risks associated with COVID-19. I HEREBY CHOOSE TO ACCEPT THE RISK OF CONTRACTING AND/OR SPREADING COVID-19 FOR MYSELF AND/OR MY CHILD(REN) IN ORDER TO BE ALLOWED TO ENTER INTO AND UTILIZE THE PREMISES. In consideration of my participation in the Programs or Activities and on behalf of myself, and any of all of my family members, minor child(ren), my heirs, successors, assigns and personal representatives and each of them, having voluntarily and knowingly entered the Premises , I HEREBY FOREVER RELEASE AND WAIVE MY RIGHT TO BRING SUIT AGAINST THE PROVIDERS THEIR OWNERS, OFFICERS, DIRECTORS, MANAGERS, OFFICIALS, TRUSTEES, AGENTS, EMPLOYEES, AFFILIATES AND OR OTHER REPRESENTATIVES (RELEASED PARTIES) IN CONNECTION WITH ANY AND ALL EXPOSURE, INFECTION, AND/OR SPREAD OF COVID-19 RELATED TO ME AND/OR MY CHILD(REN) ENTERING INTO AND OR UTILIZING THE PREMISES. I understand that this waiver and release means that I have forever discharged the released parties and give up all of my right to bring any claims, actions, lawsuits, demands for damages and or losses, including for personal injuries, death, disease or property losses, or any other loss, including but not limited to claims of negligence and give up any claim I or my child(ren) may have to seek damages against the Released Parties, whether known or unknown, foreseen or unforeseen to the maximum extent allowed by law.</p>
      <p><span class="waiver__sub-heading">PHOTO/VIDEO RELEASE</span>: I hereby agree to allow and authorize the Providers to use my child(ren)’s photograph and/or video for publicity of Providers ongoing Programs and Activities. I hereby agree to allow and authorize the Providers to use my own or my child(ren)'s photograph and/or video for publicity of Providers ongoing Programs and Activities. </p>
      <p><span class="waiver__sub-heading">WEBSITE/SOCIAL MEDIA RELEASE</span>: I hereby agree to allow and authorize my child(ren)'s name, image, likeness and any related content on any and all platforms of social media in the interest of creating awareness, recognition and support for the Providers. This consent shall remain in effect in perpetuity. I acknowledge that if a specific article is removed from a website or social media, the content may be found on other public online or social media platforms as a result of sharing, reposting or copying. I waive any and all liability for any damages or claims arising out of the Provider using my own or my child(ren)'s name, image and likeness on a website or social media platform.</p>
      <p><span class="waiver__sub-heading">CONSENT TO PERSONAL INFORMATION</span>: I acknowledge that the Provider is collecting or my child(ren)'s personal information in order to produce public, online profiles featuring my child(ren)'s youth sports accomplishments, pictures, videos, awards, statistics and any other key metrics related to youth sports performance. The information obtained is used only for specific reasons related to the nature of the youth sports services we provide. If parent or child(ren) does not consent to publication of any related data, personal information, photograph, video or any aspect of name, image or likeness, they must notify the Provider in advance of participating in any program or event. </p>
      <p><span class="waiver__sub-heading">WAIVER AND RELEASE OF LIABILITY</span>: In consideration of my participation in the Providers Programs and Activities or as an attending parent or spectator at the Premises, I HEREBY RELEASE, DISCHARGE AND COVENANT NOT TO SUE the Providers, their owners, officers, directors, employees, representatives and volunteers, from any and all present and future claims, demands, actions, payment and/or reimbursement of medical expenses, or causes of action resulting from any accidents, injuries, deaths, or loss of and/or damage to my/our person(s) or property arising out of or connected with my/our participation in any Programs and Activities while at the Premises. I hereby voluntarily waive any and all claims resulting from negligence or otherwise both present and future, which may be made by me, my family, estate, heirs, or assigns. Further, I am aware that the Programs and Activities may involve certain risks or possible dangers, including death, and that equipment provided for my protection may be inadequate to prevent serious injury. I am voluntarily participating in these Programs and Activities with knowledge of the danger involved and hereby agree to accept any and all inherent risks of property damage, personal injury, or death. I further agree to indemnify and hold harmless the Providers, their owners, officers, directors, employees, representatives and volunteers for any and all claims arising as a result of my engaging in the Programs and Activities. I understand that this waiver is intended to be as broad and inclusive as permitted by the laws of the State of California or any other State in which the Programs or Activities take place and I agree that if any portion is held invalid, the remainder of the waiver will continue in full legal force and effect. I affirm that I am of legal age and am freely signing this document. I HAVE READ THIS FORM AND FULLY UNDERSTAND THAT BY SIGNING THIS FORM, I AM GIVING UP LEGAL RIGHTS AND/OR REMEDIES WHICH MAY BE AVAILABLE TO ME AGAINST THE PROVIDERS.</p>
      <p><span class="waiver__sub-heading">UNKNOWN CLAIMS</span>: The releases contained in this document are intended as a full and complete release of all liability of any nature whatsoever for all damage, injury, loss, expense, including any consequential expense, loss or damage, whether the same are now known or unknown to the undersigned, expected, or unexpected by the undersigned, or have appeared or developed, and all rights under Section 1542 of the California Civil Code are hereby expressly waived and relinquished. Section 1542 of the California Civil Code provides as follows:</p>
      <blockquote>
      <p><strong>“A general release does not extend to claims that the creditor or releasing party does not know or suspect to exist in his or her favor at the time of executing the release and that, if known by him or her, would have materially affected his or her settlement with the debtor or released party.”</strong></p>
      </blockquote>
      <p>This Waiver and Release of Liability is entered into at Anaheim, California and shall remain effective as long as the undersigned participates in and or attends any of Providers’ Programs or Activities. The venue and jurisdiction for any action concerning or relating to this Waiver and Release shall be in Orange County, California.</p>


        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
        <script>
        hbspt.forms.create({
            region: "na1",
            portalId: "9435817",
            formId: "b3da1391-f323-4816-b26e-0de035ccff22"
        });
        </script>

    </div>
    <h3 id="order_review_heading" class="medium-margin-top"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    <p>
        <strong>Refund Policy:</strong> No refunds, all sales are final.
   </p>

    <div id="order_review" class="woocommerce-checkout-review-order">
      <?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>

    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
