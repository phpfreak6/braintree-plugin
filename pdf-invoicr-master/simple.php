<?php
include('phpinvoice.php');
$invoice = new phpinvoice();
  /* Header Settings */
  
  $invoice->setLogo("images/home_logo.png");
  $invoice->setColor("#677a1a");
  // $invoice->setType("Simple Invoice");
  $invoice->setReference("55033645");
  $invoice->setDate(date('d-m-Y',time()));
  $invoice->setDue(date('d-m-Y',strtotime('+3 months')));
  $invoice->hide_tofrom();
  /* Adding Items in table */
  $invoice->addItem("AMD Athlon X2DC-7450","",1,false,580,false);
  /* Add totals */
  $invoice->addTotal("Total",9460);
  /* Render */
  $invoice->render('invoice.pdf','D'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
?>