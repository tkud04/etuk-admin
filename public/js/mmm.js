
	let  toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];
	

$(document).ready(function() {
    "use strict";
	hideInputErrors(["signup","login","forgot-password","reset-password","oauth-sp"]);
	hideElem(["#signup-loading","#signup-finish",
	          "#login-loading","#login-finish",
			  "#fp-loading","#fp-finish",
			  "#rp-loading","#rp-finish",
			  "#apt-chat-loading","#apt-chat-finish","#message-reply-loading"
			  ]);
	
	/**
	//Init wysiwyg editors
	Simditor.locale = 'en-US';
	let aptDescriptionTextArea = $('#add-apartment-description');
	//console.log('area: ',aptDescriptionTextArea);
	**/
	
	
    $("a.lno-cart").on("click", function(e) {
    	if(isMobile()){
    	  window.location = "cart";
       }
    })
    
	
	$("#l-form-btn").click(e => {
       e.preventDefault();
	  
       hideInputErrors("login");	  
      let id = $('#login-id').val(),p = $('#login-password').val();
		  
		  
	   if(id == "" || p == ""){
		  Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           });
	   }
	   else{
		 $('#l-form').submit();   
	   }
    });
	
	$("#fp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("forgot-password");	  
      let id = $('#fp-email').val();
		  
		  
	   if(id == ""){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill in your email address."
           });
	   }
	   else{
		  hideElem("#fp-submit");
		  showElem("#fp-loading");
		  
		 fp({
			 email: id
		 });   
	   }
    });
	
	$("#rp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("reset-password");	  
      let id = $('#acsrf').val(), p = $('#rp-pass').val(), p2 = $('#rp-pass2').val();
		  
		  
	   if(p == "" || p2 == "" || p != p2){
		   let hh = "default";
		   if(p == "") hh = "Enter your new password.";
		   if(p2 == "" || p != p2) hh = "Passwords must match.";
		   
		    Swal.fire({
			 icon: 'error',
             title: hh
           });
	   }
	   else{
		  hideElem("#rp-submit");
		  showElem("#rp-loading");
		  
		 rp({
			 id: id,
			 pass: p
		 });   
	   }
    });
	
	$("#osp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("oauth-sp");	  
      let p = $('#osp-pass').val(), p2 = $('#osp-pass2').val();
		  
		  
	   if(p == "" || p2 == "" || p != p2){
		   if(p == "") showElem('#osp-pass-error');
		   if(p2 == "" || p != p2) showElem('#osp-pass2-error');
	   }
	   else{
		 $('#osp-form').submit();   
	   }
    });
	
	
	//EDIT USER
	$("#user-form-btn").click(e => {
       e.preventDefault();
	   
	   //side 1 validation
	   let fname = $('#user-fname').val(), lname = $('#user-lname').val(),email = $('#user-email').val(),
	       phone = $('#user-phone').val(), role = $('#user-role').val(),status = $('#user-status').val(),
		   side1_validation = (fname == "" || lname == "" || email == "" || phone == "" || role == "none" || status == "none");	  
	  
       
	   if(side1_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   else{
		  $('#user-form').submit();		  
	   }
    });
	
	//ADD PERMISSIONS
	$("#ap-form-btn").click(e => {
       e.preventDefault();
	   
	   //validation
	   let apSelected = false;
	   
	   for(let i = 0; i < apTags.length; i++){
		   apSelected = apSelected || apTags[i].selected;
	   }
	    console.log(apSelected);
	   let side1_validation = !apSelected;	  
	 
       
	   if(side1_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Select a permission"
           })
	   }
	   else{
		   $('#ap-pp').val(JSON.stringify(apTags));
		  $('#ap-form').submit();		  
	   }
	   
	   
    });
	
	//ADD PLUGIN
	$("#apl-form-btn").click(e => {
       e.preventDefault();
	   
	   //validation
	   let aplName = $('#apl-name').val(), aplValue = $('#apl-value').val(), aplStatus = $('#apl-status').val(),
	       validation = (aplName == "" || aplValue == "" || aplStatus == "none");
	   
	   
       
	   if(validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all required fields."
           })
	   }
	   else{
		  $('#apl-form').submit();		  
	   }
	   
	   
    });
	
});
