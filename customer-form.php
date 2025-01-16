<?php
// Check if $customers is set and is an array
$isEditing = isset($customers) && is_array($customers);
// echo'<pre>';
// print_r($customers);

    // [photo_path] => https://api.randomuser.me/portraits/men/25.jpg
    // [id_card_front] => documents/3650244262337/front-side.jpg
    // [id_card_back] => documents/3650244262337/back-side.jpg
    // [next_of_kin_id_card_front] => documents/3650244262337/NOK-front-side.jpg
    // [next_of_kin_id_card_back] => documents/3650244262337/NOK-back-side.jpg

?>


<!-- Error on the page -->
<div class="box bg-light-green success-box hidden">
                                            <div class="box-header bg-light-green ">
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                                </div>
                                                <h3 class="box-title "><i class="text-white  icon-thumbs-up"></i>
                                    <span class="text-white">SUCCESS</span>
                                </h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body " style="display: block;">
                                                <p class="text-white   success-msg "></p>
                                            </div>
                                        </div>





<div class="box bg-red error-box hidden" >
                                            <div class="box-header bg-red">
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                                    </span>
                                                </div>
                                                <h3 class="box-title "><i class="text-white fontello-cancel-circled"></i>
                                    <span class="text-white">ERROR</span>
                                </h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body " style="display: block;">
                                                <p class="text-white error-msg" > Change a few things up and try submitting again.</p>
                                            </div>
</div>

<!-- ------------------------------------------- -->
   
   <form id="<?php echo $isEditing ? 'customerEditForm' : 'customerForm'; ?>" action="customerController.php" method="POST">
        <div class="large-6 columns">
        <h4>Personal Information</h4>
        
        <div class="row">
            <div class="large-12 columns">
                <label class="custom-file-upload">
                    <div class="large-6 columns div1">
                            <img src="img/user.png" style="width:60px"/>
                            Click to upload Photo
                            <input type="file" id="photo" name="photo" style="display:none" />
                    </div>
                    <div class="large-6 columns right">        
                        
                        <input type="hidden" id="photoPath" name="photo_path" value="<?php echo $isEditing ? htmlspecialchars($customers['photo_path']) : ''; ?>" />
                        <div id="PhotoPreview" style="margin-top: 10px">
                            <img id="photoImg" src="<?php echo $isEditing ? htmlspecialchars($customers['photo_path']) : ''; ?>" alt="Uploaded Photo" style="width: 170px;" />
                        </div>
                    </div>
                    </label>
            </div>        
        </div>
    
            <div class="row">
                <div class="large-12 columns">
                    <label>Full Name: <small>As Per ID Card</small>
                        <input type="text" autocomplete="none" name="name"  placeholder="Full Name" required pattern="[a-zA-Z ]+"  value="<?php echo $isEditing ? htmlspecialchars($customers['name']) : ''; ?>" />
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Father/Husband Name: <small>As Per ID Card</small>
                        <input type="text" autocomplete="none" name="fname" placeholder="Father Name" required pattern="[a-zA-Z ]+" value="<?php echo $isEditing ? htmlspecialchars($customers['fname']) : ''; ?>" />
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                                                <div class="email-field error">
                                                    <label>Email <small>required</small>
                                                        <input type="email" name="email" required="" data-invalid="" aria-invalid="true"  value="<?php echo $isEditing ? htmlspecialchars($customers['email']) : ''; ?>">
                                                    </label>
                                                    <!-- <small class="error">An email address is required.</small> -->
                                                </div></div></div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Phone:
                        <input type="text" id="phone" class="phone" autocomplete="none" name="phone" placeholder="92300XXXXXXX" required value="<?php echo $isEditing ? htmlspecialchars($customers['phone']) : ''; ?>" />                     </label>
                    <small class="error" style="display:none">Invalid entry</small>
                </div>
            </div>

            <div class="row">
                <div class="medium-6 columns">
                <label for="city">Select a City</label>
                <input type="text" autocomplete="none" list="cities" id="city" name="city" placeholder="Type to search..." class="input-field" value="<?php echo $isEditing ? htmlspecialchars($customers['city']) : ''; ?>">
                <datalist id="cities">
                    <option value="Karachi">
                    <option value="Lahore">
                    <option value="Faisalabad">
                    <option value="Rawalpindi">
                    <option value="Gujranwala">
                    <option value="Multan">
                    <option value="Hyderabad">
                    <option value="Peshawar">
                    <option value="Quetta">
                    <option value="Islamabad">
                    <option value="Sargodha">
                    <option value="Sialkot">
                    <option value="Bahawalpur">
                    <option value="Jhang">
                    <option value="Sheikhupura">
                    <option value="Gujrat">
                    <option value="Sukkur">
                    <option value="Larkana">
                    <option value="Sahiwal">
                    <option value="Okara">
                    <option value="Rahim Yar Khan">
                    <option value="Kasur">
                    <option value="Dera Ghazi Khan">
                    <option value="Wah Cantonment">
                    <option value="Mardan">
                    <option value="Nawabshah">
                    <option value="Burewala">
                    <option value="Mingora">
                    <option value="Hafizabad">
                    <option value="Chiniot">
                    <option value="Jhelum">
                    <option value="Kamoke">
                    <option value="Khanewal">
                    <option value="Sadiqabad">
                    <option value="Turbat">
                    <option value="Mirpur Khas">
                    <option value="Muridke">
                    <option value="Khanpur">
                    <option value="Bahawalnagar">
                    <option value="Kohat">
                    <option value="Muzaffargarh">
                    <option value="Abbottabad">
                    <option value="Mandi Bahauddin">
                    <option value="Daska">
                    <option value="Pakpattan">
                    <option value="Dera Ismail Khan">
                    <option value="Jacobabad">
                    <option value="Chakwal">
                    <option value="Khuzdar">
                    <option value="Gojra">
                    <option value="Vehari">
                    <option value="Shikarpur">
                    <option value="Ahmedpur East">
                    <option value="Hub">
                    <option value="Chishtian">
                    <option value="Khairpur">
                    <option value="Dadu">
                    <option value="Samundri">
                    <option value="Ferozwala">
                    <option value="Attock">
                    <option value="Tando Adam">
                    <option value="Tando Allahyar">
                    <option value="Jaranwala">
                    <option value="Bolhari">
                    <option value="Muzaffarabad">
                    <option value="Hasilpur">
                    <option value="Kamalia">
                    <option value="Kot Abdul Malik">
                    <option value="Arif Wala">
                    <option value="Gujranwala Cantonment">
                    <option value="Swabi">
                    <option value="Jampur">
                    <option value="Jatoi">
                    <option value="Wazirabad">
                    <option value="Layyah">
                    <option value="Shujabad">
                    <option value="Haroonabad">
                    <option value="Jalalpur Jattan">
                    <option value="Umerkot">
                    <option value="Lodhran">
                    <option value="Moro">
                    <option value="Kot Addu">
                    <option value="Mian Channu">
                    <option value="Khushab">
                    <option value="Rajanpur">
                    <option value="Mansehra">
                    <option value="Taxila">
                    <option value="Mirpur">
                    <option value="Kabal">
                    <option value="Bhakkar">
                    <option value="Narowal">
                    <option value="Chaman">
                    <option value="Mianwali">
                    <option value="Shakargarh">
                    <option value="Mailsi">
                    <option value="Nowshera">
                    <option value="Dipalpur">
                    <option value="Haveli Lakha">
                    <option value="Lala Musa">
                    <option value="Shahdadkot">
                    <option value="Charsadda">
                    <option value="Ghotki">
                    <option value="Sambrial">
                    <option value="Bhalwal">
                    <option value="Badin">
                    <option value="Taunsa Sharif">
                    <option value="Barikot">
                    <option value="Phool Nagar">
                    <option value="Tando Muhammad Khan">
                    <option value="Pattoki">
                    <option value="Shahdadpur">
                    <option value="Jauharabad">
                    <option value="Kamber Ali Khan">
                    <option value="Chichawatni">
                    <option value="Farooqabad">
                    <option value="Pishin">
                    <option value="Dera Murad Jamali">
                    <option value="Kotri">
                    <option value="Sangla Hill">
                    <option value="Gujar Khan">
                    <option value="Kharian">
                    <option value="Pasrur">
                    <option value="Shabqadar">
                    <option value="Kot Radha Kishan">
                    <option value="Ludhewala Waraich">
                    <option value="Renala Khurd">
                    <option value="Kandhkot">
                    <option value="Dera Allah Yar">
                    <option value="Zafarwal">
                </datalist>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Address:
                        <textarea name="address" placeholder="Address" required><?php echo $isEditing ? htmlspecialchars($customers['address']) : ''; ?></textarea>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>ID Card <small>without dashes</small>
                        <input type="text" autocomplete="none" name="id_card" id="id_card" placeholder="ID Card" required value="<?php echo $isEditing ? htmlspecialchars($customers['id_card']) : ''; ?>" />
                        
                    </label>
                    <small class="id_card_error error" style="display:none">Invalid entry</small>
                </div>
            </div>
            
           
            <!-- PHOTO UPLOAD -->
        

            <div id="Photoloader" style="display:none ; margin-top: 10px;">
                    <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
            </div>
            <!-- PHOTO UPLOAD End-->

            <!-- ID card front side -->
        <div class="row">
                <div class="large-12">
                     <label class="custom-file-upload">
               
                    <div class="large-6 columns div1">    
                        <img src="img/id-card.png" style="width:60px"/>Click to upload ID Card Front
                        <i class="fas fa-cloud-upload-alt"></i>
                            <input type="file" id="idCardFrontUpload" name="id_card_front" />
                        <input type="hidden" id="idCardFrontPath" name="id_card_front_path"  value="<?php echo $isEditing ? htmlspecialchars($customers['id_card_front']) : ''; ?>"/>
                    </div>
                    <div class="large-6 columns right">
                        <div id="idCardFrontPreview" style="margin-top: 10px;">
                            <img id="idCardFrontImg" src="<?php echo $isEditing ? htmlspecialchars($customers['id_card_front']) : ''; ?>" alt="Uploaded ID Card Front" style="width: 170px;" />
                        </div>
                    </div>
                    </label>
            </div>
        </div>
            
            
            <div id="idCardFrontLoader" style="display:none ; margin-top: 10px;">
                    <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
            </div>
            <!-- ID Card front side ENDs -->

             <!-- ID card Back side -->
        <div class="row">
             <label class="custom-file-upload">
             <div class="large-12">
                <div class="large-6 columns div1">
                   
                    <img src="img/id-card-back.png" style="width:60px"/>    
                    Click to upload ID Card Back
                    <i class="fas fa-cloud-upload-alt"></i>
                        <input type="file" id="idCardBackUpload" name="id_card_front" style="display:none"  value="<?php echo $isEditing ? htmlspecialchars($customers['id_card_back']) : ''; ?>"/>
                </div>
                <div class="large-6 columns right">
                    <input type="hidden" id="idCardBackPath" name="id_card_back_path" />
                    <div id="idCardBackPreview" style=" margin-top: 10px;">
                        <img id="idCardBackImg" src="<?php echo $isEditing ? htmlspecialchars($customers['id_card_back']) : ''; ?>" alt="Uploaded ID Card Back" style="width: 170px;" />
                    </div>
                </div>
            </label>
            </div>
        </div>
            
            
            <div id="idCardBackLoader" style="display:none ; margin-top: 10px;">
                    <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
            </div>
            <!-- ID Card front Back ENDs -->

        </div>
        <div class="large-6 columns">   
        <h4>Next of Kin's Information</h4>         
            
            <div class="row">
                <div class="large-12 columns">
                    <label>Next of Kin Name:
                        <input type="text" autocomplete="none" name="next_of_kin" placeholder="Full Name" required value="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin']) : ''; ?>" />
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Phone
                        <input type="text" autocomplete="none" name="phone2" class="phone" placeholder="Phone" required  value="<?php echo $isEditing ? htmlspecialchars($customers['phone2']) : ''; ?>"/>
                    </label>
                    <small class="error" style="display:none">Invalid entry</small>
                </div>
            </div>

            


            <div class="row">
                <div class="large-12 columns">
                    <label>Next of Kin ID Card:
                        <input type="text" autocomplete="none" name="next_of_kin_id_card" placeholder="Next of Kin ID Card" required value="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin_id_card']) : ''; ?>" />
                    </label>
                    <small class="error" style="display:none">Invalid entry</small>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Relationship:
                        <input type="text" autocomplete  name="relationship" placeholder="Relationship" required  value="<?php echo $isEditing ? htmlspecialchars($customers['relationship']) : ''; ?>"/>
                    </label>
                </div>
            </div>

           
        
        
             <!-- KIN ID card front side -->
             <div class="row">
                <div class="large-12 columns">
                <label class="custom-file-upload">
                    <div class="large-6 columns">   
                        <img src="img/id-card.png" style="width:60px"/>  Next of Kin ID Card Front:
                            <input type="file" id="idCardNOKFrontUpload" name="id_card_front" style="display:none" />
                    </div>
                    <div class="large-6 columns right">       
                        <input type="hidden" id="idCardNOKFrontPath" name="id_card_NOK_front_path" value="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin_id_card_front']) : ''; ?>" alt="Uploaded ID Card Front" style="width: 170px;" />
                        <div id="idCardNOKFrontPreview" style="; margin-top: 10px;">
                            <img id="idCardNOKFrontImg" src="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin_id_card_front']) : ''; ?>" alt="Uploaded ID Card Front" style="width: 170px;" />
                        </div>
                    </div>    
                </label>    
                </div>
            </div>
            
            <div id="idCardNOKFrontLoader" style="display:none ; margin-top: 10px;">
                    <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
            </div>
            <!-- KIN ID Card front side ENDs -->



            <div class="row">
                <div class="large-12 columns">
                <label class="custom-file-upload">
                    <div class="large-6 columns">                    
                            <img src="img/id-card-back.png" style="width:60px"/>       
                            Next of Kin ID Card Back:
                            <input type="file" id="idCardNOKBackUpload" name="id_card_back" style="display:none" />
                    </div>
                    <div class="large-6 columns right">

                    
                    
                    <input type="hidden" id="idCardNOKBackPath" name="id_card_NOK_back_path" value="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin_id_card_back']) : ''; ?>" alt="Uploaded ID Card Front" style="width: 170px;"/>
                    <div id="idCardNOKBackPreview" style="; margin-top: 10px;">
                        <img id="idCardNOKBackImg" src="<?php echo $isEditing ? htmlspecialchars($customers['next_of_kin_id_card_back']) : ''; ?>" alt="Uploaded ID Card Front" style="width: 170px;" alt="Uploaded ID Card Back" style="width: 170px;" />
                    </div>
                    </div>
                </div>
                </label>
            </div>
            
            <div id="idCardNOKBackLoader" style="display:none ; margin-top: 10px;">
                    <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
            </div>


                    
            <div class="row">
                <div class="large-12 columns">
                    <button type="submit" class="tiny">Submit</button>
                    <button type="submit" onclick="resetForm()" class="tiny alert">Restet</button>
                </div>
            </div>
     
    </div>
    </form>

