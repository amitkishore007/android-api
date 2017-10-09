
<section class="uk-margin-top uk-margin-large-bottom ">
    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 my-balances-div">
        <h3 class="text-center heading">BALANCES, DEPOSITS & WITHDRAWALS</h3>
        <h5 class="text-center sub-heading">Estimated value of holdings: $0.00 USD / 0.00000000 BTC</h5>
        <ul id="component-tab-top" class="uk-switcher balances-table">
                         <li class="uk-active">
                            
                             <table class="uk-table uk-table-striped uk-text-center">
                                 <thead>
                                     <tr>
                                         <th class="uk-text-center"><i class="fa fa-star"></i>  </th>
                                         <th class="uk-text-center">Coin </th>
                                         <th class="uk-text-center">Name </th>
                                         <th class="uk-text-center">Total Balance </th>
                                         <th class="uk-text-center">BTC Value </th>
                                         <th class="uk-text-center">Actions </th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                    <?php if(isset($my_cryptos)): ?>
                                        <?php foreach ($my_cryptos as $crypto):  ?>
                                             <tr id='row_<?php echo $crypto->id; ?>'>
                                                 <td><i class="fa fa-star"></i></td>
                                                 <td><?php echo strtoupper($crypto->crypto_type); ?></td>
                                                 <td><?php echo strtoupper($crypto->crypto_name); ?> </td>
                                                 <td>0.00000000 </td>
                                                 <td>0.00</td>
                                                 <td>

                                                    <a href="javascript:void(0);" class='deposit' data-crypto='<?php echo $crypto->crypto_name; ?>' data-cryptoAddress='<?php echo $crypto->crypto_address; ?>' style="color:#585858;">Deposit</a> |
                                                    <a href="javascript:void(0);"  class='withdrow' data-crypto='' style="color:#585858;">Withdraw</a> 
                                                 </td>
                                             </tr>
                                         <?php endforeach; ?>
                                     <?php endif; ?>

                                    <tr id="actionRow" class="darken" role="row" currency="BCH" style="display: none;">
                    <td colspan="6">
                        <div id="withdrawDiv" class="formArea table" style="display: none;">
                            <div class="formRow meta">
                                You have <span class="num softLink" id="withdrawalBalance"></span>&nbsp;<span class="currency"></span> available for withdrawal. <span class="num" id="withdrawalOnOrders"></span>&nbsp;<span class="currency"></span> is held <a href="/openOrders" class="standard">on orders</a>.
                            </div>
                            <div class="formRow">
                                <label for="withdrawalAddress">Address:</label>
                                <input type="text" name="withdrawalAddress" id="withdrawalAddress" value="">
                            </div>
                            <div class="formRow" id="action_withdrawal_paymentID">
                                <label for="paymentID"><span id="action_withdrawal_paymentID_name">Payment ID</span>:</label>
                                <input type="text" name="paymentID" id="paymentID" value="">
                            </div>
                            <div class="formRow">
                                <label for="withdrawalAmount">Amount:</label>
                                <input type="number" step="any" name="withdrawalAmount" id="withdrawalAmount" value="">
                            </div>
                            <div class="formRow">
                                <div class="matchLabel">Transaction Fee<span id="action_percentFee"></span>:</div>
                                <div id="withdrawalTxFee" class="matchInput textOnly valueNegative"></div>
                            </div>
                            <hr class="seperator">
                            <div class="formRow">
                                <div class="matchLabel">Total:</div>
                                <div class="matchInput textOnly total"><span id="withdrawalTotal">0.00000000</span>&nbsp;<span class="currency"></span></div>
                            </div>
                            <div class="formRow" id="withdrawalNoteRow">
                                <span class="withdrawalNote"></span>
                            </div>
                            <div class="formRow buttons">
                                <button type="submit" class="theButton" id="action_withdrawButton">Withdraw</button>
                            </div>
                        </div>

                        <div id="depositDiv" class="" style="display: block;">
                            <section>
                             
                                <div class="content">
                                    Your <span class="currencyName">---</span> <span class="depositAddressType">Deposit Address</span>
                                    <div class="address">
                                        <div class="qrcode" id="crypto-qrcode" style="display: none;"></div>
                                        <div id="action_depositAddress">-------------------</div>
                                    </div>
                                    <div class="meta">
                                        <a href='javascript:void(0);'  class="matchlink qrcode_link" data-url="action_depositAddress" style="display: inline-block;">Show QR Code</a>
                                    </div>

                                    <div class="depositNote" id="depositNote"><strong class="valueNegative">IMPORTANT: Send only <span class="crypto-coin">BCH </span> to this deposit address.</strong><br>Sending any other currency to this address may result in the loss of your deposit.</div>
                                    
                                  
                                   
                                </div>
                            </section>
                        </div>

                    </td>
                </tr>
                                     
                                 </tbody>
                             </table>
                         </li>
                        
                     </ul>   
    </div>   
	
</section>	