<table style="font-size:10px;">
		<tbody>
		<?php //pr($result_pdf)?>
			<tr>
				<td align="right">Tax Invoice</td>
			</tr>
			<tr>
				<td align="left">KYI Soft Solutions Pvt Ltd</td>
			</tr>
			<tr>
				<td>
					<table>
						<tbody>
							<tr>
								<td colspan="5">
									<table>
										<tbody>
											<tr><td>B-58, 2nd Floor, Sector-64, Noida,<br>(U.P.) 201301</td></tr>
											<tr><td><strong>contact:</strong> +91 9650539090</td></tr>
											<tr><td><strong>Telephone: </strong> 0120-4268187</td></tr>
											<tr><td><strong>Email:</strong>accounts@kyisolutions.com </td></tr>
											<tr><td><strong>Website:</strong> www.kyisolutions.com</td></tr>
											<tr><td><strong>GSTIN: 09AAGCK4564L1Z0</strong></td></tr>
											<tr><td><strong>PAN NO.: AAGCK4564L</strong></td></tr>
										</tbody>
									</table>
								</td>
								<td colspan="5">
									<table>
										<tbody>
											<tr>
												<td style="border-top:1px solid #000;border-left:1px solid #000;"><strong> Invoice Number </strong></td>
												<td style="border-top:1px solid #000;border-right:1px solid #000;" align="right"> KYI/SOFT/2017-18/00<?php echo$result_pdf->id; ?> </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"><strong> Invoice Date </strong></td>
												<td style="border-right:1px solid #000;" align="right"><?php echo view_date_format($result_pdf->invoice_create_date)?></td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;" bgcolor="#808080" style="color:#fff;"> Invoice To: </td>
												<td style="border-right:1px solid #000;" bgcolor="#808080" style="color:#fff;" align="right">&nbsp;</td>
											</tr>
											
											<tr>
												<td style="border-left:1px solid #000;"><strong> Company Name </strong> </td>
												<td style="border-right:1px solid #000;" align="right"><?php echo ucfirst($result_pdf->client_name); ?></td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> Address </td>
												<td style="border-right:1px solid #000;" align="right"><?php echo ucfirst($result_pdf->client_address); ?></td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;">&nbsp; </td>
												<td style="border-right:1px solid #000;" align="right">&nbsp;</td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"><strong> GSTIN </strong></td>
												<td style="border-right:1px solid #000;" align="right"><?php echo $result_pdf->gstin; ?></td>
											</tr>
											<!--<tr>
												<td style="border-left:1px solid #000;"> State : </td>
												<td style="border-right:1px solid #000;" align="right">&nbsp;</td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;border-bottom:1px solid #000"><strong> State Code : </strong></td>
												<td style="border-right:1px solid #000;border-bottom:1px solid #000" align="right">&nbsp;</td>
											</tr>-->
										</tbody>
									</table>
								</td>
							</tr>
							

							<tr>
								<td border="1" width="32" height="30"> S. No </td>
								<td border="1" width="150"> Particulars </td>
								<td border="1" width="80"> HSN/SAC Code </td>
								<td border="1" width="50"> UOM </td>
								<td border="1" width="120"> Rate </td>
								<td border="1" width="191"> Amount </td>
							</tr>
							<tr>
								<td border="1" height="25"> 1 </td>
								<td border="1"> SMS Campaigning </td>
								<td border="1"> 998361 </td>
								<td border="1"> <?php  $price = $result_pdf->price;
														$amount = $result_pdf->total_balance;
														$uom = $amount/$price;
														echo round($uom);
								?></td>
								<td border="1"> <?php echo $result_pdf->price?> </td>
								<td border="1"> <?php echo $result_pdf->total_balance ?> </td>
							</tr>
							<tr>
								<td border="1" height="25"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
							</tr>
							<tr>
								<td border="1" height="25"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
							</tr>
							<tr>
								<td border="1" height="25"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
							</tr>
							<tr>
								<td border="1" height="25"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
								<td border="1"> &nbsp; </td>
							</tr>
							
							<tr>
								<td colspan="4">
									<table>
										<tbody>
											<tr>
												<td colspan="3">  </td>
											</tr>
											<tr>
												<td colspan="2">
													<table>
														<tbody>
															<tr>
																<td border="1" bgcolor="#808080" height="20" style="color:#fff;">
																	Amount in Words :
																</td>
															</tr><tr>
																<td border="1">
																<?php 
																$igst = $result_pdf->tax_amount;
																$amount = $result_pdf->total_balance;
																$igst_amount = ($amount * $igst)/100;
																$total_amount_after_gst = $igst_amount + $amount;
																
																
																@$rst = getIndianCurrency($total_amount_after_gst);echo "<b>".$rst."</b>"; ?>
																	
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td colspan="2">
													<table>
														<tbody>
															<tr>
																<td border="1" bgcolor="#808080" height="20" style="color:#fff;">
																	Banking Details
																</td>
															</tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;">	Bank: xxx</td></tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;" border="">	Account Type:&nbsp;&nbsp; Current Account </td></tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;" border="">	Account Number:xxx </td></tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;border-bottom:1px solid #000;">	IFSC Code: xxx</td></tr>
														</tbody>
													</table>
												</td>
											</tr>
											
											<tr> <td> &nbsp;</td> </tr>
											
											<tr>
												<td colspan="2">
													<table>
														<tbody>
															<tr>
																<td border="1" bgcolor="#808080" height="20" style="color:#fff;">
																	T & C
																</td>
															</tr><tr>
																<td border="1">
																	All disputes are subject to GB Nagar Court Jurisdiction.
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr> <td> &nbsp; </td></tr>
											<tr>
												<td colspan="2">
													<table>
														<tbody>
															<tr>
																<td border="1" bgcolor="#808080" height="20" style="color:#fff;">
																	Invoice Status
																</td>
															</tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;"> Invoice Status: <?php echo $result_pdf->invoice_status ?> </td></tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;" border="">	Invoice Due Date:<?php echo view_date_format($result_pdf->invoice_due_date) ?> </td></tr>
															<tr><td style="border-left:1px solid #000; border-right:1px solid #000;border-bottom:1px solid #000;">	Payment Date:<?php echo view_date_format($result_pdf->payment_date) ?> </td></tr>
														</tbody>
													</table>
												</td>
											</tr>
											
										</tbody>
									</table>
								</td>
								<td colspan="2">
									<table>
										<tbody>
											<tr>
												<td style="border-top:1px solid #000;border-left:1px solid #000;"> Subtotal </td>
												<td style="border-top:1px solid #000;border-right:1px solid #000;" align="right"> <?php echo "Rs.". $result_pdf->total_balance ."/-"?> </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> Discount </td>
												<td style="border-right:1px solid #000;" align="right"> Rs. 0.00</td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> Total Amount Before GST </td>
												<td style="border-right:1px solid #000;" align="right"> <?php echo "Rs.". $result_pdf->total_balance ."/-"?> </td>
											</tr>
											
											<tr>
												<td style="border-left:1px solid #000;"> CGST @ <?php echo  $result_pdf->tax_amount/2?> %  </td>
												<td style="border-right:1px solid #000;" align="right"> <?php
												$cgst = $result_pdf->tax_amount/2;
												$amount = $result_pdf->total_balance;
												$cgst_amount = ($amount * $cgst)/100;
												echo "Rs." .$cgst_amount ."/-" ;
												?></td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> SGST @ <?php echo  $result_pdf->tax_amount/2?> % </td>
												<td style="border-right:1px solid #000;" align="right"> <?php
												$scgst = $result_pdf->tax_amount/2;
												$amount = $result_pdf->total_balance;
												$scgst_amount = ($amount * $scgst)/100;
												echo "Rs." .$scgst_amount ."/-";
												?> </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> IGST @ <?php echo  $result_pdf->tax_amount?> % </td>
												<td style="border-right:1px solid #000;" align="right"> <?php
												$igst = $result_pdf->tax_amount;
												$amount = $result_pdf->total_balance;
												$igst_amount = ($amount * $igst)/100;
												echo "Rs." .$igst_amount ."/-";
												?> </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> GST Payble on Reverse Charge </td>
												<td style="border-right:1px solid #000;" align="right"> &nbsp; </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> &nbsp; </td>
												<td style="border-right:1px solid #000;" align="right">&nbsp;</td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> Total Amount after GST </td>
												<td style="border-right:1px solid #000;" align="right"> <?php $total_amount_after_gst = $igst_amount + $amount;
												echo "Rs.".$total_amount_after_gst ."/-";?> </td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;"> &nbsp; </td>
												<td style="border-right:1px solid #000;" align="right">&nbsp;</td>
											</tr>
											<tr>
												<td style="border-left:1px solid #000;border-bottom:1px solid #000"> Rounded Off Value </td>
												<td style="border-right:1px solid #000;border-bottom:1px solid #000" align="right"> <?php echo "Rs.".round($total_amount_after_gst)."/-";?> </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td> &nbsp; </td>
												<td> &nbsp; </td>
											</tr>
											<tr>
												<td colspan="2"><center> For KYI Soft Solutions Pvt Ltd </center></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							
							
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
		</table>

	