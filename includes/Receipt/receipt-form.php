<h3 style="text-align:center"><i style='font-size:34px'class="fontello-doc-text tooltipstered"></i>Add Receipt to the Payment</h3>
        <form id="receiptForm">
        <input type="hidden" value="" name="payment-id" class="payment-id"> 
        <input type="hidden" clas="customerId" name='customerId' value="<?= $payments[0]['customer_id'];?>"/>
            <div class="grid-x grid-padding-x">

            <div class="medium-12 cell">
                    <label for="amount">ISSUED BY:
                        <input type="text" readonly class="" id="" value="<?= $_SESSION['Name'] ?>" name="issued" placeholder="Enter Amount" required>
                    </label>
                </div>
                
                <div class="medium-12 cell">
                    <label for="amount">Amount
                        <input type="number" class="formattedNumber" id="amount" name="amount" placeholder="Enter Amount" required>
                    </label>
                </div>
                <div class="medium-12 cell">
                    <label for="payment_method">Payment Method
                        <select id="payment_method" name="method" required>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option selected value="bank_transfer">Bank Transfer</option>
                        </select>
                    </label>
                </div>

                   
                <div class="medium-12 cell">
                    <label for="amount">Refrance/Cheq_no
                        <input type="text"  id="ref_cheq_no" name="ref_cheq_no" placeholder="Enter Refrance/Cheq_no" required>
                    </label>
                </div>
                
                <div class="medium-12 cell">
                    <label for="description"><i class="fontello-doc"></i>Note
                        <textarea id="description" name="note" placeholder="Enter description"></textarea>
                    </label>
                </div>

                <div class="medium-12 cell">
                                        <label for="description"><i class="fontello-doc"></i>Additional Note
                                            <textarea id="description" name="note" placeholder="Enter description"></textarea>
                                        </label>
                                    </div>
                <div class="medium-12 cell ">
                    <input type="submit" class="button tiny " value="Submit">
                </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label class="custom-file-upload">
                                    <div class="large-6 columns ">
                                            <img src="img/payment-invoice.png" style="width:60px"/>
                                            Click to upload Receipt
                                            <input type="file" id="photo" name="photo" style="display:none" />
                                            <span class="id_card_error"></span>
                                    </div>
                                    <div class="large-6 columns right">        
                                                            <div id="Photoloader" style="display:none ; margin-top: 10px;">
                                            <img src="img/preloader.gif" alt="Uploading..." style="width: 100px;" />
                                    </div>
                                        <input type="hidden" id="photoPath" name="photo_path" value="" />
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