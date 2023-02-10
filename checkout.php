<?php
require('auth.php');

if (isset($_SESSION["user_id"])) {
     $user_details = $db->SelectAll("SELECT * FROM users WHERE 	user_id = :user_id", ['user_id' => $_SESSION['user_id']]);
     foreach ($user_details as $user) {
          $country = $user['country'];
          $fullName = $user['fullName'];
          $phone = $user['phone'];
          $email = $user['email'];
          $address = $user['address'];
          $company_name = $user['company_name'];
          $state = $user['state'];
     };
}

require 'PHP/octaValidate-PHP-main/src/Validate.php';

use Validate\octaValidate;
//set configuration
$options = array(
     "stripTags" => true,
     "strictMode" => true
);
//create new instance
$myForm = new octaValidate('checkout', $options);
//define rules for each form input name
$valRules = array(
     "new_email" => array(
          ["R", "Your Email Address is required"],
          ["EMAIL", "Your Email Address is invalid!"]
     ),
     "new_fullName" => array(
          ["R", "Your full name is required"],
          ["ALPHA_SPACES", "full name must have spaces"]
     ),
     "new_phone" => array(
          ["R", "Your phone number is required"],
          ["DIGITS", "Number Must contain digits"]
     ),
     "new_address" => array(
          ["R", "Your address address is required"],
          ["ALPHA_SPACES", "Input a valid address"]
     ),
     "new_state" => array(
          ["R", "Your sate number is required"],
          ["ALPHA_ONLY", "State must be an alphabets"]
     ),
);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
     // check if user is adding a different address//

     if (isset($_POST['is_different_address']) && $_POST['is_different_address'] == 1) {
          if ($myForm->validateFields($valRules, $_POST)) {
               // Get values from form //
               $_SESSION['billFullName']  = $_POST['new_fullName'];
               $_SESSION['billEmail'] = $_POST['new_email'];
               $_SESSION['billPhone'] = $_POST['new_phone'];
               $_SESSION['billAddress'] = $_POST['new_address'];
               $_SESSION['billState'] = $_POST['new_state'];
               $_SESSION['billCompany'] = $_POST['new_company_name'];
               $_SESSION['billCountry']  = $_POST['new_country'];


               // insert order//
               // insert order//
               $_SESSION['orderAmount'] = $_POST['total_amount'];
               $_SESSION['order_id'] = md5(time() . $email);
               $total = str_replace(',', '', $_POST['total_amount']);

               print('<script>
               function makePayment() {
               FlutterwaveCheckout({
                    public_key: "FLWPUBK_TEST-686aa30e76c7b416d7064eae9c7b5c42-X",
                    tx_ref: "titanic-48981487343MDI0NzMx",
                    amount: ' . $total . ' ,
                    currency: "NGN",
                    payment_options: "card, banktransfer, ussd",
                    redirect_url: "thankyou.php",
                    meta: {
                    consumer_id: 23,
                    consumer_mac: "92a3-912ba-1192a",
                    },
                    customer: {
                    email: "' . $_POST['email'] . '",
                    phone_number: ' . $_POST['phone'] . ',
                    name: "' . $_POST['fullName'] . '",
                    },
                    customizations: {
                    title: "The Titanic Store",
                    description: "Payment for an awesome cruise",
                    logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
                    },
               });
               }

               makePayment();
          </script>');
          } else {
               //return errors
               print('<script>
               document.addEventListener("DOMContentLoaded", function(){
                    showErrors(' . json_encode($myForm->getErrors()) . ');
                    toastr.error(" please fille the needed information for different billing information.",{timeOut: 10000});
          });</script>');
          };
     } else {
          // use default billing information from the users database //
          // Get values from form //
          $_SESSION['billFullName'] = $_POST['fullName'];
          $_SESSION['billEmail'] = $_POST['email'];
          $_SESSION['billPhone'] = $_POST['phone'];
          $_SESSION['billAddress'] = $_POST['address'];
          $_SESSION['billState'] = $_POST['state'];
          $_SESSION['billCompany'] = $_POST['companyName'];
          $_SESSION['billCountry'] = $_POST['country'];

          // insert order//
          $_SESSION['orderAmount'] = $_POST['total_amount'];
          $_SESSION['order_id'] = md5(time() . $email);
          $total = str_replace(',', '', $_POST['total_amount']);

          print('<script>
               function makePayment() {
               FlutterwaveCheckout({
                    public_key: "FLWPUBK_TEST-686aa30e76c7b416d7064eae9c7b5c42-X",
                    tx_ref: "titanic-48981487343MDI0NzMx",
                    amount: ' . $total . ' ,
                    currency: "NGN",
                    payment_options: "card, banktransfer, ussd",
                    redirect_url: "thankyou.php",
                    meta: {
                    consumer_id: 23,
                    consumer_mac: "92a3-912ba-1192a",
                    },
                    customer: {
                    email: "' . $_POST['email'] . '",
                    phone_number: ' . $_POST['phone'] . ',
                    name: "' . $_POST['fullName'] . '",
                    },
                    customizations: {
                    title: "The Titanic Store",
                    description: "Payment for an awesome cruise",
                    logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
                    },
               });
               }

               makePayment();
          </script>');
     }
}
?>

<div class="bg-light py-3">
     <div class="container">
          <div class="row">
               <div class="col-md-12 mb-0">
                    <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Checkout</strong>
               </div>
          </div>
     </div>
</div>

<div class="site-section">
     <div class="container">
          <?php
          if (!isset($_SESSION['auth']) && !isset($_SESSION["user_id"])) {
          ?>
               <div class="row mb-5">
                    <div class="col-md-12">
                         <div class="bg-light rounded p-3">
                              <p class="mb-0">You need to login to continue <a href="login.php" class="d-inline-block">Click here</a> to login or <a href="signup.php" class="d-inline-block">Click here</a> to signup</p>
                         </div>
                    </div>
               </div>
          <?php
          } else {
          ?>
               <!-- Billing details -->
               <form action="" method="post" id="checkout">
                    <div class="row">
                         <div class="col-md-6 mb-5 mb-md-0">
                              <h2 class="h3 mb-3 text-black">Billing Details</h2>
                              <div class="p-3 p-lg-5 border">
                                   <div class="form-group">
                                        <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                        <input readonly type="text" name="country" class="form-control" value="<?= $country ?>">
                                   </div>
                                   <div class="form-group">
                                        <div class="col-md-12">
                                             <label for="c_fname" class="text-black">Full Name <span class="text-danger">*</span></label>
                                             <input readonly name="fullName" type="text" class="form-control" value="<?= $fullName ?>">
                                        </div>
                                   </div>

                                   <div class="form-group row">
                                        <div class="col-md-12">
                                             <label for="c_companyname" class="text-black">Company Name </label>
                                             <input readonly type="text" name="companyName" class="form-control" value="<?= $company_name ?>" id="c_companyname">
                                        </div>
                                   </div>

                                   <div class="form-group row">
                                        <div class="col-md-12">
                                             <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                             <input readonly type="text" name="address" class="form-control" id="c_address" value="<?= $address ?>" placeholder="Street address">
                                        </div>
                                   </div>

                                   <div class="form-group">
                                        <input readonly type="text" name="state" class="form-control" value="<?= $state ?>" placeholder="State">
                                   </div>
                                   <!-- 
                         <div class="form-group row">
                              <div class="col-md-12">
                                   <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                                   <input readonly type="text" class="form-control" id="c_state_country" name="c_state_country">
                              </div>
                              <div class="col-md-6">
                                   <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                   <input readonly type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                              </div>
                         </div> -->

                                   <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                             <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                             <input readonly name="email" type="text" value="<?= $email ?>" class="form-control" id="c_email_address">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                             <input readonly name="phone" type="text" value="<?= $phone ?>" class="form-control" id="c_phone" placeholder="Phone Number">
                                        </div>
                                   </div>

                                   <!-- <div class="form-group">
                              <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
                              <div class="collapse" id="create_an_account">
                                   <div class="py-2">
                                        <p class="mb-3">Create an account by entering the information below. If you are a returning customer
                                             please login at the top of the page.</p>
                                        <div class="form-group">
                                             <label for="c_account_password" class="text-black">Account Password</label>
                                             <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                                        </div>
                                   </div>
                              </div>
                         </div> -->


                                   <!-- if the want to use another billing input  -->
                                   <div class="form-group">

                                        <label for="c_ship_different_address" class="text-black" data-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" name="is_different_address" value="1" id="c_ship_different_address">
                                             Ship To A Different Address?</label>
                                        <div class="collapse" id="ship_different_address">
                                             <div class="py-2">

                                                  <div class="form-group">
                                                       <select id="country" name="new_country" class="form-control fadeIn second">
                                                            <option value=" Afghanistan">Afghanistan</option>
                                                            <option value="Åland Islands">Åland Islands</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">Central African Republic</option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic</option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">French Southern Territories</option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macao">Macao</option>
                                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                            <option value="New Caledonia">New Caledonia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria" selected="selected">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian Federation</option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Helena">Saint Helena</option>
                                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                            <option value="Taiwan">Taiwan</option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Timor-leste">Timor-leste</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Viet Nam">Viet Nam</option>
                                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                            <option value="Western Sahara">Western Sahara</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                       </select>
                                                  </div>


                                                  <div class="form-group row">
                                                       <div class="col-md-12">
                                                            <label for="c_diff_fname" class="text-black">Full Name<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="c_diff_fname" name="new_fullName">
                                                       </div>
                                                  </div>

                                                  <div class="form-group row">
                                                       <div class="col-md-12">
                                                            <label for="c_diff_companyname" class="text-black">Company Name </label>
                                                            <input type="text" class="form-control" id="new_company_name" name="new_company_name">
                                                       </div>
                                                  </div>

                                                  <div class="form-group row">
                                                       <div class="col-md-12">
                                                            <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="c_diff_address" name="new_address" placeholder="Street address">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <input type="text" class="form-control" placeholder="State" name="new_state">
                                                  </div>

                                                  <!-- <div class="form-group row">
                                                  <div class="col-md-12">
                                                       <label for="c_diff_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" id="c_diff_state_country" name="new_country">
                                                  </div>
                                                  <div class="col-md-6">
                                                       <label for="c_diff_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
                                                  </div>
                                             </div> -->

                                                  <div class="form-group row mb-5">
                                                       <div class="col-md-12">
                                                            <label for="c_diff_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="c_diff_email_address" name="new_email">
                                                       </div>
                                                       <div class="col-md-12">
                                                            <label for="c_diff_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="c_diff_phone" name="new_phone" placeholder="Phone Number">
                                                       </div>
                                                  </div>

                                             </div>
                                        </div>
                                   </div>

                              </div>

                              <div class="form-group">
                                   <label for="c_order_notes" class="text-black">Order Notes</label>
                                   <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                              </div>

                         </div>
                         <div class="col-md-6">
                              <!-- Coupon Code -->
                              <div class="row mb-5">
                                   <div class="col-md-12">
                                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                                        <div class="p-3 p-lg-5 border">

                                             <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                                             <div class="input-group w-75">
                                                  <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                                                  <div class="input-group-append">
                                                       <button class="btn btn-primary btn-sm px-4" type="button" id="button-addon2">Apply</button>
                                                  </div>
                                             </div>

                                        </div>
                                   </div>
                              </div>

                              <div class="row mb-5">
                                   <div class="col-md-12">
                                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                                        <div class="p-3 p-lg-5 border">
                                             <table class="table site-block-order-table mb-5">
                                                  <thead>
                                                       <th>Product</th>
                                                       <th>Total</th>
                                                  </thead>
                                                  <tbody>
                                                       <?php
                                                       $total = 0;
                                                       foreach ($_SESSION['shopping_cart'] as $keys => $value) {
                                                            $total = $total + ($value['item_quantity'] * $value['item_price']);
                                                       ?>
                                                            <tr>
                                                                 <td><?= $value['item_name'] ?><strong class="mx-2">x</strong><?= $value['item_quantity'] ?></td>
                                                                 <td><?php echo number_format($value['item_price'], 2) ?></td>
                                                            </tr>
                                                       <?php
                                                       }
                                                       ?>
                                                       <tr>
                                                            <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                                            <td class="text-black">$ <?php echo number_format($value['item_quantity'] * $value["item_price"], 2); ?></td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                            <td class="text-black font-weight-bold"><strong>$ <?php echo number_format($value['item_quantity'] * $value["item_price"], 2); ?></strong></td>
                                                            <td lass="text-black font-weight-bold">
                                                                 <input name="total_amount" value="<?= number_format($total, 2) ?>" type="text" hidden>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>

                                             <div class="border mb-3">
                                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                                  <div class="collapse" id="collapsebank">
                                                       <div class="py-2 px-4">
                                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                                                                 payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="border mb-3">
                                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                                  <div class="collapse" id="collapsecheque">
                                                       <div class="py-2 px-4">
                                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                                                                 payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="border mb-5">
                                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                                  <div class="collapse" id="collapsepaypal">
                                                       <div class="py-2 px-4">
                                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                                                                 payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <button type="submit" class="btn btn-primary btn-lg btn-block">Place
                                                       Order</button>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </form>
          <?php
          };
          ?>

     </div>
</div>

<!-- onclick="window.location='thankyou.html'" -->


<div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
     <div class="container">
          <div class="row align-items-stretch">
               <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                         <div class="banner-1-inner align-self-center">
                              <h2>Pharma Products</h2>
                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                              </p>
                         </div>
                    </a>
               </div>
               <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                         <div class="banner-1-inner ml-auto  align-self-center">
                              <h2>Rated by Experts</h2>
                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                              </p>
                         </div>
                    </a>
               </div>
          </div>
     </div>
</div>



<?php
require('footer.php');
?>