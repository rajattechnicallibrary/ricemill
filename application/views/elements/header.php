<style>
			  #loader {
					transition: all .3s ease-in-out;
					opacity: 1;
					visibility: visible;
					position: fixed;
					height: 100vh;
					width: 100%;
					background: #fff;
					z-index: 90000
				}

				#loader.fadeOut {
					opacity: 0;
					visibility: hidden
				}

				.spinner {
					width: 40px;
					height: 40px;
					position: absolute;
					top: calc(50% - 20px);
					left: calc(50% - 20px);
					background-color: #333;
					border-radius: 100%;
					-webkit-animation: sk-scaleout 1s infinite ease-in-out;
					animation: sk-scaleout 1s infinite ease-in-out
				}

				@-webkit-keyframes sk-scaleout {
					0% {
						-webkit-transform: scale(0)
					}
					100% {
						-webkit-transform: scale(1);
						opacity: 0
					}
				}

				@keyframes sk-scaleout {
					0% {
						-webkit-transform: scale(0);
						transform: scale(0)
					}
					100% {
						-webkit-transform: scale(1);
						transform: scale(1);
						opacity: 0
					}
				}
			.form-group  input[type='number'] {
    -moz-appearance:textfield;
	-webkit-appearance:textfield;
	-o-appearance:textfield;
}



		</style>

	  <link href="<?=base_url()?>assets/admin/assets/css/bootstrap.css" rel="stylesheet">
	  <link href="<?=base_url()?>assets/admin/assets/css/chart.css" rel="stylesheet">
	  <link href="<?=base_url()?>assets/admin/assets/css/jqstooltip.css" rel="stylesheet">
	  <link href="<?=base_url()?>assets/admin/assets/css/layout.css" rel="stylesheet">  