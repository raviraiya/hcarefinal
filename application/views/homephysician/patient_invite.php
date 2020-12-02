<style>

.today{border-bottom:1px solid #CCC}

</style>

<div class="col-md-10 container_padding_none">
  	<div class="content_right_dashboard" >
	    <div class="content_right_patients_titel">
	      <h1>Invites</h1>
	    </div>
	    <div class="content_right1_patients">
	      	<div class="appointments_width_block appWidth">
		        <div class="patients_select patients_input_width select-style">
		          <input placeholder="Patient Name" id="pname" name="pname" >
		        </div>
		        <div class="patients_select patients_input_width select-style pemailMainDiv">
		          <input placeholder="Email Address" id="pemail" name="pemail">
		          <a href="javascript:void(0)" class="sendInvite">Invite</a> 
		  		</div>
	      	</div>
	    </div>

	    <div class="content_right_appointments_box">
	      	<center>
	  		<div class="select_button" style="height:10%">
	      		<div class='pendInvitesDiv'>Pending Invites</div>
		     	<div class='btnClassReminder'>
		      		<input class="btn btn-primary check" type="button" value="select all" id='selectAllBtn'/>
		        	<input class="inviteBtn" type="button"  value="Send Reminder To All"  />
		      	</div>
	      	</div>
	      	<table border="1" width="63%" class='tableDiv' ng-controller="hphysican_patients_invite_today_Ctrl">
	      		<tr id="heading">
		      		<td colspan="3">
		      			<div class="settings_box_content"><b> Today </b></div>
		      		</td>
				</tr>

				<tr class='borderBottom' ng-repeat="hpatientinviteTodaydata in hpatientInviteTodaydataObj | limitTo:limit">
					<td>
						<div class="checkboxInvite">
				          	<input type="checkbox" class="cb-element checkboxInviteClass" id="checkboxInviteId1213"/>
				            <label for="checkboxInviteId1213"></label>
		        		</div>
			  			<div class='inviteName'>{{hpatientinviteTodaydata.name}}</div>
					</td>
		          	<td>
		          		<div class='inviteEmail'>{{hpatientinviteTodaydata.email}}</div>
		      		</td>
		          	<td>
		          		<button type="button" class="singleinviteBtn single_invite_button" id="reminder">
		          			REMINDER
	          			</button>
		      		</td>
				</tr>

				<tr>
					<td colspan="3">
						<a href="javascript:void(0)" ng-hide="loadmore" ng-click='loadMore()' class="content_right_patients_load_more">load more</a>	
					</td>
				</tr>
	      	</table>

	      	<table border="1" width="63%" class='tableDiv' ng-controller="hphysican_patients_invite_yest_Ctrl">
				<tr id="heading">
		      		<td colspan="3">
		      			<div class="settings_box_content"><b> Yesterday </b></div>
		      		</td>
				</tr>

				<tr class='borderBottom' ng-repeat="hpatientInviteYesterdaydata in hpatientInviteYesterdaydataObj | limitTo:limit">
					<td>
						<div class="checkboxInvite">
				          	<input type="checkbox" class="cb-element checkboxInviteClass" id="checkboxInviteId1213"/>
				            <label for="checkboxInviteId1213"></label>
		        		</div>
			  			<div class='inviteName'>{{hpatientInviteYesterdaydata.name}}</div>
					</td>
		          	<td>
		          		<div class='inviteEmail'>{{hpatientInviteYesterdaydata.email}}</div>
		      		</td>
		          	<td>
		          		<button type="button" class="singleinviteBtn single_invite_button" id="reminder">
		          			REMINDER
	          			</button>
		      		</td>
				</tr>

				<tr>
					<td colspan="3">
						<a href="javascript:void(0)" ng-hide="loadmore" ng-click='loadMore()' class="content_right_patients_load_more">load more</a>	
					</td>
				</tr>
	      	</table>

	      	<table border="1" width="63%" class='tableDiv' ng-controller="hphysican_patients_invite_less_Ctrl">
				<tr id="heading">
		      		<td colspan="3">
		      			<div class="settings_box_content"><b> More than two days </b></div>
		      		</td>
				</tr>

				<tr  class='borderBottom' ng-repeat="hpatientinvitedataLess in hpatientInviteLessdataObj | limitTo:limit">
					<td>
						<div class="checkboxInvite">
				          	<input type="checkbox" class="cb-element checkboxInviteClass" id="checkboxInviteId1213"/>
				            <label for="checkboxInviteId1213"></label>
		        		</div>
			  			<div class='inviteName'>{{hpatientinvitedataLess.name}}</div>
					</td>
		          	<td>
		          		<div class='inviteEmail'>{{hpatientinvitedataLess.email}}</div>
		      		</td>
		          	<td>
		          		<button type="button" class="singleinviteBtn single_invite_button" id="reminder">
		          			REMINDER
	          			</button>
		      		</td>
				</tr>
				<tr>
					<td colspan="3">
						<a href="javascript:void(0)" ng-hide="loadmore" ng-click='loadMore()' class="content_right_patients_load_more">load more</a>	
					</td>
				</tr>
	      	</table>

	      	<table border="1" width="63%" class='tableDiv'>
		      	<?php /*foreach($invite as $key => $invitation){?>
			      	<tr id="heading">
			      		<td colspan="3">
			      			<div class="settings_box_content"><b><?php echo $key ?></b></div>
			  			</td>
					</tr>
			        <?php $id = 1;?>
			        <?php foreach($invitation as $value){//print_r($value); die(); ?>
				        <tr class='borderBottom'>
				          	<td>
				          		<div class="checkboxInvite">
						          	<input type="checkbox" class="cb-element checkboxInviteClass" id="checkboxInviteId<?php echo $id ?><?php //echo $invitation['ID'] ?>"/>
						            <label for="checkboxInviteId<?php echo $id ?>"></label>
				        		</div>
					  			<div class='inviteName'><?php echo $value['name']?></div>
				  			</td>
				          	<td>
				          		<div class='inviteEmail'><?php echo $value['email'] ?></div>
				      		</td>
				          	<td>
				          		<button type="button" class="singleinviteBtn single_invite_button" id="reminder" rKey="<?php //echo $invitation['ID'] ?>">REMINDER</button>
				      		</td>
				        </tr>
				        <?php $id++;?>
		        	<?php }?>
	      		<?php }*/?>
	      	</table>
	      	</center>
	    </div>
  	</div>
</div>

<script>

$(document).ready(function(){

	var base_url=get_base_url();

	$(".sendInvite").on("click",function(){

		var pname=$("#pname").val();

		var pemail=$("#pemail").val();

		$.ajax({ 

			type:"POST",                                    

			url: base_url+'homephysician/sendInvite',

			data:{pname:pname,pemail:pemail},

			dataType: 'json',      

			success: function(response)

			{

				if(response.success == true){

					bootbox.alert(response.message);

					window.location.reload();

				}else if(response.success == false){

					bootbox.alert(response.message);

					window.location.reload();

				}

			}

		});

	})	





     $('.check:button').click(function(){

          var checked = !$(this).data('checked');

          $('input:checkbox').prop('checked', checked);

          $(this).val(checked ? 'uncheck all' : 'select all' )

          $(this).data('checked', checked);

    });

	

	jQuery("table tr").each(function(index, value){

		if(jQuery(this).attr('id') == 'heading'){

			jQuery(this).prev('tr').css("border-bottom", "none" );

			//alert(jQuery('tr').attr('id'));

		}

	});

	

	$(".inviteBtn").on("click",function(){

		var inviteBtn = $(this);

		var allcheck = $('.check').val();

		var email=[];

		if(allcheck == 'uncheck all')

		{   

			  $(".borderBottom").each(function( i ) {

				 var allEmail = $(this).find(".inviteEmail").html();

				 email.push(allEmail);

				  });

		$.ajax({ 

			type:"POST",                                    

			url: '<?php echo  base_url();?>homephysician/sendemail',

			data:{'email':email},

			dataType: 'json',      

			success: function(response)

			{

				alert(response);

			}

		});

		}

			else if(allcheck == 'select all')

			{

				alert("Please click select all button");

				}

		});

		

		$(".singleinviteBtn").on("click",function(){

			var singleinviteBtn = $(this);

			 var email = singleinviteBtn.closest('td').prev('td').text();

				$.ajax({ 

			type:"POST",                                    

			url: '<?php echo  base_url();?>homephysician/sendemail',

			data:{'email':email},

			dataType: 'json',      

			success: function(response)

			{alert(response);

			}

		});

			});



})

</script>

