			<?php
               session_start();
               $currentTime = time();
               if (isset($_SESSION['auth']) && $currentTime < $_SESSION['expire']) {
                    include('autheader.php');
               } else {
                    session_unset();
                    session_destroy();
                    include('header.php');
               }
               ?>

			<div class="site-blocks-cover inner-page" style="background-image: url('images/hero_1.jpg');">
			     <div class="container">
			          <div class="row">
			               <div class="col-lg-7 mx-auto align-self-center">
			                    <div class=" text-center">
			                         <h1>About Us</h1>
			                         <p>NID Africa offers natural medicine alternatives of ayurvedic origin, including vitamins & and minerals, beauty products, nutritional drinks, toiletries, and other topical health products. </p>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section bg-light custom-border-bottom" data-aos="fade">
			     <div class="container">
			          <div class="row mb-5">
			               <div class="col-md-6">
			                    <div class="block-16">
			                         <figure>
			                              <img src="images/bg_1.jpg" alt="Image placeholder" class="img-fluid rounded">
			                              <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="icon-play"></span></a>

			                         </figure>
			                    </div>
			               </div>
			               <div class="col-md-1"></div>
			               <div class="col-md-5">


			                    <div class="site-section-heading pt-3 mb-4">
			                         <h2 class="text-black">Who we are</h2>
			                    </div>
			                    <p>Where health has become a major concern, we, NID Africa, have developed complete healthcare solutions of Ayurvedic origin manufactured by North India Pvt. Ltd. (NID).</p>
			                    <p>
			                         NID manufactures authentic and herbal medicines, including beauty Products, nutritional drinks, toiletries, and other topical health products like hand sanitizers. Our products are Positioned at the high end of the market in terms of quality and price.
			                         NID Africa offers natural medicine alternatives, including vitamins & minerals. We assure you that all medications are completely of Ayurvedic origin and natural.
			                    </p>

			               </div>
			          </div>
			     </div>
			</div>



			<div class="site-section bg-light custom-border-bottom" data-aos="fade">
			     <div class="container">
			          <div class="row mb-5">
			               <div class="col-md-6 order-md-2">
			                    <div class="block-16">
			                         <figure>
			                              <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded">
			                              <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="icon-play"></span></a>

			                         </figure>
			                    </div>
			               </div>
			               <div class="col-md-5 mr-auto">


			                    <div class="site-section-heading pt-3 mb-4">
			                         <h2 class="text-black">We are trusted</h2>
			                    </div>
			                    <p class="text-black">
			                         North India Pharma Pvt. Ltd. is the fastest-growing Ayurvedic medicines manufacturer, supplier, & exporter from Karnal, Haryana (India). We manufacture and distribute Ayurvedic medicines all over India and internationally in extension. Since our establishment in 2012, we have become one of India's top ten Ayurvedic capsule manufacturers. We are a well-knitted team committed to leveraging Ayurvedic medical science and pulling our resources to enhance well-being at every stage of life.
			                    </p>
			                    <p class="text-black">
			                         North India Pharma Pvt. Ltd. Is a GMP-certified Ayurvedic medicines manufacturer, with years of experience to back us. Because of that, it has an unmatchable reputation for developing, manufacturing, and distributing medicines to treat various illnesses. We take pride in our commitment to operate at the highest quality standards and create and supply products that enhance the value of healthcare systems. Due to this, we are a certified Good Manufacturing Practice (G.M.P) company. We are one of the distinguished manufacturers and developers of a wide range of Ayurvedic products for many diseases in the form of Ayurvedic capsules, tablets, creams, gels, syrups, etc., through our advanced and latest machines to formulate the comprehensive range of herbal products as per Industrial standards.
			                         Naturetwig Impex (Nig.) Ltd. RC number: 1456256 is the Exclusive Distributor of North India Pharma Pvt. Ltd. In Nigeria and West Africa in, extension.
			                    </p>

			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
			     <div class="container">
			          <div class="row">
			               <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
			                    <div class="icon mr-4 align-self-start">
			                         <span class="icon-truck text-primary"></span>
			                    </div>
			                    <div class="text">
			                         <h2>Free Shipping</h2>
			                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan
			                              tincidunt fringilla.</p>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
			                    <div class="icon mr-4 align-self-start">
			                         <span class="icon-refresh2 text-primary"></span>
			                    </div>
			                    <div class="text">
			                         <h2>Free Returns</h2>
			                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan
			                              tincidunt fringilla.</p>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
			                    <div class="icon mr-4 align-self-start">
			                         <span class="icon-help text-primary"></span>
			                    </div>
			                    <div class="text">
			                         <h2>Customer Support</h2>
			                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan
			                              tincidunt fringilla.</p>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>


			<div class="site-section bg-light custom-border-bottom" data-aos="fade">
			     <div class="container">
			          <div class="row justify-content-center mb-5">
			               <div class="col-md-7 site-section-heading text-center pt-4">
			                    <h2>The Team</h2>
			               </div>
			          </div>
			          <div class="row">
			               <div class="col-md-6 col-lg-6 mb-5">

			                    <div class="block-38 text-center">
			                         <div class="block-38-img">
			                              <div class="block-38-header">
			                                   <img src="images/person_1.jpg" alt="Image placeholder" class="mb-4">
			                                   <h3 class="block-38-heading h4">Elizabeth Graham</h3>
			                                   <p class="block-38-subheading">CEO/Co-Founder</p>
			                              </div>
			                              <div class="block-38-body">
			                                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio
			                                        recusandae doloribus ut fugit officia voluptate soluta. </p>
			                              </div>
			                         </div>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-6 mb-5">
			                    <div class="block-38 text-center">
			                         <div class="block-38-img">
			                              <div class="block-38-header">
			                                   <img src="images/person_2.jpg" alt="Image placeholder" class="mb-4">
			                                   <h3 class="block-38-heading h4">Jennifer Greive</h3>
			                                   <p class="block-38-subheading">Co-Founder</p>
			                              </div>
			                              <div class="block-38-body">
			                                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio
			                                        recusandae doloribus ut fugit officia voluptate soluta. </p>
			                              </div>
			                         </div>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-6 mb-5">
			                    <div class="block-38 text-center">
			                         <div class="block-38-img">
			                              <div class="block-38-header">
			                                   <img src="images/person_3.jpg" alt="Image placeholder" class="mb-4">
			                                   <h3 class="block-38-heading h4">Patrick Marx</h3>
			                                   <p class="block-38-subheading">Marketing</p>
			                              </div>
			                              <div class="block-38-body">
			                                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio
			                                        recusandae doloribus ut fugit officia voluptate soluta. </p>
			                              </div>
			                         </div>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-6 mb-5">
			                    <div class="block-38 text-center">
			                         <div class="block-38-img">
			                              <div class="block-38-header">
			                                   <img src="images/person_4.jpg" alt="Image placeholder" class="mb-4">
			                                   <h3 class="block-38-heading h4">Mike Coolbert</h3>
			                                   <p class="block-38-subheading">Sales Manager</p>
			                              </div>
			                              <div class="block-38-body">
			                                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae aut minima nihil sit distinctio
			                                        recusandae doloribus ut fugit officia voluptate soluta. </p>
			                              </div>
			                         </div>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>

			<?php
               include('footer.php');

               ?>