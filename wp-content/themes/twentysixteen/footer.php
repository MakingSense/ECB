<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


	 <footer class="component--footer">
	   <h2>Stay in Touch</h2>
	   <p>Sign up to receive our monthly newsletter and receive the latest Ecocity news</p>
      <!--Begin CTCT Sign-Up Form-->
      	<!-- EFD 1.0.0 [Mon Sep 26 08:32:50 EDT 2016] -->
         <div class="subscribe-container ctct-embed-signup" >
             <span id="success_message" style="display:none;">
                 <div style="text-align:center;">Thanks for signing up!</div>
             </span>
             <form data-id="embedded_signup:form" class="ctct-custom-form Form" name="embedded_signup" method="POST" action="https://visitor2.constantcontact.com/api/signup">

                 <!-- The following code must be included to ensure your sign-up form works properly. -->
                 <input data-id="ca:input" type="hidden" name="ca" value="f99de5de-dc09-47d1-bc25-5f778694a5d5">
                 <input data-id="list:input" type="hidden" name="list" value="2080365734">
                 <input data-id="source:input" type="hidden" name="source" value="EFD">
                 <input data-id="required:input" type="hidden" name="required" value="list,email">
                 <input data-id="url:input" type="hidden" name="url" value="">
                 <p data-id="Email Address:p" ></p>
                     <label data-id="Email Address:label" data-name="email" class="ctct-form-required">
                         <input data-id="Email Address:input" type="text" name="email" value="" maxlength="80" placeholder="Email">
                     </label>
                 <button type="submit" class="subscribe-button Button ctct-button Button--block Button-secondary" data-enabled="enabled">Subscribe</button>
             </form>
         </div>
      <!--End CTCT Sign-Up Form-->

	   <div class="mobile-only">
			 <nav class="component--social-menu">
			   <a class="menuitem" href="https://www.facebook.com/ecocitybuilders/" target="_blank">
			     <span class="ms-icon icon-facebook-white-socialico"></span>
			   </a>
			   <a class="menuitem" href="https://twitter.com/ecocitybuilder" target="_blank">
			     <span class="ms-icon icon-twitter-white-socialico"></span>
			   </a>
			   <a class="menuitem" href="https://www.instagram.com/ecocitybuilders/" target="_blank">
			     <span class="ms-icon icon-linkedin-white-socialico"></span>
			   </a>
			 </nav>
	   </div>

	   <span class="contact-container">
	     <span class="pipe">Ecocity Builders</span>
	     <span class="pipe">399 15th Street, Suite 208</span>
	     <span class="pipe">Oakland, CA 94612</span>
	     <span>510-452-9522</span>
	   </span>

	   <hr>

	   <div class="bottom-container">
	     <span class="legal-container">
	       <a class="pipe" href="#">Privacy Policy</a>
	       <a class="pipe" href="#">Terms & Conditions</a>
	       <span>© 2016 Ecocity Builders. All Rights Reserved.</span>
	     </span>

	     <div class="desktop-only">
					 <nav class="component--social-menu">
		 				  <a class="menuitem" href="https://www.facebook.com/ecocitybuilders/" target="_blank">
		 				    <span class="ms-icon icon-facebook-white-socialico"></span>
		 				  </a>
		 				  <a class="menuitem" href="https://twitter.com/ecocitybuilder" target="_blank">
		 				    <span class="ms-icon icon-twitter-white-socialico"></span>
		 				  </a>
		 				  <a class="menuitem" href="https://www.instagram.com/ecocitybuilders/" target="_blank">
		 				    <span class="ms-icon icon-linkedin-white-socialico"></span>
		 				  </a>
	 				</nav>
	     </div>
	   </div>
	 </footer>

</div><!-- .main-wrapper  -->

<script type='text/javascript'>
   var localizedErrMap = {};
   localizedErrMap['required'] = 		'This field is required.';
   localizedErrMap['ca'] = 			'An unexpected error occurred while attempting to send email.';
   localizedErrMap['email'] = 			'Please enter your email address in name@email.com format.';
   localizedErrMap['list'] = 			'Please select at least one email list.';
   localizedErrMap['generic'] = 		'This field is invalid.';
   localizedErrMap['shared'] = 		'Sorry, we could not complete your sign-up. Please contact us to resolve this.';
   var postURL = 'https://visitor2.constantcontact.com/api/signup';
</script>
<script type='text/javascript' src='https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/js/signup-form.js'></script>
<!--End CTCT Sign-Up Form-->
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/vendor/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/vendor/flexibility.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/vendor/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/scripts.min.js"></script>
</body>
 <?php wp_footer(); ?>
</html>
