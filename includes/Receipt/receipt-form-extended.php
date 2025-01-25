<h3 style="text-align:center;margin-top:30px;"><i style='font-size:34px'class="fontello-doc-text tooltipstered"></i>Create Receipt For the Payment</h3>
        <form id="receiptForm">
        <input type="hidden" value="<?= session_id(); ?>" name="session_id" class="session_id"> 
       
            <div class="grid-x grid-padding-x">
                
             
               
                 <div class="medium-12 cell">
                    <label for="amount">Created BY:
                        <input type="text" readonly class="" id="" value="<?= $_SESSION['Name'] ?>" name="issued" placeholder="Enter Amount" required>
                    </label>
                </div>

                <div class="medium-12 cell">
                    <label for="amount">Reqested BY:
                        <input type="text" autocomplete="on" class="" id="" value="" name="reqested_by" placeholder="Enter The Name who requested to create this Receipt " required>
                    </label>
                </div>
                <hr>

                <div class="medium-12 large-12 cell">
                    <div class="row">

                    <div class="columns small-4 medium-4 large-2 left">
    <label for="conditional">CONDITIONAL TOKEN</label>
    <input type="checkbox" id="conditional" value="conditional-token" name="token_type">
</div>

<div class="columns small-4 medium-4 large-2 left">
    <label for="confirm">CONFIRM TOKEN</label>
    <input type="checkbox" id="confirm" value="confirm-token" name="token_type">
</div>
                        
                        

                        <div class="columns small-12 medium-12   large-6 left condition hidden">
                            <label for="condition">CONDITION(if there is a condition)</label>
                            <textarea name="condition" ></textarea>
                        </div>
                    </div>
                </div>


                <!-- <div class="medium-12 large-12 cell">
                    <div class="row">
                        <div class="columns small-4  medium-4 large-2 left">
                            <label for="confirm">Full Payment</label>
                            <input  type="radio" id="confirm" value="full" name="status">
                        </div>
                        
                        <div class="columns small-4 medium-4 large-2 left">
                            <label for="conditional">Partial Payment</label>
                            <input type="radio" checked id="conditional" value="partial" name="status">
                        </div>

                        
                    </div>
                </div> -->


                <div class="medium-12 cell">

                            
                        <div class="row collapse">
                            <label for="amount">Total Amount</label>
                            <div class="small-4 columns">
                                    <input  tabindex="0" type="number" autocomplete="off" class="formattedNumber number-input2" id="number-input2" name="famount" placeholder="Enter Amount" required>
                            </div>
                            <div class="small-8 columns">
                                <input  tabindex="-1" type="text" autocomplete="off" name="amount_in_words" id="" class="postfix words2" placeholder="AMOUNT IN WORDS" />
                            </div>
                        </div>

                        <div class="row collapse">
                            <label for="amount">Rceived Amount</label>
                            <div class="small-4 columns">
                                    <input  type="number" autocomplete="off" class="formattedNumber number-input1" id="number-input1" name="amount" placeholder="Enter Amount" required>
                            </div>
                            <div class="small-8 columns">
                                <input tabindex="-1" type="text" autocomplete="off" id="" name="receive_mount_in_words" class="postfix words1" placeholder="AMOUNT IN WORDS" />
                            </div>
                        </div>

                        
                        


                        <div class="row collapse">
                            <label for="amount">Remaining Amount</label>
                            <div class="small-2 columns">
                                    <input type="number" autocomplete="off"  class="formattedNumber number-input3" id="" name="ramount" placeholder="" required>
                            </div>
                            <div class="small-7 columns">
                                <input tabindex="-1" type="text" autocomplete="off" id="" name="remaining_mount_in_words" class="postfix words3" placeholder="AMOUNT IN WORDS" />
                            </div>

                            <div class="small-3 columns">
                                <input   type="date" autocomplete="off" name="remaining_date" id="remaining_date" class="postfix " placeholder="" />
                            </div>
                        </div>

                        <div class="row collapse">
                            <label for="amount">  Biyanah Amount</label>
                            <div class="small-2 columns">
                                    <input tabindex="-1" type="number" autocomplete="off"  class="formattedNumber number-input4" id="number-input3" name="biyanah" placeholder="" >
                            </div>
                            <div class="small-7 columns">
                                <input tabindex="-1" type="text" autocomplete="off" id="" name="biyanah_in_words" class="postfix words4 " placeholder="AMOUNT IN WORDS" />
                            </div>

                            <div class="small-3 columns">
                                <input tabindex="-1"   type="date" autocomplete="off" name="biyanah_date" id="" class="postfix " placeholder="" />
                            </div>
                        </div>
                    

                    
                </div>
                     
                <div class="medium-12 cell">
                    <label for="payment_method">Payment Method
                        <select id="payment_method" name="method" required>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option selected value="Bank Transfer">Bank Transfer</option>
                            <option  value="Pay Order">Pay Order</option>
                        </select>
                    </label>
                </div>

                   
                <div class="medium-12 cell">
                    <label for="amount">Refrance/Cheq_no
                        <input type="text"  id="ref_cheq_no" name="ref_cheq_no" placeholder="Enter Refrance/Cheq_no" >
                    </label>
                </div>
                        <hr>
                <fieldset>
                        <legend>Customer Details</legend>

                    <div class="medium-12 cell">
                        <input type="hidden" name="customer_id" id="customer_id" >
                    <div class="row">
                        <div class="large-6 columns">
                            <label>Full Name: <small>As Per ID Card</small>
                                <input type="text" id="name"  autocomplete="off" name="name"  placeholder="Full Name" required pattern="[a-zA-Z ]+"  value="" />
                                <div class="spinner hidden"></div>    
                            </label>
                        </div>

                        <div class="large-6 columns">
                            <label>Phone:
                                <input type="text"  autocomplete="off" id="phone" class="phone" autocomplete="none" name="phone" placeholder="92300XXXXXXX" required value="" />
                                <div class="spinner hidden"></div>   </label><div class="spinner hidden"></div>
                            <small class="error" style="display:none">Invalid entry</small>
                        </div>

                        <div class="large-12 columns">
                            <label>ID Card <small>without dashes</small>
                                <input type="text" autocomplete="off" name="id_card" id="id_card" placeholder="ID Card " required value="" />
                               
                            </label> <div class="spinner hidden"></div>
                            <small class="id_card_error error" style="display:none">Invalid entry</small>
                        </div>
                    </div>

                </div>
                <a href=""  style="cursor:pointer" class="new-cus tiny radius button bg-light-green right hidden">Create Customer</a>
                <!-- Info box for the customer -->
                    <div class="box-header bg-light-green hidden customer-results">
                            <div class="box-title ">
                                <span class="text-white text"></span>
                            </div>
                           
                    </div>
                <!-- Info box for the customer END-->
                </fieldset>

                <fieldset>
                        <legend>Property Details</legend>
                        <input type="hidden" name="inventory_id" id="inventory_id" >

                        <div class="large-12 columns">
                            <label>Inventory Name: <small>PLOT/HOUSE/SHOP/OUTLET/PLAZA/Building Number</small>
                                <input type="text" id="inv-name"  autocomplete="off" name="inv-name"  placeholder="PLOT/HOUSE/SHOP/OUTLET/PLAZA NUMBER" required  value="" />
                            </label>
                            
                            <label>Inventory Location: <small>Block/Sector/Floor</small>
                                <input type="text" id="floor"  autocomplete="on" name="floor"  placeholder="Block/Sector/Floor" required  value="" />
                                
                            </label>
                            <div class="row">
                                <div class="large-4 columns">
                                    <label>Type:
                                        <select id="type" name="type">
                                            <option selected value="Plot">Plot</option>
                                            <option value="Hoouse">House</option>
                                            <option value="Shop">Shop</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Floor">floor</option>
                                            <option value="Outlet">Outlet</option>
                                            <option value="Plaza">Plaza</option>
                                            <option value="Building">Building</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="large-4 columns">
                                    <label>Size: 
                                        <input type="text" id="size"  autocomplete="on" name="size"  placeholder="Size with Units"   value="" /> 
                                    </label>
                                </div>

                                <div class="large-4 column">
                                <label>Registration Number
                                <input type="text" name="registration_number" required id="registration_number"></label>
                                </div>
                            </div>
                            <div class="row">
                                

                                <div class="large-3 column">
                                    <label>Possession</label>
                                    <select name="possession" id="possession">
                                        <option>Not Paid</option>    
                                        <option>Paid</option>   
                                    </select>
                                </div>

                                <div class="large-3 column">
                                    <label>Utility</label>
                                    <select name="utility" id="Utility">
                                        <option>Not Paid</option>    
                                        <option>Paid</option>   
                                    </select>
                                </div>


                                <div class="large-3 column">
                                    <label>Extra</label>
                                    <select name="extra" id="extra">
                                        <option>Not Paid</option>    
                                        <option>Paid</option>   
                                    </select>
                                </div>

                                <div class="large-3 column">
                                    <label>Corner</label>
                                    <select name="corner" id="corner">
                                        <option>Not Paid</option>    
                                        <option>Paid</option>   
                                    </select>
                                </div>


                            </div>        
                            <a href=""  style="cursor:pointer" class="new-inv tiny radius button bg-light-green right hidden">Create Inventory</a>
                            <!-- Info box for the customer -->
                                <div class="box-header bg-light-green hidden inventory-results">
                                        <div class="box-title ">
                                            <span class="text-white text"></span>
                                        </div>
                                    
                                </div>
                            <!-- Info box for the customer END-->

                        </div>
                        <div class="row">
                            <div class="columns large-12">
                            <small class="inv_error error" style="display:none">Invalid entry</small>
                            </div>
                        </div>
                       

                </fieldset>        
                
                <div class="medium-12 cell">
                    <label for="description"><i class="fontello-doc"></i>Additional Note
                        <textarea id="description" name="note" placeholder="Enter description"></textarea>
                    </label>
                </div>
                <div class="medium-12 cell ">
                    <input type="submit" class="button receipt-generate" value="Create Receipt">
                </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label class="custom-file-upload">
                                    <div class="large-12 columns ">
                                            <img src="img/payment-invoice.png" style="width:60px"/>
                                            Click to upload Receipt
                                            <input type="file" id="photo_receipt" name="photo_receipt" style="display:none" />
                                            <span class="id_card_error"></span>
                                    </div>
                                    <div class="large-6 columns right">        
                                                            <div id="Photoloader" style="display:none ; margin-top: 10px;">
                                            <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
                                    </div>
                                        <input type="hidden" id="photoPath_receipt" name="photo_path" value="" />
                                        <div id="PhotoPreview" style="margin-top: 10px">
                                            <img id="photoImg" name="file" src="" alt="Uploaded Photo" style="width: 170px;" />
                                        </div>
                                    </div>
                                    </label>
                            </div>        
                        </div>
            </div>
        </form>
        <div id="responseMessage" class="callout" style="display:none;"></div>