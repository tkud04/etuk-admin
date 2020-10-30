
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
	hideElem(["#add-apartment-side-2","#add-apartment-side-3"]);
	hideElem(["#apartment-preference-side-2"]);
	hideElem(["#my-apartment-side-2","#my-apartment-side-3"]);
	hideElem([".review-loading","#host-total-revenue-loading","#host-best-selling-apartments-loading"]);
	
	
	//Init wysiwyg editors
	Simditor.locale = 'en-US';
	let aptDescriptionTextArea = $('#add-apartment-description');
	//console.log('area: ',aptDescriptionTextArea);
	
	
	
    $("a.lno-cart").on("click", function(e) {
    	if(isMobile()){
    	  window.location = "cart";
       }
    })
    
	$("#ca-state").on("change", function(e) {
       // e.preventDefault();
      let s = $('#ca-state').val();
	   if(s == "none"){}
	   else{
		 getDeliveryFee(s);   
	   }
    });
	
	$("#s-form").submit(e => {
       e.preventDefault();
	  
       hideInputErrors("signup");	  
      let fname = $('#s-fname').val(),lname = $('#s-lname').val(),em = $('#s-email').val(),
	      phone = $('#s-phone').val(),p = $('#s-pass').val(),p2 = $('#s-pass2').val();
		  
		  
	   if(fname == "" || lname == "" || em == "" || phone == "" || p == "" || p2 == "" || p != p2){
		   if(fname == "") showElem('#s-fname-error');
		   if(lname == "") showElem('#s-lname-error');
		   if(em == "") showElem('#s-em-error');
		   if(phone == "") showElem('#s-phone-error');
		   if(p == "") showElem('#s-pass-error');
		   if(p2 == "") showElem('#s-pass2-error');
		   if(p != p2) showElem('#s-pass2-error');
	   }
	   else{
		  hideElem("#signup-submit");
		  showElem("#signup-loading");
		  
		 signup({
			 fname: fname,
			 lname: lname,
			 email: em,
			 phone: phone,
			 pass: p,
			 pass_confirmation: p2
		 });   
	   }
    });
	
	$("#l-form").submit(e => {
       e.preventDefault();
	  
       hideInputErrors("login");	  
      let id = $('#l-id').val(),p = $('#l-pass').val();
		  
		  
	   if(id == "" || p == ""){
		   if(id == "") showElem('#l-id-error');
		   if(p == "") showElem('#l-pass-error');
	   }
	   else{
		  hideElem("#login-submit");
		  showElem("#login-loading");
		  
		 login({
			 id: id,
			 pass: p
		 });   
	   }
    });
	
	$("#fp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("forgot-password");	  
      let id = $('#fp-email').val();
		  
		  
	   if(id == ""){
		   if(id == "") showElem('#fp-id-error');
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
		   if(p == "") showElem('#rp-pass-error');
		   if(p2 == "" || p != p2) showElem('#rp-pass2-error');
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
	
	
	//ADD APARTMENT
	$("#add-apartment-side-1-next").click(e => {
       e.preventDefault();
	   
	   if(facilities.length > 0){
		   let aptSidebarFacilitiesHTML = ``;
		   for(let adf = 0; adf < facilities.length; adf++){
			   aptSidebarFacilitiesHTML += `<li>${facilities[adf].id}</li>`;
		   }
		   $('#apt-sidebar-facilities').html(aptSidebarFacilitiesHTML);
	   }
	   
	  hideElem(['#add-apartment-side-1','#add-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-2']);
    });
	$("#add-apartment-side-2-prev").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-2','#add-apartment-side-3']);
	  selectCheckoutSide({side: 1,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-1']);
    });	
	$("#add-apartment-side-2-next").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-1','#add-apartment-side-2']);
	  selectCheckoutSide({side: 3,type: ".add-apartment",content: "ti-check"});
	  aptFinalPreview("add-apartment"); 
	  
	  let aptImages = $(`#add-apartment-images input[type=file]`);
	  let ac = aptCover == "none" ? 0 : aptCover;
	  //Add the cover image to the apt sidebar
	  if (aptImages[ac].files && aptImages[ac].files[0]) {
        let reader = new FileReader();
    
        reader.onload = function(e) {
		  $(`#apt-sidebar-cover`).attr({
	        'src': e.target.result,
	        'width': "236",
	        'height': "161"
	      });
        }
    
        reader.readAsDataURL(aptImages[ac].files[0]); // convert to base64 string
		
		let ii = aptImages.length == 1 ? "image" : "images";
		$('#apt-sidebar-img-count').html(`${aptImages.length} ${ii}`);
     }
	  
	  
	  showElem(['#add-apartment-side-3']);
    });
	$("#add-apartment-side-3-prev").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-1','#add-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-2']);
    });	
	$("#add-apartment-side-3-next").click(e => {
       e.preventDefault();
	   console.log("add apartment submit");
	   
	   //side 1 validation
	   let aptUrl = $('#add-apartment-url').val(), aptName = $('#add-apartment-name').val(), aptAmount = $('#add-apartment-amount').val(),
	   aptMaxAdults = $('#add-apartment-max-adults').val(),aptMaxChildren = $('#add-apartment-max-children').val(),aptDescription = $('#add-apartment-description').val(),
	       aptCheckin = $('#add-apartment-checkin').val(), aptCheckout = $('#add-apartment-checkout').val(),aptIdRequired = $('#add-apartment-id-required').val(),
	       aptChildren = $('#add-apartment-children').val(), aptPets = $('#add-apartment-pets').val(),
		   side1_validation = (aptUrl == "" || aptName == "" || aptMaxAdults == "" || aptMaxChildren == "" || aptAmount < 0 || aptDescription == "" || aptCheckin == "none" || aptCheckout == "none" || aptIdRequired == "none" || facilities.length < 1);	  
	  
       //side 2 validation imgs = $(`${BUUPlist[bc].id}-images-div input[type=file]`);
	   let aptAddress = $('#add-apartment-address').val(), aptCity = $('#add-apartment-city').val(),aptState = $('#add-apartment-state').val(),
	       aptImages = $(`#add-apartment-images input[type=file]`), emptyImage = false,
           side2_validation = (aptAddress == "" || aptCity == "" || aptState == "none");
           
		   for(let i = 0; i < aptImages.length; i++){
			   if(aptImages[i].files.length < 1) emptyImage = true;
		   }
		   
        // console.log("video: ",aptVideo);
         //console.log("images: ",aptImages);
	   
	   if(side1_validation || side2_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   else if(emptyImage){
		   Swal.fire({
			 icon: 'error',
             title: "You have an empty image field."
           })
	   }
	   else if(aptCover == "none"){
		   Swal.fire({
			 icon: 'error',
             title: "Select a cover image."
           })
	   }
	   /**
	   else if(aptVideo[0].size > 15000000){
		   Swal.fire({
			 icon: 'error',
             title: "Video must not be larger than 10MB"
           })
	   }
	   **/
	   else{
		 //let aptName = $('#add-apartment-name').val(),   
		 console.log("final");
		 
		 let ff = [];
		 for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) ff.push(facilities[y]);
		 }
		 
		 let fd =  new FormData();
		 fd.append("url",aptUrl);
		 fd.append("name",aptName);
		 fd.append("max_adults",aptMaxAdults);
		 fd.append("max_children",aptMaxChildren);
		 fd.append("description",aptDescription);
		 fd.append("checkin",aptCheckin);
		 fd.append("checkout",aptCheckout);
		 fd.append("id_required",aptIdRequired);
		 fd.append("amount",aptAmount);
		 fd.append("children",aptChildren);
		 fd.append("pets",aptPets);
		 fd.append("address",aptAddress);
		 fd.append("city",aptCity);
		 fd.append("state",aptState);
		 fd.append("facilities",JSON.stringify(ff));
		 
		 //fd.append("video",aptVideo[0]);
		 fd.append("cover",aptCover);
		 fd.append("img_count",aptImages.length);
		 
		 for(let r = 0; r < aptImages.length; r++)
		 {
		    let imgg = aptImages[r];
			let imgName = imgg.getAttribute("id");
            //console.log("imgg name: ",imgName);			
            fd.append(imgName,imgg.files[0]);   			   			
		 }
		 
		 /**
		 for(let vv of fd.values()){
			 console.log("vv: ",vv);
		 }
		 **/
		  fd.append("_token",$('#tk-apt').val());
		  
		  $('#add-apartment-submit').hide();
		  $('#add-apartment-loading').fadeIn();
		  addApartment(fd);
	   }
    });
	
	//APARTMENT PREFERENCES
	$("#apartment-preference-side-1-next").click(e => {
       e.preventDefault();
	   
	   if(facilities.length > 0){
		   let aptSidebarFacilitiesHTML = ``;
		   for(let adf = 0; adf < facilities.length; adf++){
			   aptSidebarFacilitiesHTML += `<li>${facilities[adf].id}</li>`;
		   }
		   $('#apt-sidebar-facilities').html(aptSidebarFacilitiesHTML);
	   }
	   
	  hideElem(['#apartment-preference-side-1']);
	  selectCheckoutSide({side: 2,type: ".apartment-preferencet",content: "ti-check"});
	  aptPreferencePreview("apartment-preference"); 
	  showElem(['#apartment-preference-side-2']);
    });
	
	$("#apartment-preference-side-2-prev").click(e => {
       e.preventDefault();
	  hideElem(['#apartment-preference-side-2']);
	  selectCheckoutSide({side: 1,type: ".apartment-preference",content: "ti-check"});
	  showElem(['#apartment-preference-side-1']);
    });	
	
	$("#apartment-preference-side-2-next").click(e => {
       e.preventDefault();
	   console.log("update apartment preference submit");
	   
	   //validation
	  let aptMaxAdults = $(`#apartment-preference-max-adults`).val(), aptMaxChildren = $(`#apartment-preference-max-children`).val(),
	  aptAvb = $(`#apartment-preference-avb`).val(), aptAmount = $(`#apartment-preference-amount`).val(),
       aptRating = $(`#apartment-preference-rating`).val(),aptIdRequired = $(`#apartment-preference-id-required`).val(),
	   aptChildren = $(`#apartment-preference-children`).val(), aptPets = $(`#apartment-preference-pets`).val(),
       aptCity = $(`#apartment-preference-city`).val(),aptState = $(`#apartment-preference-state`).val(),
 	  side1_validation = (aptAvb == "none" || aptMaxAdults == "" || aptPets == "" || aptChildren == "" || aptAmount < 0 || aptRating < 0 || aptState == "" || aptIdRequired == "none" || facilities.length < 1);	  

	   
	   if(side1_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }

	   else{
		 //let aptName = $('#add-apartment-name').val(),   
		 console.log("final");
		 
		 let ff = [];
		 for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) ff.push(facilities[y]);
		 }
		 
		 let fd =  new FormData();
		 fd.append("avb",aptAvb);
		 fd.append("max_adults",aptMaxAdults);
		 fd.append("max_children",aptMaxChildren);
		 fd.append("rating",aptRating);
		 fd.append("id_required",aptIdRequired);
		 fd.append("amount",aptAmount);
		 fd.append("children",aptChildren);
		 fd.append("pets",aptPets);
		 fd.append("city",aptCity);
		 fd.append("state",aptState);
		 fd.append("facilities",JSON.stringify(ff));
		 

		  fd.append("_token",$('#tk-apf').val());
		  
		  $('#apartment-preference-submit').hide();
		  $('#apartment-preference-loading').fadeIn();
		  updateApartmentPreference(fd);
	   }
    });
	
	
	
	//MY APARTMENT
	$("#my-apartment-side-1-next").click(e => {
       e.preventDefault();
	   
	   if(facilities.length > 0){
		   let aptSidebarFacilitiesHTML = ``;
		   for(let adf = 0; adf < facilities.length; adf++){
			   aptSidebarFacilitiesHTML += `<li>${facilities[adf].id}</li>`;
		   }
		   $('#apt-sidebar-facilities').html(aptSidebarFacilitiesHTML);
	   }
	  hideElem(['#my-apartment-side-1','#my-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-2']);
    });
	$("#my-apartment-side-2-prev").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-2','#my-apartment-side-3']);
	  selectCheckoutSide({side: 1,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-1']);
    });	
	$("#my-apartment-side-2-next").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-1','#my-apartment-side-2']);
	  selectCheckoutSide({side: 3,type: ".my-apartment",content: "ti-check"});
	  aptFinalPreview("my-apartment");
	  let aptImages = $(`#my-apartment-images input[type=file]`), acc = parseInt(aptCurrentImgCount) + parseInt(aptImages.length);
	  let ii = acc == 1 ? "image" : "images";
		$('#apt-sidebar-img-count').html(`${acc} ${ii}`);
	  showElem(['#my-apartment-side-3']);
    });
	$("#my-apartment-side-3-prev").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-1','#my-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-2']);
    });	
	$("#my-apartment-side-3-next").click(e => {
       e.preventDefault();
	   console.log("my apartment submit");
	   
	   //side 1 validation
	   let aptUrl = $('#my-apartment-url').val(), aptName = $('#my-apartment-name').val(), aptAmount = $('#my-apartment-amount').val(), aptAvb = $('#my-apartment-avb').val(),
	   aptMaxAdults = $('#my-apartment-max-adults').val(),aptMaxChildren = $('#my-apartment-max-children').val(),aptDescription = $('#my-apartment-description').val(),
	       aptCheckin = $('#my-apartment-checkin').val(), aptCheckout = $('#my-apartment-checkout').val(),aptIdRequired = $('#my-apartment-id-required').val(),
	       aptPaymentType = $('#my-apartment-payment-type').val(), aptChildren = $('#my-apartment-children').val(), aptPets = $('#my-apartment-pets').val(),
		   side1_validation = (aptUrl == "" || aptName == "" || aptAvb == "none" || aptMaxAdults == "" || aptMaxChildren == "" || aptAmount < 0 || aptDescription == "" || aptPaymentType == "none" || aptCheckin == "none" || aptCheckout == "none" || aptIdRequired == "none" || facilities.length < 1);	  
	  
       //side 2 validation imgs = $(`${BUUPlist[bc].id}-images-div input[type=file]`);
	   let aptAddress = $('#my-apartment-address').val(), aptCity = $('#my-apartment-city').val(),aptState = $('#my-apartment-state').val(),
	       aptImages = $(`#my-apartment-images input[type=file]`), emptyImage = false,
           side2_validation = (aptAddress == "" || aptCity == "" || aptState == "none");
           
		   for(let i = 0; i < aptImages.length; i++){
			   if(aptImages[i].files.length < 1) emptyImage = true;
		   }
		   
        // console.log("video: ",aptVideo);
         //console.log("images: ",aptImages);
	   
	   if(side1_validation || side2_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   else if(emptyImage){
		   Swal.fire({
			 icon: 'error',
             title: "You have an empty image field."
           })
	   }
	   else if(aptCover == "none"){
		   Swal.fire({
			 icon: 'error',
             title: "Select a cover image."
           })
	   }
	   /**
	   else if(aptVideo[0].size > 15000000){
		   Swal.fire({
			 icon: 'error',
             title: "Video must not be larger than 10MB"
           })
	   }
	   **/
	   else{
		 //let aptName = $('#my-apartment-name').val(),   
		 console.log("final");
		 
		 let ff = [];
		 for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) ff.push(facilities[y]);
		 }
		 
		 let fd =  new FormData();
		 fd.append("url",aptUrl);
		 fd.append("name",aptName);
		 fd.append("max_adults",aptMaxAdults);
		 fd.append("max_children",aptMaxChildren);
		 fd.append("description",aptDescription);
		 fd.append("checkin",aptCheckin);
		 fd.append("checkout",aptCheckout);
		 fd.append("id_required",aptIdRequired);
		 fd.append("payment_type",aptPaymentType);
		 fd.append("amount",aptAmount);
		 fd.append("avb",aptAvb);
		 fd.append("children",aptChildren);
		 fd.append("pets",aptPets);
		 fd.append("address",aptAddress);
		 fd.append("city",aptCity);
		 fd.append("state",aptState);
		 fd.append("facilities",JSON.stringify(ff));
		 
		 //fd.append("video",aptVideo[0]);
		 fd.append("cover",aptCover);
		 fd.append("img_count",aptImages.length);
		 
		 for(let r = 0; r < aptImages.length; r++)
		 {
		    let imgg = aptImages[r];
			let imgName = imgg.getAttribute("id");
            //console.log("imgg name: ",imgName);			
            fd.append(imgName,imgg.files[0]);   			   			
		 }
		 
		 /**
		 for(let vv of fd.values()){
			 console.log("vv: ",vv);
		 }
		 **/
		  fd.append("_token",$('#tk-apt').val());
		  fd.append("apartment_id",$('#tk-xf').val());
		  
		  $('#my-apartment-submit').hide();
		  $('#my-apartment-loading').fadeIn();
		  updateApartment(fd);
	   }
    });	
	
	
	//APARTMENTS
	$('#guest-apt-sidebar-submit').click(e => {
		e.preventDefault();

		let aptMaxAdults = $(`#guest-apt-sidebar-max-adults`).val(), aptMaxChildren = $(`#guest-apt-sidebar-max-children`).val(),
		aptAvb = $(`#guest-apt-sidebar-avb`).val(), aptAmount = $(`#guest-apt-sidebar-amount`).val(),
       aptRating = $(`#guest-apt-sidebar-rating`).val(),aptIdRequired = $(`#guest-apt-sidebar-id-required`).val(),
	   aptChildren = $(`#guest-apt-sidebar-children`).val(), aptPets = $(`#guest-apt-sidebar-pets`).val(),
       aptCity = $(`#guest-apt-sidebar-city`).val(),aptState = $(`#guest-apt-sidebar-state`).val(),  facilities = $('input.guest-apt-sidebar-facility:checked'),
	   validation = (facilities.length < 1 || aptState == "");
	   
		console.log(facilities);
		
		if(validation){
			  Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
		}
		else{
			let ff = [];
			for(let i = 0; i < facilities.length; i++){
				let f = facilities[i];
				console.log(f);
				ff.push($(f).attr('data-tag'));
			}
			let dt = {
				avb: aptAvb,
				city: aptCity,
				state: aptState,
				max_adults: aptMaxAdults,
				max_children: aptMaxChildren,
				amount: aptAmount,
				id_required: aptIdRequired,
				children: aptChildren,
				pets: aptPets,
				facilities: ff,
				rating: aptRating
			};
			search(dt);
		}
			
	});
	
	$('#landing-search-btn').click(e => {
		e.preventDefault();
		console.log("landing search");
		
		let loc = $('#landing-search-location').val(), dts = $('#landing-search-dates').val(),
		    kids = $('#landing-search-kids').val(), adults = $('#landing-search-adults').val();
		
		if(loc == "" || parseInt(adults) < 1){
			let hh = "";
			
			if(loc == "") hh = "Enter your location.";
			if(parseInt(adults) < 1) hh = "Enter the number of adults.";
			Swal.fire({
			 icon: 'error',
             title: `${hh}`
           });
		}
		else{
			 landingSearchDT.city = loc;
			 landingSearchDT.state = loc;
			 landingSearchDT.kids = kids;
			 landingSearchDT.adults = adults;
			
			$('#landing-search-dt').val(JSON.stringify(landingSearchDT));
	        $('#landing-search-form').submit();
		}
		
	});
	
	
	//APARTMENT
	$('#apartment-hostchat-btn').click(e => {
		e.preventDefault();
		scrollTo({'id': "#apartment-hostchat"});
			
	});
	
	$('#apt-chat-btn').click(e => {
		e.preventDefault();
		let name = $('#apt-message-name').val(), em = $('#apt-message-email').val(),
   		    msg = $('#apt-chat-msg').val(), aptID = $('#apt-id').val(),
			aptGXF = $('#apt-gxf').val(), aptGSB = $('#apt-gsb').val();
		
		if(name == "" || em == "" || msg == ""){
			Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           });
		}
		else{
			 $('#apt-chat-btn').hide();
		  $('#apt-chat-loading').fadeIn();
		   let fd =  new FormData();
		   fd.append("_token",$('#tk-apt-chat').val());
		   fd.append("name",name);
		   fd.append("email",em);
		   fd.append("apartment_id",aptID);
		   fd.append("gsb",aptGSB);
		   fd.append("gxf",aptGXF);
		   fd.append("msg",msg);
			sendMessage(fd,"apt-chat");
		}
			
	});
	
	$('#apartment-add-first-review-btn').click(e => {
		e.preventDefault();
		scrollTo({'id': "#apartment-add-review"});
			
	});
	
	$('#apartment-add-review-btn').click(e => {
		e.preventDefault();
		
		/**
		 <input type="hidden" id="apartment-add-review-svc" name="svc" value="0">
							   <input type="hidden" id="apartment-add-review-sec" name="sec" value="0">
							   <input type="hidden" id="apartment-add-review-loc" name="loc" value="0">
							   <input type="hidden" id="apartment-add-review-cln" name="cln" value="0">
							   <input type="hidden" id="apartment-add-review-cmf" name="cmf" value="0">
		**/
		
		let msg = $('#apartment-add-review-msg').val();

        let validation = sec < 1 || svc < 1 || loc < 1 || cln < 1 || cmf < 1 || msg == "";
		
        if(validation){
			Swal.fire({
			 icon: 'error',
             title: "Please fill all required fields."
           });
		}
        else{
			$('#apartment-add-review-sec').val(sec);
			$('#apartment-add-review-svc').val(svc);
			$('#apartment-add-review-loc').val(loc);
			$('#apartment-add-review-cln').val(cln);
			$('#apartment-add-review-cmf').val(cmf);
			$('#apartment-add-review-form').submit();
		}		
	});
	
	$('#apartment-book-now-btn').click(e => {
		e.preventDefault();
		
		/**let msg = $('#apartment-add-review-msg').val();

        let validation = sec < 1 || svc < 1 || loc < 1 || cln < 1 || cmf < 1 || msg == "";
		**/
		let validation = false;
		
        if(validation){
			Swal.fire({
			 icon: 'error',
             title: "Please fill all required fields."
           });
		}
        else{
			$('#add-to-cart-form').submit();
		}		
	});
	
	
	//CHAT
	$('#message-reply-btn').click(e => {
		e.preventDefault();
		
		let msg = $('#message-reply-msg').val();
		
		if(msg == ""){
			Swal.fire({
			 icon: 'error',
             title: "Your reply cannot be empty."
           });
		}
		else{
			 $('#message-reply-btn').hide();
		    $('#message-reply-loading').fadeIn();

		   let fd =  new FormData();
		   fd.append("_token",$('#tk-message').val());
           fd.append("apartment_id",aapt);
		   fd.append("gsb",hhxf);
		   fd.append("gxf",ggxf);
		   fd.append("msg",msg);
			sendMessage(fd,"message-reply");
	
		}
		
			
	});
	
	//CHECKOUT
	$('#checkout-pay-btn').click(e => {
		e.preventDefault();
		
		console.log("pay btn");
		
		let pt = $('#checkout-payment-type').val(), ref = $('#checkout-ref').val();
		
		if(pt == "none"){
			Swal.fire({
			 icon: 'error',
             title: "Select a payment type."
           });
		}
		else{
			 payCard({ref: ref,pt: pt});
		}
		
	});


	//ANALYTICS
	$('#host-total-revenue-btn').click(e => {
		e.preventDefault();
		
		let m = $('#host-total-revenue-month').val(), y = $('#host-total-revenue-year').val();
		
		if(m == "none" || y == ""){
			Swal.fire({
			 icon: 'error',
             title: "Select a period."
           });
		}
		else{
			 $(`#host-total-revenue-loading`).fadeIn();
			 getAnalytics({type: "total-revenue",month: m,year: y});
		}
		
	});
	
	$('#host-best-selling-apartments-btn').click(e => {
		e.preventDefault();
		
		let m = $('#host-best-selling-apartments-month').val(), y = $('#host-best-selling-apartments-year').val();
		
		if(m == "none" || y == ""){
			Swal.fire({
			 icon: 'error',
             title: "Select a period."
           });
		}
		else{
			 $(`#host-best-selling-apartments-loading`).fadeIn();
			 getAnalytics({type: "best-selling-apartments",month: m,year: y});
		}
		
	});
	
	$('#checkout-book-btn').click(e => {
		e.preventDefault();
		console.log("book btn");
		/**
		let msg = $('#message-reply-msg').val();
		
		if(msg == ""){
			Swal.fire({
			 icon: 'error',
             title: "Your reply cannot be empty."
           });
		}
		else{
			 $('#message-reply-btn').hide();
		    $('#message-reply-loading').fadeIn();

		   let fd =  new FormData();
		   fd.append("_token",$('#tk-message').val());
           fd.append("apartment_id",aapt);
		   fd.append("gsb",hhxf);
		   fd.append("gxf",ggxf);
		   fd.append("msg",msg);
			sendMessage(fd,"message-reply");
	
		}
		
	**/
	});
	
});
