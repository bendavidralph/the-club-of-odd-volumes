<?php 
    $styleSheets = ["cms"];
    $pageTitle = "Size Charts";
    include ('php/modules/_header.php');
?>




<main class="container">
    
    <!-- Large modal -->

<?php

    $sizeModal = ["baby", "kid", "tee", "jumper","tote","homeware"];
    foreach($sizeModal as $value){
?>  
  <div class="modal fade <?php echo $value; ?>-size-modal" tabindex="-1" role="dialog" aria-labelledby="This is a label">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <section class="row">
          <img src="assets/images/sizing/<?php echo $value; ?>.jpg" class="img-responsive"   >
        </section>
    </div>
  </div>
</div>
</div>

<?php
                                          
    }
     
        
 
?>




    <h1>SIZE CHARTS</h1>
    
    <section id="size-thumbnail-wrapper" class="row">
    
        <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".baby-size-modal"><img src="assets/images/sizing/thumbnails/baby.jpg" class="img-responsive"></div>
        <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".kid-size-modal"><img src="assets/images/sizing/thumbnails/kids.jpg" class="img-responsive"></div>
        <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".tee-size-modal"><img src="assets/images/sizing/thumbnails/tee.jpg" class="img-responsive"></div>
        <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".jumper-size-modal"><img src="assets/images/sizing/thumbnails/jumper.jpg" class="img-responsive"></div>
         <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".tote-size-modal"><img src="assets/images/sizing/thumbnails/tote.jpg" class="img-responsive"></div>
        <div class="col-xs-12 col-sm-6 col-md-2" data-toggle="modal" data-target=".homeware-size-modal"><img src="assets/images/sizing/thumbnails/homewares.jpg" class="img-responsive"></div>
        
    
    </section>
    
    <hr>
    <h1>RETURNS</h1>    
        
    <section id="returns" class="row">
        
        <p>All purchases are final.</p>
        <br>
        <p>Both custom designs and online shop purchases are printed-to-order. 
        Yes, thats right, once you place an order we fire up the printed and make it just for you. 
        Because of this we do not hold printed stock and therefore can not accept returns 
        for the wrong size / change of mind. </p>
        <br>
        <p>Please select your size and design carefully. </p>
        <br>
        <p>Contact shop@theclubofoddvolumes.com if you have any questions / 
        faulty products and we can consider appropriate solutions on a case-by-case basis.</p>
        
    </section>    
    
    
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>