     <form name="customer">
         
              <div class="form-group">
                <label for="exampleInputEmail1">Full Name: *</label>
                <input type="text" class="form-control validate" name="fullName" placeholder="John Smith" value="<?php   echo $customer["fullName"]; ?>">
              </div>
         
            <div class="form-group">
                <label for="exampleInputEmail1">Email Address: *</label>
                <input type="text" class="form-control validate" name="email" placeholder="email@domain.com" value="<?php   echo $customer["email"]; ?>">
              </div>
         
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number:</label>
                <input type="text" class="form-control" name="phone" placeholder="" value="<?php   echo $customer["phone"]; ?>">
              </div>
                
            <h3>Address</h3>    
              <div class="form-group">
                <label for="exampleInputEmail1">Address Line 1: *</label>
                <input type="text" class="form-control validate" name="line1" placeholder="Street Address, PO Box, Company Name, C/O" value="<?php   echo $customer["line1"]; ?>">
              </div>    
                
             <div class="form-group">
                <label for="exampleInputEmail1">Address Line 2:</label>
                <input type="text" class="form-control" name="line2" placeholder="Apartments, Suits, Units, etc." value="<?php   echo $customer["line2"]; ?>">
              </div>   
                
             <div class="form-group">
                <label for="exampleInputEmail1">City/Suburb: *</label>
                <input type="text" class="form-control validate" name="city" placeholder=""  value="<?php   echo $customer["city"]; ?>">
              </div>       
                
            <div class="form-group">
                <label for="exampleInputEmail1">State/Province/Region:</label>
                <input type="text" class="form-control" name="state" placeholder="" value="<?php   echo $customer["state"]; ?>">
              </div>  
                
            <div class="form-group">
                <label for="exampleInputEmail1">ZIP/Postal Code:</label>
                <input type="text" class="form-control" name="zip" placeholder=""  value="<?php   echo $customer["zip"]; ?>">
              </div>     
            
         <div id="shippingRegion-error" class="form-group">
             <label for="shippingRegion" >Shipping Region: *</label>    
                <select name="shippingRegion" class="form-control" required="true">
                  <option disabled <?php   if(!($customer['shippingRegion'])){echo "selected";}?>> -- select an option -- </option>
                  <option value="australia" <?php   if($customer["shippingRegion"]== "australia"){echo "selected";} ?>>Australia</option>
                  <option value="newZealand" <?php   if($customer["shippingRegion"]== "newZealand"){echo "selected";} ?>>New Zealand</option>
                  <option value="us" <?php   if($customer["shippingRegion"]== "us"){echo "selected";} ?>>United States</option>
                  <option value="europe" <?php   if($customer["shippingRegion"]== "europe"){echo "selected";} ?>>Europe</option>
                  <option value="restOfTheWorld" <?php   if($customer["shippingRegion"]== "restOfTheWorld"){echo "selected";} ?>>Rest of the World</option>
                </select>
         </div>
  
          <div class="form-group">
                <label for="country" class="country-label" style="display:none">Country:</label>
                <input type="hidden" class="form-control" name="country" placeholder="" value="<?php   echo $customer["country"]; ?>">
          </div>  
                
          <input class="btn btn-default" type="submit" value="Next: Shipping Method">     
</form>   
            
      <div id="mandatory-field-message" class="static-message error">
            Whoops! Please complete all mandatory fields before continuing
     </div>      
        