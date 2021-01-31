<!DOCTYPE HTML>
<html>
<head>
<script>var url = "<?= base_url() ?>"; </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<title><?=($title)?$title:"Track (The Rest Accounting Key) || Site"?></title>
<link href="<?= base_url()?>frontend_assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/plugin/owlslider/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/plugin/owlslider/owl.theme.default.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/style.css" rel="stylesheet" type="text/css"/>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link href="<?= base_url()?>frontend_assets/css/fonts.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 
<script src="<?= base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<link rel="shortcut icon" href="<?= base_url() ?>assets/admin/layout4/img/favicon1-16x16.png">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
<link href="<?= base_url()?>frontend_assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/multiselect.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/slimscroll.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url()?>frontend_assets/css/responsive.css" rel="stylesheet" type="text/css"/>
</head>
<script>var url1 ='<?= base_url(); ?>'</script>
<body>
<style>
.breadcrumb>li:after {
    content: "\f105";
    font-family: FontAwesome;
    font-size: 36px;
}
.breadcrumb>li {
    padding-right: 23px;
    position: relative;
}
.breadcrumb>li a {
    color: #a6a9a9;
}
.breadcrumb>li:after {content: "\f105";font-family: FontAwesome;font-size: 24px;position: absolute;line-height: 20px;padding: 0 5px 0 8px;right: 0; top: -2px;color: #a6a9a9;}
.breadcrumb > li + li:before{display:none;}
.breadcrumb>li:last-child:after {content: "";}
.breadcrumb>li:last-child {color: #c8202d;}
.breadcrumb{background: transparent;}
</style>
<?= $this->load->view('elements/landing_header'); ?>
<!--==Breadcrumb-Start==-->
<?php if(@$breadcum!='') { ?>
  <div class="container-fluid">
    <div class="container">
      
        <ul class="page-breadcrumb breadcrumb">
		<?php 

                if(@$breadcum!='')
                {					
                    foreach (@$breadcum as $b_key => $b_val) {
                        if ($b_key != '') { ?>
                            <li class=""> <a href="<?= base_url() . $b_key ?>"><?= $b_val ?></a></li>
                       <?php } else if ($b_key == '') { ?>
                            <li class="active"> <?= $b_val ?> </li>
                       <?php } 
                   }
                        }
            ?>
        </ul>
      
    </div>
  </div>
<?php } ?>
<?= $this->load->view($page) ?> 
<?= $this->load->view('elements/top_landing_footer'); ?>
<?= $this->load->view('elements/landing_footer'); ?>

<!-- Modal -->

<?= $this->load->view('elements/signup'); ?>

<!--=Sign-up-form-End=-->
<?= $this->load->view('elements/login'); ?>

<?= $this->load->view('elements/forgot_password'); ?>
<?= $this->load->view('elements/newbeepopup'); ?>

<script src="<?= base_url()?>frontend_assets/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?= base_url()?>frontend_assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?= base_url()?>frontend_assets/js/bootstrap-select.js"></script>
<script src="<?= base_url()?>frontend_assets/js/multiselet.js" type="text/javascript"></script>
<script src="<?= base_url()?>frontend_assets/js/delivery-step.js" type="text/javascript"></script>
<script src="<?= base_url()?>frontend_assets/js/cart.js" type="text/javascript"></script>
<script src="<?= base_url()?>frontend_assets/js/slimscroll.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
	
 $( ".datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });


$('#chooseFile').bind('change', function () {
  var filename = $("#chooseFile").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#noFile").text("No file chosen..."); 
  }
  else {
    $(".file-upload").addClass('active');
    $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
  }
});

});


$('.image-box').click(function(event) {
  var imgg = $(this).children('img');
  $(this).siblings().children("input").trigger('click');  

  $(this).siblings().children("input").change(function() {
    var reader = new FileReader();

    reader.onload = function (e) {
      var urll = e.target.result;
      $(imgg).attr('src', urll);
      imgg.parent().css('background','transparent');
			imgg.show();
      imgg.siblings('p').hide();
			
    }
    reader.readAsDataURL(this.files[0]);
  }); 
});



</script>
<script src="<?= base_url()?>frontend_assets/plugin/owlslider/owl.carousel.min.js"></script>
<!--==Left-Script==-->
<script>
   ( function( $ ) {
   $( document ).ready(function() {
   $('.cssmenu > ul > li > a').click(function() {
     $('.cssmenu li').removeClass('active');
     $(this).closest('li').addClass('active');  
     var checkElement = $(this).next();
     if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
       $(this).closest('li').removeClass('active');
       checkElement.slideUp('normal');
     }
     if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
       $('.cssmenu ul ul:visible').slideUp('normal');
       checkElement.slideDown('normal');
     }
     if($(this).closest('li').find('ul').children().length == 0) {
       return true;
     } else {
       return false;  
     }    
   });
   
   //Inner sub menu
   $('.cssmenu > ul > li > ul > li > a').click(function() {
     $('.cssmenu > ul li').removeClass('active');
     $(this).closest('li').addClass('active');  
     var checkElement = $(this).next();
     if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
       $(this).closest('li').removeClass('active');
       checkElement.slideUp('normal');
     }
     if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
       $('.cssmenu ul ul ul:visible').slideUp('normal');
       checkElement.slideDown('normal');
     }
     if($(this).closest('li').find('ul').children().length == 0) {
       return true;
     } else {
       return false;  
     }    
   });
   
   });
   } )( jQuery );
</script> 
 <script>

$(document).ready(function(){
	$('.tab').hide();
	 
	$('#tab_1').show();
	
	$('.account-left-section ul li').click(function(){
		id = $(this).attr('id');
		$('.tab').hide();
		$('#tab_'+id).toggle();
	});
});

</script>




<!--==Left-Script==-->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
<script>
$('.cartbtn').click(function() {
    $('#mycart').toggle('slow');
});
</script>
  <script>
            $('.fakeScroll--outside').fakeScroll({
                sensitivity: .6
            });
            $('.fakeScroll--inside').fakeScroll({
                offset       : "10 10",
                sensitivity  : 1.2,
                minBarSizer : 50
            });
        </script>
        <script>
$("#cooking-institute").owlCarousel({
    nav : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      items :4,
	  margin:10, 
         responsive:{
        0:{
            items:1
        },
        480:{
            items:1
        },
        
        568:{
            items:1
        },
        667:{
            items:1
        },
        736:{
            items:3
        },        
        768:{
            items:3
        },
        1000:{
            items:1
        }
        }
  });
  </script>

</body>
</html>
