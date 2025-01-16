<div class="for-print" style="display:none ;">
    <!-- <img src="img/client-logo.png" class="client-logo"/> -->
    <div class="background-image"></div>
    <table style="width:100%;">
      
        <tbody>
            <tr>
                <td>
                    <div class="summary-nest">
                        <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo number_format($total_due_amt); ?></span><small>PKR</small></h2>
                        <p>Total Price</p>
                    </div>

                    <div class="summary-nest">
                        
                        <h2 class="text-black "><?php echo  $percentage; ?>% </h2>
                        <p>Received</p>
                            
                        
                    </div>

                </td>
                <td>
                    <div class="summary-nest">
                        <h2 class="text-black total_value"><span class="counter-up"><?php echo number_format($outstanding); ?></span><small>PKR</small></h2>
                        <p>Total Outstanding</p>
                    </div>

                    <div class="summary-nest">
                        <h2 class="text-black total_value"><span class="counter-up-fast"><?php echo number_format($outstanding); ?></span><small>PKR</small></h2>
                        <p class=""> Total Installments </p>
                    </div>

                </td>
                <td>
                    <div class="summary-nest">
                        <h2 class="text-black total_value"><span class="counter-up mint"><?php echo number_format($total_receipt_amt); ?></span><small>PKR</small></h2>
                        <p class="mint">Total Received</p>
                    </div>
                    <div class="summary-nest">
                        <h2 class="text-black total_value"><span class=" carriot toverdue"></span><small>PKR</small></h2>
                        <p class=""> Total Over Due Amount </p>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

